<?php

namespace app\controllers;

use app\models\AddRuleForm;
use app\models\Domain;
use app\models\Page;
use app\models\PageGroup;
use app\models\Project;
use app\models\RulesSettingsForm;
use app\models\SetPageGroupForm;
use Yii;
use app\models\Group;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\base\Controller;
use yii\data\ArrayDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
{
    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Group::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Group model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $addRuleModel = new AddRuleForm();

        return $this->render('view', [
            'model' => $model,
            'addRuleModel' => $addRuleModel
        ]);
    }
    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Group();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/group/view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $addRuleModel = new AddRuleForm();
        $rules = array();
        $forms = array();


        if(strlen($model->rules) !== 0){
            $rules = explode(':', $model->rules);
        }

        foreach ($rules as $rule){
            array_push($forms, new RulesSettingsForm([
                'ruleName' => $rule,
                'description' => (new $rule)->description,
                'group' => $model
            ]));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Model::loadMultiple($forms, \Yii::$app->request->post());
            foreach ($forms as $fs){
                $fs->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'forms' => $forms,
                'addRuleModel' => $addRuleModel
            ]);
        }
    }
    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionAddRule($id){
        $group = Group::find()->where(['id' => $id])->one();
        $form = new AddRuleForm();

        if($form->load(\Yii::$app->request->post()) && $form->validate()){
            $rules = explode(':', $group->rules);
            if(strlen($group->rules) === 0){ $rules = array(); }
            array_push($rules, $form->ruleName);
            $rules = array_unique($rules);
            $group->rules = implode(':', $rules);
            $group->save();

            return $this->redirect(['/group/update', 'id' => $id]);
        }

        return $this->render('add-rule', ['model' => $form]);
    }
    public function actionDeleteRule($id, $name){
        $group = $this->findModel($id);

        $this->deleteRule($id, $name);

        return $this->redirect(['group/update', 'id' => $id]);
    }
    protected function deleteRule($group_id, $rule_name){
        $rules = array();
        $group = $this->findModel($group_id);

        if(strlen($group->rules) !== 0){ $rules = explode(':', $group->rules); }

        $rules = array_diff($rules, [$rule_name]);
        $group->rules = implode(':', $rules);
        $group->save();
    }
    public function actionSetGroup(){
        $form = new SetPageGroupForm();
        $domains = array(); $pages = array();
        $groups = ArrayHelper::map(Group::find()->all(), 'id', 'name');

        if(\Yii::$app->request->isPjax && $form->load(\Yii::$app->request->post())) {
            $domains = ArrayHelper::map(Domain::findAll(['project_id' => $form->projects]), 'id', 'name');
            $pages = ArrayHelper::map(Page::findAll(['domain_id' => $form->domains]), 'id', function($model){
                return urldecode($model->name);
            });

            if ($form->validate()) {
                $form->save();
            }
        }

        return $this->render('ui', [
            'model' => $form,
            'domains' => $domains,
            'groups' => $groups,
            'pages' => $pages,
        ]);
    }
    public function actionEditPage($id = NULL){

        if(\Yii::$app->request->isPost && \Yii::$app->request->isAjax){
            $data = \Yii::$app->request->post('data');
            if(is_null($data)) return;

            //Deleting actions
            foreach ($data as $id){
                PageGroup::deleteAll(['id' => $id]);
            }
            //Deleting actions
        }

        if(is_null($id)) return;


        $dataProvider = new ActiveDataProvider([
            'query' => PageGroup::find()->where(['group_id' => $id]),
        ]);


        return $this->render('edit-pages', ['dataProvider' => $dataProvider]);

    }
}
