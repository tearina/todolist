<?php
use yii\helpers\Url;

/* @var $model yii\web\Task*/
?>

<div class="task">
    <a class="ajax-link control pull-right" href="<?= Url::to(['task/delete', 'id' => $model -> id]) ?>"
        data-type="control" data-message="Вы уверены, что хотите удалить задачу?">
        <span class="glyphicon glyphicon-remove"></span>
    </a>
    <a class="ajax-link control pull-right" href="<?= Url::to(['task/edit', 'id' => $model -> id]) ?>" data-type="open_modal">
        <span class="glyphicon glyphicon-pencil"></span>
    </a>
    <span><?= $model -> task ?></span>
    <?php if ($model -> attachment) :?>
        <div class="attachment">
        <?php if ($model -> attachment -> is_pic) :?>
            <a class="gallery" href="/upload/<?= $model -> attachment -> name ?>">
                <img src="/upload/<?= $model -> attachment -> name ?>">
            </a>
        <?php else: ?>
            <a href="/upload/<?= $model -> attachment -> name ?>" download> 
                <span><?= $model -> attachment -> name ?></span>
            </a>
        <?php endif;?>
        </div>
    <?php endif;?>
</div>

