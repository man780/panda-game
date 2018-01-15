<?php

namespace app\controllers;

use app\models\Branch;
use app\models\Team;
use Yii;
use yii\filters\AccessControl;
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
        $teams = Team::find()->all();
        $branches = Branch::find()->all();
        return $this->render('index', [
            'branches' => $branches,
            'teams' => $teams,
        ]);
    }

    public function actionCreateBranch(){
        $this->layout = false;
        $model = new Branch();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
                $file = $model->file;
                $dir = \Yii::getAlias('@app');
                $model->image = 'images/branches/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($dir.'/web/images/branches/' . $file->baseName . '.' . $file->extension);
            }
            $model->file = null;
            $model->dcreated = time();
            if($model->save()){
                return $this->redirect(['company/index']);
            }else{
                vd($model-errors);
            }
        }
        return $this->render('branch_form', [
            'model' => $model,
        ]);
    }

    public function actionCreateTeam(){
        $this->layout = false;
        $model = new Team();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file){
                $file = $model->file;
                $dir = \Yii::getAlias('@app');
                $model->image = 'images/branches/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($dir.'/web/images/teams/' . $file->baseName . '.' . $file->extension);
            }
            $model->file = null;
            $model->dcreated = time();
            if($model->save()){
                return $this->redirect(['company/index']);
            }else{
                vd($model-errors);
            }
        }
        return $this->render('team_form', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
