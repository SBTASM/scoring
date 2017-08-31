<?php

use yii\db\Migration;

/**
 * Class m170725_095155_scoring
 *
 *  $table->increments('id');



$table->foreign('domen_id')->references('id')->on('domens')->onDelete('set null')->onUpdate('cascade');

$table->timestamps();
 */

class m170725_095155_scoring extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%scoring}}", [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'visitor_id' => $this->integer()->defaultValue(NULL),
            'domain_id' => $this->integer()->notNull(),

            'browser_name' => $this->string(),
            'browser_engine' => $this->string(),
            'browser_agent' => $this->string(),
            'browser_language' => $this->string(),
            'browser_online' => $this->string(),
            'browser_platform' => $this->string(),
            'browser_java' => $this->string(),
            'browser_version' => $this->string(),

            'data_cookies_enabled' => $this->string(),
            'data_cookies' => $this->string(),
            'data_cookies1' => $this->string(),
            'data_storage' => $this->string(),
            'page_on' => $this->string(),
            'referrer' => $this->string(),
            'history_length' => $this->string(),

            'size_screen_w' => $this->string(),
            'size_screen_h' => $this->string(),
            'size_doc_w' => $this->string(),
            'size_doc_h' => $this->string(),
            'size_in_w' => $this->string(),
            'size_in_h' => $this->string(),
            'size_avail_w' => $this->string(),
            'size_avail_h' => $this->string(),

            'scr_color_depth' => $this->string(),
            'scr_pixel_depth' => $this->string(),
            'host_name' => $this->string(),
//            'geo_ip' => $this->string(),
            'geo_country_code' => $this->string(),
            'geo_region_code' => $this->string(),
            'geo_region_name' => $this->string(),
            'geo_city' => $this->string(),
            'geo_zip_code' => $this->string(),
            'geo_time_zone' => $this->string(),
            'geo_latitude' => $this->string(),
            'geo_longitude' => $this->string(),

            'visitor_email' => $this->string(),
//            'first_cookie_record' => $this->string(),
            'browser_plugins_list' => $this->string(),

            'read_write' => $this->boolean()->notNull(),
            'points' => $this->integer()->defaultValue(NULL),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-scoring-project', 'scoring', 'project_id');
        $this->createIndex('idx-scoring-visitor', 'scoring', 'visitor_id');
        $this->createIndex('idx-scoring-domain', 'scoring', 'domain_id');
        $this->addForeignKey(
            'fk-scoring-project',
            'scoring',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-scoring-visitor',
            'scoring',
            'visitor_id',
            'visitor',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-scoring-domain',
            'scoring',
            'domain_id',
            'domain',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170725_095155_scoring cannot be reverted.\n";

        return $this->dropTable("{{%scoring}}");
    }
}
