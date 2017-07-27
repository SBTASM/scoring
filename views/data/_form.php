<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Scoring */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scoring-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'visitor_id')->textInput() ?>

    <?= $form->field($model, 'domain_id')->textInput() ?>

    <?= $form->field($model, 'browser_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_engine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_online')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_platform')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_java')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_cookies_enabled')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_cookies')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_cookies1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_storage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_on')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referrer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'history_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_screen_w')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_screen_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_doc_w')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_doc_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_in_w')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_in_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_avail_w')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_avail_h')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scr_color_depth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scr_pixel_depth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_country_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_region_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_region_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_zip_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_time_zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geo_longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visitor_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_cookie_record')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'browser_plugins_list')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
