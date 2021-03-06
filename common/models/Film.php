<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Film extends ActiveRecord
{
    public $images = [];
    
    public function rules()
    {
        return [
            [['title', 'director', 'year'], 'required'],
            [['storyline'], 'string'],
            [['year'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['director'], 'string', 'max' => 100]
        ];
    }
 
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'storyline' => 'Storyline',
            'director' => 'Director',
            'year' => 'Year',
        ];
    }
    
    public function getImages()
    {        
        return $this->hasMany(Image::className(), ['film_id' => 'id']);
    }
}


