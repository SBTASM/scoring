<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'domain_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Domain::find()->all(), 'id', 'name')) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($group, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Group::find()->all(), 'id', 'name')) ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="text-center">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
