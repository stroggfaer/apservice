<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_year_details".
 *
 * @property int $id
 * @property int $device_year_id
 * @property int $device_problem_id
 * @property int $device_diagonal_id
 *
 * @property DeviceYear $deviceYear
 * @property DeviceProblems $deviceProblem
 * @property DeviceDiagonals $deviceDiagonal
 */
class DeviceYearDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_year_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_year_id','device_problem_id'], 'required'],
            [['device_year_id', 'device_problem_id', 'device_diagonal_id'], 'integer'],
            [['device_year_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceYear::className(), 'targetAttribute' => ['device_year_id' => 'id']],
            [['device_problem_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceProblems::className(), 'targetAttribute' => ['device_problem_id' => 'id']],
            [['device_diagonal_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceDiagonals::className(), 'targetAttribute' => ['device_diagonal_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_year_id' => 'Device Year ID',
            'device_problem_id' => 'Device Problem ID',
            'device_diagonal_id' => 'Device Diagonal ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceYear()
    {
        return $this->hasOne(DeviceYear::className(), ['id' => 'device_year_id']);
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
    public function getDeviceDiagonal()
    {
        return $this->hasOne(DeviceDiagonals::className(), ['id' => 'device_diagonal_id']);
    }

    // Загрузка проблемы;
    public function getDeviceProblemsArrayParamsList($device_id = false) {
        if(empty($device_id)) return false;
        $deviceProblems = DeviceProblems::find()->select(['device_problems.title','device_problems.id'])->
        leftJoin(DevicesDetails::tableName(),'devices_details.device_problems_id = device_problems.id')->indexBy('id')->where(['devices_details.devices_id'=>$device_id,'device_problems.status'=>1])->all();

        if(!empty($deviceProblems)) {
            foreach ($deviceProblems as $key => $deviceProblem) {
                $deviceProblems[$key] = $deviceProblem->title .' '. Functions::money($deviceProblem->price->money). '.р (' .$deviceProblem->devices. ')';
            }
        }

        return $deviceProblems;
        //return ArrayHelper::map(array_merge(DeviceProblems::find()->where(['status'=>1])->andWhere(['not in','id',$device_problems_id])->orderBy('id ASC')->all()),'id','title');
    }



}
