<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace api\controllers\actions;

use Yii;
use yii\web\Response;

/**
 * ViewAction implements the API endpoint for returning the detailed information about a model.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UpdateAction extends Action
{
    public $modelClass;
    /**
     * Displays a model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being displayed
     */
    public function run($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        /* @var $model ActiveRecord */
        $model = $this->findModel((int)$id);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }
}
