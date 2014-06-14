<?php

namespace frontend\controllers;

use common\models\Post;
use frontend\models\CommentForm;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

class PostController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['comment'],
                ],
            ],
        ];
    }

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

        $commentFormModel = new CommentForm();
        $commentFormModel->post_id = $id;

        return $this->render('view', [
            'model' => $model,
            'commentFormModel' => $commentFormModel,
        ]);
    }

    public function actionComment()
    {
        $commentFormModel = new CommentForm();

        if ($commentFormModel->load(Yii::$app->request->post()) && $commentFormModel->submit()) {
            Yii::$app->session->setFlash('success', "コメントを投稿しました。");
            return $this->redirect(['view', 'id' => $commentFormModel->post_id]);
        } else {
            $model = Post::findOne($commentFormModel->post_id);
            if (!$model) {
                throw new NotFoundHttpException();
            }
            return $this->render('view', [
                'model' => $model,
                'commentFormModel' => $commentFormModel,
            ]);
        }
    }
}
