<?php

use app\models\Options;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = $pages->title;
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();

$reviews = \app\models\Reviews::find()->where(['status'=>1])->limit(40)->all();
?>
<div class="reviews">

    <div class="container min-size">
        <div class="content-title">
            <h1 class="title pull-left"><?= $pages->title?></h1>
            <a href="https://2gis.ru/novosibirsk/search/Apple.sc" target="_blank" class="btn btn-danger pull-right">Оставить отзыв в 2gis</a>
        </div>

        <div class="content-reviews">
            <table class="table table-striped table-hover mobile__mod" id="map_table">
                <?php foreach ($reviews as $review): ?>
                    <?=  app\components\WReviewsList::widget(['review'=>$review])?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>



