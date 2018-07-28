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
        $this->actionNavigation = [
            'main' => [
                'title' => 'Главная',
                'link' => '/cms/',
                'status' => 1,
            ],
            'pages' => [
                'title' => 'Контент',
                'link' => '#',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/cms/pages',
                        'title' => 'Страницы',
                    ],
                    [
                        'link' => '/cms/menu-repairs',
                        'title' => 'Меню устройства',
                    ],
                    [
                        'link' => '/cms/devices/index',
                        'title' => 'Девайсы',
                    ],
                    [
                        'link' => '/cms/devices/group-device-problems',
                        'title' => 'Список проблемы',
                    ],
                    [
                        'link' => '/cms/devices/prices',
                        'title' => 'Цены',
                    ],
                ],
            ],
            'marketing' => [
                'title' => 'Маркетинг',
                'link' => '#',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/cms/call/index',
                        'title' => 'Заявки',
                    ],
                ],
            ],
            'geo' => [
                'title' => 'Гео данные',
                'link' => '#',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/cms/geo/index',
                        'title' => 'Страна',
                    ],
                    [
                        'link' => '/cms/geo/city',
                        'title' => 'Город',
                    ],
                ],
            ],
        ];
        if(\Yii::$app->user->can('old_admin'))  $this->actionNavigation['shop'] =[
            'title' => 'Магазин',
            'link' => '#',
            'status' => 1,
            'items' => [
                [
                    'link' => '/cms/shop/index',
                    'title' => 'Категории',
                ],
                [
                    'link' => '/cms/shop/goods',
                    'title' => 'Товары',
                ],
                [
                    'link' => '/cms/shop/delivery',
                    'title' => 'Доставки',
                ],

            ],
        ];
        if(\Yii::$app->user->can('old_admin')) $this->actionNavigation['service'] = [
            'title' => 'Продажи',
            'link' => '/cms/services/',
            'status' => 1,
            'items' => [
                [
                    'link' => ' /cms/reports/index',
                    'title' => 'Транзакции',
                ],
                [
                    'link' => ' /cms/orders/index',
                    'title' => 'Заказы',
                ]
            ],
        ];
        if(\Yii::$app->user->can('admin')) $this->actionNavigation['user'] = [

            'title' => 'Пользователи',
            'link' => '/cms/users/',
            'status' => 1,
            'items' => [
                [
                    'link' => '/cms/users',
                    'title' => 'Пользователи',
                ],
                [
                    'link' => '/cms/rule',
                    'title' => 'Управление ролями',
                ],
            ],
        ];
        if(\Yii::$app->user->can('admin')) $this->actionNavigation['options'] = [
            'title' => 'Система',
            'link' => '#',
            'status' => 1,
            'items' => [
                [
                    'link' => '/cms/name-site',
                    'title' => 'Настройки',
                ],
                [
                    'link' => '/cms/mailer',
                    'title' => 'Настройки почты',
                ],
                [
                    'link' => '/cms/logs/index',
                    'title' => 'Логи',
                ],


            ],
        ];
        $this->actionNavigation['out'] = [
            'title' => 'Выйти',
            'link' => '/site/logout',
            'status' => 1,
        ];


    }
}
