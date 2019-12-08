<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "excel_upload_prices".
 *
 * @property int $id
 * @property string $devices
 * @property string $city
 * @property string $device_problems
 * @property string $description_problems
 * @property string $prices
 * @property string $created_at
 * @property int $success
 * @property int $status
 */
class ExcelUploadPrices extends \yii\db\ActiveRecord
{
    public $excel;
    const SCENARIO_EXCEL = 'excel';
    const SCENARIO_EXCEL_VALUE = 'excel_value';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'excel_upload_prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

           // [['devices', 'city', 'device_problems', 'description_problems', 'created_at', 'success'], 'required','on' => self::SCENARIO_EXCEL_VALUE],
            //[['devices', 'city', 'device_problems', 'description_problems', 'created_at', 'success'], 'required'],

            [['prices'], 'number'],
            [['created_at'], 'safe'],
            ['created_at', 'default', 'value'=>date('Y-m-d H:i:s')],
            [['success', 'status'], 'integer'],
            [['devices', 'city', 'device_problems'], 'string', 'max' => 228],
            [['description_problems'], 'string', 'max' => 800],
        //    [['excel'], 'file',  'extensions' => 'xls','on' => self::SCENARIO_EXCEL],
            [['excel'], 'file',  'extensions' => 'xls'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'devices' => Yii::t('app', 'Devices'),
            'city' => Yii::t('app', 'City'),
            'device_problems' => Yii::t('app', 'Device_problems'),
            'description_problems' => Yii::t('app', 'Description_problems'),
            'prices' => Yii::t('app', 'Prices'),
            'created_at' => Yii::t('app', 'Created At'),
            'success' => Yii::t('app', 'Success'),
            'status' => Yii::t('app', 'Status'),
            'excel'=>'Загрузка файл',
        ];
    }

    // Выводим данные;
    public function getSessionExcel() {
        $session = Yii::$app->session;
        return !empty($session['excel-data']) ? $session['excel-data']: false;
    }

    // Сохраняем данные в сессие тип данные массив;
    public function setSessionExcel($array = false) {
        $session = Yii::$app->session;
        $session->open();
        if(!empty($array) && is_array($array)) {
            return $_SESSION['excel-data'] = $array;
        }
        unset($_SESSION['excel-data']);
        return false;
    }

    public static function setMessage($message,$type = 'error') {
        $session = Yii::$app->session;
        $session->setFlash($type, $message);
        Yii::$app->getResponse()->redirect('/cms/devices/download-prices-excel');
        Yii::$app->getResponse()->send();
        exit;
    }

    // Проверка полей;
    public function rowPrices(){
        // Удаляем пробелы;
        $city = trim($this->city);
        $devices = trim($this->devices);
        $device_problems = trim($this->device_problems);

        $cityOne = City::find()->select('id')->where(['name'=>$city])->one();  // Город;
        $devicesOne = Devices::find()->select('id')->where(['title'=>$devices])->one();  // Девайс;

        if(!empty($devicesOne)) {
            $deviceProblemsOne = DeviceProblems::find()->select('device_problems.id')
                ->leftJoin(DevicesDetails::tableName(), 'devices_details.device_problems_id = device_problems.id')
                ->where(['device_problems.title' => $device_problems, 'devices_details.devices_id' => $devicesOne->id])
                ->one();  // Дивайс проблемы и описание;
        }
        return [
            'city_id'=> !empty($cityOne) ? $cityOne->id : null,
            'devices'=>!empty($devicesOne) ? $devicesOne->id : null,
            'device_problems_id' => !empty($deviceProblemsOne) ? $deviceProblemsOne->id : null
        ];
    }

    /*
       status - 1 (Обновить запись)
       status - 2 (Добавить запись)
       status - 3 (Игнорировать запись)
    */
    // Проверка запись цены;
    public function getRowPrices() {
        $rowPrices = $this->rowPrices();
        if(!empty($rowPrices['city_id']) && !empty($rowPrices['devices']) && !empty($rowPrices['device_problems_id'])) {
            $prices = Prices::find()->where(['city_id' => $rowPrices['city_id'], 'device_problems_id' => $rowPrices['device_problems_id']])->one();
            if (!empty($prices)) {
                return [
                    'status' => 1,
                    'price_id'=>$prices->id,
                    'city_id' => $rowPrices['city_id'],
                    'device_id' => $rowPrices['devices'],
                    'device_problems_id' => $rowPrices['device_problems_id'],
                ];
            } else {
                return [
                    'status' => 2,
                    'price_id'=> null,
                    'city_id' => $rowPrices['city_id'],
                    'device_id' => $rowPrices['devices'],
                    'device_problems_id' => $rowPrices['device_problems_id'],
                ];
            }
        }
        return [
            'status' => 3,
            'price_id'=> null,
            'city_id' => null,
            'device_id' => null,
            'device_problems_id' => null,
        ];
    }

}
