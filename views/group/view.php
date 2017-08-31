<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$groups = array();

if(strlen($model->rules) !== 0){
    $groups_name = explode(':', $model->rules);
    foreach ($groups_name as $group_name){
        array_push($groups, new $group_name);
    }
}

$labels = array();

foreach ($groups as $group){
    array_push($labels, $group->description);
}

?>
<div class="group-view">
    <div class="row">
        <div class="col-sm-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'label' => \Yii::t('app', 'Page count of group'),
                        'format' => 'html',
                        'value' => function($model){
                            return \app\models\PageGroup::find()->where(['group_id' => $model->id])->count();
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-sm-4">
            <?= Html::tag('p', \Yii::t('app', 'Rules')) ?>
            <?= Html::ol($labels) ?>
        </div>
    </div>
    </div>
        <div class="col-sm-12">
            <div class="text-center">
                <?= Html::a(Yii::t('app', 'Edit pages'), ['edit-page', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
