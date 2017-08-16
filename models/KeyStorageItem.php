<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%key_storage_item}}".
 *
 * @property integer $key
 * @property integer $value
 * @property integer $comment
 */
class KeyStorageItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%keystorage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            ['key', 'unique'],
            ['key', 'string', 'max' => 128],
            ['comment', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key Name',
            'value' => 'Value',
            'comment' => 'Comment',
            'searchstring' => 'Start your search'
        ];
    }
}
