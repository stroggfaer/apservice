<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $url
 * @property string $title
 * @property string $seo_title
 * @property string $keywords
 * @property string $description
 * @property string $text
 * @property int $menu
 * @property int $positons
 * @property int $status
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'seo_title', 'keywords', 'description', 'text'], 'required'],
            [['description', 'text'], 'string'],
            [['menu', 'positions', 'status'], 'integer'],
            [['url', 'title', 'seo_title'], 'string', 'max' => 128],
            [['keywords'], 'string', 'max' => 228],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'title' => 'Название',
            'seo_title' => 'Сео Название',
            'keywords' => 'Ключ',
            'description' => 'Описание',
            'text' => 'Текст',
            'menu' => 'Тип меню',
            'positions' => 'Позиция',
            'status' => 'Статус',
        ];
    }
}
