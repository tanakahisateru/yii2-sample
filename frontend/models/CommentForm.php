<?php
namespace frontend\models;

use common\models\Comment;
use yii\base\Model;
use Yii;

/**
 * Comment form
 */
class CommentForm extends Model
{
    public $post_id;

    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'body'], 'required'],
            [['post_id'], 'integer'],
            [['body'], 'string'],
        ];
    }

    public function submit()
    {
        if (!$this->validate()) {
            return false;
        }

        $model = new Comment();
        $model->setAttributes([
            'post_id' => $this->post_id,
            'body' => $this->body,
        ]);
        $model->save(false); // バリデーションはこのフォームで済んでいる

        return true;
    }
}
