<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_diagonals".
 *
 * @property int $id
 * @property int $device_problem_id
 * @property string $title
 * @property int $status
 *
 * @property DeviceProblems $deviceProblem
 * @property DeviceYearDetails[] $deviceYearDetails
 */
class DeviceDiagonals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_diagonals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_problem_id', 'status'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 128],
            [['device_problem_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceProblems::className(), 'targetAttribute' => ['device_problem_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_problem_id' => 'Device Problem ID',
            'title' => 'Название',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceProblem()
    {
        return $this->hasOne(DeviceProblems::className(), ['id' => 'device_problem_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceYearDetails()
    {
        return $this->hasMany(DeviceYearDetails::className(), ['device_diagonal_id' => 'id']);
    }
}
