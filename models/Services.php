<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $city_id
 * @property string $url
 * @property string $title
 * @property string $address
 * @property string $metro
 * @property string $time
 * @property string $phone
 * @property string $value
 * @property string $description
 * @property string $text
 * @property string $map_lat
 * @property string $map_lon
 * @property int $positions
 * @property int $sttaus
 *
 * @property City $city
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'positions', 'sttaus'], 'integer'],
            [['title'], 'required'],
            [['description', 'text'], 'string'],
            [['url'], 'string', 'max' => 68],
            [['title', 'metro', 'time', 'phone'], 'string', 'max' => 128],
            [['address'], 'string', 'max' => 228],
            [['value'], 'string', 'max' => 368],
            [['map_lat', 'map_lon'], 'string', 'max' => 24],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'url' => 'Url',
            'title' => 'Title',
            'address' => 'Address',
            'metro' => 'Metro',
            'time' => 'Time',
            'phone' => 'Phone',
            'value' => 'Value',
            'description' => 'Description',
            'text' => 'Text',
            'map_lat' => 'Map Lat',
            'map_lon' => 'Map Lon',
            'positions' => 'Positions',
            'sttaus' => 'Sttaus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
