<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$layout = <<< HTML
<div class="pull-right">
    {export}
</div>
<div class="pull-left">
    <div class="btn btn-default">{summary}</div>
</div>


<div class="clearfix"></div>
<hr>
{items}
<div class="text-center">{pager}</div>
HTML;

$this->title = Yii::t('app', 'Scorings');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="scoring-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
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

//            'visitor_id',
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
             'geo_ip',
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

            ['class' => \kartik\grid\ActionColumn::className()],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
