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
                        'actions' => ['logout', 'index'],
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
        $teams = Team::find()->all();
        $branches = Branch::find()->all();
        return $this->render('index', [
            'branches' => $branches,
            'teams' => $teams,
            'title' => $title,
        ]);
    }

    public function actionCreateBranch(){
        $this->layout = false;
        $model = new Branch();

        if (Yii::$app->request->isAjax &&
            $model->load(Yii::$app->request->post()))
        {

            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
                $file = $model->file;
                $model->image = 'images/branches/' . $file->baseName . '.' . $file->extension;
            }
            if($model->save()){
                if($model->file){
                    $file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    $file->saveAs($dir.'/web/images/branches/' . $file->baseName . '.' . $file->extension);
                }else{
                    vd($model->errors);
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

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
                $file = $model->file;
                $model->image = 'images/teams/' . $file->baseName . '.' . $file->extension;
            }
            if($model->save()){
                if($model->file){
                    $file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    $model->image = 'images/teams/' . $file->baseName . '.' . $file->extension;
                    $file->saveAs($dir.'/web/images/teams/' . $file->baseName . '.' . $file->extension);
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

    public function actionAbout()
    {
        return $this->render('about');
    }
}
