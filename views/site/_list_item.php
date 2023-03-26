<?php

declare(strict_types=1);

use yii\helpers\Url;

/* @var $model \app\models\Images */
?>

<div style="padding=10%,10%;border:1px solid">
    <a href="<?= Url::to("/uploads/$model->name") ?>">
        <img src="<?= Url::to("/uploads/$model->name") ?>"
             width="200"
             height="150" alt="Превью изображения">
    </a>
    <p>name: <?= $model->name ?></p>
    <p>date: <?= Yii::$app->formatter->asDate($model->created_at, 'd-MM-Y') ?></p>
    <p>time: <?= Yii::$app->formatter->asTime($model->time, 'H:i:s') ?></p>
</div>