<?php

use app\widgets\ExportMenu;

use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'onRenderDataCell' => function ($cell, $content, $model, $key, $index, $grid){
        var_dump($cell, $content, $model, $key, $index, $grid); die();
    }
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
        'layout' => $layout,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'name',
                'attribute' => 'name',
                'value' => function($model){
                    return urldecode($model->name);
                }
            ],
            [
                'label' => 'Domain',
                'attribute' => 'domain_id',
                'value' => function($model){
                    return $model->getDomain()->one()->name;
                }
            ],
            'rating',

            ['class' => \kartik\grid\ActionColumn::className()],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
