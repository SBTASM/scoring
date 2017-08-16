<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$rules_list = array();
$rules = explode(':', $model->rules);
if(strlen($model->rules) !== 0){
    foreach ($rules as $rule){
        $rules_list[$rule] = (new $rule)->description;
    }
}
?>
<div class="group-view">

    <div class="row">
        <div class="col-sm-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php $form = \kartik\form\ActiveForm::begin() ?>
            <?php foreach ($forms as $sett_from){ ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <?= $sett_from->ruleName ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <?= $form->field($sett_from, 'description') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($sett_from, 'pointCounts') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php $form::end() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center">
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
