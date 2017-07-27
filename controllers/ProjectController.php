<?php

namespace app\controllers;

use app\base\Controller;
use app\models\CodeForm;
use Yii;
use app\models\Project;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors = array_merge($behaviors, [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);

        return $behaviors;
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project([
            'owner_id' => \Yii::$app->user->identity->getId(),
            'key' => \Yii::$app->security->generateRandomString(64),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSetActive($id){
        $project = Project::find()->where(['id' => $id])->one();
        if(is_null($project)){
            return $this->goBack();
        }

        \Yii::$app->getSession()->set('project_id', $project->id);

        return $this->redirect(Url::to(['project/index']));
    }

    public function actionGetCode(){
        if(is_null(\Yii::$app->getSession()->get('project_id'))){
            \Yii::$app->getSession()->setFlash('error', \Yii::t('app', 'You need select project!'));
            return $this->redirect(['project/index']);
        }
        $project = Project::find()->where(['id' => \Yii::$app->getSession()->get('project_id')])->one();

        $codeFormSource = $this->renderPartial('counter', ['project' => $project]);
        $mailFormSource = $this->renderPartial('email', ['project' => $project]);
        $form = new CodeForm(['counterCode' => $codeFormSource, 'formCode' => $mailFormSource]);

        return $this->render('code', ['project' => $project, 'model' => $form]);
    }
}
