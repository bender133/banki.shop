<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFilesForm extends Model {

  private const CONVERT = [
    'а' => 'a',
    'б' => 'b',
    'в' => 'v',
    'г' => 'g',
    'д' => 'd',
    'е' => 'e',
    'ё' => 'e',
    'ж' => 'zh',
    'з' => 'z',
    'и' => 'i',
    'й' => 'y',
    'к' => 'k',
    'л' => 'l',
    'м' => 'm',
    'н' => 'n',
    'о' => 'o',
    'п' => 'p',
    'р' => 'r',
    'с' => 's',
    'т' => 't',
    'у' => 'u',
    'ф' => 'f',
    'х' => 'h',
    'ц' => 'ts',
    'ч' => 'ch',
    'ш' => 'sh',
    'щ' => 'sch',
    'ъ' => '',
    'ы' => 'y',
    'ь' => '',
    'э' => 'e',
    'ю' => 'yu',
    'я' => 'ya',
  ];

  /**
   * @var UploadedFile[]
   */
  public $files;

  public int $time;

  public function rules(): array {
    return [
      [
        'files',
        'image',
        'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
        'checkExtensionByMimeType' => TRUE,
        'maxSize' => 20971520,
        'tooBig' => 'Limit is 20Mb',
        'maxFiles' => 5,
      ],
    ];
  }

  public function upload(): bool {
    if ($this->validate()) {
      foreach ($this->files as $file) {
        $name = $this->transleateFileName($file->baseName);
        $name = file_exists('uploads/' . $name . '.' . $file->extension) ? $this->randomFileName() : $name;
        $file->saveAs('uploads/' . $name . '.' . $file->extension);
        $file->name = $name . '.' . $file->extension;
      }
      return TRUE;
    }

    return FALSE;
  }

  private function randomFileName(): string {
    return bin2hex(random_bytes(10));
  }

  public function transleateFileName(string $filename): string {
    return strtr(mb_strtolower($filename), self::CONVERT);
  }

}