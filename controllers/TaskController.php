<?php

namespace app\controllers;

use app\models\Task;
use app\models\Attachment;
use yii\helpers\Url;
use Yii;

class TaskController extends \yii\web\Controller
{
    /**
     * res array
     * @var array
     */
    private $res = [
        'error' => null,
        'data' => null
    ];
    
    /**
     * set result to send
     * @param string|integer $param event data
     * @param boolean $success operation success
     */
    private function setResult($param, $success = true){
        if ($success)
            $this -> res['data'] = $param;
        else
            $this -> res['error'] = $param;
    }
    
    /**
     * get the result to send
     * @return jsone result
     */
    private function getResult(){
        return json_encode($this -> res);
    }
   
    public function actionIndex()
    {
        $taskList = Task :: getTaskList();
        return $this->render('index', ['taskList' => $taskList]);
    }
    
    public function actionCreate()
    {
        $model = new Task();
        $attachment = new Attachment();
        if ($model -> load(Yii::$app->request->post())){
            //task create
            if ($model->save()){
                //attachment create
                $attachment -> task_id = $model -> id;
                $attachment -> save(false);
                //
                $options = [
                    'model' => $model,
                    'attachment' => $attachment
                ];
                $this -> setResult($this -> getListView());
            }
            else
                $this -> setResult('Не удалось добавить задачу', false);
        }
        else
            //get create form
            $this -> setResult($this-> getForm($model, $attachment));
        return $this -> getResult();
    }
    
    public function actionEdit($id = null)
    {
        if ($model = Task :: findOne($id)){
            if (!$attachment = $model -> attachment)
                $attachment = new Attachment();
            if ($model -> load(Yii::$app->request->post())){
                //task create
                if ($model->save()){
                    //attachment create
                    $attachment -> task_id = $model -> id;
                    $attachment -> save(false);
                    //
                    $options = [
                        'model' => $model,
                        'attachment' => $attachment
                    ];
                    $this -> setResult($this -> getListView());
                }
                else
                    $this -> setResult('Не удалось изменить данные', false);
            }
            else
                //get edit form
                $this -> setResult($this-> getForm($model, $attachment));
        }
        else
            $this -> setResult('error', 'Не найдена задача');
        return $this -> getResult();
     }
    
    public function actionDelete($id = null){
        if ($model = Task :: findOne($id)){
            if ($model -> delete())
                $this -> setResult($this -> getListView());
            else
                $this -> setResult('Не удалось удалить задачу', false);
        }
        else
            $this -> setResult('Не найдена задача', false);
        return $this -> getResult();
    }
    
    /**
     * get create and update task form
     * @param app\models\Task $model
     * @param app\models\Attachment $attachment
     * @return string
     */
    private function getForm($model, $attachment){
        $options = [
            'model' => $model,
            'attachment' => $attachment,
            'formOption' => ['id' => 'task-create-form', 'title' => 'Добавить дело']
        ];
        return $this->renderAjax('form', $options);
    }
    
    /**
     * get task list
     * @return string
     */
    private function getListView(){
        $taskList = Task :: getTaskList();
        return $this->renderPartial('_list', ['taskList' => $taskList]);
    }
    
    /**
     * Get path to application upload
     * @return string
     */
    private function getApplicationPath()
    {
        $path = Yii::getAlias('@webroot') . '/upload/';
        if (!is_dir($path)){
            mkdir($path, 0777);
            chmod($path, 0777);
        }
        return $path;
    }
}
