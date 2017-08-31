<?php

use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;

$layout = <<< HTML
<div class="pull-right">
    {export}
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>
<div class="clearfix"></div>
<hr>
<div class="text-center">{items}</div>
<div class="text-center">{pager}</div>
HTML;
?>

<div class="group-index">

    <div class="row">
        <div class="col-sm-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => $layout,
                'columns' => [
                    ['class' => \kartik\grid\SerialColumn::className()],
                    'name',
                    ['class' => \app\widgets\ActionColumn::className()],
                ],
            ]); ?>
        </div>
        <div class="col-sm-12">
            <div class="text-center">
                <?= Html::a(Yii::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

</div>
