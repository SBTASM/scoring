<?php

namespace app\models;

use yii\base\Model;

class CodeForm extends Model{
    public $counterCode;
    public $formCode;

    public function rules()
    {
        return [
            [['counterCode', 'formCode'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'counterCode' => \Yii::t('app', 'Counter Code'),
            'formCode' => \Yii::t('app', 'Form Code')
        ];
    }
}