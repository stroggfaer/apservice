<?php
//namespace console\controllers;
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */

class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора контента
        $admin = $auth->createRole('admin');
        $manager = $auth->createRole('manager');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($manager);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование контента updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateContent = $auth->createPermission('updateContent');
        $updateContent->description = 'Редактирование каталог';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($updateContent);

        // Теперь добавим наследования. Для роли manager мы добавим разрешение updateContent,
        // а для админа добавим наследование от роли manager и еще добавим собственное разрешение viewAdminPage

        // Роли «Редактор новостей» присваиваем разрешение «Редактирование контент»
        $auth->addChild($manager,$updateContent);

        // админ наследует роль редактора контента. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $manager);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1001
        $auth->assign($admin, 1);

        // Назначаем роль editor пользователю с ID 1002
        $auth->assign($manager, 2);
    }
}