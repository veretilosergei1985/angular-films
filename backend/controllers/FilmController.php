<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;

class FilmController extends \backend\controllers\ApiController
{
    public $modelClass = 'common\models\Film';

    public function behaviors()
    {
        return 
        \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ]);
    }
    
    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'backend\controllers\actions\IndexAction',
                'modelClass' => $this->modelClass,
                //'sort' => ['post_date' => SORT_DESC],
                //'params' => array('entityName' => 'Post'),
            ],
            'view' => [
                'class' => 'backend\controllers\actions\ViewAction',
                'modelClass' => $this->modelClass,
            ],
        ]);

    }
}
