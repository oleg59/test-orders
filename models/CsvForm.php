<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Foto;
use yii\web\UploadedFile;

class CsvForm extends Model
{
    public $file;
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file' => 'Фаил CSV'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv', 'checkExtensionByMimeType' => false, 'maxFiles' => 1, 'maxSize' => 2000 * 1024, 'tooBig' => 'Размер фаила до 2МБ'],
        ];
    }
}