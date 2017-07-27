<?php

?>

<?php $form = \yii\widgets\ActiveForm::begin() ?>

<div class="code">
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'formCode')->textarea(['rows' => 14]); ?>
            <?= $form->field($model, 'counterCode')->textarea(['rows' => 10]); ?>
        </div>
    </div>
</div>

<?php \yii\widgets\ActiveForm::end() ?>
