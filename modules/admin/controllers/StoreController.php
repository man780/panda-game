<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\Product;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class StoreController extends Controller
{
    //public $layout = 'basic';
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
        $this->view->title = 'Магазин';
		$products = Product::find()->all();
		//vd($products);
        return $this->render('index', [
			'products' => $products,
		]);
    }

    public function actionCreate(){
        $this->layout = false;
        $this->view->title = 'Добавить новый товар';
        $model = new Product();
        return $this->render('form', [
            'model' => $model,
        ]);
    }
}
