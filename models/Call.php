<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "call".
 *
 * @property int $id
 * @property int $group_id
 * @property string $value
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $comments
 * @property string $date
 * @property int $status
 *
 * @property CallGroups $group
 */
class Call extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_center';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'status'], 'integer'],
            [['comments'], 'string'],
            [['fio','phone'], 'required'],

          //  ['phone', 'validatePhone'],
            // Проверка на правильно ввода  телефона;
            ['phone', 'filter', 'filter' => function ($value) {
                $phone = Functions::phone($value);
                $phone = preg_match('/^[0-9]{10}$/',Functions::phone_is($phone));
                if (empty($phone)) {
                    $this->addError('phone', 'Неверный номер телефона!');
                }
                return $value;
            }],
            ['date', 'default', 'value'=>date('Y-m-d')],
            [['date'], 'safe'],
            [['value'], 'string', 'max' => 228],
            [['fio'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 64],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CallGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'value' => 'Значение',
            'fio' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'comments' => 'Комменатрий',
            'date' => 'Дата создание',
            'status' => 'Статус',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CallGroups::className(), ['id' => 'group_id']);
    }

//    // Проверка на правильно ввода  телефона;
//    public function validatePhone()
//    {
//        if (!$this->hasErrors()) {
//            // Формат +700 000 00 00;
//            $phone = Functions::phone($this->phone);
//            $phone = preg_match('/^[0-9]{10}$/',Functions::phone_is($phone));
//            if (empty($phone)) {
//                $this->addError('phone', 'Неверный номер телефона!');
//            }
//        }
//    }
}
