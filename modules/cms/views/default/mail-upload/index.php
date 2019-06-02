<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'Выгрузка почты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-settings">
    <h1><?= Html::encode($this->title) ?></h1>

    <div id="page">
        <?php if(!empty($error)): ?>
           <div class="alert alert-danger">
               <b>Нужно указать логин или пароль (config/params.php  mail_upload)</b>
           </div>
        <?php else: ?>
            <h3>Яндекс Почта (Входящие) | <?php echo($mail_login['email']);?></h3>
            <h4>Число писем: <?php echo(count($mails_data));?></h4>
            <?php if(!isset($mails_data)):?>
                <div class="empty">писем нет</div>
            <?php else:?>
               <table class="table table-bordered">
                   <tr>
                       <th>Временная метка:</th>
                       <th>Дата:</th>
                       <th>Кому:</th>
                       <th>От:</th>
                       <th>Тема:</th>
                       <th width="160px">Письмо в base64:</th>
                   </tr>
                  <?php foreach($mails_data as $key => $mail):?>
                   <tr>
                       <td><?php echo(date('d.m.Y H:i:s',strtotime($mail["time"])));?></td>
                       <td><?php echo($mail["date"]);?></td>
                       <td><?php echo(!empty($mail["to"])) ? $mail["to"] : 'Нет';?></td>
                       <td><?php echo($mail["from"]);?></td>
                       <td><?php echo($mail["title"]);?></td>
                       <td width="160px"><?php echo($mail["body"]);?></td>
                   </tr>
                <?php endforeach;?>
               </table>
            <?php endif;?>
        <?php endif; ?>
    </div>
</div>
