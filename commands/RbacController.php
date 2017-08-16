<?php

namespace app\commands;

use app\models\User;
use app\rbac\RolesDictionary;
use app\rbac\UserGroupRule;
use yii\console\Controller;
use yii\rbac\Role;

class RbacController extends Controller{

    public function actionInit(){
        $authManager = \Yii::$app->getAuthManager();
        if(is_null($authManager)){
            echo "Auth manager is null!!!!"; return;
        }

        $authManager->removeAllRoles();
        $authManager->removeAllRules();
        $authManager->removeAllPermissions();


        foreach (\Yii::$app->params['roles'] as $name => $role){
            $role_item = $authManager->createRole($name);
            $authManager->add($role_item);

            foreach ($role['rules'] as $class){
                $rule = new $class;
                if(is_null($authManager->getRule($rule->name))){
                    $authManager->add($rule);
                }
            }

            //Rules not working(

            foreach ($role['actions'] as $action){
                if(is_null($authManager->getPermission($action))){
                    $authManager->add($authManager->createPermission($action));
                }
            }

            foreach ($role['actions'] as $action){
                $authManager->addChild($role_item, $authManager->getPermission($action));
            }
        }
    }

    public function actionAssign($username, $roleName){
        $user = User::find()->where(['username' => $username])->one();
        $role = \Yii::$app->authManager->getRole($roleName);

        if(is_null($user) || is_null($role)){
            echo "User name or role name invalid";
        }

        \Yii::$app->authManager->assign($role, $user->id);
    }
}