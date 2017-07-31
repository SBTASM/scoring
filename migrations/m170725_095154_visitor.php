<?php

use yii\db\Migration;

class m170725_095154_visitor extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /**
        $table->increments('id');
        $table->string('email')->unique();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('password');
        $table->string('password_native');
        $table->string('visitor_key')->nullable();
        $table->string('project_key')->nullable();
        $table->timestamps();
         */

        $this->createTable("{{%visitor}}", [
            'id' => $this->primaryKey(),
            'email' => $this->string()->unique()->defaultValue(NULL),
            'first_name' => $this->string()->defaultValue(NULL),
            'last_name' => $this->string()->defaultValue(NULL),
            'key' => $this->string()->unique()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'ip' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-visitor-project', 'visitor', 'project_id');
        $this->addForeignKey(
            'fk-visitor-project',
            'visitor',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170725_095154_visitor cannot be reverted.\n";

        return $this->dropTable("{{%visitor}}");
    }
}
