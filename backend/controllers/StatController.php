<?php

namespace api\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use \common\models\Click;
use \common\models\Post;
use \common\models\PostView;


/**
 * Share Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class StatController extends ApiController
{
    public $modelClass = 'common\models\Post';
    public function actionIndex()
    {
        parent::actionIndex();
        if (!$projectId = Yii::$app->getRequest()->getQueryParam('project_id')) {
            throw new ForbiddenHttpException("Project_id is required", self::CODE_NO_PROJECT);
        }
        if (!$postId = Yii::$app->getRequest()->getQueryParam('post_id')) {
            throw new ForbiddenHttpException("Post_id is required", self::CODE_NO_POST);
        }
        $whereCondition['ID'] = (int)$postId;
        $whereCondition['project_id'] = (int)$projectId;

        $post = Post::find()->where($whereCondition)->one();

        $response = array();
        if (!is_null($post)) {

            $response = array(
                'shares' => $post->shares,
                'clicks' => $post->clicks,
                'views' => $post->views
            );
        }

        return $response;
    }
}


