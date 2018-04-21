<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Complaint;
use app\models\Complaintsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Student;
use yii\web\ForbiddenHttpException;

/**
 * ComplaintController implements the CRUD actions for Complaint model.
 */
class ComplaintController extends Controller
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
     * Lists all Complaint models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('complaint_register')) {
            $searchModel = new Complaintsearch();
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
     * Displays a single Complaint model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('complaint_register')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Complaint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('complaint_register')) {
            $model = new Complaint();

            $studentList = ArrayHelper::map(Student::find()->where(['is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

            if ($model->load(Yii::$app->request->post())) {

                $grno = Student::findOne(['id' => $model->student_id])->grno;
                $model->c_date = date("Y-m-d", strtotime($model->c_date));
                $model->grno = $grno;
                $model->i_by = Yii::$app->user->identity->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->identity->id;
                $model->u_date = time();

                $model->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'studentList' => $studentList,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Complaint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('complaint_register')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                $grno = Student::findOne(['id' => $model->student_id])->grno;
                $model->c_date = date("Y-m-d", strtotime($model->c_date));
                $model->grno = $grno;
                $model->i_by = Yii::$app->user->identity->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->identity->id;
                $model->u_date = time();

                $model->save();
                return $this->redirect(['index']);
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
     * Deletes an existing Complaint model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('complaint_register')) {
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
	public function actionPage()
    {
        if(isset($_REQUEST['size']) && $_REQUEST['size']!=null)
        {
         \Yii::$app->session->set('user.size',$_REQUEST['size']);
        }
    }

    /**
     * Finds the Complaint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Complaint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Complaint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
