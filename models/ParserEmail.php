<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parser_email".
 *
 * @property int $id
 * @property int $uid
 * @property string $date
 * @property string $subject
 * @property string $from_email
 * @property string $to_email
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $content
 * @property string $create_at
 * @property string $city
 * @property int $type
 * @property int $status
 */
class ParserEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parser_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'status'], 'integer'],
            ['uid', 'unique'],
            [['create_at'], 'safe'],
            ['create_at', 'default', 'value'=>date('Y-m-d')],
            [['content'], 'string'],
            [['subject', 'from_email', 'to_email', 'name','date','city'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'date' => 'Дата письма',
            'subject' => 'Subject',
            'from_email' => 'From',
            'to_email' => 'To',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Email',
            'city'=>'Город',
            'content' => 'Content',
            'create_at' => 'Дата созданя',
            'type' => 'Тип',
            'status' => 'Статус',
        ];
    }
}
