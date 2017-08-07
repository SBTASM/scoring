<?php

use app\widgets\ExportMenu;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
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

$this->title = Yii::t('app', 'Visitors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitor-index">
<?php Pjax::begin(); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => $layout,
        'columns' => [

            'id',
//            'email:email',
//            'first_name',
//            'last_name',
            'key',
             [
                 'label' =>  'request count',
                 'value' => function($model){
                    return $model->getScorings()->count();
                 }
             ],
             [
                 'label' => Yii::t('app', 'Project'),
                 'attribute' => 'project_id',
                 'value' => function($model){
                    return $model->getProject()->one()->name;
                 }
             ],
            'ip',
            ['class' => \kartik\grid\ActionColumn::className()],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
