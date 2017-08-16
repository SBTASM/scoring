<?php

namespace app\behaviors;

use app\components\keyStorage\KeyStorage;
use app\interfaces\RuleInterface;
use app\models\Page;
use app\models\Scoring;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class TestBehavior extends Behavior implements RuleInterface {

    public $description = 'Тестовое правило';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'point'
        ];
    }

    public function point($event){
        /**
         * @var $ks KeyStorage
         */
        $ks = \Yii::$app->keyStorage;

        $enabled = $ks->get('settings.scoring.rules.enabled');

        if($enabled !== false){ return; }

        if($event->sender instanceof Scoring){
            /**
             * @var $scoring Scoring
             */
            $scoring = $event->sender;
            $page = Page::find()->where(['domain_id' => $scoring->domain_id, 'name' => $scoring->page_on])->one();

            if(!is_null($page) && ($page instanceof Page)){
                if(is_null($page->points)) $page->points = '0';
                $page->points = (string)((int)$page->points + 1);
                $page->save();
            }
        }
    }

    public function getDescription()
    {
        return $this->description;
    }
}