<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_repairs".
 *
 * @property int $id
 * @property string $url
 * @property string $title
 * @property string $seo_title
 * @property string $seo_description
 * @property int $positions
 * @property int $status
 *
 * @property Devices[] $devices
 */
class MenuRepairs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_repairs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],

            [['seo_description','icon','description1','description2','title1','title2','title_h1','short_name'], 'string'],
            [['position','show_prices', 'status'], 'integer'],
            [['url', 'title'], 'string', 'max' => 128],
            [['seo_title'], 'string', 'max' => 258],
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
            'short_name'=>'Название модель',
            'seo_title' => 'Сео название',
            'seo_description' => 'Сео описание',
            'title_h1'=>'Заголовок H1',
            'title1' => 'Название - 1',
            'description1' => 'Описание-1',
            'title2' => 'Название - 2',
            'description2' => 'Описание-2',
            'icon' => 'Икон class',
            'position' => 'Позиция',
             'show_prices'=>'Показать виде прайса',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Devices::className(), ['menu_repair_id' => 'id']);
    }


}
