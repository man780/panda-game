<?php
namespace app\modules\admin\controllers;

use app\models\Employee;
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
// link to Google Docs spreadsheet
$url='https://docs.google.com/spreadsheets/d/1dpTtDqGWg24l6j9HMPOak6MkNtJTLFRV2yTSWptUAO4/edit?alt=json#gid=0';

// open file for reading
if (($handle = fopen($url, "r")) !== FALSE)
{
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
        $totalrows = count($data);
        for ($row=0; $row<=$totalrows; $row++)
        {
            // only print out even rows, i.e. the questions
            // the second if is to avoid blank divs from being printed out
            // which was a bug I was experiencing
            if (($row % 2 == 0) && (strlen($data[$row])>0))
            {
                $answer = $row + 1;
                echo '<dt><span class="icon"></span>'.$data[$row].'</dt><dd>'.$data[$answer].'</dd>';
            }
        }
    }
    fclose($handle);
}

    }
}