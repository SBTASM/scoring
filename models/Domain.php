<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "domain".
 *
 * @property integer $id
 * @property string $name
 * @property integer $project_id
 *
 * @property Project $project
 * @property Page[] $pages
 * @property Scoring[] $scorings
 */
class Domain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'project_id'], 'required'],
            [['project_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'project_id' => Yii::t('app', 'Project ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['domain_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScorings()
    {
        return $this->hasMany(Scoring::className(), ['domain_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DomainQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DomainQuery(get_called_class());
    }
}
