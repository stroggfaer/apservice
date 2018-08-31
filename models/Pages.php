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
            [['title'], 'required'],
            [['description', 'text','value'], 'string'],
            [['menu', 'position', 'status'], 'integer'],
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
            'value' => 'Значения',
            'position' => 'Позиция',
            'status' => 'Статус',
        ];
    }

    /*--------Страница--------*/

    // Вывод меню страницы;
    public static function menuPages($type= 1) {
        $pages = self::find()->where(['status'=>1,'menu'=>$type])->orderBy('position ASC')->all();
        return $pages;
    }



}
