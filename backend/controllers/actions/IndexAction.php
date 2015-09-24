<?php

namespace backend\controllers\actions;

use Yii;
use yii\web\Response;
use yii\base\InvalidConfigException;

class IndexAction extends \yii\base\Action
{
    /**
     * @var string class name of the model which will be handled by this action.
     * The model class must implement [[ActiveRecordInterface]].
     * This property must be set.
     */
    public $modelClass;
    public $modelName;
    public $sort;
    public $params;

    /**
     * @return array of models
     */
    public function run()
    {
        $this->checkAccess();
        $whereCondition = array();
        if ($this->modelClass === null) {
            throw new InvalidConfigException(get_class($this) . '::$modelClass must be set.');
        }

        $modelClass = $this->modelClass;

        if ($postId = Yii::$app->getRequest()->getQueryParam('post_id')) {
            $whereCondition['post_id'] = (int)$postId;
        }        
        if ($projectId = Yii::$app->getRequest()->getQueryParam('project_id')) {
            $whereCondition['project_id'] = (int)$projectId;
        }
        $rs = $modelClass::find()
            ->where($whereCondition);
            //->orderBy($this->sort)
            //->limit(Yii::$app->getRequest()->getQueryParam('limit') ?: Yii::$app->params['limit'])
            //->offset(Yii::$app->getRequest()->getQueryParam('offset') ?: Yii::$app->params['offset'])
                ;
        
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $rs->all();

    }

    /**
     * function that will be called when running an action to determine
     * if user has the permission to execute the action.
     */
    protected function checkAccess()
    {
        //@TODO implement api_key authentication
        /*if (!$api_key = Yii::$app->getRequest()->getQueryParam('api_key')) {
            throw new NotFoundHttpException("Forbidden. Param api_key is not provided", 914);
        }*/
        return true;
    }
}
