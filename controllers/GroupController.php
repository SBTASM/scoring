<?php

namespace app\controllers;

use app\models\AddRuleForm;
use app\models\RulesSettingsForm;
use Yii;
use app\models\Group;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\base\Controller;
use yii\web\NotFoundHttpException;
/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
{
    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Group::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);


        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Group();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/group/view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $rules = array();
        $forms = array();


        if(strlen($model->rules) !== 0){
            $rules = explode(':', $model->rules);
        }

        foreach ($rules as $rule){
            array_push($forms, new RulesSettingsForm([
                'ruleName' => $rule,
                'description' => (new $rule)->description,
                'group' => $model
            ]));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Model::loadMultiple($forms, \Yii::$app->request->post());
            foreach ($forms as $fs){
                $fs->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'forms' => $forms
            ]);
        }
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddRule($id){
        $group = Group::find()->where(['id' => $id])->one();
        $form = new AddRuleForm();

        if($form->load(\Yii::$app->request->post()) && $form->validate()){
            $rules = explode(':', $group->rules);
            if(strlen($group->rules) === 0){ $rules = array(); }
            array_push($rules, $form->ruleName);
            $rules = array_unique($rules);
            $group->rules = implode(':', $rules);
            $group->save();

            return $this->redirect(['/group/update', 'id' => $id]);
        }

        return $this->render('add-rule', ['model' => $form]);
    }

    public function actionDeleteRule($id, $name){
        $group = $this->findModel($id);

        $this->deleteRule($id, $name);

        return $this->redirect(['group/update', 'id' => $id]);
    }

    protected function deleteRule($group_id, $rule_name){
        $rules = array();
        $group = $this->findModel($group_id);

        if(strlen($group->rules) !== 0){ $rules = explode(':', $group->rules); }

        $rules = array_diff($rules, [$rule_name]);
        $group->rules = implode(':', $rules);
        $group->save();
    }
}
