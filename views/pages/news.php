<?php

use app\models\Options;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$modelNews = new \app\models\News();

?>
<div class="container min-size">
    <div class="news">
        <div class="row">
                 <div class="sidebar col-sm-3 col-xs-12">
                     <?= app\components\WMenuLeft::widget()?>
                     <div class="visible-xs content-menu">
                         <?= Breadcrumbs::widget([
                             'links' => [
                                 'homeLink' => [
                                     'label' => 'Новости и Акции ',
                                 ],
                             ],
                         ]) ?>
                         <h1 class="title">Новости и Акции</h1>
                         <div class="select__mod">
                             <select class="select" onchange="top.location=this.value">
                                 <option value="/repair/iphone/iphone_4">Вакансия</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <?php if(!empty($one)): ?>
                   <div class="new col-sm-9 col-xs-12">
                       <div class="hidden-xs">
                           <?= Breadcrumbs::widget([
                               'links' => [
                                   'homeLink' => [
                                       'label' => 'Новости и Акции ',
                                       'url' => ['/news'] // сама ссылка
                                   ],
                                   [
                                        'label' => $one->title, // название ссылки
                                   ],
                               ],
                           ]) ?>
                       </div>
                       <h1 class="title hidden-xs"><?=$one->title?></h1>
                       <div class="siver date"><?=\app\models\Functions::dateFormat($one->date_create)?></div>
                       <div class="images"><img src="<?=$one->getImages(false);?>" alt="" class="size-2" /></div>
                       <div class="text"><?=$one->text?></div>
                   </div>
                 <?php else: ?>
                     <div class="list-news col-sm-9 col-xs-12">
                         <div class="hidden-xs">
                             <?= Breadcrumbs::widget([
                                 'links' => [
                                     'homeLink' => [
                                         'label' => 'Новости и Акции ',
                                     ],
                                 ],
                             ]) ?>
                         </div>
                         <h1 class="title hidden-xs">Новости и Акции</h1>
                         <?= app\components\news\WNewsType::widget(['modelNews'=>$modelNews])?>
                         <div class="news__com">
                             <div class="upadate">
                                 <?= app\components\news\WNewsItem::widget(['modelNews'=>$modelNews])?>
                             </div>
                             <div class="clear"></div>
                             <div class="text-center more hidden"> <div class="btn btn-more circle">Показать еще 10</div></div>
                         </div>
                     </div>
                 <?php endif; ?>
        </div>
    </div>
</div>