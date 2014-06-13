<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;
use yii\db\ActiveQuery;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    public $category_name;

    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'body', 'category_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Post::find()->joinWith(['category' => function(ActiveQuery $q){
            $q->orderBy(['sort' => SORT_ASC]);
        }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['category_name'] = [
            'asc' => ['category.sort' => SORT_ASC],
            'desc' => ['category.sort' => SORT_DESC],
            'default' => SORT_ASC,
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'category.name', $this->category_name])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
