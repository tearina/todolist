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
            //get file
            if($file = UploadedFile::getInstance($attachment, 'attachment'))
                $attachment -> attachment = $file;
            //task safe
            if ($model->save() && $file){
                //attachment safe
                $attachment -> task_id = $model -> id;
                $attachment -> name =  $model -> id . '.'. $attachment -> attachment -> extension;
                if ($attachment -> save())
                    $file -> saveAs($this->getApplicationPath() . $attachment -> name);
            }
                
            $this -> redirect(array('index'));
        }
        else
            return $this->render('form', ['model' => $model, 'attachment' => $attachment]);
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
