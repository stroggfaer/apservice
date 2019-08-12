<?php

namespace app\controllers;

use app\models\AppleServices;
use app\models\Functions;
use app\models\News;
use app\models\Pages;
use app\models\Repair;
use Yii;
use yii\web\NotFoundHttpException;


class PagesController extends AppController
{

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
    }

    // Страница сайта;
    public function actionPage($url = false)
    {
       // $url = preg_replace('/\s/', '', $url);
        $url =  trim($url,"/"); // Удаляем слэш;

        try {

            $pages = $this->setPage($url);
            if(empty($pages->content)) {

                // Запуск контроллер экшен;
                return Yii::$app->runAction($url);
            }
            //  Проверка файл;
            if(Functions::fileDir('/views/pages/'.$url)) {
                return $this->render($url, [ 'pages' => $pages,]);
            }else{
                // Запуск контроллер экшен;
                return $this->render('index',[ 'pages' => $pages]);
            }
        } catch (NotFoundHttpException $e) {

            return $this->redirect('/site/error');
        }

    }

    // Контакты;
    public function actionContacts()
    {

        try {
            $pages = $this->setPage($this->action->id);
            $model = new Repair();
            $city = \Yii::$app->action->currentCity;
            $appleServices = $model->getAppleServices();
            // Загрузка страница;
            return $this->render('contacts', [
                'pages'=>$pages,
                'model'=>$model,
                'city'=>$city,
                'contacts'=>$appleServices
            ]);
        } catch (NotFoundHttpException $e) {
            return $this->redirect('/site/error');
        }
    }


    // Сервисы;
    public function actionServices($url = false) {
        if(empty($url)) return $this->redirect('/site/error');
        $url =  trim($url,"/"); // Удаляем слэш;
        try {
            $model = new Repair();
            $city = \Yii::$app->action->currentCity;
            $appleService = AppleServices::find()->where(['city_id'=>$city->id,'url'=>$url, 'status'=>1])->one();
            if(empty($appleService))    return $this->redirect('/site/error');
            $this->setMeta((!empty($appleService->title_seo) ?   Functions::getTemplateCode($appleService->title_seo) : $appleService->title),Functions::getTemplateCode($appleService->keywords),Functions::getTemplateCode($appleService->description));
            // Загрузка страница;
            return $this->render('services', [
                'model'=>$model,
                'city'=>$city,
                'appleService'=>$appleService
            ]);
        } catch (NotFoundHttpException $e) {
            return $this->redirect('/site/error');
        }
    }


    // Новости;
    public function actionNews($url = false) {

        $url =  trim($url,"/"); // Удаляем слэш;
        $model = new Repair();
        $city = \Yii::$app->action->currentCity;
        $one = News::find()->where(['url'=>$url, 'status'=>1])->one();
        if(empty($one))    return $this->redirect('/site/error');
        $this->setMeta((!empty($one->seo_title) ?   Functions::getTemplateCode($one->seo_title) : $one->title),Functions::getTemplateCode($one->keywords),Functions::getTemplateCode($one->description));
        // Загрузка страница;
        return $this->render('news', [
            'model'=>$model,
            'city'=>$city,
            'one'=>$one
        ]);

    }

    /**
     * @param string $action
     * @return array|null|\yii\db\ActiveRecord|\yii\web\Response
     * @throws NotFoundHttpException
     */
    protected function setPage($action = null){

        if(empty($action)) throw new NotFoundHttpException('The requested page does not exist.');
        $url =  trim($action,"/"); // Удаляем слэш;
        // Страница;
        $pages = Pages::find()->where(["url"=>$url,"status"=> 1])->limit(1)->one();
        if(empty($pages)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        // Сео настройки;
        $this->setMeta((!empty($pages->seo_title) ?   Functions::getTemplateCode($pages->seo_title) : $pages->title),Functions::getTemplateCode($pages->keywords),Functions::getTemplateCode($pages->description));
        return $pages;
    }



}
