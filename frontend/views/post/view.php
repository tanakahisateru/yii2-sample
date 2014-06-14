<?php
/**
 * @var yii\web\View $this
 * @var Post $model
 * @var \frontend\models\CommentForm $commentFormModel
 */
use common\models\Post;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '記事一覧', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><i class="fa fa-file-o"></i> <?= Html::encode($model->title) ?></h1>
<div><span class="label label-default"><?= Html::encode($model->category->name); ?></span></div>
<p>
    <?= nl2br(Html::encode($model->body)) ?>
</p>
<div>作成日時 <?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at)) ?></div>
<div>更新日時 <?= Html::encode(Yii::$app->formatter->asDatetime($model->updated_at)) ?></div>

<div class="comments">
    <h2>コメント</h2>

    <?php foreach ($model->comments as $comment): ?>
        <div class="comment">
            <p><?= nl2br(Html::encode($comment->body)) ?></p>
            <div>作成日時 <?= Html::encode(Yii::$app->formatter->asDatetime($comment->created_at)) ?></div>
            <div>更新日時 <?= Html::encode(Yii::$app->formatter->asDatetime($comment->updated_at)) ?></div>
        </div>
    <?php endforeach; ?>

    <div class="commnt-form">
        <?php $form = ActiveForm::begin(['action' => ['comment']]); ?>
        <?= $form->field($commentFormModel, 'post_id')->hiddenInput() ?>
        <?= $form->field($commentFormModel, 'body')->textarea() ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

