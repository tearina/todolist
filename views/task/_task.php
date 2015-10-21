<?php
use yii\helpers\Url;


/* @var $model yii\web\Task*/
?>

<div class="task">
<!--<a href="<?= Url::to(['application/view', 'id' => $model -> id]) ?>">  -->
    <span><?= $model -> task ?></span>
    <?php if ($model -> attachment) :?>
        <div class="align-right">
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
<!-- </a>  -->
</div>
