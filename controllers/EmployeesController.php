<?php

namespace app\controllers;

use app\models\AddUserEmployeeForm;
use app\models\EmployeeRate;
use app\models\SendRateForm;
use app\models\Branch;
use app\models\Invite;
use app\models\Position;
use app\models\Roles;
use app\models\Team;
use app\models\TransferRate;
use app\models\User;
use Yii;
use app\models\Employee;
use app\models\EmployeeSerach;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeesController extends Controller
{
    public $defaultAction = 'gamers';
    /**
     * @inheritdoc
     */
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
                    [
                        'actions' => ['confirm-email', 'add-user-employee'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionGamers(){
        $employees = Employee::find()->where(['>', 'branch_id', 1])->all();
        $model = new Employee();
        $invite = new Invite();
        $toConfirmList = Employee::find()->where(['branch_id' => 1])->all();
        return $this->render('gamers', [
            'employees' => $employees,
            'model' => $model,
            'invite' => $invite,
            'toConfirmList' => $toConfirmList,
        ]);
    }

    public function actionInvite(){
        $invite = new Invite();
        if ($invite->load(Yii::$app->request->get())) {
            //vd($invite->attributes);
            $invite->status = null;
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
        //vd($invite->attributes);
        if($count==0 && is_array($invite->attributes) && $invite->status==0){
            //$invite->status=1;
            //if($invite->save() && $invite->confirmed($invite->id)){
            $message = 'Спасибо за подтверждение почты!<br>';
            $message .= 'Пожалуйста заполните форму';
            //}
        }elseif($count>0){
            $message = 'Это почта уже зарегистрирована!';
        }else{
            $message = 'Вы уже подтвердили эту почту!';
        }
        $addUserEmployeeForm = new AddUserEmployeeForm();
        $addUserEmployeeForm->token = $get['token'];
        $addUserEmployeeForm->email = $invite['email'];
        $fioArr = explode(' ', $invite['fio']);
        $addUserEmployeeForm->name = $fioArr[1];
        $addUserEmployeeForm->fname = $fioArr[0];
        return $this->render('confirm', [
            'message' => $message,
            'addUserEmployeeForm' => $addUserEmployeeForm,
        ]);
    }

    public function actionAddUserEmployee(){
        $post = Yii::$app->request->post();
        $user = new AddUserEmployeeForm();
        $user->load(Yii::$app->request->post());
        $user->status = 1;
        $invite = Invite::find()->where(['invite_code' => $user->token])->one();
        //vd($invite);
        $invite->status = 0;
        //vd($user);
        if($user->reg() && $invite->save()){
            return $this->redirect('/');
            //vd([$user, $post]);
        }else{
            vd($invite->errors);
        }

    }

    public function actionSaveUser($invite_id){
        //$model = $this->f
        return $this->render('save-user', [
            //'model' => $model,
        ]);
    }

    public function actionConfirmEmployee($employee_id){

        $this->view->title = 'Подтверждения сотрудника админом';
        $employee = Employee::find()->where(['id' => $employee_id])->one();

        if ($employee->load(Yii::$app->request->post())) {
            $user = $employee->user;
            $user->status = 10;
            if($employee->save() && $user->save()){
                return $this->redirect(['gamers']);
            }else{
                vd($employee->errors);
                vd($user->errors);
            }
        }

        $branch = new Branch();
        $team = new Team();
        $position = new Position();
        $role = new Roles();
        $branches = ArrayHelper::map($branch->getList(), 'id', 'name');
        $teams = ArrayHelper::map($team->getList(), 'id', 'name');
        $positions = ArrayHelper::map($position->getList(), 'id', 'name');
        $roles = ArrayHelper::map($role->getList(), 'id', 'name');

        return $this->render('confirm-employee', [
            'employee' => $employee,
            'branches' => $branches,
            'teams' => $teams,
            'positions' => $positions,
            'roles' => $roles,
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

    public function actionRating(){
        $employee = Employee::find()->where(['user_id' => Yii::$app->user->id])->one();
        $employees = Employee::find()->where(['!=', 'id', $employee->id])->all();
        return $this->render('rating', [
            'employees' => $employees,
        ]);
    }

    public function actionSendRating($to_employee){
        $this->layout = false;
        $employeeFrom = Employee::find()->where(['user_id' => Yii::$app->user->id])->one();
        $employeeTo = Employee::findOne($to_employee);
        $sendRate = new SendRateForm();
        if ($sendRate->load(Yii::$app->request->post()) ) {
            //vd(Yii::$app->request->post(), false);
            $transfer = new TransferRate();
            $transfer->to_employee = $sendRate->to_employee;
            $transfer->from_employee = $sendRate->from_employee;
            $transfer->rate = $sendRate->rate;
            $transferFrom = EmployeeRate::find()->where(['employee_id' => $employeeFrom->id])->one();
            $transferFrom->current_rate = $transferFrom->current_rate - $sendRate->rate;

            $transferTo = EmployeeRate::find()->where(['employee_id' => $employeeTo->id])->one();
            if(!is_null($transferTo)){
                $transferTo->current_rate = $transferTo->current_rate + $sendRate->rate;
                $transferTo->global_rate = $transferTo->global_rate + $sendRate->rate;
            }else{
                $transferTo = new EmployeeRate();
                $transferTo->employee_id = $employeeTo->id;
                $transferTo->rate = $sendRate->rate;
                $transferTo->current_rate = $sendRate->rate;
                $transferTo->global_rate = $sendRate->rate;
            }

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();

            try {
                if($transferTo->save() && $transferFrom->save() && $transfer->save()){
                    Yii::$app->session->setFlash('success', 'Запись добавлена!');
                    return $this->redirect('/');
                }else{
                    $transaction->rollBack();
                    vd([$transferTo->errors, $transferFrom->errors, $transfer->errors]);
                }
                // ... executing other SQL statements ...

                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch(\Throwable $e) {
                $transaction->rollBack();
            }

            /*vd($transferTo);
            vd($transferFrom->current_rate);
            vd($transfer->attributes);*/
        }

        $sendRate->to_employee = $employeeTo->id;
        $sendRate->from_employee = $employeeFrom->id;
        return $this->render('send_rate_form', [
            'rate' => $sendRate,
            'employeeFrom' => $employeeFrom,
            'employeeTo' => $employeeTo,
        ]);
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
