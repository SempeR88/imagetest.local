<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use app\models\UploadForm;
use app\models\Photos;

class PhotosController extends Controller
{
    public function actionUpload()
    {
        $model = new UploadForm();
 
        if (Yii::$app->request->isPost) {
            $model->photos = UploadedFile::getInstances($model, 'photos');
            if ($model->upload()) {
                Yii::$app->session->setFlash('success', 'Фотографии загружены');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка загрузки фото');
            }
        }
 
        return $this->render('upload', ['model' => $model]);
    }

    public function actionIndex()
    {
        $query = Photos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'totalCount' => $query->count(),
                'pageSize' => 5,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
            'sort' => [
                'attributes' => [
                    'fileName',
                    'timedate',
                ],
                'defaultOrder' => [
                    'timedate' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}