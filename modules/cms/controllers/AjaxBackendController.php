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
        $file_name = Yii::$app->request->post('file_name');
        $file_min = Yii::$app->request->post('file_min');
        $path = $_SERVER['DOCUMENT_ROOT'].'/web/files/'.$file_name;
       if(!empty($file_min)) $path_min = $_SERVER['DOCUMENT_ROOT'].'/web/files/'.$file_min;
        // Удаления обложка в бассеин;
       if(Yii::$app->request->post('delete_image_file')) {
           // Удаляем файл;
           Functions::fDeleteOne($path);
           if(isset($path_min) && !empty($path_min)) {
               Functions::fDeleteOne($path_min);
           }

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