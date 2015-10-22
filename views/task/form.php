<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View
     * @var $model app\models\Task
     * @var $attachment app\models\Attachment
     * @var $form yii\widgets\ActiveForm
     * @var $role app\rbac\models\Role;
     */
?>
<div class="modal-dialog">
    <?php $form = ActiveForm::begin(['id' => $formOption['id'], 'options' => ['enctype' => 'multipart/form-data', 'class' => 'form ajax_form']]) ?>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span><span class="sr-only"></span>
            </button>
            <h4 class="modal-title"><?= $formOption['title'] ?></h4>
        </div>
        <div class="modal-body">
               <?= $form -> field($model, 'task', [
                   'labelOptions' => ['class' => 'col-sm-2 control-label'],
                   'template' => '{label}<div class="row"><div class="col-sm-8">{input}{error}{hint}</div></div>'
               ]) ?>
               <?= $form -> field($attachment, 'attachment', [
                   'labelOptions' => ['class' => 'col-sm-2 control-label'],
                   'template' => '{label}<div class="row"><div class="col-sm-8">{input}{error}{hint}</div></div>'
               ]) -> fileInput() ?>
        </div>
        <div class="modal-footer">
            <?= Html::submitButton(Yii::t('app', 'Закрыть'), ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) ?>
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary sendForm']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>