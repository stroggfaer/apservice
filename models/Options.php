<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $title
 * @property string $phone
 * @property string $email
 * @property string $value
 * @property string $adminEmail
 * @property string $logo
 * @property string $url
 * @property string $description
 * @property int $status
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 12],
            [['email', 'adminEmail'], 'string', 'max' => 30],
            [['value','address','map_key'], 'string', 'max' => 200],
            [['logo', 'url', 'description'], 'string', 'max' => 128],
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
            'phone' => 'Phone',
            'email' => 'Email',
            'value' => 'Value',
            'adminEmail' => 'Admin Email',
            'logo' => 'Logo',
            'url' => 'Url',
            'description' => 'Description',
            'map_key' => 'map_key',
            'status' => 'Status',
        ];
    }
}
