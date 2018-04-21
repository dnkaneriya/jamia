<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Classes;
use app\models\ClassesSearch;
use yii\web\Controller;
use yii\web\Session;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ClassesController implements the CRUD actions for Classes model.
 */
class ClassesController extends Controller
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
                        'actions' => ['index','create','update','delete','change'],
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
     * Lists all Classes models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('islamic_class')) {
            $searchModel = new ClassesSearch();
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
     * Displays a single Classes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('islamic_class')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Classes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('islamic_class')) {
            $model = new Classes();

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                if ($model->validate()) {
                    $model->is_active = 'Y';
                    $model->is_deleted = 'N';
                    $model->i_by = Yii::$app->user->id;
                    $model->i_date = time();
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save())
                        return $this->redirect(['index']);
                }else {
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
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Classes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('islamic_class')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                if ($model->validate()) {
                    $model->is_active = 'Y';
                    $model->is_deleted = 'N';
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save())
                        return $this->redirect(['index']);
                }else {
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
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Classes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('islamic_class')) {
            if (isset($_REQUEST['id'])) {
                $model = $this->findModel($_REQUEST['id']);
                $model->is_deleted = "Y";
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                $model->save(false);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    public function actionChange()
    {
        if(Yii::$app->user->can('islamic_class')) {
            $str = $_REQUEST['str'];
            $field = $_REQUEST['field'];
            $val = $_REQUEST['val'];
            if ($str != null) {
                $cond = [$field => $val];

                if (Classes::updateAll($cond, 'id IN(' . $str . ')')) {
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
            throw new ForbiddenHttpException;
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
     * Finds the Classes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
