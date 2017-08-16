<?php

namespace app\controllers;

use app\components\keyStorage\KeyStorage;
use app\models\Page;
use yii\web\Controller;

class DumpController extends Controller{
    public function actionPageGroups(){
        $page = Page::find()->all()[0];
        var_dump(\yii\helpers\ArrayHelper::map(\app\models\Page::find()->all(), 'name', 'id')); die();
    }
    public function actionKey(){
        /**
         * @var $ks KeyStorage
         */
        $ks = \Yii::$app->keyStorage;

        $ks->set('settings/scoring/rules', true);

        var_dump($ks->get('settings/scoring/rules'));
    }

    public function actionRules(){
    }
}