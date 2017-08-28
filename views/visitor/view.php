<?php

use app\widgets\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Visitor */

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
]);

$layout = <<< HTML
<div class="pull-right">
    $fullExportMenu
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>


<div class="clearfix"></div>
<hr>
<div class="text-center">{items}</div>
<div class="text-center">{pager}</div>
HTML;

$this->title = $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visitors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitor-view">
    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'first_name',
            'last_name',
            'key',
            'ip',
            [
                'label' => \Yii::t('app', 'Points'),
                'value' => function($model){
                    return $model->getPoints();
                }
            ],
        ],
    ]) ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => $layout,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Project',
                'attribute' => 'project_id',
                'value' => function($model){
                    return $model->getProject()->one()->name;
                }
            ],

            [
                'label' => 'Visitor key',
                'attribute' => 'visitor_id',
                'value' => function($model){
                    return $model->getVisitor()->one()->key;
                }
            ],
            [
                'label' => 'Domain',
                'attribute' => 'domain_id',
                'value' => function($model){
                    return $model->getDomain()->one()->name;
                }
            ],
//            'browser_name',
//             'browser_engine',
            'browser_agent',
            // 'browser_language',
            // 'browser_online',
            // 'browser_platform',
            // 'browser_java',
            'browser_version',
            // 'data_cookies_enabled',
            // 'data_cookies',
            // 'data_cookies1',
            // 'data_storage',
            [
                'label' => Yii::t('app', 'Page On'),
                'attribute' => 'page_on',
                'value' => function($model){
                    return urldecode($model->page_on);
                }
            ],
//             'referrer',
            // 'history_length',
            // 'size_screen_w',
            // 'size_screen_h',
            // 'size_doc_w',
            // 'size_doc_h',
            // 'size_in_w',
            // 'size_in_h',
            // 'size_avail_w',
            // 'size_avail_h',
            // 'scr_color_depth',
            // 'scr_pixel_depth',
            // 'host_name',
//            'geo_ip',
            // 'geo_country_code',
            // 'geo_region_code',
            // 'geo_region_name',
            // 'geo_city',
            // 'geo_zip_code',
            // 'geo_time_zone',
            // 'geo_latitude',
            // 'geo_longitude',
            // 'visitor_email:email',
            // 'first_cookie_record',
            // 'browser_plugins_list',

            [
                'label' => 'Created at',
                'attribute' => 'ceated_at',
                'value' => function($model){
                    return date("Y-m-d H:i:s", $model->created_at);
                }
            ],
            [
                'label' => \Yii::t('app', 'Read') . '&' . Yii::t('app', 'Write'),
                'attribute' => 'read_write',
                'value' => function($model){
                    return $model->read_write === 1 ? Yii::t('app', 'Write') : Yii::t('app', 'Read');
                }
            ],

            ['class' => \kartik\grid\ActionColumn::className()],
        ],
    ]); ?>

</div>
