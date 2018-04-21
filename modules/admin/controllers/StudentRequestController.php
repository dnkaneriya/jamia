<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\StudentRequest;
use app\models\StudentRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Student;
use yii\helpers\ArrayHelper;

/**
 * StudentRequestController implements the CRUD actions for StudentRequest model.
 */
class StudentRequestController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
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
                    [
                        'actions' => ['login', 'logout', 'forgotpassword'],
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
     * Lists all StudentRequest models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StudentRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $studentList = ArrayHelper::map(Student::find()->where(['is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'studentList' => $studentList,
        ]);
    }
    
    
    /**
     * Approve Student request 
     */
    public function actionApproverequest()
    {
        $str = $_REQUEST['str'];
        $status = $_REQUEST['newstatus'];
        
        $strvalues = explode(",",$str);
        foreach($strvalues as $value){
            $model = StudentRequest::findOne(['id' => $value]);
            if(!empty($model) && count($model) > 0) {
                $model->status = $status;
                $model->save();
            }
        }
        //die;
        $msg = 'standard allocated';
        $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
        \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        die;
    }
    
    /**
     * Displays a single StudentRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StudentRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StudentRequest();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = strtotime($model->date); 
            //$model->date = date("Y-m-d", strtotime($model->date));
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->date = date("m/d/Y", $model->date);
        if ($model->load(Yii::$app->request->post())) {
            $model->date = strtotime($model->date);
            //$model->date = date("Y-m-d", strtotime($model->date));
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StudentRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
