<?php

namespace app\modules\cms\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\models\UploadedImage;
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
                'link' => '',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/cms/pages',
                        'title' => 'Статичные страницы',
                    ],
                    [
                        'link' => '/cms/content-groups',
                        'title' => 'Основные разделы',
                    ],
                    [
                        'link' => '/cms/content',
                        'title' => 'Контент разделов',
                    ],
                    [
                        'link' => '/cms/menu-repairs',
                        'title' => 'Устройства',
                    ],
                    [
                        'link' => '/cms/devices/index',
                        'title' => 'Девайсы',
                    ],
                    [
                        'link' => '/cms/devices/group-device-problems',
                        'title' => 'Список проблем',
                    ],
                    [
                        'link' => '/cms/devices/prices',
                        'title' => 'Цены',
                    ],
                    [
                        'link' => '/cms/apple-services',
                        'title' => 'Адреса сервисов',
                    ],
                    [
                        'link' => '/cms/delivery',
                        'title' => 'Выезд / Доставка',
                    ],
                ],
            ],
            'marketing' => [
                'title' => 'Маркетинг',
                'link' => '',
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
                'link' => '',
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
                    [
                        'link' => '/cms/geo/region',
                        'title' => 'Район',
                    ],
                ],
            ],
        ];
        if(\Yii::$app->user->can('old_admin'))  $this->actionNavigation['shop'] =[
            'title' => 'Магазин',
            'link' => '',
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
            'link' => '',
            'status' => 1,
            'items' => [
                [
                    'link' => '/cms/settings',
                    'title' => 'Настройки',
                ],
                [
                    'link' => '/cms/parser-email', // /cms/mail-upload
                    'title' => 'Выгрузка почты',
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

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin','manager'],
                    ],
                ],
            ],

        ];
    }
}
