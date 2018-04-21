<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Guest;
use app\models\Guestsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * GuestController implements the CRUD actions for Guest model.
 */
class GuestController extends Controller
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
     * Lists all Guest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('guest')) {
            $searchModel = new Guestsearch();
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
     * Displays a single Guest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('guest')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Guest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('guest')) {
            $model = new Guest();

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($params);die;
                if ($model->validate()) {
                    if (isset($params['Guest']['in_date']) && $params['Guest']['in_date'] != null) {
                        $model->in_date = strtotime($params['Guest']['in_date']);
                    }
                    if (isset($params['Guest']['out_date']) && $params['Guest']['out_date'] != null) {
                        $model->out_date = strtotime($params['Guest']['out_date']);
                    }
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
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Guest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('guest')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($params);die;
                if ($model->validate()) {
                    if ($params['Guest']['in_date'] != null) {
                        //$model->in_date = str_replace("/","-",strtotime($params['Guest']['in_date']));
                        $model->in_date = strtotime($params['Guest']['in_date']);
                    }
                    if ($params['Guest']['out_date'] != null) {
                        //$model->out_date = str_replace("/","-",strtotime($params['Guest']['out_date']));
                        $model->out_date = strtotime($params['Guest']['out_date']);
                    }
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save(false)) {
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
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Guest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('guest')) {
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
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
    }
	
	public function actionChange()
    {
        $str = $_REQUEST['str'];
        $field =$_REQUEST['field'];
        $val = $_REQUEST['val'];
        if($str!= null)
        {
            $cond = [$field => $val];
                
            if(Guest::updateAll($cond,'id IN('.$str.')'))
            {
                if($_REQUEST['field'] == 'is_deleted')
                {
                    $msg = 'Data successfully deleted';
                }
                else{
                    $msg = 'Data successfully updated';
                }
                $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                
            }
            else
            {
                if($_REQUEST['field'] == 'is_deleted')
                    $msg = 'Unable to delete data. Please try again.';
                else
                    $msg = 'Unable to update data. Please try again.';
                    
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            }
        }
        $this->redirect(['index']);
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
     * Finds the Guest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
