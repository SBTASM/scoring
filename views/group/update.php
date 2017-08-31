<?php

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Group',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="group-update">

    <div class="row">
        <div class="col-sm-12">
            <?= $this->render('_form', [
                'model' => $model,
                'forms' => $forms,
                'addRuleModel' => $addRuleModel
            ]) ?>
        </div>
    </div>
</div>
