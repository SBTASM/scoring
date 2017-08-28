<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 25.07.2017
 * Time: 11:02
 */

namespace app\controllers;

use app\models\Domain;
use app\models\Group;
use app\models\Page;
use app\models\Project;
use app\models\Scoring;
use app\models\Visitor;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class ScoringController extends Controller
{
    public function actionIndex(){

        $transaction = \Yii::$app->db->beginTransaction();

        $data = \Yii::$app->request->get();
        $scoring = new Scoring();
        $user_ip = isset($data['geo_ip']) ? $data['geo_ip'] : NULL;

        if(is_null($data['geo_ip'])){
            throw new NotFoundHttpException(\Yii::t('app', 'Invalid ip address!!!'));
            return;
        }

        $project = Project::find()->where(['key' => $data['project_key']])->one();
        if(is_null($project)){
            throw new NotFoundHttpException(\Yii::t('app', 'Invalid project key!!!'));
            return;
        }

        //Костиль
        if(!isset($data['visitor_key'])) return;
        //Костиль

        $visitor = Visitor::find()->where(['key' => $data['visitor_key'], 'ip' => $user_ip])->one();
        if(is_null($visitor)){
            $visitor = new Visitor(['key' => $data['visitor_key']]);
            $visitor->project_id = $project->id;
            $visitor->ip = $user_ip;
            $scoring->read_write = 1;
            $visitor->save();
        }else{
            $scoring->read_write = 0;
        }


        $domain_name = $data['host_name'];
        $domain = Domain::find()->where(['name' => $domain_name])->one();
        if(is_null($domain)){
            $domain = new Domain(['name' => $domain_name, 'project_id' => $project->id]);
            $domain->save();
        }

        $page_name = $data['page_on'];
        $page = Page::find()->where(['name' => $page_name, 'domain_id' => $domain->id])->one();
        if(is_null($page)){
            $page = new Page([
                'name' => $page_name,
                'domain_id' => $domain->id,
                'rating' => '1',
            ]);
            $page->save();
        }else{
            $page->rating = (string)((int)$page->rating + 1);
            $page->save();
        }

        foreach ($data as $name => $value){
            if($scoring->hasAttribute($name)){
                $scoring->$name = $value;
            }
        }

        $scoring->project_id = $project->id;
        $scoring->visitor_id = $visitor->id;
        $scoring->domain_id = $domain->id;
        $scoring->created_at = time();
        $scoring->updated_at = $scoring->created_at;

        $groups = $page->getGroups()->one();
        if(!is_null($groups)) {
            $group = $groups->getGroup()->one();
            $this->attachRules($scoring, $group);
        }

        if(!$scoring->save()){
            $transaction->rollBack();
            return $this->serializeData(['errors' => $scoring->getErrors()]);
        }

        $transaction->commit();
        return $this->serializeData(['result' => true]);
    }

    /**
     * @param $scoring Scoring
     * @param $group Group
     */
    protected function attachRules($scoring, $group){
        if(is_null($group)) return;

        $rules = array();
        if(strlen($group->rules) !== 0){ $rules = explode(':', $group->rules); }


        foreach ($rules as $rule){
            array_push($rules, new $rule);
            $scoring->attachBehavior($rule::className(), new $rule);
        }
    }
}