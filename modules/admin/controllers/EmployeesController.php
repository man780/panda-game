<?php

namespace app\modules\admin\controllers;

use app\models\Achievements;
use app\models\AchievementsEmployee;
use app\models\AddUserEmployeeForm;
use app\models\Branch;
use app\models\EmployeeRate;
use app\models\Invite;
use app\models\Position;
use app\models\Roles;
use app\models\Team;
use app\models\User;
use Yii;
use app\models\Employee;
use app\models\EmployeeSerach;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        $employees = Employee::find()->where(['>', 'branch_id', 1])->all();
        $model = new Employee();
        $invite = new Invite();
        $toConfirmList = Employee::find()->where(['branch_id' => 1])->all();
        //vd($toConfirmList);

        $branch = new Branch();
        $team = new Team();
        $branches = ArrayHelper::map($branch->getList(), 'id', 'name');
        $teams = ArrayHelper::map($team->getList(), 'id', 'name');

        return $this->render('gamers', [
            'employees' => $employees,
            'model' => $model,
            'invite' => $invite,
            'toConfirmList' => $toConfirmList,
            'branches' => $branches,
            'teams' => $teams,
        ]);
    }

    public function actionInvite(){
        $invite = new Invite();
        if ($invite->load(Yii::$app->request->get())) {
            //vd($invite->attributes);
            $invite->status = null;
            //vd($invite);
            if($invite->send() && $invite->save()){
                return $this->redirect(['gamers']);
            }
        }
    }

    public function actionConfirmEmail(){
        $this->layout = 'clear';
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
        $invite->status = 0;

        if($user->reg() && $invite->save()){
            return $this->redirect('/');
            //vd([$user, $post]);
        }else{
            vd($invite->errors);
        }

    }

    public function actionSaveUser($invite_id){

        return $this->render('save-user', [
            'model' => $model,
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
        $this->layout = 'clear';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'avatar');
            $time = date('YmdHis');
            if($image){
                $oldImage = $model->avatar;
                $model->avatar = 'images/employees/' . $time . '.' . $image->extension;
            }else{
                $model->avatar = Employee::findOne($id)->avatar;
            }
            $post = Yii::$app->request->post();
            if(isset($post['rate']) && !empty($post['rate'])){
                $employeeRate = EmployeeRate::find()->where(['employee_id' => $id])->one();
                //vd($employeeRate);
                if(is_null($employeeRate)){
                    $employeeRate = new EmployeeRate();
                    $employeeRate->employee_id = $id;
                    $employeeRate->rate = $post['rate'];
                    $employeeRate->current_rate = $post['rate'];
                    $employeeRate->global_rate = $post['rate'];
                }else{
                    $employeeRate->rate = $post['rate'];
                    $employeeRate->current_rate = $employeeRate->current_rate+$post['rate'];
                    $employeeRate->global_rate = $employeeRate->global_rate+$post['rate'];
                }

                if(!$employeeRate->save()){
                    vd($employeeRate->attributes);
                }
            }
            if($model->save()) {
                if ($image) {
                    $dir = \Yii::getAlias('@app');
                    if(is_file($dir.'/web/'.$oldImage))
                        unlink($dir.'/web/'.$oldImage);
                    $image->saveAs($dir . '/web/images/employees/' . $time . '.' . $image->extension);
                }
                return $this->redirect(['gamers']);
            }else{
                vd($model->errors);
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
        $rate = $model->employeeRate->current_rate;
        //$achievements = ;
        $achievements = ArrayHelper::map(Achievements::find()->all(), 'id', 'name');
        $myAchievements = $model->achievements;
        if(is_null($rate)){
            $rate = 0;
        }
        //vd($rate);

        return $this->render('update', [
            'model' => $model,
            'branches' => $branches,
            'teams' => $teams,
            'positions' => $positions,
            'roles' => $roles,
            'rate' => $rate,
            'achievements' => $achievements,
            'myAchievements' => $myAchievements,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAchievements($id)
    {
        $this->layout = 'clear';
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if (isset($post['achievements'])) {

            //$model->unlinkAll('achievements', true);
            $achievementsArr = explode(',', $post['achievements']);
            //vd($achievementsArr);
            if(is_array($achievementsArr) && count($achievementsArr) > 0 && $achievementsArr[0] != '')
                foreach ($achievementsArr as $achievement_id){
                    $achievementsEmployee = AchievementsEmployee::find()->where(['achievement_id' => $achievement_id, employee_id => $model->id])->one();
                    //vd($achievementsEmployee);
                    if(is_null($achievementsEmployee)){
                        $achievementsEmployee = new AchievementsEmployee();
                        $achievementsEmployee->achievement_id = $achievement_id;
                        $achievementsEmployee->employee_id = $model->id;
                        if($achievementsEmployee->save()){
                            $achievementsEmployee->setRate($model->id, $achievement_id);

                        }else{
                            vd($achievementsEmployee->errors);
                        }
                    }

                    /*$achievementsEmployee = new AchievementsEmployee();
                    $achievementsEmployee->achievement_id = $achievement_id;
                    $achievementsEmployee->employee_id = $model->id;
                    if(!$achievementsEmployee->save()){
                        vd($achievementsEmployee->errors);
                    }*/

                }


            return $this->redirect(['gamers']);

        }

        $rate = $model->employeeRate->current_rate;
        if(is_null($rate)){
            $rate = 0;
        }
        $myAchievements = $model->achievements;
        $myAchievementsIds = [];
        foreach ($myAchievements as $achi){
            $myAchievementsIds[] = $achi->id;
        }
        $achievements = Achievements::find()->all();
        //vd($myAchievements);
        return $this->render('achievements', [
            'model' => $model,
            'rate' => $rate,
            'achievements' => $achievements,
            'myAchievementsIds' => join(',', $myAchievementsIds),
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

        return $this->redirect(['gamers']);
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
