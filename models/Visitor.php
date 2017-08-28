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
 * @property integer points
 * @property string $key
 * @property integer $project_id
 * @property string $ip
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
            [['key', 'project_id', 'ip'], 'required'],
            [['project_id', 'points'], 'integer'],
            [['email', 'first_name', 'last_name', 'key', 'ip'], 'string', 'max' => 255],
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
            'id' => \Yii::t('app', 'ID'),
            'email' => \Yii::t('app','Email'),
            'first_name' => \Yii::t('app','First Name'),
            'last_name' => \Yii::t('app','Last Name'),
            'points' => \Yii::t('app','Points'),
            'key' => \Yii::t('app','Key'),
            'project_id' => \Yii::t('app','Project ID'),
            'ip' => \Yii::t('app','Ip'),
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

    public function getPages(){
        return $this->hasMany(Page::className(), ['id' => 'id']);
    }
}
