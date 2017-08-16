<?php

namespace app\models;

use app\behaviors\PointsBehavior;
use Yii;

/**
 * This is the model class for table "scoring".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $visitor_id
 * @property integer $domain_id
 * @property string $browser_name
 * @property string $browser_engine
 * @property string $browser_agent
 * @property string $browser_language
 * @property string $browser_online
 * @property string $browser_platform
 * @property string $browser_java
 * @property string $browser_version
 * @property string $data_cookies_enabled
 * @property string $data_cookies
 * @property string $data_cookies1
 * @property string $data_storage
 * @property string $page_on
 * @property string $referrer
 * @property string $history_length
 * @property string $size_screen_w
 * @property string $size_screen_h
 * @property string $size_doc_w
 * @property string $size_doc_h
 * @property string $size_in_w
 * @property string $size_in_h
 * @property string $size_avail_w
 * @property string $size_avail_h
 * @property string $scr_color_depth
 * @property string $scr_pixel_depth
 * @property string $host_name
 * @property string $geo_country_code
 * @property string $geo_region_code
 * @property string $geo_region_name
 * @property string $geo_city
 * @property string $geo_zip_code
 * @property string $geo_time_zone
 * @property string $geo_latitude
 * @property string $geo_longitude
 * @property string $visitor_email
 * @property string $browser_plugins_list
 * @property integer $read_write
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Domain $domain
 * @property Project $project
 * @property Visitor $visitor
 */
class Scoring extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scoring';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'domain_id', 'read_write', 'created_at', 'updated_at'], 'required'],
            [['project_id', 'visitor_id', 'domain_id', 'read_write', 'created_at', 'updated_at'], 'integer'],
            [['browser_name', 'browser_engine', 'browser_agent', 'browser_language', 'browser_online', 'browser_platform', 'browser_java', 'browser_version', 'data_cookies_enabled', 'data_cookies', 'data_cookies1', 'data_storage', 'page_on', 'referrer', 'history_length', 'size_screen_w', 'size_screen_h', 'size_doc_w', 'size_doc_h', 'size_in_w', 'size_in_h', 'size_avail_w', 'size_avail_h', 'scr_color_depth', 'scr_pixel_depth', 'host_name', 'geo_country_code', 'geo_region_code', 'geo_region_name', 'geo_city', 'geo_zip_code', 'geo_time_zone', 'geo_latitude', 'geo_longitude', 'visitor_email', 'browser_plugins_list'], 'string', 'max' => 255],
            [['domain_id'], 'exist', 'skipOnError' => true, 'targetClass' => Domain::className(), 'targetAttribute' => ['domain_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['visitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visitor::className(), 'targetAttribute' => ['visitor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'visitor_id' => 'Visitor ID',
            'domain_id' => 'Domain ID',
            'browser_name' => 'Browser Name',
            'browser_engine' => 'Browser Engine',
            'browser_agent' => 'Browser Agent',
            'browser_language' => 'Browser Language',
            'browser_online' => 'Browser Online',
            'browser_platform' => 'Browser Platform',
            'browser_java' => 'Browser Java',
            'browser_version' => 'Browser Version',
            'data_cookies_enabled' => 'Data Cookies Enabled',
            'data_cookies' => 'Data Cookies',
            'data_cookies1' => 'Data Cookies1',
            'data_storage' => 'Data Storage',
            'page_on' => 'Page On',
            'referrer' => 'Referrer',
            'history_length' => 'History Length',
            'size_screen_w' => 'Size Screen W',
            'size_screen_h' => 'Size Screen H',
            'size_doc_w' => 'Size Doc W',
            'size_doc_h' => 'Size Doc H',
            'size_in_w' => 'Size In W',
            'size_in_h' => 'Size In H',
            'size_avail_w' => 'Size Avail W',
            'size_avail_h' => 'Size Avail H',
            'scr_color_depth' => 'Scr Color Depth',
            'scr_pixel_depth' => 'Scr Pixel Depth',
            'host_name' => 'Host Name',
            'geo_country_code' => 'Geo Country Code',
            'geo_region_code' => 'Geo Region Code',
            'geo_region_name' => 'Geo Region Name',
            'geo_city' => 'Geo City',
            'geo_zip_code' => 'Geo Zip Code',
            'geo_time_zone' => 'Geo Time Zone',
            'geo_latitude' => 'Geo Latitude',
            'geo_longitude' => 'Geo Longitude',
            'visitor_email' => 'Visitor Email',
            'browser_plugins_list' => 'Browser Plugins List',
            'read_write' => 'Read Write',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomain()
    {
        return $this->hasOne(Domain::className(), ['id' => 'domain_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitor()
    {
        return $this->hasOne(Visitor::className(), ['id' => 'visitor_id']);
    }
}
