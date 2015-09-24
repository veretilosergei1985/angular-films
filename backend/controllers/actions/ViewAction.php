<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\controllers\actions;

use Yii;
use yii\web\Response;

/**
 * ViewAction implements the API endpoint for returning the detailed information about a model.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ViewAction extends Action
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
        $model = $this->findModel($id);
        $images = $model->getImages()->all();

        return [
            "id" => $model->id,
            "title" => $model->title,
            "storyline" => $model->storyline,
            "director" => $model->director,
            "year" => $model->year,
            "images" => $images,
        ];
    }
}
