<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Visitor */

$this->title = Yii::t('app', 'Create Visitor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visitors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>