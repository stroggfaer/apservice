<?php

namespace app\controllers;
use app\models\Functions;
use app\models\Repair;
use Yii;
use app\models\Bootstrap;
use yii\helpers\Url;
//
class RepairController extends AppController
{
    public function beforeAction( $action )
    {
        return parent::beforeAction($action);
    }

    public function actionIndex($url = false, $alias = false, $last = false)
    {

        // Обработка урл;
        $url = (!empty($url) ? trim($url, '/') : false);
        $alias = (!empty($alias) ? trim($alias, '/') : false);
        $last = (!empty($last) ? trim($last, '/') : false);

        $model = new Repair();
        // Первый уровень
        if(!empty($url) && empty($alias)) {

            $one = $model->getCurrentRepair($url);
            if(!empty($one)) {
                // Сео настройки;
                $this->setMeta((!empty($one->seo_title) ? Functions::getTemplateCode($one->seo_title) : $one->title), Functions::getTemplateCode($one->seo_keywords), Functions::getTemplateCode($one->seo_description));
                return $this->render('index', [
                    'model' => $model,
                    'one' => $one,
                ]);
            }else{
                return Yii::$app->runAction($url);
            }
        }

        // Второй уровень
        if(!empty($alias) && empty($last)){

            $one = $model->getCurrentDevices($alias);
            $this->setMeta((!empty($one->seo_title) ? Functions::getTemplateCode($one->seo_title,$one->id) : $one->title), Functions::getTemplateCode($one->seo_keywords,$one->id), Functions::getTemplateCode($one->seo_description,$one->id));

            if(!empty($one)) {
                return $this->render('device-problems', [
                    'model' => $model,
                    'one' => $one,
                ]);
            }else{
                return Yii::$app->runAction($url.'/'.$alias);
            }
        }

        // Третий уровень
        if(!empty($last)){
            $devices = $model->getCurrentDevices($alias);
            $one = $model->getCurrentDeviceProblems(false,false, array('url'=>$last,'device_id'=>$devices->id));

            // Сео настройки;
            $this->setMeta((!empty($one->seo_title) ? Functions::getTemplateCode($one->seo_title,$devices->id,$one->id) : $one->title), Functions::getTemplateCode($one->seo_keywords,$devices->id,$one->id), Functions::getTemplateCode($one->seo_description,$devices->id,$one->id));

            if(!empty($one)) {
                return $this->render('device-problems-items', [
                    'model' => $model,
                    'one' => $one,
                ]);
            }else{
                return Yii::$app->runAction($url.'/'.$alias.'/'.$last);
            }
        }

        $this->redirect('/site/error/', 301);
    }

}
