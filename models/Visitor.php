<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visitor".
 *
 * @property integer $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $key
 * @property integer $project_id
 *
 * @property Scoring[] $scorings
 * @property Project $project
 */
class Visitor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visitor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'project_id'], 'required'],
            [['project_id'], 'integer'],
            [['email', 'first_name', 'last_name', 'key'], 'string', 'max' => 255],
            [['key'], 'unique'],
            [['email'], 'unique'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'key' => 'Key',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScorings()
    {
        return $this->hasMany(Scoring::className(), ['visitor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
