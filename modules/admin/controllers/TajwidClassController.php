<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TajwidClass;
use app\models\TajwidClassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * TajwidClassController implements the CRUD actions for TajwidClass model.
 */
class TajwidClassController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'dashboardgraph'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'change', 'page'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return true;
                },
                    ],
                ],
                'denyCallback' => function () {
            return Yii::$app->response->redirect(['admin/default/login']);
        },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionPage() {
        if (isset($_REQUEST['size']) && $_REQUEST['size'] != null) {
            \Yii::$app->session->set('user.size', $_REQUEST['size']);
        }
    }

    public function actionIndex() {
        $searchModel = new TajwidClassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_deleted' => 'N']), 'class_name', 'class_name');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'tajwidClassList' => $tajwidClassList,
        ]);
    }

    /**
     * Displays a single TajwidClass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TajwidClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TajwidClass();

        if ($model->load(Yii::$app->request->post())) {
            $model->is_active = 'Y';
            $model->is_deleted = 'N';
            $model->i_by = Yii::$app->user->identity->id;
            $model->i_date = time();
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TajwidClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->u_by = Yii::$app->user->identity->id;
            $model->u_date = time();
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', ['model' => $model]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TajwidClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if (isset($_REQUEST['id'])) {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_deleted = "Y";
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            if ($model->save(false))
                return $this->redirect(['index']);
        }
    }

    /**
     * Finds the TajwidClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TajwidClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TajwidClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
