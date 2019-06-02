<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sliders".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property int $value
 * @property int $position
 * @property string $exp
 * @property int $show_text
 * @property int $status
 */
class Sliders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sliders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position', 'show_text', 'status','show_button'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['value','buttons'], 'string'],
            [['description'], 'string'],
            [['url'], 'string', 'max' => 48],
            [['exp'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'url' => 'Урл',
            'position' => 'Позиция',
            'exp' => 'Расширения',
            'show_text' => 'Показать текст',
            'value'=>'Занчение',
            'buttons' => 'Кнопки html формат',
            'show_button' => 'Кнопки вкл/выкл',
            'status' => 'Статус',
        ];
    }

    public function getImg() {
        return Functions::imgPath('/sliders/'.$this->id.'.'.$this->exp);
    }
}
