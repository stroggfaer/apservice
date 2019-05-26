<?php

namespace app\controllers;

use app\models\Functions;
use app\models\Pages;
use Yii;
use yii\web\NotFoundHttpException;


class PagesController extends AppController
{

//    public function beforeAction( $action )
//    {
//        return parent::beforeAction($action);
//    }

    // Страница сайта;
    public function actionPage($url = false)
    {
       // $url = preg_replace('/\s/', '', $url);
        $url =  trim($url,"/"); // Удаляем слэш;
        try {
            $pages = $this->setPage($url);
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
            // Загрузка страница;
            return $this->render('contacts', [
                'pages'=>$pages
            ]);
        } catch (NotFoundHttpException $e) {
            return $this->redirect('/site/error');
        }
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
        if(empty($pages)) throw new NotFoundHttpException('The requested page does not exist.');
        // Сео настройки;
        $this->setMeta((!empty($pages->seo_title) ?   Functions::getTemplateCode($pages->seo_title) : $pages->title),Functions::getTemplateCode($pages->keywords),Functions::getTemplateCode($pages->description));
        return $pages;
    }



}
