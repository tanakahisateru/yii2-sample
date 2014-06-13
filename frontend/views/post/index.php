<?php
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
use common\models\Post;
use yii\helpers\Html;

$this->title = "記事一覧";
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>記事一覧</h1>

<?php $this->beginBlock('posts-table'); ?>
<table class="table">
    <tr>
        <th>タイトル</th>
        <th>カテゴリ</th>
        <th>作成日時</th>
        <th>更新日時</th>
    </tr>
    <tbody>
        {items}
    </tbody>
</table>
{pager}
<?php $this->endBlock(); ?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => $this->blocks['posts-table'],
    'itemView' => function(Post $model) {
        ob_start(); ?>
        <tr>
            <td><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]); ?></td>
            <td><span class="label label-default"><?= Html::encode($model->category->name); ?></span></td>
            <td><?= Html::encode(Yii::$app->formatter->asDatetime($model->created_at)); ?></td>
            <td><?= Html::encode(Yii::$app->formatter->asDatetime($model->updated_at)); ?></td>
        </tr>
        <?php return ob_get_clean();
    }
]) ?>
