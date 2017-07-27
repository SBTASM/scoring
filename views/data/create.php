<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scoring */

$this->title = Yii::t('app', 'Create Scoring');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scorings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scoring-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
