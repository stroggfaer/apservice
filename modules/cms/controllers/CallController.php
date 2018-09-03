<?php

namespace app\modules\cms\controllers;

use Yii;
use app\models\Call;
use app\models\CallGroups;
use app\modules\cms\models\CallGroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * CallController implements the CRUD actions for CallGroups model.
 */
class CallController extends BackendController
{

    public function actionCall($group_id=false)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Call::find()->where(['group_id'=>$group_id]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
        ]);
        // Пометить как отмечень;
        if (Yii::$app->request->post('checkboxColumn')) {
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            $model =  Call::find()->where(['id'=>$id])->one();
            $model->status = $status;
            $model->save(false);
            return $this->render('call', [
                'dataProvider' => $dataProvider,
            ]);
        }
        // Пометить как отмечень;
        if (Yii::$app->request->post('delete')) {
            $id = Yii::$app->request->post('id');
            $model =  Call::find()->where(['id'=>$id])->one();
            $model->delete();
            return $this->render('call', [
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('call', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all CallGroups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallGroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CallGroups model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CallGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CallGroups();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CallGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CallGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CallGroups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CallGroups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CallGroups::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
