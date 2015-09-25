<?php

namespace api\controllers;

use Yii;
use common\components\helpers\SocialShare;
use yii\web\ForbiddenHttpException;
use \common\models\Post;



/**
 * Share Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ShareController extends ApiController
{
    public $modelClass = 'common\models\Share';

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
        if (!$url = Yii::$app->getRequest()->getQueryParam('url')) {
            throw new ForbiddenHttpException("Param url is not provided", self::CODE_NO_URL);
        }

        $post = Post::findByUrl($url);
        if (!$post)
            throw new ForbiddenHttpException("Post not found", self::CODE_NO_POST);

        $response = array();
        if (!is_null($post)) {
            $response = array(
                'url' => $post->getAbsoluteUrl(),
                'shares' => $post->shares,
            );
        }
        return $response;
    }

    public function actionCreate()
    {

        parent::actionIndex();
        if (!$url = Yii::$app->getRequest()->post('url')) {
            throw new ForbiddenHttpException("Param url is not provided", self::CODE_NO_URL);
        }

        if (substr($url, -1) != "/")
            $url = $url."/";
        $socialShare = new SocialShare($url);

        $post = Post::findByUrl($url);
        if (!$post)
            throw new ForbiddenHttpException("Post not found", self::CODE_NO_POST);

        return $socialShare->save($post);
    }
}


