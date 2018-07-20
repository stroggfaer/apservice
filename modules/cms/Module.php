<?php

namespace app\modules\cms;

/**
 * cms module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $layout = '@app/views/layouts/cms';
    public $controllerNamespace = 'app\modules\cms\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
