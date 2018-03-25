<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Achievements;
use app\models\AchievementsSerach;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AchievementsController implements the CRUD actions for Achievements model.
 */
class AchievementsController extends Controller
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
     * Lists all Achievements models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = 'Достижения';
        $achievements = Achievements::find()->all();
        return $this->render('index', [
            'achievements' => $achievements,
        ]);
    }

    /**
     * Displays a single Achievements model.
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
     * Creates a new Achievements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = false;
        $model = new Achievements();

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');
            $time = date('YmdHis');
            if($image){
                $model->image = 'images/achievements/' . $time . '.' . $image->extension;
            }

            if($model->save()){
                if($image){
                    //$file = $model->file;
                    $dir = \Yii::getAlias('@app');
                    $image->saveAs($dir.'/web/images/achievements/' . $time . '.' . $image->extension);
                }
                return $this->redirect(['index']);
            }else{
                vd($model->errors);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Achievements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            //vd(Yii::$app->request->post());
            $image = UploadedFile::getInstance($model, 'image');
            $time = date('YmdHis');
            if(!is_null($image)){
                $oldImage = $model->image;
                $model->image = 'images/achievements/' . $time . '.' . $image->extension;
            }else{
                $model->image = $this->findModel($id)->image;
            }
            //vd($model->attributes);
            if($model->save()){
                if(!is_null($image)){
                    $dir = \Yii::getAlias('@app');
                    if(is_file($dir.'/web/'.$oldImage))
                        unlink($dir.'/web/'.$oldImage);
                    $image->saveAs($dir.'/web/images/achievements/' . $time . '.' . $image->extension);
                }
                return $this->redirect('index');
            }else{
                vd($model->errors);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Achievements model.
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
     * Finds the Achievements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Achievements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Achievements::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
