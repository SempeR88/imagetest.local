<?php 

namespace app\models;
 
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\db\Expression;
use app\models\Photos;
 
class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $photos;
 
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photos'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 5 * 1024 * 1024, 'maxFiles' => 5, 'checkExtensionByMimeType' => false],
        ];
    }
     
    /**
     * @return void
     */
    public function upload()
    {
        if ($this->validate()) { 
            foreach($this->photos as $file) {
                $urlAlias = substr(md5(microtime()), 0, 10);
                $fileName = self::renameFileName($file->baseName) . $urlAlias . '.' . $file->extension;
                $filePath = 'upload/photos/' . $fileName;
                if ($file->saveAs($filePath)) {
                    Yii::$app->db->createCommand()->insert(Photos::tableName(), [
                        'fileName' => $fileName,
                        'filePath' => $filePath,
                        'timedate' => new Expression('NOW()'),
                    ])->execute();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $fileName
     * @return string
     */
    private static function renameFileName(string $fileName): string
    {
        $pattern = "[^a-zа-я0-9-_\.]";
			$name = mb_eregi_replace($pattern, '_', $fileName);
			$name = mb_ereg_replace('[-]+', '-', $name);
			
			$converter = [
				'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya', 
			
				'А' => 'a',   'Б' => 'b',   'В' => 'v',    'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
				'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',    'И' => 'i',   'Й' => 'y',   'К' => 'k',
				'Л' => 'l',   'М' => 'm',   'Н' => 'n',    'О' => 'o',   'П' => 'p',   'Р' => 'r',
				'С' => 's',   'Т' => 't',   'У' => 'u',    'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',
				'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',  'Ь' => '',    'Ы' => 'y',   'Ъ' => '',
				'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',
            ];

            $name = strtr($name, $converter);
            return $name . '_' . bin2hex(random_bytes(3));
    }
}