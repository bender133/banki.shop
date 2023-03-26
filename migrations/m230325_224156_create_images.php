<?php

use yii\db\Migration;

/**
 * Class m230325_224156_create_images
 */
class m230325_224156_create_images extends Migration {

  public function up() {
    $this->createTable('images', [
      'id' => $this->primaryKey(),
      'name' => $this->string(64)->notNull()->unique(),
      'time' => $this->integer(),
      'created_at' => $this->integer(),
      'updated_at' => $this->integer(),
    ]);
  }

  public function down() {
    $this->dropTable('images');
  }

}
