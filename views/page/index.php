<?php

use app\widgets\ExportMenu;

use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
//    'onRenderDataCell' => function ($cell, $content, $model, $key, $index, $grid){
//        var_dump($cell, $content, $model, $key, $index, $grid); die();
//    }
]);

$layout = <<< HTML
<div class="pull-right">
    $fullExportMenu
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>
<div class="clearfix"></div>
<hr>
<div class="text-center">{items}</div>
<div class="text-center">{pager}</div>
HTML;

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filterModel,
        'layout' => $layout,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'name',
                'attribute' => 'name',
                'value' => function($model){
                    return urldecode($model->name);
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Page::find()->all(), 'name', function($model){
                    return urldecode($model->name);
                }),
            ],
            [
                'label' => 'Domain',
                'attribute' => 'domain_id',
                'value' => function($model){
                    return $model->getDomain()->one()->name;
                },
                'filter' =>  \yii\helpers\ArrayHelper::map(\app\models\Domain::find()->all(), 'id', 'name')
            ],
            [
                'attribute' => 'rating',
                'filter' => array_unique(\yii\helpers\ArrayHelper::map(\app\models\Page::find()->all(), 'rating', 'rating'))
            ],
            [
                'label' => Yii::t('app', 'Groups'),
                'format' => 'html',
                'value' => function($model){
                    $groups = $model->getGroups()->all();
                    if(count($groups) === 0) return NULL;
                    else{
                        $links = array();
                        foreach($groups as $group){
                            $g = $group->getGroup()->one();
                            array_push($links, \yii\helpers\Html::a($g->name, ['/group/view', 'id' => $g->id], ['class' => '']));
                        }
                        return implode(', ', $links);
                    }
                },
                'filter' => array_unique(\yii\helpers\ArrayHelper::map(\app\models\Group::find()->all(), 'id', 'name')),
            ],
            [
                'label' => Yii::t('app', 'Points'),
                'attribute' => 'points',
                'filter' => array_unique(\yii\helpers\ArrayHelper::map(\app\models\Page::find()->all(), 'points', 'points'))
            ],
            ['class' => \kartik\grid\ActionColumn::className()],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
