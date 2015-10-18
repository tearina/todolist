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
            [['task_id', 'is_pic'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
