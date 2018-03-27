<?php
namespace app\modules\admin\controllers;

use app\models\Employee;
use app\models\Rate;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SettingsController extends Controller
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
        $rate = Rate::find()->all();
        //vd($rate);
        $employees = [];
        $dates = [];
        $tableArr = [];
        foreach ($rate as $item){
            if(is_null($tableArr[$item->employee_id][$item->created_time]))$tableArr[$item->employee_id][$item->created_time] = [];
            $tableArr[$item->employee_id][$item->created_time] = $item->rate;
            if(!in_array($item->employee_id, $employees)){
                array_push($employees, $item->employee_id);
            }
            if(!in_array($item->created_time, $dates)){
                array_push($dates, $item->created_time);
            }
        }

        return $this->render('index', [
            'rate' => $rate,
            'employees' => $employees,
            'dates' => $dates,
            'tableArr' => $tableArr,
        ]);

    }

    public function actionChart(){
        $rate = Rate::find()->all();
        //vd($rate);
        $employees = [];
        $dates = [];
        $tableArr = [];
        foreach ($rate as $item){
            if(is_null($tableArr[$item->employee_id][$item->created_time]))$tableArr[$item->employee_id][$item->created_time] = [];
            $tableArr[$item->employee_id][$item->created_time] = $item->rate;
            if(!in_array($item->employee_id, $employees)){
                array_push($employees, $item->employee_id);
            }
            if(!in_array($item->created_time, $dates)){
                array_push($dates, $item->created_time);
            }
        }

        return $this->render('chart', [
            'rate' => $rate,
            'employees' => $employees,
            'dates' => $dates,
            'tableArr' => $tableArr,
        ]);
    }

    public function actionCreate(){
        $employees = Employee::find()->all();
        return $this->render('create', [
            'employees' => $employees,
        ]);
    }
}