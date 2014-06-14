<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comment-form">

    <p>
        <?= Html::a(Html::encode($model->post->title), ['post/view', 'id' => $model->post_id]) ?> へのコメント
    </p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
