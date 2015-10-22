<?php

namespace app\controllers;

use app\models\Task;
use app\models\Attachment;
use app\models\UploadForm;
use yii\helpers\Url;
use Yii;

class TaskController extends \yii\web\Controller
{
    /**
     * res array
     * @var array
     */
    private $res;
    
    /**
     * set result to send
     * @param string $event event name
     * @param string|integer $param event data
     */
    private function setResult($event, $param){
        $this -> res[$event] = $param;
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
            }
            //get res
            $options = [
                'model' => $model,
                'attachment' => $attachment
            ];
            $html = $this -> getListView();
            $this -> setResult('close_modal', null);
            $this -> setResult('html_replace', ['selector' => '.task-list', 'html' => $html]);
            $this -> setResult('colorBoxes', "a.gallery");
        }
        else
            $this -> setResult('open_modal', $this-> getForm($model, $attachment));
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
                }
                //get res
                $options = [
                'model' => $model,
                'attachment' => $attachment
                ];
                $html = $this -> getListView();
                $this -> setResult('close_modal', null);
                $this -> setResult('html_replace', ['selector' => '.task-list', 'html' => $html]);
                $this -> setResult('colorBoxes', "a.gallery");
            }
            else
                $this -> setResult('open_modal', $this-> getForm($model, $attachment));
        }
        else
            $this -> setResult('alert', 'Не найден элемент');
        return $this -> getResult();
     }
    
    public function actionDelete($id = null){
        if ($model = Task :: findOne($id)){
            $model -> delete();
            $html = $this -> getListView();
            $this -> setResult('html_replace', ['selector' => '.task-list', 'html' => $html]);
        }
        else
            $this -> setResult('alert', 'Не найден элемент');
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
