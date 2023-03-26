<?php

declare(strict_types=1);


namespace app\models;

use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

class Images extends ActiveRecord {

  /**
   * @inheritdoc
   */
  public function behaviors(): array {
    return [
      'timestamp' => [
        'class' => TimestampBehavior::class,
        'attributes' => [
          BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
          BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
        ],
      ],
    ];
  }

  public function rules(): array {
    return [
      ['name', 'required', 'message' => 'Введите название'],
      ['time', 'safe'],
    ];
  }

  public function fields(): array {
    return [
      'id',
      'path' => 'name',
      'date' => function () {
        return Yii::$app->formatter->asDate($this->created_at, 'd-MM-Y');
      },
      'time' => function () {
        return Yii::$app->formatter->asDate($this->time, 'H:i:s');
      },
    ];
  }

  public function setTime(string $time): void {
    $this->time = strtotime((new DateTime($time))->format('H:i:s'));
  }

}