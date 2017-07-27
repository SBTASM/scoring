<?php

use yii\db\Migration;

class m170725_082736_domain extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable("{{%domain}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'project_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex("idx-domain-project", "domain", "project_id");
        $this->addForeignKey(
            'fk-domain-project',
            'domain',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170725_082736_domain cannot be reverted.\n";

        return $this->dropTable("{{%domain}}");
    }
}
