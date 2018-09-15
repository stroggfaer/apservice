<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\CmsAsset;
use app\models\Pages;
use app\models\Options;

CmsAsset::register($this);

$version = '2.0.2';
$menu = Pages::find()->where(['status'=>1])->all();
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="spinner__mod">
    <div class="loader"></div>
</div>
<div class="wrap">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand" href="/cms">CMS <small>v <?=$version?></small></a></div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if(!empty(\Yii::$app->controller->actionNavigation)): ?>
                        <?php foreach(\Yii::$app->controller->actionNavigation as $key=>$value): ?>
                            <li class="dropdown js-mounts">
                                <a <?= !empty($value['items']) ? 'class="dropdown-toggle" role="navigation"  data-toggle="dropdown"' : '' ?>href="/repair<?=$value['link']?>">
                                    <?=$value['title']?>
                                    <?php if(!empty($value['count'])): ?><span style="margin-left: 5px" class="badge pull-right danger-bg"><?=$value['count']?></span><?php endif; ?>
                                </a>
                                <?php if(!empty($value['items'])): ?>
                                    <ul class="dropdown-menu">
                                        <?php foreach($value['items'] as $k=>$v): ?>
                                            <li><a href="/repair<?=$v['link']?>"><?=$v['title']?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <p class="navbar-text navbar-right">Вы <a href="#" class="navbar-link"><?=Yii::$app->user->identity->username ?></a></p>
                <p class="navbar-text navbar-right"><a href="/repair/" target="_blank" class="navbar-link">Сайт</a></p>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; AppleService <?= date('Y') ?></p>

        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
