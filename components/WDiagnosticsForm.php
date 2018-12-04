<?php
namespace app\components;
use app\models\Functions;
use app\models\Repair;
use yii\base\Widget;
use Yii;

class WDiagnosticsForm extends Widget{

    public function run(){

        $repair =  new Repair();

            ?>
             <div class="container size">
                <div class="text-left">
                    <h2 class="seo-title">Сколько стоит ремонт вашей техники Apple?</h2>
                    <div style="position: relative;left: 5px;">Узнай  срок и цену ремонта за одну минут</div>
                </div>
                <div class="form right pull-left">
                    <form role="form" class="form__mod">
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Укажите устройство:</label>
                                <select class="form-control js-select-devices-form">
                                    <option>---</option>
                                    <?php if(!empty($repair->devices)): ?>
                                        <?php foreach ($repair->devices as $device): ?>
                                             <option <?=(!empty($repair->deviceObj->deviceOne) && $repair->deviceObj->deviceOne->id == $device->id ? 'selected' : '')?> value="<?=$device->id?>"><?=$device->title?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-xs-6 update-select__js">
                                <label>Укажите проблему:</label>
                                <select class="form-control js-select-devices-problems-form" <?=!empty($repair->deviceObj->deviceOne) ? '' : 'disabled'?>>
                                    <option>---</option>
                                    <?php if(!empty($repair->deviceObj->deviceOneProblems)): ?>
                                        <?php foreach ($repair->deviceObj->deviceOneProblems as $deviceOneProblem): ?>
                                            <option <?=(!empty($repair->deviceObj->deviceProblemOne) && $repair->deviceObj->deviceProblemOne->id == $deviceOneProblem->id ? 'selected' : '')?> value="<?=$deviceOneProblem->id?>"><?=$deviceOneProblem->title?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="clear"></div>
                    <div class="update-content__js">
                        <?php if(!empty($repair->deviceObj->deviceProblemOne)): ?>
                        <div class="description-warning">
                            Внимание! Данная информация является ознакомительной и не гарантирует, что результаты “Предварительной диагностики” могут совпадать с диагностикой вашего устройства в сервисном центре.
                        </div>
                        <h3 class="title"><?=$repair->deviceObj->deviceProblemOne->title?></h3>
                        <div class="description"><?=$repair->deviceObj->deviceProblemOne->description?></div>
                       <?php endif; ?>
                    </div>
                </div>
                <div class="result-content result-content__js pull-left">
                    <?php if(!empty($repair->deviceObj->deviceProblemOne)): ?>
                        <div class="content">
                            <div class="description-warning">
                                Внимание! Данная информация является ознакомительной и не гарантирует, что результаты “Предварительной диагностики” могут совпадать с диагностикой вашего устройства в сервисном центре.
                            </div>
                            <div class="title">Предварительный анализ</div>
                            <div class="_icon-ap time"><?=$repair->deviceObj->deviceProblemOne->time?></div>
                            <div class="_icon-ap money"><?=Functions::money($repair->deviceObj->deviceProblemOne->price->money)?> руб.</div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
            <?php
    }
}