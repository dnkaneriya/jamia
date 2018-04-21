<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Request;
use app\models\Requestsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    public $layout="//listing";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','dashboardgraph'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','change','page'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                                        {
                                            return true;
                                        },
                    ],
                    [
                        'actions' => ['login','logout','forgotpassword'],
                        'allow' => true,
                        'roles' => ['?'],
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

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('student_request')) {
            $searchModel = new Requestsearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('student_request')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('student_request')) {
            $model = new Request();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('student_request')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionApproved()
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_approved = $_REQUEST['val'];
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            $model->save(false);
        }
    }
    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_deleted = "Y";
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            $model->save(false);
        }
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
    }
	public function actionPage()
    {
        if(isset($_REQUEST['size']) && $_REQUEST['size']!=null)
        {
         \Yii::$app->session->set('user.size',$_REQUEST['size']);
        }
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
