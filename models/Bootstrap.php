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
        $pathInfo = Yii::$app->request->pathInfo;
        // Исключение;
        $cms = preg_match("/cms/i", $pathInfo);
        $site = preg_match("/site/i", $pathInfo);
        $ajax = preg_match("/ajax/i", $pathInfo);
        $gridview = preg_match("/gridview/i", $pathInfo);
//        //TODO: чуть позже вернусь;
//        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//
//        }
//        if(\Yii::$app->request->isAjax ) {
//
//        }
        $result = [];
        if(empty($cms) && empty($ajax) && empty($gridview) && empty($site)) {
            $result = [
                '/<url:[\w_\/-]+>/<alias:[\w_\/-]+>/<last:[\w_\/-]+>' => 'repair/index',
                '/<url:[\w_\/-]+>/<alias:[\w_\/-]+>' => 'repair/index',
                '/<url:[\w_\/-]+>' => 'repair/index',
            ];
        }

        $app->getUrlManager()->addRules($result,true);
    }
}
?>