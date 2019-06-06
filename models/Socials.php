<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socials".
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property int $type
 * @property string $href
 * @property int $status
 */
class Socials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'socials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['type', 'status','position'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 68],
            [['href'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'icon' => Yii::t('app', 'Иконка'),
            'type' => Yii::t('app', 'Тип'),
            'href' => Yii::t('app', 'Сыллки'),
            'position'=>'Позиция',
            'status' => Yii::t('app', 'Статус'),
        ];
    }
}
