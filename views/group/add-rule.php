<?php

/**
 * @var $model \app\models\AddRuleForm
 */

use yii\bootstrap\Html;

$rules_list = array();
foreach (\Yii::$app->params['rules'] as $rule){ $rules_list[$rule] = (new $rule)->description; }
?>

<?php $form = \kartik\form\ActiveForm::begin([
        'action' => ['/group/add-rule', 'id' => $id],
        'id' => 'add-rule-form'
]) ?>

<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'ruleName')->dropDownList($rules_list) ?>
    </div>
    <div class="col-sm-12">
        <div class="text-center">

            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php $form::end() ?>
