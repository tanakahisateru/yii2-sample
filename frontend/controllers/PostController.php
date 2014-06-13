<?php

namespace frontend\controllers;

use common\models\Post;
use yii\data\ActiveDataProvider;

class PostController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Post::find()->with('category')->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
