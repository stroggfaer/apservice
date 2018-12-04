<?php
namespace app\components;

use yii\base\Widget;
use Yii;

class WDevicesProblemsGroups extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        if (empty($this->model->devicesProblemsGroups)) {
            return false;
        }else {

            ?>
            <div class="devices__com groups">
                <div class="items">
                 <?php foreach ($this->model->devicesProblemsGroups as $devicesProblemsGroups): ?>
                    <div class="group">
                        <div class="name"><?=$devicesProblemsGroups['title']?></div>
                        <?php if(!empty($devicesProblemsGroups['deviceProblem'])): ?>
                           <?php foreach ($devicesProblemsGroups['deviceProblem'] as $devicesProblems): ?>
                               <div class="item">
                                    <a href="<?=Yii::$app->request->url.$devicesProblems->url?>">
                                        <?=$devicesProblems->title?>
                                        <div class="small"><?=(!empty($devicesProblems->price->value) ? $devicesProblems->price->value : '')?></div>
                                    </a>
                              </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                 <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
}