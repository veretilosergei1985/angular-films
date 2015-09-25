<?php

namespace api\controllers;

use yii\rest\ActiveController;

/**
 * Post Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class TaxonomyController extends ActiveController
{
    public $modelClass = 'common\models\Taxonomy';

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'api\controllers\actions\IndexAction',
                'modelClass' => $this->modelClass,
                'sort' => ['term_id' => SORT_ASC],
                'params' => array('entityName' => 'Taxonomy'),
            ],
            'view' => [
                'class' => 'api\controllers\actions\ViewAction',
                'modelClass' => $this->modelClass,
            ],
            'update' => [
                'class' => 'api\controllers\actions\UpdateAction',
                'modelClass' => $this->modelClass,
            ],
            'delete' => [
                'class' => 'api\controllers\actions\DeleteAction',
                'modelClass' => $this->modelClass,
            ]
        ]);

    }
}


