<?php

namespace app\models;
use app\models\Functions;
use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $apple_service_id
 * @property string $name
 * @property string $description
 * @property string $text
 * @property string $date
 * @property string $value
 * @property int $status
 *
 * @property AppleServices $appleService
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
            [['text','value'], 'string'],
            [['date','date_created'], 'safe'],
            ['date', 'default', 'value'=>date('Y-m-d')],
            [['status','rating','gis_id','show'], 'integer'],
            [['name', 'description'], 'string', 'max' => 128],
            [['apple_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppleServices::className(), 'targetAttribute' => ['apple_service_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'apple_service_id' => Yii::t('app', 'Apple Service ID'),
            'name' => Yii::t('app', 'Имя'),
            'description' => Yii::t('app', 'Описание'),
            'text' => Yii::t('app', 'Текст'),
            'date' => Yii::t('app', 'Дата'),
            'value' => Yii::t('app', 'Value'),
            'rating'=>'Рейтинг',
            'gis_id'=>'2gis_id',
            'date_created'=>'date_created',
            'show'=>'Показать на главном',
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    public function getImg() {
        return Functions::imgPath('/review/'.$this->id.'.jpg');
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppleService()
    {
        return $this->hasOne(AppleServices::className(), ['id' => 'apple_service_id']);
    }
}
