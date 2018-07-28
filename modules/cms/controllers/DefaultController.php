<?php

namespace app\modules\cms\controllers;
use app\models\Pages;
use dastanaron\translit\Translit;
use app\modules\cms\models\PostSearchPages;

use app\models\User;
use app\modules\cms\models\PostSearchUsers;

use app\models\AuthAssignment;
use app\modules\cms\models\AuthAssignmentSearch;

use app\models\MenuRepairs;
use app\modules\cms\models\MenuRepairSearch;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
/**
 * Default controller for the `cms` module
 */
class DefaultController extends BackendController
{
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


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionPages()
    {
        $searchModel = new PostSearchPages();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('pages/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewPages($id)
    {
        return $this->render('pages/view', [
            'model' => $this->findModelPages($id),
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatePages()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-pages', 'id' => $model->id]);
        } else {
            return $this->render('pages/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePages($id)
    {
        $model = $this->findModelPages($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-pages', 'id' => $model->id]);
        } else {
            return $this->render('pages/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeletePages($id)
    {
        $this->findModelPages($id)->delete();

        return $this->redirect(['pages']);
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPages($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionUsers()
    {
        $searchModel = new PostSearchUsers();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('users/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewUsers($id)
    {
        return $this->render('users/view', [
            'model' => $this->findModelUsers($id),
        ]);
    }

    /**
     ******------Добавить пользователь------*******
     */
    public function actionCreateUsers()
    {

        $model = new User(['scenario' => User::SCENARIO_ADMIN_RULE]);
        // Регистрация пользвателя;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // Генерация ключ;
                $model->generateAuthKey();
                $model->generateEmailConfirmToken();
                $model->setPassword($model->password);
                $model->save();
                return $this->redirect(['view-users', 'id' => $model->id]);
            }
        }
        return $this->render('users/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateUsers($id)
    {
        $model = $this->findModelUsers($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-users', 'id' => $model->id]);
        }

        return $this->render('users/update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteUsers($id)
    {
        $this->findModelUsers($id)->delete();

        return $this->redirect(['users']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelUsers($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*Управление ролями*/
    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionRule()
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rule/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewRule($item_name, $user_id)
    {
        return $this->render('rule/view', [
            'model' => $this->findModelRule($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateRule()
    {

        $model = new AuthAssignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-rule', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('rule/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateRule($item_name, $user_id)
    {
        $model = $this->findModelRule($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-rule', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('rule/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteRule($item_name, $user_id)
    {
        $this->findModelRule($item_name, $user_id)->delete();

        return $this->redirect(['rule']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelRule($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all MenuRepairs models.
     * @return mixed
     */
    public function actionMenuRepairs()
    {
        $searchModel = new MenuRepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('menu-repairs/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuRepairs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewMenuRepairs($id)
    {
        return $this->render('menu-repairs/view', [
            'model' => $this->findModelMenuRepairs($id),
        ]);
    }

    /**
     * Creates a new MenuRepairs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateMenuRepairs()
    {
        $translit = new Translit();
        $model = new MenuRepairs();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->url = mb_strtolower($translit->translit($model->title,true,'ru-en'));
            if(!$model->save(true)) {
                return 'Ошибка save';
            }
            return $this->redirect(['view-menu-repairs', 'id' => $model->id]);
        }

        return $this->render('menu-repairs/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MenuRepairs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateMenuRepairs($id)
    {
        $model = $this->findModelMenuRepairs($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-menu-repairs', 'id' => $model->id]);
        }

        return $this->render('menu-repairs/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MenuRepairs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteMenuRepairs($id)
    {
        $this->findModelMenuRepairs($id)->delete();

        return $this->redirect(['menu-repairs']);
    }

    /**
     * Finds the MenuRepairs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuRepairs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMenuRepairs($id)
    {
        if (($model = MenuRepairs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
