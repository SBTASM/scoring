<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scoring */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scorings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scoring-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'project_id',
            'visitor_id',
            'domain_id',
            'browser_name',
            'browser_engine',
            'browser_agent',
            'browser_language',
            'browser_online',
            'browser_platform',
            'browser_java',
            'browser_version',
            'data_cookies_enabled',
            'data_cookies',
            'data_cookies1',
            'data_storage',
            'page_on',
            'referrer',
            'history_length',
            'size_screen_w',
            'size_screen_h',
            'size_doc_w',
            'size_doc_h',
            'size_in_w',
            'size_in_h',
            'size_avail_w',
            'size_avail_h',
            'scr_color_depth',
            'scr_pixel_depth',
            'host_name',
            'geo_ip',
            'geo_country_code',
            'geo_region_code',
            'geo_region_name',
            'geo_city',
            'geo_zip_code',
            'geo_time_zone',
            'geo_latitude',
            'geo_longitude',
            'visitor_email:email',
            'first_cookie_record',
            'browser_plugins_list',
        ],
    ]) ?>

</div>
