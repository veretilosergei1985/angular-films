<?php
/**
 * Created by PhpStorm.
 * User: emsi
 * Date: 19.04.2015
 * Time: 0:17
 */
namespace backend\controllers;
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Yii;
use yii\web\Response;
use yii\rest\ActiveController;


class ApiController extends ActiveController
{
    const CODE_NO_URL = 43;
    const CODE_NO_RESULT = 44;
    const CODE_NO_POST = 45;
    const CODE_NO_PROJECT = 46;

    public function init()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    public function actions()
    {
        return [
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
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
}