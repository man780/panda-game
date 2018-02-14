<?php

namespace app\controllers;

use app\models\Branch;
use app\models\Team;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class CompanyController extends Controller
{
    //public $layout = 'basic';
    public $defaultAction = 'index';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index', 'create-branch', 'create-team', 'update-branch', 'update-team',
                            'delete-branch', 'delete-team'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Компания';
        $team = new Team();
        $teams = $team->getList();
        $branch = new Branch();
        $branches = $branch->getList();
        return $this->render('index', [
            'branches' => $branches,
            'teams' => $teams,
            'title' => $title,
        ]);
    }

    public function actionCreateBranch(){
        $this->layout = false;
        $this->view->title = 'Добавть отдел';
        $model = new Branch();

        if (Yii::$app->request->isAjax &&
            $model->load(Yii::$app->request->post()))
        {

            $model->file = UploadedFile::getInstance($model, 'file');
            $time = date('YmdHis');
            if($model->file){
                $file = $model->file;
                $model->image = 'images/branches/' . $file->baseName.'-'.$time . '.' . $file->extension;
            }
            if($model->save()){
                if($model->file){
                    $file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    $file->saveAs($dir.'/web/images/branches/' . $file->baseName.'-'.$time . '.' . $file->extension);
                }
                return $this->redirect(['company/index']);
            }else{
                vd($model->errors);
            }
        }
        return $this->renderAjax('branch_form', [
            'model' => $model,
        ]);
    }

    public function actionUpdateBranch($id){
        $this->layout = false;
        $this->view->title = 'Редактировать отдел';
        $model = Branch::find()->where(['id' => $id])->one();

        if (Yii::$app->request->isAjax &&
            $model->load(Yii::$app->request->post()))
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            $time = date('YmdHis');
            if(!is_null($model->file)){
                $file = $model->file;
                $oldImage = $model->image;
                $model->image = 'images/branches/' . $file->baseName.'-'.$time . '.' . $file->extension;
            }
            if($model->save()){
                if(!is_null($model->file)){
                    $file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    unlink($dir.'/web/'.$oldImage);
                    $file->saveAs($dir.'/web/images/branches/' . $file->baseName. '-'.$time . '.' . $file->extension);
                }
                return $this->redirect(['company/index']);
            }else{
                vd($model->errors);
            }
        }
        return $this->renderAjax('branch_form', [
            'model' => $model,
        ]);
    }

    public function actionCreateTeam(){
        $this->layout = false;
        $model = new Team();
        $this->view->title = 'Добавть команду';
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $time = date('YmdHis');
            if($model->file){
                $file = $model->file;
                $model->image = 'images/teams/' . $file->baseName.'-'.$time . '.' . $file->extension;
            }
            if($model->save()){
                if($model->file){
                    $file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    //$model->image = 'images/teams/' . $file->baseName . '.' . $file->extension;
                    $file->saveAs($dir.'/web/images/teams/' . $file->baseName . '-' . $time . '.' . $file->extension);
                }
                $model->file = null;
                return $this->redirect(['company/index']);
            }else{
                vd($model->errors);
            }
        }
        $class = new Branch();
        //$branches = ArrayHelper::map(Branch::find()->asArray()->all(), 'id','name');
        $branches = $class->getBranchesAll();
        return $this->renderAjax('team_form', [
            'model' => $model,
            'branches' => $branches,
        ]);
    }

    public function actionUpdateTeam($id){
        $this->layout = false;
        $model = Team::find()->where(['id' => $id])->one();
        $this->view->title = 'Редактировать команду';
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $time = date('YmdHis');
            if($model->file){
                $file = $model->file;
                $oldImage = $model->image;
                $model->image = 'images/teams/' . $file->baseName .'-'.$time . '.' . $file->extension;
            }
            if($model->save()){
                if($model->file){
                    $file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    unlink($dir.'/web/'.$oldImage);
                    //$model->image = 'images/teams/' . $file->baseName . '.' . $file->extension;
                    $file->saveAs($dir.'/web/images/teams/' . $file->baseName .'-'.$time . '.' . $file->extension);
                }
                $model->file = null;
                return $this->redirect(['company/index']);
            }else{
                vd($model->errors);
            }
        }
        $class = new Branch();
        //$branches = ArrayHelper::map(Branch::find()->asArray()->all(), 'id','name');
        $branches = $class->getBranchesAll();
        return $this->renderAjax('team_form', [
            'model' => $model,
            'branches' => $branches,
        ]);
    }

    /**
     * Deletes an existing Branch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteBranch($id)
    {
        Branch::findOne($id)->delete();

        return $this->redirect(['company/index']);
    }

    /**
     * Deletes an existing Team model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteTeam($id)
    {
        Team::findOne($id)->delete();

        return $this->redirect(['company/index']);
    }

}
