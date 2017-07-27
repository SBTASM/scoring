<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Scoring]].
 *
 * @see Scoring
 */
class ScoringQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Scoring[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Scoring|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
