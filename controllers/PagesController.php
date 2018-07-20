<?php

namespace app\controllers;

use app\models\Functions;
use app\models\Pages;
use Yii;



class PagesController extends AppController
{

    public function beforeAction( $action )
    {
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    // Страница сайта;
    public function actionPage($url = false)
    {
        $url = preg_replace('/\s/', '', $url);
        // Загрузка страница;
        $pages = Pages::find()->where(["url"=>$url,"status"=> 1])->limit(1)->one();

        if(!empty($pages) && !empty($url)){
            // Сео настройки;
            $this->setMeta((!empty($pages->seo_title) ? $pages->seo_title : $pages->title),$pages->keywords,$pages->description);

            //  Проверка файл;
            if(Functions::fileDir('/views/pages/'.$url)) {
                return $this->render($url, [ 'pages' => $pages,]);
            }else{
                // Запуск контроллер экшен;
                return Yii::$app->runAction($url);
            }
        }else {
            // Запуск контроллер экшен;
            return Yii::$app->runAction($url);
        }
    }


}
