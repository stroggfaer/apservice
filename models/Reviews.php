<?php

namespace app\models;
use app\models\Functions;
use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $text
 * @property string $date
 * @property int $status
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            ['date', 'default', 'value'=>date('Y-m-d')],
            [['status'], 'integer'],
            [['name', 'description'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя'),
            'description' => Yii::t('app', 'Описание'),
            'text' => Yii::t('app', 'Текст'),
            'date' => Yii::t('app', 'Дата'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    public function getImg() {
        return Functions::imgPath('/review/'.$this->id.'.jpg');
    }
}
