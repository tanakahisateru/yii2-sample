<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * commentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    public $post_title;

    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['post_title', 'body'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Comment::find()->joinWith('post');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['post_title'] = [
            'asc' => ['post.title' => SORT_ASC],
            'desc' => ['post.title' => SORT_DESC],
            'default' => SORT_ASC,
        ];
        $dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'post.title', $this->post_title])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
