<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Bed;
use app\models\Bedsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * BedController implements the CRUD actions for Bed model.
 */
class BedController extends Controller
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
     * Lists all Bed models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('bed')) {
            $searchModel = new Bedsearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Displays a single Bed model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('bed')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Creates a new Bed model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('bed')) {
            $model = new Bed();

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($params);die;
                if ($model->validate()) {
                    $model->i_by = Yii::$app->user->id;
                    $model->i_date = time();
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save()) {
                        return $this->redirect(['index']);
                    }
                } else {
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Updates an existing Bed model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('bed')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($params);die;
                if ($model->validate()) {
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save()) {
                        return $this->redirect(['index']);
                    }
                } else {
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Deletes an existing Bed model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('bed')) {
            
            if (isset($_REQUEST['id'])) {
                $model = $this->findModel($_REQUEST['id']);
                $model->is_deleted = "Y";
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                $model->save(false);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
    }
    
    public function actionChange()
    {
        if(Yii::$app->user->can('bed')) {
            
            $str = $_REQUEST['str'];
            $field = $_REQUEST['field'];
            $val = $_REQUEST['val'];
            if ($str != null) {
                $cond = [$field => $val];

                if (Cms::updateAll($cond, 'id IN(' . $str . ')')) {
                    if ($_REQUEST['field'] == 'is_deleted') {
                        $msg = 'Data successfully deleted';
                    } else {
                        $msg = 'Data successfully updated';
                    }
                    $flash_msg = \Yii::$app->params['msg_success'] . $msg . \Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                } else {
                    if ($_REQUEST['field'] == 'is_deleted')
                        $msg = 'Unable to delete data. Please try again.';
                    else
                        $msg = 'Unable to update data. Please try again.';

                    $flash_msg = \Yii::$app->params['msg_error'] . $msg . \Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                }
            }
            $this->redirect(['index']);
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }
    
    /*
     *  Set Page Number for paggination
     */
    public function actionPage()
    {
        if(isset($_REQUEST['size']) && $_REQUEST['size']!=null)
        {
         \Yii::$app->session->set('user.size',$_REQUEST['size']);
        }
    }


    /**
     * Finds the Bed model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bed the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bed::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
