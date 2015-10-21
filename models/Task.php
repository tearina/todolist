<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id task id
 * @property string $task task formulation
 *
 * @property Attachment[] $attachments
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['task'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task' => 'Задача',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachment()
    {
        return $this->hasOne(Attachment::className(), ['task_id' => 'id']);
    }
    
    public static function getTaskList(){
        $query = self::find()->joinWith(['attachment']);;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);
        return $dataProvider;
    }
}
