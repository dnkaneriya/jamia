<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Weightheight;
use app\models\WeightheightSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Student;
//Added By Sandeep Thakkar
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use yii\helpers\ArrayHelper;

//End

/**
 * WeightheightController implements the CRUD actions for Weightheight model.
 */
class WeightheightController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'dashboardgraph'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'change'],
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
     * Lists all Weightheight models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WeightheightSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Weightheight model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Weightheight model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Weightheight();
        $model->scenario = 'wh_options';
        //Added By Sandeep Thakkar
        $yearList = [];
        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $monthList = Yii::$app->params['islamic_month_en'];

        //echo '<pre>';
        //print_r($subclassList);die;
        //End
        
        if ($postdata = Yii::$app->request->post()) {
            
            return $this->redirect(['enter-weightheight', 't_year' => $postdata['Weightheight']['t_year'], 't_month' => $postdata['Weightheight']['t_month'], 'class_id' => $postdata['Weightheight']['class_id'], 'subclass_id' => $postdata['Weightheight']['subclass_id'], 'division_id' => $postdata['Weightheight']['division_id'], 'category' => $postdata['Weightheight']['category']]);
        } else {
            //print_r($model->getErrors());exit;
            return $this->render('create', [
                        'model' => $model,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'divisionList' => $divisionList,
                        'yearList' => $yearList,
                        'monthList' => $monthList
            ]);
        }
    }
    
    public function actionEnterWeightheight()
    {
        $t_year = Yii::$app->getRequest()->getQueryParam('t_year');
        $t_month = Yii::$app->getRequest()->getQueryParam('t_month');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
        $category = Yii::$app->getRequest()->getQueryParam('category');
        
        $requestData = [
            't_year' => $t_year,
            't_month' => $t_month,
            'class_id' => $class_id,
            'subclass_id' => $subclass_id,
            'division_id' => $division_id,
            'category' => $category,
        ];

        $students = Student::find()->select(['id', 'grno'])->where(['class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->orderBy('grno ASC')->all();
        $stuData = [];
        $i = 0;
        
        foreach($students as $stu) {
            $obj = Weightheight::findOne(['student_id' => $stu['id'], 't_year' => $t_year, 't_month' => $t_month]);
            
            if(!empty($obj) && count($obj) > 0) {
                $stuData[$i]['weight'] = $obj->weight;
                $stuData[$i]['height'] = $obj->height;
            }
            $i++;
        }
        
        if($postdata = Yii::$app->request->post()) {
            //print_r($postdata);exit;
            for ($i = 0; $i < count($students); $i++) {                
                //$grno = Student::findOne(['id' => $postdata['student'][$i]])->grno;
                $whmodel = Weightheight::findOne(['t_year' => $postdata['t_year'], 't_month' => $postdata['t_month'], 'student_id' => $postdata['student_id'][$i]]);
                if(empty($whmodel) || count($whmodel) == 0) {
                    $whmodel = new Weightheight();
                }
                
                $whmodel->t_year = $postdata['t_year'];
                $whmodel->t_month = $postdata['t_month'];
                $whmodel->student_id = $postdata['student_id'][$i];
                $whmodel->grno = $postdata['grno'][$i];
                if(isset($postdata['weight'][$i]) && $postdata['weight'][$i] != '') {
                    $whmodel->weight = $postdata['weight'][$i];
                }
                if(isset($postdata['height'][$i]) && $postdata['height'][$i] != '') {
                    $whmodel->height = $postdata['height'][$i];
                }
                $whmodel->is_active = 'Y';
                $whmodel->is_deleted = 'N';
                $whmodel->i_by = Yii::$app->user->identity->id;
                $whmodel->i_date = time();
                $whmodel->u_by = Yii::$app->user->identity->id;
                $whmodel->u_date = time();
                
                if(!$whmodel->save()) {
                    print_r($whmodel->getErrors());exit;
                }
            }    
            return $this->redirect(['index']);
        }
        
        return $this->render('enter-weightheight', [
                    'students' => $students,
                    'requestData' => $requestData,
                    'stuData' => $stuData,
                ]);
    }
    
    /**
     * Updates an existing Weightheight model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->request->post();
            if ($model->validate()) {
                //$model->date = strtotime($params['Weightheight']['date']);
                $model->student_id = $params['Weightheight']['student_id'];
                $model->grno = Student::find()->where(['id' => $params['Weightheight']['student_id']])->one()->grno;
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
    }

    /**
     * Deletes an existing Weightheight model.
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
            $model->save(false);
        }
    }

    public function actionChange() {
        $str = $_REQUEST['str'];
        $field = $_REQUEST['field'];
        $val = $_REQUEST['val'];
        if ($str != null) {
            $cond = [$field => $val];

            if (Weightheight::updateAll($cond, 'id IN(' . $str . ')')) {
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
    }

    /*
     *  Set Page Number for paggination
     */

    public function actionPage() {
        if (isset($_REQUEST['size']) && $_REQUEST['size'] != null) {
            \Yii::$app->session->set('user.size', $_REQUEST['size']);
        }
    }

    /**
     * Finds the Weightheight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Weightheight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Weightheight::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Added by Sandeep Thakkar

    /**

     * Get Subclass List

     */
    public function actionGetSubclassList($id) {

        $model = Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $id]);



        echo "<option value=''>Select Subclass</option>";



        foreach ($model as $obj) {

            echo "<option value='" . $obj['id'] . "'>" . $obj['sub_class'] . "</options>";
        }
    }

    /**

     * Get Subclass List

     */
    public function actionGetDivisionList($class_id, $subclass_id) {

        $model = Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id]);



        echo "<option value=''>Select Division</option>";



        foreach ($model as $obj) {

            echo "<option value='" . $obj['id'] . "'>" . $obj['division'] . "</options>";
        }
    }

    /**

     * Get Subclass List

     */
    //End
}
