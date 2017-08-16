<?php

use yii\db\Migration;

class m170725_102936_page extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%page}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'domain_id' => $this->integer(),
            'rating' => $this->string(),
            'points' => $this->integer(),
        ], $tableOptions);

        $this->createIndex("idx-page-domain", "page", "domain_id");
        $this->addForeignKey(
            'fk-page-domain',
            'page',
            'domain_id',
            'domain',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170725_102936_page cannot be reverted.\n";

        return $this->dropTable("{{%page}}");
    }

}
