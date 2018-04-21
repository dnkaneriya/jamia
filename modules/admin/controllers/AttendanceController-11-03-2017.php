<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Attendance;
use app\models\Attendancesearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Student;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'change', 'page'],
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
     * Lists all Attendance models.
     * @return mixed
     */
    public function actionIndex() {
        if(Yii::$app->user->can('attendance')) {
            $searchModel = new Attendancesearch();
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
     * Displays a single Attendance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if(Yii::$app->user->can('attendance')) {
            $model = $this->findModel($id);
            return $this->render('view', [
                        'model' => $model
            ]);
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if(Yii::$app->user->can('attendance')) {
            $model = new Attendance();
            $model->scenario = "attendance_options";
            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }
            $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
            $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
            $monthList = Yii::$app->params['islamic_month_en'];

            $dayList = [];
            for($i=1; $i <= 30; $i++) {
                $dayList[$i] = $i;
            }

            if ($postdata = Yii::$app->request->post()) {

                return $this->redirect(['enter-attendance', 't_year' => $postdata['Attendance']['t_year'], 't_month' => $postdata['Attendance']['t_month'], 'day' => $postdata['Attendance']['day'], 'class_id' => $postdata['Attendance']['class_id'], 'subclass_id' => $postdata['Attendance']['subclass_id'], 'division_id' => $postdata['Attendance']['division_id'] ]);

            } else {
                return $this->render('create', [
                            'model' => $model,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'divisionList' => $divisionList,
                        'yearList' => $yearList,
                        'monthList' => $monthList,
                        'dayList' => $dayList,    
                    ]);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
        
    }

    /**
     * Enter Student attendance for perticular day
     */
    public function actionEnterAttendance()
    {   
        if(Yii::$app->user->can('attendance')) {
            
            $t_year = Yii::$app->getRequest()->getQueryParam('t_year');
            $t_month = Yii::$app->getRequest()->getQueryParam('t_month');
            $day = Yii::$app->getRequest()->getQueryParam('day');
            $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
            $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
            $division_id = Yii::$app->getRequest()->getQueryParam('division_id');

            $requestData = [
                't_year' => $t_year,
                't_month' => $t_month,
                'day' => $day,
                'class_id' => $class_id,
                'subclass_id' => $subclass_id,
                'division_id' => $division_id,
            ];

            $students = Student::find()->select(['id', 'grno'])->where(['class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all();

            if ($postdata = Yii::$app->request->post()) {

                for ($i = 0; $i < count($students); $i++) {
                    $attendance = new Attendance();
                    $attendance->t_year = $postdata['t_year'];
                    $attendance->t_month = $postdata['t_month'];
                    $attendance->day = $postdata['day'];
                    $attendance->class_id = $postdata['class_id'];
                    $attendance->subclass_id = $postdata['subclass_id'];
                    $attendance->division_id = $postdata['division_id'];
                    $attendance->student_id = $postdata['student_id'][$i];
                    $attendance->grno = $postdata['student_grno'][$i];
                    if (isset($postdata['class'][$i]) && $postdata['class'][$i] != '') {
                        $attendance->class = 'A';
                    } else {
                        $attendance->class = 'P';
                    }
                    if (isset($postdata['hostel'][$i]) && $postdata['hostel'][$i] != '') {
                        $attendance->hostel = 'A';
                    } else {
                        $attendance->hostel = 'P';
                    }

                    $attendance->is_deleted = 'N';
                    $attendance->i_by = Yii::$app->user->identity->id;
                    $attendance->i_date = time();
                    $attendance->u_by = Yii::$app->user->identity->id;
                    $attendance->u_date = time();
                    $attendance->save();
                }
                return $this->redirect(['index']);
            }

            return $this->render('enter-attendance', [
                        'requestData' => $requestData,
                        'students' => $students,
            ]);
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Updates an existing Attendance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if(Yii::$app->user->can('attendance')) {
            
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                #print_r($params);
                if ($model->validate()) {
                    #print_r($params);exit;
                    $model->grno = Student::find()->where(['id' => $params['Attendance']['student_id']])->one()->grno;
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
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Deletes an existing Attendance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if(Yii::$app->user->can('attendance')) {
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
    }

    public function actionChange() {
        if(Yii::$app->user->can('attendance')) {
            
            $str = $_REQUEST['str'];
            $field = $_REQUEST['field'];
            $val = $_REQUEST['val'];
            if ($str != null) {
                $cond = [$field => $val];

                if (Attendance::updateAll($cond, 'id IN(' . $str . ')')) {
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

    public function actionPage() {
        if(Yii::$app->user->can('attendance')) {
            if (isset($_REQUEST['size']) && $_REQUEST['size'] != null) {
                \Yii::$app->session->set('user.size', $_REQUEST['size']);
            }
        } else {
            throw new \yii\web\ForbiddenHttpException;
            //return $this->render('@app/modules/admin/default/forbidden');
        }
    }

    /**
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}