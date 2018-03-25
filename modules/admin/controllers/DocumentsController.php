<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Documents;
use app\models\DocumentsSerach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentsController implements the CRUD actions for Documents model.
 */
class DocumentsController extends Controller
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
     * Lists all Documents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $docs = Documents::find()->all();
        return $this->render('index', [
            'docs' => $docs,
        ]);
    }

    /**
     * Displays a single Documents model.
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
     * Creates a new Documents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = false;
        $model = new Documents();

        if ($model->load(Yii::$app->request->post())) {
            $model->file_name = UploadedFile::getInstance($model, 'file_name');
            $time = date('YmdHis');
            if(!is_null($model->file_name)){
                $file_name = $model->file_name;
                $model->file_name = 'images/documents/' . $time . '.' . $file_name->extension;
            }
            if($model->save()){
                if(!is_null($model->file_name)){
                    $dir = \Yii::getAlias('@app');
                    $file_name->saveAs($dir.'/web/images/documents/' . $time . '.' . $file_name->extension);
                }
                return $this->redirect(['/admin/documents/index']);
            }else{
                vd($model->errors);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //$model->file_name = UploadedFile::getInstance($model, 'file_name');
            $file = UploadedFile::getInstance($model, 'file_name');
            $time = date('YmdHis');
            if($file){
                $oldImage = $model->file_name;
                $model->file_name = 'images/documents/' . $time . '.' . $file->extension;
            }else{
                $model->file_name = Documents::find()->where(['id' => $id])->one()->file_name;
            }

            if($model->save()){
                if ($file) {
                    $dir = \Yii::getAlias('@app');
                    if(is_file($dir.'/web/'.$oldImage))
                        unlink($dir.'/web/'.$oldImage);
                    $file->saveAs($dir . '/web/images/documents/' . $time . '.' . $file->extension);
                }
                return $this->redirect(['/admin/documents/index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/admin/documents/index']);
    }

    /**
     * Finds the Documents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
