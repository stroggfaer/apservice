<?php

namespace app\modules\cms\controllers;


use app\models\Content;
use app\models\ExportEmail;

use app\models\Pages;
use dastanaron\translit\Translit;
use app\modules\cms\models\PostSearchPages;

use app\models\User;
use app\modules\cms\models\PostSearchUsers;

use app\models\AuthAssignment;
use app\modules\cms\models\AuthAssignmentSearch;

use app\models\ContentGroups;
use app\modules\cms\models\ContentGroupsSearch;

use app\models\MenuRepairs;
use app\modules\cms\models\MenuRepairSearch;

use app\models\AppleServices;
use app\modules\cms\models\AppleServicesSearch;

use app\models\Delivery;
use app\modules\cms\models\DeliverySearch;

use app\models\ParserEmail;
use app\modules\cms\models\ParserEmailSearch;

use app\models\Functions;
use app\models\Options;
use app\models\UploadedImage;
use yii\web\UploadedFile;
use Yii;
use yii\data\ActiveDataProvider;
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

        $model = new User();
        // Регистрация пользвателя;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->phone = Functions::phone($model->phone);
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
        }else{
            if(!empty($model->errors)) print_arr($model->errors);
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

    /*--------------Настройки сайта-------------------------*/

    public function actionSettings()
    {
        $model = $this->findModelSettings(1000);
        $image = new UploadedImage();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Загрузка изображения;
            $image->imageMax = UploadedFile::getInstance($image, 'imageMax');
            // Путь и расширения файл;
            $file = Functions::pathFile('/documents/logo');
            if(!empty($image->imageMax)) {
                // Путь к файлу;
                $fileDir = $file . '.' . $image->imageMax->extension;
                //Добавляем изображения;
                $image->imageMax->saveAs($fileDir);
                $model->logo = '/files/documents/logo.'.$image->imageMax->extension;

            }
            if(!$model->save()) {
                return false;
            }
            // Уведомления;
            Yii::$app->getSession()->setFlash('success', 'Настройки успешно сохранены!');

            return $this->redirect(['settings']);
        }


        return $this->render('settings/settings', [
            'model' => $model,
            'image' => $image,
        ]);
    }
    protected function findModelSettings($id)
    {
        if (($model = Options::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all ContentGroups models.
     * @return mixed
     */
    public function actionContentGroups()
    {
        $searchModel = new ContentGroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('content-groups/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentGroups model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewContentGroups($id)
    {
        return $this->render('content-groups/view', [
            'model' => $this->findModelContentGroups($id),
        ]);
    }

    /**
     * Creates a new ContentGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateContentGroups()
    {
        $model = new ContentGroups();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-content-groups', 'id' => $model->id]);
        }

        return $this->render('content-groups/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContentGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateContentGroups($id)
    {
        $model = $this->findModelContentGroups($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-content-groups', 'id' => $model->id]);
        }

        return $this->render('content-groups/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContentGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteContentGroups($id)
    {
        $this->findModelContentGroups($id)->delete();

        return $this->redirect(['content-groups']);
    }

    /**
     * Finds the ContentGroups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentGroups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelContentGroups($id)
    {
        if (($model = ContentGroups::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    //КОНТЕНТ;
    public function actionContent($group_id = false)
    {
        if(!empty($group_id)) {
            $content = Content::find()->where(['group_id'=>$group_id])->orderBy('id DESC');
        }else{
            $content = Content::find()->orderBy('id DESC');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $content,
            'pagination' => [
                'pageSize' => 40,
            ],
        ]);

        return $this->render('content-groups/index-content', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new ContentGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateContent()
    {
        $model = new Content();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['content']);
        }

        return $this->render('content-groups/create-content', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing ContentGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateContent($id)
    {
        $model = $this->findModelContent($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['content']);
        }

        return $this->render('content-groups/update-content', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing ContentGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteContent($id)
    {
        $this->findModelContent($id)->delete();

        return $this->redirect(['content-groups']);
    }

    protected function findModelContent($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all AppleServices models.
     * @return mixed
     */
    public function actionAppleServices()
    {
        $searchModel = new AppleServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('apple-services/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AppleServices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewAppleServices($id)
    {
        return $this->render('apple-services/view', [
            'model' => $this->findModelAppleServices($id),
        ]);
    }

    /**
     * Creates a new AppleServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateAppleServices()
    {
        $model = new AppleServices();
        $translit = new Translit();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->url = mb_strtolower($translit->translit($model->title,true,'ru-en'));
            if(!$model->save(true)) {
                return 'Ошибка save';
            }
            return $this->redirect(['view-apple-services', 'id' => $model->id]);
        }

        return $this->render('apple-services/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AppleServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAppleServices($id)
    {
        // Загружаем фото;
        $images = new UploadedImage();

        $model = $this->findModelAppleServices($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $images->imageMax = UploadedFile::getInstance($images, 'imageMax');


            // Путь и расширения файл;
            $file =  Functions::pathFile('/apple/').$model->id;

            // Параметры $file путь; резайз $w-Длина $h-высота;
            if ($images->isUpload($file,false)) {
                // file is uploaded successfully
            }
            return $this->redirect(['view-apple-services', 'id' => $model->id]);
        }

        return $this->render('apple-services/update', [
            'model' => $model,
            'images'=>$images
        ]);
    }

    /**
     * Deletes an existing AppleServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteAppleServices($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['apple-services']);
    }

    /**
     * Finds the AppleServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppleServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelAppleServices($id)
    {
        if (($model = AppleServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all Delivery models.
     * @return mixed
     */
    public function actionDelivery()
    {
        $searchModel = new DeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('delivery/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Delivery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewDelivery($id)
    {
        return $this->render('delivery/view', [
            'model' => $this->findModelDelivery($id),
        ]);
    }

    /**
     * Creates a new Delivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateDelivery()
    {
        $model = new Delivery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-delivery', 'id' => $model->id]);
        }

        return $this->render('delivery/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Delivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateDelivery($id)
    {
        $model = $this->findModelDelivery($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-delivery', 'id' => $model->id]);
        }

        return $this->render('delivery/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Delivery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteDelivery($id)
    {
        $this->findModelDelivery($id)->delete();

        return $this->redirect(['delivery/index']);
    }

    /**
     * Finds the Delivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Delivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelDelivery($id)
    {
        if (($model = Delivery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*Настройка сбор данные почты */
    public function actionMailUpload() {

        $exportEmail = new ExportEmail();

        $mail_login = yii::$app->params['mail_upload'];

        if(empty($mail_login['email']) || empty($mail_login['password'])) {

            return $this->render('mail-upload/index', [
                'error' => true,
            ]);
        }

        $mails_data = $exportEmail->getDataListEmail($mail_login['mail_imap'], $mail_login['email'], $mail_login['password']);

        return $this->render('mail-upload/index', [
            'mails_data' => $mails_data,
            'mail_login'=>$mail_login
        ]);
    }

    /**
     * Lists all ParserEmail models.
     * @return mixed
     */
    public function actionParserEmail()
    {
        $exportEmail = new ExportEmail();

//        $counts = 6;
//
//        $testSearsh = array(755,756,757,758,759,760,761,762,763,764,765,766,767,768,769,770,771,772,773,783);
//        $dataMails = array();
//        if(!empty($testSearsh)) {
//            $mailsList = ParserEmail::find()->select('uid')->orderBy('id DESC')->asArray()->where(['status' => 1])->column();
//            $result = array_diff($testSearsh, $mailsList);
//            sort($result);
//            $dataMails = array_slice($result, 0, $counts);
//        }
//        print_arr($dataMails);
//
//
//        die('STOP');

        $searchModel = new ParserEmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       //$mails_data = $exportEmail->getDataListEmail();

        return $this->render('parser-email/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'exportEmail'=>$exportEmail
        ]);
    }

    /**
     * Deletes an existing ParserEmail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteParserEmail($id)
    {
        $this->findModelParserEmail($id)->delete();

        return $this->redirect(['parser-email']);
    }

    /**
     * Finds the ParserEmail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ParserEmail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelParserEmail($id)
    {
        if (($model = ParserEmail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
