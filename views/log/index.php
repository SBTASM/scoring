<?php

use app\widgets\ExportMenu;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$export = ExportMenu::widget([
    'dataProvider' => $dataProvider,
]);


$layout = <<< HTML
<div class="pull-right">
    $export
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>


<div class="clearfix"></div>
<hr>
{items}
<div class="text-center">{pager}</div>
HTML;

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => $layout,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'level',
            'category',
            [
                'label' => 'Log time',
                'attribute' => 'log_time',
                'value' => function($model){
                    return date("Y-m-d H:i:s", $model->log_time);
                }
            ],
            'prefix:ntext',
            // 'message:ntext',

            ['class' => ActionColumn::className()],
        ],
    ]); ?>
<?= \yii\helpers\Html::a('Delete all logs', ['log/delete-all'], ['class' => 'btn btn-danger']) ?>

<?php Pjax::end(); ?></div>
