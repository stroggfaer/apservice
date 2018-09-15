<?php
$this->title = 'CMS Apple Service';

$call = \app\models\Call::find()->where(['status'=>0])->all();
?>
<div class="cms-default-index">
    <div class="page-header">
        <h1><?=$this->title?> <small>Панель состояния</small></h1>
    </div>
    <div class="row">
        <a href="/repair/cms/call/index" class="col-md-3 no_border block">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">ЗАКАЗАТЬ ЗВОНОК</h3>
                </div>
                <div class="panel-body">
                    <h2 class="count margin-clear"><?php if(!empty($call)):?><small class="label label-danger" >New</small><?=count($call)?><?php endif; ?></h2>
                </div>
            </div>
        </a>
    </div>
</div>
