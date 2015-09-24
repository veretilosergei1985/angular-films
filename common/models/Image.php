<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Image extends ActiveRecord
{
    public function rules()
    {
        return [
            [['film_id', 'image'], 'required'],
        ];
    }
 
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_id' => 'Film ID',
            'image' => 'Image',
        ];
    }
    
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['film_id' => 'id']);
    }
}


