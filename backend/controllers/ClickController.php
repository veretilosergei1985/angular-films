<?php

namespace api\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use \common\models\Click;
use \common\models\Post;

/**
 * Click Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ClickController extends ApiController
{
    public $modelClass = 'common\models\Click';

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

        $total = Click::find()->where(array('project_id' => (int)$projectId, 'post_id' => (int)$postId))->count();
        $unique = Click::find()->where(array('project_id' => (int)$projectId, 'post_id' => (int)$postId))->distinct("uid");

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
        parent::actionIndex();
        $postId = (int)Yii::$app->getRequest()->post('post_id');
        $url = Yii::$app->getRequest()->post('post_url');
        if ($postId && $postId != "undefined") {
            $post = Post::findByMySqlId($postId, Yii::$app->getRequest()->post('project_id'));
        }  elseif ($url) {
            $post = Post::findByUrl($url);
        } else
            throw new ForbiddenHttpException("Param url is not provided", self::CODE_NO_URL);

        $clickModel = new Click();
        $clickModel->load(Yii::$app->getRequest()->getBodyParams(), '');
        $clickModel->post_id = $postId;
        $clickModel->save();

        if ($post) {
            $total = Click::find()->where(array('project_id' => (int)Yii::$app->getRequest()->post('project_id'), 'post_id' => (int)$post->getID()))->count();
            //$unique = Click::find()->where(array('project_id' => (int)Yii::$app->getRequest()->post('project_id'), 'post_id' => (int)$post->getID()))->distinct("uid");

            $response = array(
                'total' => $total,
                'unique' => (int)$post->clicks['unique'],
            );
            $post->clicks = $response;
            $post->save();
        } else {
            $total = Click::find()->where(array('project_id' => (int)Yii::$app->getRequest()->post('project_id'), 'post_id' => $postId, 'post_url' => $url))->count();

            $response = array(
                'total' => $total,
                'unique' => 0, //@TODO need to implement
            );
        }
        return $response;

    }
}


