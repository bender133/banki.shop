<?php

namespace app\controllers;

use app\models\Images;
use app\models\UploadFilesForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\UploadedFile;

class SiteController extends Controller {

  /**
   * {@inheritdoc}
   */
  public function actions() {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : NULL,
      ],
    ];
  }


  public function actionIndex() {

    $model = new UploadFilesForm();

    if (Yii::$app->request->isPost) {

      $model->files = UploadedFile::getInstances($model, 'files');

      if ($model->upload()) {
        foreach ($model->files as $file) {
          $images = new Images();
          $images->name = $file->name;
          $images->setTime('now');
          $images->save();
        }
        Yii::$app->session->setFlash('success', 'Изображения загружены');
        return $this->refresh();
      }
    }

    $sort = new Sort([
      'attributes' => [
        'name' => [
          'asc' => ['name' => SORT_ASC],
          'desc' => ['name' => SORT_DESC],
          'default' => SORT_DESC,
          'label' => 'Name',
        ],
        'created_at' => [
          'asc' => ['created_at' => SORT_ASC],
          'desc' => ['created_at' => SORT_DESC],
          'label' => 'Data',
        ],
        'time' => [
          'asc' => ['time' => SORT_ASC],
          'desc' => ['time' => SORT_DESC],
          'label' => 'Time',
        ],
      ],
    ]);

    $dataProvider = new ActiveDataProvider([
      'query' => Images::find()->orderBy($sort->orders),
      'pagination' => [
        'pageSize' => 10,
      ],
    ]);


    return $this->render('index', [
      'dataProvider' => $dataProvider,
      'sort' => $sort,
      'model' => $model,
    ]);
  }

}
