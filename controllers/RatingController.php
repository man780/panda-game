<?php

namespace app\controllers;

use app\models\Employee;
use app\models\EmployeeRate;
use app\models\News;
use app\models\Product;
use app\models\Team;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class RatingController extends Controller
{

    public $defaultAction = 'global';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],

        ];
    }


    public function actionGlobal()
    {
        $this->view->title = 'Глобальный рейтинг';
        //$employeeList = EmployeeRate::find()->orderBy('global_rate DESC')->all();
        $employees = Employee::find()->all();
        return $this->render('global', [
            //'employeeList' => $employeeList,
            'employees' => $employees,
        ]);

    }

    public function actionTeams(){
        $this->view->title = 'Рейтинг команд';
        $teams = Team::find()->where(['>', 'id', 1])->all();

        return $this->render('teams', [
            'teams' => $teams,
        ]);
    }

}