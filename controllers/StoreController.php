<?php

namespace app\controllers;

use app\models\Employee;
use app\models\EmployeeRate;
use app\models\Product;
use app\models\ProductEmployee;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class StoreController extends Controller
{

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


    public function actionIndex()
    {
        $this->view->title = 'Магазин';
        $productList = Product::find()->all();
        $cookies = Yii::$app->request->cookies;
        $employee_id = $cookies->getValue('employee_id');
        $employee = Employee::findOne($employee_id);
        $myProductList = $employee->products;
        return $this->render('index', [
            'productList' => $productList,
            'myPproductList' => $myProductList,
        ]);
    }


    public function actionBuy($id){
        $this->layout = 'clear';
        //$this->view->title = 'Добавить новый товар';
        $product = $this->findModel($id);
        $post = Yii::$app->request->post();
        if(!empty($post)){
            $cookies = Yii::$app->request->cookies;
            $employee_id = $cookies->getValue('employee_id');
            $employee = Employee::findOne($employee_id);
//vd([$product->cost , $employee->employeeRate->current_rate]);
            if($product->cost < $employee->employeeRate->current_rate){
                $employeeRate = EmployeeRate::find()->where(['employee_id' => $employee->id])->one();
                $employeeRate->current_rate = $employeeRate->current_rate - $product->cost;
                $product->quantity = $product->quantity - 1;
                $productEmployee = new ProductEmployee();
                $productEmployee->product_id = $product->id;
                $productEmployee->employee_id = $employee->id;
                if($employeeRate->save() && $product->save() && $productEmployee->save()){
                    Yii::$app->session->setFlash('success', 'Вы успешно приобрели этот товар!');
                    $this->redirect(['/']);
                }else{
                    vd([$employeeRate->errors, $product->errors, $productEmployee->errors]);
                }

            }else{
                Yii::$app->session->setFlash('error', 'У вас не достаточно средств на балансе для покупки этого товара!');
                $this->redirect(['/']);
            }
        }

        return $this->render('buy', [
            'model' => $product,
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
