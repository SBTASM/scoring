<?php

namespace app\models;

use yii\base\Model;

class AddRuleForm extends Model{
    public $ruleName;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['ruleName'], 'required'],
            [['ruleName'], 'string', 'max' => 255]
        ]);
    }

    /**
     * @param $group Group
     */
    public function attach($group){

    }
}