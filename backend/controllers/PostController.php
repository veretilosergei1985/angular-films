<?php

namespace api\controllers;

use yii\rest\ActiveController;

/**
 * Post Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class PostController extends ActiveController
{
    public $modelClass = 'common\models\Post';

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'api\controllers\actions\IndexAction',
                'modelClass' => $this->modelClass,
                'sort' => ['post_date' => SORT_DESC],
                'params' => array('entityName' => 'Post'),
            ],
            'view' => [
                'class' => 'api\controllers\actions\ViewAction',
                'modelClass' => $this->modelClass,
            ],
        ]);

    }
}


