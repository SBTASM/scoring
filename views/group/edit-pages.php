<?php

/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ArrayDataProvider
 */

$layout = <<< HTML
<div class="pull-right">
    {export}
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>
<div class="clearfix"></div>
<hr>
<div class="">{items}</div>
<div class="text-center">{pager}</div>
HTML;

$ajax_url = \yii\helpers\Url::to(['/group/edit-page']);
$btn_src = <<< JS
$('#delete-button').on('click', function(){
        var indexes = $('#pages-edit').yiiGridView('getSelectedRows');
        $.post('$ajax_url', {data : indexes}, function(response) {
          $.pjax({container: "#pages-edit"});
        })
    });
JS;

$this->registerJs($btn_src);


?>

<?php \yii\widgets\Pjax::begin() ?>


<div class="site-edut-pages">
    <div class="row">
        <div class="col-sm-12">
            <?= \app\widgets\GridView::widget([
                'dataProvider' => $dataProvider,
                'id' => 'pages-edit',
                'options' => [
                    'data-pjax' => true,
                ],
                'layout' => $layout,
                'columns' => [
                    ['class' => \kartik\grid\SerialColumn::className()],
                    [
                        'label' => Yii::t('app', 'Name'),
                        'value' => function($model){
                            return urldecode($model->getPage()->one()->name);
                        },
                    ],
                    [
                        'label' => Yii::t('app', 'Group'),
                        'value' => function($model){
                            return $model->getGroup()->one()->name;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Domain'),
                        'value' => function($model){
                            return $model->getPage()->one()->getDomain()->one()->name;
                        }
                    ],
                    ['class' => \yii\grid\CheckboxColumn::className()],
                ]
            ]) ?>
        </div>
        <div class="col-sm-12">
            <div class="text-center">
                <?= \yii\helpers\Html::button(Yii::t('app', 'Delete selected'), [
                    'id' => 'delete-button',
                    'class' => 'btn btn-danger'
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
