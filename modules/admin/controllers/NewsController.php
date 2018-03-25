<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\News;
use app\models\NewsSerach;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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

    public function actionIndex()
    {
        $this->view->title = 'Новости';
        $news = News::find()->all();
        return $this->render('index', [
            'newsList' => $news,
        ]);
    }

    public  function actionCreate(){
        $this->view->title = 'Добавить новость';
        $this->layout = 'clear';
        $news = new News();
        if($news->load(Yii::$app->request->post())){
            $image = UploadedFile::getInstance($news, 'image');
            $time = date('YmdHis');
            if($image){
                $news->image = 'images/news/' . $time . '.' . $image->extension;
            }
            if($news->save()){
                if($image){
                    $dir = \Yii::getAlias('@app');
                    $image->saveAs($dir.'/web/images/news/' .$time . '.' . $image->extension);
                }
                return $this->redirect(['/admin/news/index']);
            }else{
                vd($news->errors);
            }
        }

        //vd($news);
        return $this->render('create', [
            'model' => $news,
        ]);
    }

    /**
     * Updates an existing News model.
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

            $image = UploadedFile::getInstance($model, 'image');
            $time = date('YmdHis');
            if($image){
                $oldImage = $model->image;
                $model->image = 'images/news/' . $time . '.' . $image->extension;
            }else{
                $model->image = News::find()->where(['id' => $id])->one()->image;
            }

            if($model->save()) {
                if ($image) {
                    $dir = \Yii::getAlias('@app');
                    if(is_file($dir.'/web/'.$oldImage))
                        unlink($dir.'/web/'.$oldImage);
                    $image->saveAs($dir . '/web/images/news/' . $time . '.' . $image->extension);
                }
                return $this->redirect(['index']);
            }else{
                vd($model->attritbutes);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
