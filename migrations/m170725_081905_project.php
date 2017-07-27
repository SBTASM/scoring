<?php

use yii\db\Migration;

/**
 * Class m170725_081905_projects
 * $table->increments('id');
 * $table->string('name')->unique();
 * $table->integer('owner_user_id')->unsigned()->nullable();
 * $table->string('project_key')->nullable()->unique();
 * $table->timestamps();
 * $table->foreign('owner_user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
 */

class m170725_081905_project extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable("{{%project}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'owner_id' => $this->integer()->notNull(),
            'key' => $this->string()->unique()->notNull(),
        ], $tableOptions);

        $this->createIndex("idx-project-user", 'project', 'owner_id');
        $this->addForeignKey(
            'fk-project-user',
            'project',
            'owner_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170725_081905_projects cannot be reverted.\n";

        return $this->dropTable("{{%project}}");
    }
}
