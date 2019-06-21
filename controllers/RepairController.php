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

        if (defined('YII_DEBUG')) {

        }
        $model = new Repair();
        if(empty($url)) {

            $one = $model->menuRepair;
            return $this->redirect(Url::home());
        }
        // Первый уровень
        if(!empty($url) && empty($alias)) {

            $one = $model->getCurrentRepair($url);
            if(!empty($one)) {
                \Yii::$app->action->setTitleH1($one->title_h1);
                // Сео настройки;
                $this->setMeta((!empty($one->seo_title) ? Functions::getTemplateCode($one->seo_title) : $one->title), Functions::getTemplateCode($one->seo_keywords), Functions::getTemplateCode($one->seo_description));
                return $this->render('@app/views/site/index', [
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

            if(!empty($one)) {
                \Yii::$app->action->setTitleH1($one->title_h1);
                \Yii::$app->action->setDeviceId($one->id);

                $this->setMeta((!empty($one->seo_title) ? Functions::getTemplateCode($one->seo_title,$one->id) : $one->title), Functions::getTemplateCode($one->seo_keywords,$one->id), Functions::getTemplateCode($one->seo_description,$one->id));

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
            if(!empty($one)) {
                \Yii::$app->action->setTitleH1($one->title_h1);
                \Yii::$app->action->setDeviceId($devices->id);
                \Yii::$app->action->setDeviceProblemsId($one->id);
                // Сео настройки;
                $this->setMeta((!empty($one->seo_title) ? Functions::getTemplateCode($one->seo_title,$devices->id,$one->id) : $one->title), Functions::getTemplateCode($one->seo_keywords,$devices->id,$one->id), Functions::getTemplateCode($one->seo_description,$devices->id,$one->id));
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
