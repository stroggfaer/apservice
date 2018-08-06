<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $country_id
 * @property string $domen
 * @property string $name
 * @property string $seo_name
 * @property string $seo_description
 * @property string $time
 * @property string $phone
 * @property string $map_lat
 * @property string $map_lon
 * @property string $zoom
 * @property int $status
 *
 * @property Country $country
 * @property Prices[] $prices
 * @property Services[] $services
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id','position','main', 'status'], 'integer'],
            [['country_id', 'domen', 'name'], 'required'],
            [['seo_description'], 'string'],
            [['domen', 'name', 'seo_name'], 'string', 'max' => 128],
            [['time'], 'string', 'max' => 68],
            [['phone', 'map_lon'], 'string', 'max' => 16],
            [['map_lat'], 'string', 'max' => 18],
            [['zoom'], 'string', 'max' => 12],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Страна',
            'domen' => 'Домен',
            'name' => 'Название',
            'seo_name' => 'Сео Название',
            'seo_description' => 'Сео описание',
            'time' => 'Время',
            'phone' => 'Телефон',
            'map_lat' => 'Map Lat',
            'map_lon' => 'Map Lon',
            'zoom' => 'Zoom',
            'main'=>'Главный',
            'position'=>'Позиция',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Prices::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['city_id' => 'id']);
    }

    public function getPrice()
    {
        $price = Prices::find()->where(['status'=>1,'city_id'=>$this->id])->one();
        return $price;
    }

}