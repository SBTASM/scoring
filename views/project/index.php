<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$layout = <<< HTML
<div class="pull-right">
    {export}
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>


<div class="clearfix"></div>
<hr>
    {items}
    <div class="text-center">{pager}</div>
HTML;

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
    <div class="row">
        <div class="text-center">
            <div class="col-sm-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => $layout,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                        'id',
                        'name',
                        [
                            'label' => Yii::t('app', 'Owner'),
                            'attribute' => 'owner_id',
                            'value' => function($model){
                                return  $model->getOwner()->one()->username;
                            }
                        ],
                        'key',

                        [
                            'class' => \app\widgets\ActionColumn::className(),
                        ],
                        [
                            'label' => Yii::t('app', 'Current'),
                            'format' => 'html',
                            'value' => function($model){
                                $project_id = \Yii::$app->getSession()->get('project_id');
                                if(!is_null($project_id))
                                    if($project_id === $model->id)
                                        return Html::tag('p', Yii::t('app', 'Active'), ['class' => 'btn btn-success btn-xs']);
                                    else
                                        return Html::a(Yii::t('app', 'Select'), ['project/set-active', 'id' => $model->id], ['class' => 'btn btn-danger btn-xs']);
                                else
                                    return Html::a(Yii::t('app', 'Select'), ['project/set-active', 'id' => $model->id], ['class' => 'btn btn-danger btn-xs']);
                            },
                        ]
                    ],
                ]); ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="text-center">
                <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
<?php Pjax::begin(); ?>
<?php Pjax::end(); ?></div>
