<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
   public  $title_h1;

    public function init()
    {
        parent::init(); // TODO: Главный контроллер;
//        ksort($_GET);
//        $url = Yii::$app->getUrlManager()->createUrl('',$_GET);
//        if (Yii::$app->request->url != $url) {
//            print_arr($url);
//            print_arr($_GET);
//            die();
//           // $this->redirect($url,301);
//        }
    }
    protected function setMeta($title = null, $keywords = null, $description = null){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}
