<?php

namespace app\models;

use app\behaviors\PointsBehavior;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property integer $domain_id
 * @property string $rating
 * @property integer $points
 *
 * @property Domain $domain
 * @property PageGroup[] $pageGroups
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain_id', 'points'], 'integer'],
            [['points', 'rating'], 'safe'],
            [['name', 'rating'], 'string', 'max' => 255],
            [['domain_id'], 'exist', 'skipOnError' => true, 'targetClass' => Domain::className(), 'targetAttribute' => ['domain_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'domain_id' => 'Domain ID',
            'rating' => 'Rating',
            'points' => 'Points',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomain()
    {
        return $this->hasOne(Domain::className(), ['id' => 'domain_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageGroups()
    {
        return $this->hasMany(PageGroup::className(), ['page_id' => 'id']);
    }

    public function search(array $params){
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if(!$this->load($params) && !$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
            'domain_id' => $this->domain_id,
            'name' => $this->name,
            'rating' => $this->rating,
            'points' => $this->points
        ]);

        return $dataProvider;
    }

    public function getGroups(){
        return self::hasMany(PageGroup::className(), ['page_id' => 'id']);
    }
}
