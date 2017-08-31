<?php

namespace app\commands;

use app\models\Project;
use yii\console\Controller;
use yii\helpers\Console;

class ResetController extends Controller{
    public function actionIndex(){
        $project = new Project([
            'name' => 'Test project',
            'key' => 'lR6RVkLaPChLyqp3anS3yIi0zBvzPcXow_m9vIP1BrQlfwMYs9t_JNhOnovCnvyD',
            'owner_id' => 1,
        ]);

        if($project->save()){
            echo $this->ansiFormat("Save ok!\n", Console::FG_GREEN);
            return 0;
        }else{
            echo $this->ansiFormat("Fail save!\n", Console::FG_RED);
            return 1;
        }
    }
}