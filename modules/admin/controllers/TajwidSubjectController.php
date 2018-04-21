<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TajwidSubject;
use app\models\TajwidSubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\TajwidClass;
use yii\helpers\ArrayHelper;

/**
 * TajwidSubjectController implements the CRUD actions for TajwidSubject model.
 */
class TajwidSubjectController extends Controller {

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

    /**
     * Lists all TajwidSubject models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TajwidSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_deleted' => 'N']), 'id', 'class_name');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'tajwidClassList' => $tajwidClassList,
        ]);
    }

    /**
     * Displays a single TajwidSubject model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TajwidSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TajwidSubject();
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_deleted' => 'N']), 'id', 'class_name');

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
                            'tajwidClassList' => $tajwidClassList,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'tajwidClassList' => $tajwidClassList,
            ]);
        }
    }

    /**
     * Updates an existing TajwidSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_deleted' => 'N']), 'id', 'class_name');
        if ($model->load(Yii::$app->request->post())) {
            $model->u_by = Yii::$app->user->identity->id;
            $model->u_date = time();
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'tajwidClassList' => $tajwidClassList,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'tajwidClassList' => $tajwidClassList,
            ]);
        }
    }

    /**
     * Deletes an existing TajwidSubject model.
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
     * Finds the TajwidSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TajwidSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TajwidSubject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
