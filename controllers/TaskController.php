<?php

namespace app\controllers;

use app\models\Task;
use app\models\Attachment;
use app\models\UploadForm;
use yii\web\UploadedFile;
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
            if($file = UploadedFile::getInstance($attachment, 'attachment'))
                $attachment -> attachment = $file;
            if ($model->save() && $file){
                //attachment create
                $attachment -> task_id = $model -> id;
                $attachment -> name =  $model -> id . '.'. $attachment -> attachment -> extension;
                if ($attachment -> save())
                    $file -> saveAs($this->getApplicationPath() . $attachment -> name);
            }
            //get res
            $options = [
                'model' => $model,
                'attachment' => $attachment
            ];
            $html = $this -> renderPartial('_task', $options);
            $this -> setResult('close_modal', null);
            $this -> setResult('html_prepend', ['selector' => '.task-list', 'html' => $html]);
        }
        else{
            //get create form
            $options = [
                'model' => $model,
                'attachment' => $attachment,
                'formOption' => ['id' => 'task-create-form', 'title' => 'Добавить дело']
            ];
            $this -> setResult('open_modal', $this->renderAjax('form', $options));
        }
        return $this -> getResult();
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
