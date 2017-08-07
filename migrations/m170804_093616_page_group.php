<?php

use yii\db\Migration;

class m170804_093616_page_group extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable("{{%page_group}}", [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-page_group-page', 'page_group', 'page_id');
        $this->createIndex('idx-page_group-group', 'page_group', 'group_id');

        $this->addForeignKey(
            'fk-page_group-page',
            'page_group',
            'page_id',
            'page',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-page_group-group',
            'page_group',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170804_093616_page_group cannot be reverted.\n";

        return $this->dropTable("{{%page_group}}");
    }
}
