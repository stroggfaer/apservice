<?php
namespace app\modules\cms\controllers;
use Yii;
use app\models\Functions;
use yii\web\UploadedFile;
use app\models\ExportEmail;

class AjaxBackendController extends BackendController
{
// Удаления изображения;
    public function actionImagesDelete()
    {
        $path = Yii::$app->request->post('path');


        // Удаления обложка в бассеин;
       if(Yii::$app->request->post('delete_image_file')) {
           // Удаляем файл;
           Functions::fDeleteOne($path);
       }
        return false;
    }
	
    // Загрузка данные;
    public function actionRunExportEmail() {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $exportEmail = new ExportEmail();
        if ($request->post('runExportEmail')) {
            $maxCounts = abs($request->post('max_counts'));
            $data = $exportEmail->getDataListEmail($maxCounts);

            return $response->data = ['status' => 'ok','counts'=>count($data),'data'=>$data];
        }
        return false;
    }

}