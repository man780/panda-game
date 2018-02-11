<?php

namespace app\controllers;

use app\models\AddUserEmployeeForm;
use app\models\Invite;
use app\models\User;
use Yii;
use app\models\Employee;
use app\models\EmployeeSerach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGamers(){
        $employees = Employee::find()->all();
        $model = new Employee();
        $invite = new Invite();
        return $this->render('gamers', [
            'employees' => $employees,
            'model' => $model,
            'invite' => $invite,
        ]);
    }

    public function actionInvite(){
        $invite = new Invite();
        if ($invite->load(Yii::$app->request->get())) {
            //vd($invite->attributes);
            if($invite->send() && $invite->save()){
                return $this->redirect(['gamers']);
            }
        }
    }

    public function actionConfirmEmail(){
        $get = Yii::$app->request->get();
        $invite = Invite::find()->where(['invite_code' => $get['token']])->one();
        $count = count(User::findAll(['email' => $invite->email]));
        $message = '';
        if($count==0 && is_array($invite->attributes) && $invite->status==0){
            //$invite->status=1;
            //if($invite->save() && $invite->confirmed($invite->id)){
            $message = 'Спасибо за подтверждение почты!';
            //}
        }elseif($count>0){
            $message = 'Это почта уже зарегистрирована!';
        }else{
            $message = 'Вы уже подтвердили эту почту!';
        }
        $addUserEmployeeForm = new AddUserEmployeeForm();
        return $this->render('confirm', [
            'message' => $message,
            'addUserEmployeeForm' => $addUserEmployeeForm,
        ]);
    }

    public function actionAddUserEmployee(){
        $post = Yii::$app->request->post();
        vd($post);
    }

    public function actionSaveUser($invite_id){

        return $this->render('save-user', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
