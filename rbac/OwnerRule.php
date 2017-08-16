<?php

namespace app\rbac;

use yii\rbac\Item;
use yii\rbac\Rule;

class OwnerRule extends Rule{

    public $name = 'ownerRule';

    public function execute($user, $item, $params)
    {

    }
}