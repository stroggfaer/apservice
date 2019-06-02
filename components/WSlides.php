<?php
namespace app\components;
use app\models\Sliders;
use yii\base\Widget;
use app\models\Options;
use Yii;
use app\models\Functions;



class WSlides extends Widget{

    public function run(){
        $city = \Yii::$app->action->currentCity;
        $options = Options::find()->where(['id'=>1000,'status'=>1])->one();
        $title = !empty(\Yii::$app->action->titleH1) ? \Yii::$app->action->titleH1 : (!empty($options->title) ? $options->title : '');
        $device_id = !empty(\Yii::$app->action->device_id) ? \Yii::$app->action->device_id : false;
        $device_problems_id = !empty(\Yii::$app->action->device_problems_id) ? \Yii::$app->action->device_problems_id : false;
        $sliders = Sliders::find()->where(['status'=>1])->all();
        ?>
        <?php if(!empty($sliders)): ?>
        <div class="slider js-slider">
            <div class="items" >
                <?php foreach ($sliders as $slider): ?>
                   <div class="item">
                    <a href="<?=$slider->url?>"><img src="<?=$slider->img?>"></a>
                    <div class="caption">
                        <h1><?=$slider->title?></h1>
                        <?php if(!empty($slider->description) && !empty($slider->show_text)): ?>
                            <div class="description"><?=$slider->description?></div>
                        <?php endif; ?>
                        <?php if(!empty($slider->buttons) && !empty($slider->show_button)): ?>
                            <?=$slider->buttons?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php

    }
}