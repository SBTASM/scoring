<?php

namespace app\behaviors;

use app\components\keyStorage\KeyStorage;
use app\interfaces\RuleInterface;
use app\models\Page;
use app\models\Scoring;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class PointsBehavior extends Behavior implements RuleInterface {

    public $description = 'Посещения';

    public function events()
    {
        return [ ActiveRecord::EVENT_AFTER_INSERT => 'point' ];
    }

    protected function getFormat($group_id, $name = 'points'){
        return sprintf("%s\%d\%d\%s", self::className(), \Yii::$app->getUser()->identity->getId(), $group_id, $name);
    }

    public function point($event){

        if($event->sender instanceof Scoring){
            /**
             * @var $scoring Scoring
             */
            $scoring = $event->sender;
            $page = Page::find()->where(['domain_id' => $scoring->domain_id, 'name' => $scoring->page_on])->one();
            $group = $page->getGroups()->one();

            $visitor = $scoring->getVisitor()->one();

            $points = (int)\Yii::$app->keyStorage->get($this->getFormat($group->id, 'points'));
            $vcount = (int)\Yii::$app->keyStorage->get($this->getFormat($group->id, 'vcount'));

            if(!is_null($page) && ($page instanceof Page)){
                if(is_null($page->points)) $page->points = '0';
                $rating = (int)$page->rating;
                if(($rating % $vcount) === 0){
                    $page->points = (string)((int)$page->points + $points);
                    $visitor->points = (string)((int)$visitor->points + $points);
                    $visitor->save();
                    $page->save();
                }
            }
        }
    }

    public function getDescription()
    {
        return $this->description;
    }
}