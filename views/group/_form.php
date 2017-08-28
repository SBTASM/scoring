<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Group */
/* @var $form yii\widgets\ActiveForm */
/* @var $forms \app\models\RulesSettingsForm[] */

$rules_list = array();


?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if(isset($forms)){ ?>
                    <?php foreach ($forms as $index => $sett_from){ ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center">
                                            <?= $sett_from->ruleName ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="">
                                        <div class="col-sm-3">
                                            <?= $form->field($sett_from, "[$index]description") ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($sett_from, "[$index]pointCounts") ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($sett_from, "[$index]visitCount") ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <?= Html::a(Yii::t('app', 'Delete rule'), ['group/delete-rule', 'id' => $model->id, 'name' => $sett_from->ruleName], ['class' => 'btn btn-danger']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="text-center">
                <div class="form-group">
                    <?= Html::a(Yii::t('app', 'Add rule'), ['/group/add-rule', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
