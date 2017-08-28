<?php

use yii\db\Migration;

class m170804_073940_group extends Migration
{
    public function safeUp()
    {
        $this->createTable("{{%group}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'rules' => $this->string(2048)->defaultValue(NULL),
        ]);
    }

    public function safeDown()
    {
        echo "m170804_073940_page_group cannot be reverted.\n";

        return $this->dropTable("{{%group}}");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170804_073940_page_group cannot be reverted.\n";

        return false;
    }
    */
}
