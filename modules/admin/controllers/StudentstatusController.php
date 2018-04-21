<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Student;
use app\models\Studentstatus;
use app\models\StudentstatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * StudentstatusController implements the CRUD actions for Studentstatus model.
 */
class StudentstatusController extends Controller
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
     * Lists all Studentstatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentstatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Studentstatus model.
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
     * Creates a new Studentstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Studentstatus();
        $student = new Student();

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            $student->is_continue = $params['Studentstatus']['is_continue'];
            if($model->validate())
            {
                $model->join_date = strtotime($params['Studentstatus']['join_date']);
                $model->left_date = strtotime($params['Studentstatus']['left_date']);
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->i_by = Yii::$app->user->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save()){
                    $student->save();
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
     * Updates an existing Studentstatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $student = Student::find()->where(['id'=>$id])->one();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            $student->is_continue = $params['Studentstatus']['is_continue'];
            if($model->validate())
            {
                $model->join_date = strtotime($params['Studentstatus']['join_date']);
                $model->left_date = strtotime($params['Studentstatus']['left_date']);
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save()){
                    $student->save();
                    return $this->redirect(['index']);
                }
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
     * Deletes an existing Studentstatus model.
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
                
            if(Studentstatus::updateAll($cond,'id IN('.$str.')'))
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
     * Finds the Studentstatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Studentstatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Studentstatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
