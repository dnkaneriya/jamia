<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Subjectoption;
use app\models\SubjectoptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SubjectoptionController implements the CRUD actions for Subjectoption model.
 */
class SubjectoptionController extends Controller
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
     * Lists all Subjectoption models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubjectoptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subjectoption model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Subjectoption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subjectoption();

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            if($model->validate())
            {
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->i_by = Yii::$app->user->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save()){
                    return $this->redirect(['index']);
                }
            }else{
               return $this->render('update', [
                    'model' => $model,
                ]); 
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subjectoption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            if($model->validate())
            {
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save())
                return $this->redirect(['index']);
            }else{
               return $this->render('update', [
                    'model' => $model,
                ]); 
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subjectoption model.
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
    }
    
    public function actionChange()
    {
        $str = $_REQUEST['str'];
        $field =$_REQUEST['field'];
        $val = $_REQUEST['val'];
        if($str!= null)
        {
            $cond = [$field => $val];
                
            if(Subjectoption::updateAll($cond,'id IN('.$str.')'))
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
     * Finds the Subjectoption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subjectoption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subjectoption::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
