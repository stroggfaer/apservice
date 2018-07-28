<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Pages;
use app\models\Options;

AppAsset::register($this);


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

<div class="wrap">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Brand</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php foreach($menu as $key=>$value): ?>
                        <li class=""><a href="<?=$value->url?>"><?=$value->title?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php if(!empty(Yii::$app->user->isGuest)):?>
                  <a  class="btn btn-primary  navbar-btn pull-right" style="margin-left: 10px" href="/repair/login">Регистрация</a>
                  <a  class="btn btn-success  navbar-btn pull-right" href="/repair/login">Войти</a>
                <?php else: ?>
                    <a class="pull-right navbar-btn" href="/site/logout" style="color:#fff;margin-left: 10px">Выйти</a>
                    <a class="pull-right navbar-btn" href="#" style="color:#fff"><?=Yii::$app->user->identity->username ?></a>

                <?php endif; ?>
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
