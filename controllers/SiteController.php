<?php

namespace app\controllers;

use app\models\Employee;
use app\models\News;
use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\User;

class SiteController extends Controller
{
    //public $layout = 'basic';
    public $defaultAction = 'index';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['new-employee', 'index', 'profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'new-employee', 'index', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
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
        $employee = Employee::find()->where(['user_id' => Yii::$app->user->id])->one();
        $employees = Employee::find()->all();
        $newsList = News::find()->orderBy('id DESC')->limit(4)->all();
        $productList = Product::find()->orderBy('id DESC')->limit(4)->all();
        if($employee){
            return $this->render('index', [
                'employee' => $employee,
                'employees' => $employees,
                'newsList' => $newsList,
                'productList' => $productList,
            ]);
        }else{
            return $this->redirect('site/new-employee');
        }
    }

    public function actionUser($user_id)
    {
        $user = User::findOne($user_id);
        $employee = Employee::find()->where(['user_id' => $user_id])->one();
        //vd($user->attributes);
        if($employee){
            return $this->render('user', [
                'employee' => $employee,
                'user' => $user,

            ]);
        }else{
            return $this->redirect('site/new-employee');
        }
    }

    public function actionReset(){

        $this->layout = 'auth';
        $model = new User();
        $post = Yii::$app->request->post();

        if(isset($post['User']['email']) && !is_null($model->findByEmail($post['User']['email']))){
            $user = $model->findByEmail($post['User']['email']);

            if($user->sendResetPassword() && $user->save()):
                $this->redirect(['index']);
            endif;
        }
        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }



    public function actionNewEmployee()
    {
        $model = new Employee();
        $model->scenario = 'new-employee';
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->team_id = 1;
            $model->branch_id = 1;
            $model->position_id = 1;
            $model->role_id = 1;
            $avatar = UploadedFile::getInstance($model, 'avatar');
            $time = date('YmdHis');
            if($avatar){
                $model->avatar = 'images/employees/' . $time . '.' . $avatar->extension;
            }
            if($model->save()){
                if($avatar){
                    $dir = \Yii::getAlias('@app');
                    $avatar->saveAs($dir.'/web/images/employees/' .$time . '.' . $avatar->extension);
                }
                return $this->redirect(['site/index']);
            }else{
                vd($model->errors);
            }

        }
        return $this->render('new-employee', [
            'model' => $model,
        ]);

    }

    public function actionLogin()
    {
        $this->layout = 'auth';
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

    public function actionProfile()
    {
        $cookies = Yii::$app->request->cookies;
        $employee_id = $cookies->getValue('employee_id');
        $employee = Employee::find()->where(['id' => $employee_id])->one();

        if ($employee->load(Yii::$app->request->post())) {
            $avatar = UploadedFile::getInstance($employee, 'avatar');
            $time = date('YmdHis');
            if($avatar){
                $oldImage = $employee->avatar;
                $employee->avatar = 'images/employees/' . $time . '.' . $avatar->extension;
            }else{
                $employee->avatar = Employee::find()->where(['id' => $employee_id])->one()->avatar;
            }
            if($employee->save()){
                if ($avatar) {
                    $dir = \Yii::getAlias('@app');
                    if(is_file($dir.'/web/'.$oldImage))
                        unlink($dir.'/web/'.$oldImage);
                    $avatar->saveAs($dir . '/web/images/employees/' . $time . '.' . $avatar->extension);
                }
                return $this->redirect(['index']);
            }else{
                vd($employee->errors);
            }
        }

        return $this->render('profile', [
            'employee' => $employee,
        ]);
    }
}
