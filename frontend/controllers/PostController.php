<?php

namespace frontend\controllers;

use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

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

    public function actionView($id)
    {
        $model = Post::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
