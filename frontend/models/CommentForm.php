<?php
namespace frontend\models;

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

        return true;
    }
}
