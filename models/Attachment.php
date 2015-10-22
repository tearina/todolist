<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attachment".
 *
 * @property integer $id attachment id
 * @property integer $task_id task id
 * @property string $name file name
 * @property integer $is_pic if attachment is a picture = 1 else = 0
 *
 * @property Task $task
 */
class Attachment extends \yii\db\ActiveRecord
{
    const MAX_SIZE_FILE = 5242880;
    
    const MAX_SIZE_FILE_MSG = 'Размер файла не должен превышать 5 Мб.';
    /**
     * load task attachment
     * @var attachment
     */
    public $attachment;
    
    /**
     * delete task attachment
     * @var del_attachment
     */
    //public $del_attachment;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'name'], 'required'],
            [['attachment', 'name', 'is_pic'], 'safe'],
            //[['del_img'], 'boolean'],
            [['attachment'], 'file', 'maxSize' => self :: MAX_SIZE_FILE, 'checkExtensionByMimeType' => false, 'tooBig' => self :: MAX_SIZE_FILE_MSG]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'ID задачи',
            'name' => 'Наименование файла',
            'is_pic' => 'Является картинкой',
            'attachment' => 'Файл',
            //'del_attachment' => 'Удалить файл'
        ];
    }

    public function beforeSave($insert)
    {
        $imgTypes = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
        $this -> is_pic = (in_array($this -> attachment -> type, $imgTypes)) ? 1 : 0;
        return parent::beforeSave($insert);
    }
    
    public function beforeDelete(){
        if (parent::beforeDelete())
        {
            $this -> deleteFile();
            return true;
        }
        return false;
    }
    
    public function deleteFile(){
        $file = $this -> getUploadPath() . $this -> name;
        if (file_exists($file)){
            unlink($this -> getUploadPath() . $this -> name);
            $this -> attachment = '';
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
    
    /**
     * Get path to upload
     * @return string
     */
    private function getUploadPath()
    {
        $path = Yii::getAlias('@webroot') . '/upload/';
        if (!is_dir($path)){
            mkdir($path, 0777);
            chmod($path, 0777);
        }
        return $path;
    }
}
