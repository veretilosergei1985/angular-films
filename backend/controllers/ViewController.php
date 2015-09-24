<?php

namespace api\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use \common\models\PostView;
use \common\models\Post;


/**
 * Share Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class  ViewController extends ApiController
{
    public $modelClass = 'common\models\PostView';

    public function actions()
    {
        return [
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'update' => [
                'class' => 'yii\rest\UpdateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->updateScenario,
            ],
            'delete' => [
                'class' => 'yii\rest\DeleteAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ]
        ];
    }

    public function actionIndex()
    {
        parent::actionIndex();
        if (!$projectId = Yii::$app->getRequest()->getQueryParam('project_id')) {
            throw new ForbiddenHttpException("Project_id is required", self::CODE_NO_PROJECT);
        }
        if (!$postId = Yii::$app->getRequest()->getQueryParam('post_id')) {
            throw new ForbiddenHttpException("Post_id is required", self::CODE_NO_POST);
        }

        $total = PostView::find()->where(array('project_id' => (int)$projectId, 'post_id' => (int)$postId))->count();
        $unique = PostView::find()->where(array('project_id' => (int)$projectId, 'post_id' => (int)$postId))->distinct("uid");

        if (!$total)
            throw new ForbiddenHttpException("Empty result", self::CODE_NO_RESULT);

        $response = array(
            'total' => $total,
            'unique' => count($unique),
        );
        return $response;
    }

    public function actionCreate()
    {
        //$start = microtime();
        parent::actionIndex();
        $postId = (int)Yii::$app->getRequest()->post('post_id');
        $url = Yii::$app->getRequest()->post('post_url');
        if ($postId && $postId != "undefined") {
            $post = Post::findByMySqlId($postId, Yii::$app->getRequest()->post('project_id'));
        }  elseif ($url) {
            $post = Post::findByUrl($url);
        } else
            throw new ForbiddenHttpException("Param url is not provided", self::CODE_NO_URL);

        $postViewModel = new PostView();
        $postViewModel->load(Yii::$app->getRequest()->getBodyParams(), '');
        $postViewModel->post_id = $postId;
        $postViewModel->save();

        if ($post) {
            $total = PostView::find()->where(array('project_id' => (int)Yii::$app->getRequest()->post('project_id'), 'post_id' => $postId))->count();
            //$unique = PostView::find()->where(array('project_id' => (int)Yii::$app->getRequest()->post('project_id'), 'post_id' => (int)$post->getID()))->distinct("uid");

            $response = array(
                'total' => $total,
                'unique' => (int)$post->views['unique'],
            );
            $post->views = $response;
            $post->save();
        } else {
            $total = PostView::find()->where(array('project_id' => (int)Yii::$app->getRequest()->post('project_id'), 'post_id' => $postId, 'post_url' => $url))->count();

            $response = array(
                'total' => $total,
                'unique' => 0, //@TODO need to implement
            );
        }

        //echo microtime() - $start;
        return $response;
    }
}


