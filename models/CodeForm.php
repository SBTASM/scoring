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
}