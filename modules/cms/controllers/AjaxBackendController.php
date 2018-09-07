<?php
namespace app\modules\cms\controllers;
use Yii;
use app\models\Functions;
use yii\web\UploadedFile;

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
}