<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "Page_group".
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $group_id
 */
class PageGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'group_id'], 'required'],
            [['page_id', 'group_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'group_id' => 'Group ID',
            'rules' => 'Rules'
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getGroup(){
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getPage(){
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
