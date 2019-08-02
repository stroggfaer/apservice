<?php
namespace app\models;
use yii\base\BootstrapInterface;
use Yii;
use app\models\Repair;


class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // Исключение;
//        $cms = preg_match("/cms/i", $pathInfo);
//        $site = preg_match("/site/i", $pathInfo);
//        $ajax = preg_match("/ajax/i", $pathInfo);
//        $gridview = preg_match("/gridview/i", $pathInfo);
        $pathInfo = Yii::$app->request->pathInfo;
        $rules = true;
        if(!empty(Yii::$app->params['url_rules'])) {
            foreach (Yii::$app->params['url_rules'] as $controller) {
                if(preg_match("/{$controller}/i", $pathInfo)) {
                    $rules = false;
                    break;
                }
            }
        }

        $result = [];
        if(!empty($rules)) {

            $result = [
            //    '/<url:[\w_\/-]+>/<alias:[\w_\/-]+>/<last:[\w_\/-]+>' => 'repair/index',
              //  '/<url:[\w_\/-]+>/<alias:[\w_\/-]+>' => 'repair/index',
               // '/<url:[\w_\/-]+>' => 'repair/index',

                'repair/<url:[\w_\/-]+>/<alias:[\w_\/-]+>/<last:[\w_\/-]+>' => 'repair/index',
                'repair/<url:[\w_\/-]+>/<alias:[\w_\/-]+>' => 'repair/index',
                'repair/<url:[\w_\/-]+>' => 'repair/index',
                'repair' => 'repair/index',
                '<url:[\w_\/-]+>' => 'pages/page',

                //'<url:\w+>'=>'pages/page',
            ];
        }

        $app->getUrlManager()->addRules($result,true);
    }
}
?>