<?php
namespace app\controllers;

use app\models\City;
use app\models\Devices;
use Yii;
use yii\web\Controller;


class AjaxController extends Controller
{
    public function actionCity()
    {
        // Параметры пост данные;
        $request = Yii::$app->request;
        if ($request->post('geo')) {
            $model = City::findAll(['status'=>1]);
            return \app\components\WCityGeo::widget(['model'=>$model]);
        }
    }

    public function actionCityOne()
    {
        $cookies = Yii::$app->response->cookies;
        // Параметры пост данные;
        $request = Yii::$app->request;
        if ($request->post('city_id')) {
            $city_id = abs($request->post('city_id'));
            $model = City::findOne($city_id);
            $time = time() + 3600 * 24 * 30;

//            // добавление новой куки в HTTP-ответ
//            $cookies->add(new \yii\web\Cookie([
//                'name' => 'city_id',
//                'value' => $city_id,
//                'domain'=> 'http://127.0.0.1/',
//                'expire'=>$time,
//            ]));
            //header('Set-Cookie: city_id='.$city_id.'; Expires='.$time.'; path=/');
            return false;
        }
    }

    // Предварительная диагностика
    function actionDiagnostics()
    {
        $request = Yii::$app->request;
        $devices =  new Devices();

        // Выбор девайс;
        if ($request->post('select_devices_form')) {
            $device_id = abs($request->post('device_id'));
            $devices->setDeviceIdSession($device_id);
            $devices->setDeviceProblemIdSession(false);
            return \app\components\WDiagnosticsForm::widget();
        }
        // Удалить сессия;
        if ($request->post('select_devices_remove')) {
            unset($_SESSION['devices']);
            return \app\components\WDiagnosticsForm::widget();
        }

        // Выбор проблемы;
        if ($request->post('select_devices_problems_form')) {
            $device_problem_id = abs($request->post('device_problem_id'));
            $devices->setDeviceProblemIdSession($device_problem_id);
            return \app\components\WDiagnosticsForm::widget();
        }

        // Удалить сессия
        if ($request->post('select_devices_problems_remove')) {

            $devices->setDeviceProblemIdSession(false);
            return \app\components\WDiagnosticsForm::widget();
        }
    }

}

