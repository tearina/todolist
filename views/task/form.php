<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $model app\models\Task */
    /* @var $attachment app\models\Attachment */
    /* @var $form yii\widgets\ActiveForm */
    /* @var $role app\rbac\models\Role; */
?>
<div class="application-add-form">

    <?php $form = ActiveForm::begin(['id' => 'task-form', 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal col-sm-8']]) ?>

    <?= $form -> field($model, 'task');?>

    <?= $form -> field($attachment, 'attachment') -> fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 
</div>