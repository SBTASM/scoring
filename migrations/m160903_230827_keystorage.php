<?php

use yii\db\Migration;

class m160903_230827_keystorage extends Migration
{
    private $tableOptions = null;

    public function safeUp()
    {

        if ($this->db->driverName === 'mysql') {
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%keystorage}}', [
            'id' => $this->primaryKey(11)->unsigned()->notNull(),
            'key' => $this->string(255)->unique(),
            'value' => $this->string(255),
            'comment' => $this->string(255),
        ], $this->tableOptions);

        $this->createIndex('idx-keystorage-unique-key', '{{%keystorage}}', 'key', true);
        $this->createIndex('idx-keystorage-value', '{{%keystorage}}', 'value');

    }

    public function safeDown()
    {
        $this->dropTable('{{%keystorage}}');
    }
}
