<?php

/** @var yii\web\View $this */


use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = 'My Yii Application';
?>
<style>
    .pagination > li {
        border: 1px solid black;
        border-radius:5px;
        margin: 3px;
        padding: 2px;
        background-color: rgba(128, 128, 128, 0.18);
    }

    ;
</style>
<?php
/* @var $this yii\web\View */
/* @var $model \app\models\UploadFilesForm */
/* @var $images \app\models\Images */
/* @var $dataProvider  \yii\data\ActiveDataProvider */
/* @var $sort  \yii\data\Sort */
?>
<?= $sort->link('name') . ' | ' . $sort->link('created_at') . ' | ' . $sort->link('time') ?>

<?php $form = ActiveForm::begin(['options' => []]) ?>
<?= $form->field($model, 'files[]')->fileInput([
  'multiple' => TRUE,
  'accept' => 'image/*',
  'class' => 'form-control-file',
]) ?>
<button class="btn btn-success my-btn">Submit</button>
<?php ActiveForm::end() ?>

<div class="row">
  <?=
  ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{pager}{items}{summary}",
    'itemView' => function ($model) {
      return $this->render('_list_item', ['model' => $model]);
    },
    'pager' => [
      'firstPageLabel' => 'первая',
      'lastPageLabel' => 'последняя',
      'nextPageLabel' => 'вперед>>',
      'prevPageLabel' => '<<назад',
      'maxButtonCount' => 3,
    ],
  ]);
  ?>
</div>
