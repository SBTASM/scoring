<?php
/**
 * @var $model \app\models\SetPageGroupForm
 */

$this->title = \Yii::t('app', 'Set group for pages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php \yii\widgets\Pjax::begin() ?>
<div class="group-ui">
    <div class="row">
        <?php $form = \kartik\form\ActiveForm::begin([
            'id' => 'set-group-form',
            'options' => [
                'data-pjax' => true,
            ]

        ]) ?>
        <div class="col-sm-12">
            <div class="col-sm-4">
                <?= $form->field($model, 'projects')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\Project::find()->all(), 'id', 'name'),
                    'id' => 'project-select',
                    'options' => [
                        'multiple' => true,
                    ],
                    'pluginEvents' => [
                        'change' => "select"
                    ]
                ])?>
            </div>
            <div class="col-sm-4">
                <?php if(count($domains) > 0){ ?>
                    <?= $form->field($model, 'domains')->widget(\kartik\select2\Select2::className(), [
                        'data' => $domains,
                        'id' => 'domain-select',
                        'options' => [
                            'multiple' => true,
                        ],
                        'pluginEvents' => [
                            'change' => 'select'
                        ]
                    ]) ?>
                <?php } ?>
            </div>
            <div class="col-sm-4">
                <?php if(count($groups) > 0 && count($pages) > 0 && count($domains) > 0){ ?>
                    <?= $form->field($model, 'groups')->widget(\kartik\select2\Select2::className(), [
                        'id' => 'groups-select',
                        'data' => $groups,
                        'value' => NULL,
                        'options' => [
                            'multiple' => false,
                        ],
                        'pluginEvents' => [
                            'change' => 'select'
                        ]
                    ]) ?>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-12">
            <?php if(count($pages) > 0){ ?>
                <?= $form->field($model, 'pages')->widget(\kartik\select2\Select2::className(), [
                    'id' => 'pages-select',
                    'data' => $pages,
                    'options' => [
                        'multiple' => true,
                    ],
                    'pluginEvents' => [
                        'change' => 'select'
                    ]
                ]) ?>
            <?php } ?>
        </div>
        <div class="col-sm-12">
            <div class="text-center">
                <?php if($model->validate()){ ?>
                    <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $form::end() ?>
</div>
<?php \yii\widgets\Pjax::end() ?>

<script type="text/javascript">
    function select(){
        $("#set-group-form").submit();
    }
</script>
