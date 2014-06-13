<?php
/**
 * @var yii\web\View $this
 * @var Post $model
 */
use common\models\Post;
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
