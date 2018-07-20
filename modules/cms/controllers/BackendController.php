<?php

namespace app\modules\cms\controllers;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class BackendController extends Controller
{

    public $actionNavigation;

    public function init()
    {
        parent::init();

        $this->actionNavigation = [
            'main' => [
                'title' => 'Главная',
                'link' => '/cms/',
                'status' => 1,
            ],
            'pages' => [
                'title' => 'Страницы',
                'link' => '/cms/pages/',
                'status' => 1,
            ],
            'user' => [
                'title' => 'Пользователи',
                'link' => '/cms/users/',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/cms/create-users',
                        'title' => 'Добавить пользователь',
                    ],
                    [
                        'link' => '/cms/rule',
                        'title' => 'Управление ролями',
                    ],
                ],
            ],
            'orders' => [
                'title' => 'Заявки',
                'count'=> 3,
                'link' => '/admin/orders/',
                'status' => 1,
            ],
            'service' => [
                'title' => 'Сервис',
                'link' => '/admin/services/',
                'status' => 1,
            ],
            'options' => [
                'title' => 'Настройка',
                'link' => '/cms/options/',
                'status' => 1,
            ],

            'out' => [
                'title' => 'Выйти',
                'link' => '/site/logout',
                'status' => 1,
            ],

        ];


    }
}
