<?php

declare(strict_types=1);


namespace app\controllers;

use app\models\Images;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class ImagesController extends ActiveController {

  public $modelClass = 'app\models\Images';

  public function actions() {
    $actions = parent::actions();
    unset($actions['delete'], $actions['create']);
    $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

    return $actions;
  }

  public function prepareDataProvider() {
    $query = Images::find();

    $provider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
        'pageSize' => 10,
      ],
      'sort' => [
        'defaultOrder' => [
          'id' => SORT_ASC,
        ],
      ],
    ]);

    if (Yii::$app->request->get('total') === 'true') {
      return ['total' => $provider->getTotalCount()];
    }
    $data = $provider->getModels();
    return [
      'page' => $provider->getPagination()->getPage(),
      'list' => [$data],
    ];
  }

}