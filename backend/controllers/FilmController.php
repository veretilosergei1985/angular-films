<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;

class FilmController extends ActiveController
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
}
