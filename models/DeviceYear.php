<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_year".
 *
 * @property int $id
 * @property int $device_id
 * @property string $title
 * @property string $title_th1
 * @property string $title_th2
 * @property string $value1
 * @property string $value2
 * @property int $status
 *
 * @property Devices $device
 * @property DeviceYearDetails[] $deviceYearDetails
 */
class DeviceYear extends \yii\db\ActiveRecord
{
    private $device_year_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id', 'status'], 'integer'],
            [['title','value1','value2','title_th1','title_th2'], 'string', 'max' => 128],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Устройства',
            'title' => 'Название',
            'title_th1'=>'Название столбца1',
            'title_th2'=>'Название столбца2',
            'value1' => 'Значение1',
            'value2' => 'Значение2',
            'status' => 'Status',
        ];
    }
    public function setDeviceYearId($device_year_id) {
        if(empty($device_year_id)) return false;
        return $this->device_year_id  = $device_year_id;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceYearDetails()
    {
        return $this->hasMany(DeviceYearDetails::className(), ['device_year_id' => 'id']);
    }
    //
    public function getDeviceDiagonals() {
        $deviceDiagonals = DeviceDiagonals::find()->
        leftJoin(DeviceYearDetails::tableName(),'device_year_details.device_diagonal_id = device_diagonals.id')->
        where(['device_diagonals.status'=>1,'device_year_details.device_year_id'=>$this->id])->all();
        return $deviceDiagonals;
    }

    public function getDeviceDiagonalOne($diagonal_id = false) {
        if(empty($diagonal_id)) return false;
        $deviceDiagonals = DeviceDiagonals::find()->
        leftJoin(DeviceYearDetails::tableName(),'device_year_details.device_diagonal_id = device_diagonals.id')->
        where(['device_diagonals.id'=>$diagonal_id,'device_diagonals.status'=>1,'device_year_details.device_year_id'=>$this->id])->all();
        return $deviceDiagonals;
    }

    // Список проблемы
    public function getDeviceProblems($diagonal_id = false,$flag = true) {

           $deviceProblemsObj = DeviceProblems::find();

           if(!empty($flag)) {
               $deviceProblemsObj->select(['device_problems.title', 'device_problems.id'])->leftJoin(DeviceYearDetails::tableName(), 'device_year_details.device_problem_id = device_problems.id');
           }else{
               $deviceProblemsObj->select(['device_problems.*'])->leftJoin(DeviceYearDetails::tableName(), 'device_year_details.device_problem_id = device_problems.id');
           }
           if(!empty($diagonal_id)) {
               $deviceProblems = $deviceProblemsObj->where(['device_year_details.device_year_id' => $this->id, 'device_problems.status' => 1])->
               andWhere(['device_year_details.device_diagonal_id'=>$diagonal_id])->all();
           }else{
               $deviceProblems = $deviceProblemsObj->where(['device_year_details.device_year_id' => $this->id, 'device_problems.status' => 1])->
               andWhere(['is', 'device_year_details.device_diagonal_id',null])->all();
           }

        return $deviceProblems;
    }

    // Загрузка Список проблемы;

}
