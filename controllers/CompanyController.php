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
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        ]);
    }


    public function actionStructure(){
        $this->view->title = 'Структура компании';
        return $this->render('structure', [

        ]);
    }

}
