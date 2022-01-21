<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "photos".
 *
 * @property int $id
 * @property string $fileName
 * @property string $filePath
 * @property string $timedate
 */
class Photos extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fileName', 'filePath'], 'required'],
            [['fileName', 'filePath'], 'string', 'max' => 400],
            [['timedate'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fileName' => 'Название файла',
            'filePath' => 'Путь до файла',
            'timedate' => 'Дата и время',
        ];
    }
}