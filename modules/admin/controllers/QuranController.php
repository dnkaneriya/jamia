<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Quran;
use app\models\QuranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Student;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\base\DynamicModel;
/**
 * QuranController implements the CRUD actions for Quran model.
 */
class QuranController extends Controller
{
    public $layout="//listing";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' =>  ['index','create','update','delete','change'],
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
     * Lists all Quran models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('quran')) {
            $searchModel = new QuranSearch();
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
     * Displays a single Quran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('quran')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Quran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('quran')) {
            $model = new Quran();
            
            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
            $divisionList = ArrayHelper::map(Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'division');
            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }
            $monthList = Yii::$app->params['islamic_month_en'];

            $dayList = [];
            for($i=1; $i <= 30; $i++) {
                $dayList[$i] = $i;
            }
            $model->scenario = 'mainform';
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//                $params = Yii::$app->request->post();
//                if ($model->validate()) {
//                    
//                    $model->grno = Student::find()->where(['id' => $params['Quran']['student_id']])->one()->grno;
//                    $model->i_by = Yii::$app->user->id;
//                    $model->i_date = time();
//                    $model->u_by = Yii::$app->user->id;
//                    $model->u_date = time();
//                    if ($model->save(false)) {
//                        return $this->redirect(['index']);
//                    }
//                } else {
//                    return $this->render('create', [
//                                'model' => $model,
//                    ]);
//                }
                
                return $this->redirect(['enter-data', 'class_id' => $model->class_id, 'subclass_id' =>$model->subclass_id, 'division_id' => $model->division_id, 't_year' => $model->t_year, 't_month' => $model->t_month, 'day' => $model->day]);
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
            throw new ForbiddenHttpException;
        }
    }
    
    public function actionEnterData()
    {
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

            $students = Student::find()->select(['id', 'grno'])->where(['class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'grno', ''])->all();
            $model = new DynamicModel([
                'para_no', 'line_no'
            ]);
            
            $detArr = [];
            $i = 0;
            foreach ($students as $obj) {
                $studentquran = Quran::findOne(['student_id' => $obj['id'], 't_year' => $t_year, 't_month' => $t_month, 'day' => $day]);
                if (!empty($studentquran) && count($studentquran) > 0) {
                    $detArr['para_no'][$i] = $studentquran->para_no;
                    $detArr['line_no'][$i] = $studentquran->line_no;
                }
                $i++;
            }
            
            if($postdata = Yii::$app->request->post()) {
                
                $i = 0;
                foreach($postdata['student_id'] as $student) {
                    
                    $quranModel = Quran::findOne(['student_id' => $student, 't_year' => $t_year, 't_month' => $t_month, 'day' => $day]);
                    if(empty($quranModel) || count($quranModel) == 0) {
                        $quranModel = new Quran();
                    }
                    
                    $quranModel->student_id = $postdata['student_id'][$i];
                    $quranModel->grno = $postdata['student_grno'][$i];
                    $quranModel->t_year = $postdata['t_year'];
                    $quranModel->t_month = $postdata['t_month'];
                    $quranModel->day = $postdata['day'];
                    $quranModel->para_no = $postdata['DynamicModel']['para_no'][$i];
                    $quranModel->line_no = $postdata['DynamicModel']['line_no'][$i];
                    $quranModel->is_active = 'Y';
                    $quranModel->is_deleted = 'N';
                    $quranModel->i_by = Yii::$app->user->identity->id;
                    $quranModel->i_date = time();
                    $quranModel->u_by = Yii::$app->user->identity->id;
                    $quranModel->u_date = time();
                    if(!$quranModel->save()) {
                        print_r($quranModel->getErrors());exit;
                    }
                    $i++;
                }
                return $this->redirect(['index']);
            }

            $model->addRule(['para_no', 'line_no'], 'required');
        
        return $this->render('enter-data', [
                'model' => $model,
                'students' => $students,
                'requestData' => $requestData,
                'detArr' => $detArr,
            ]);
    }
    
    /**
     * Updates an existing Quran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('quran')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                #print_r($params);
                if ($model->validate()) {
                    #print_r($params);exit;
                    #$model->quran_date = strtotime($params['Quran']['quran_date']);
                    $model->grno = Student::find()->where(['id' => $params['Quran']['student_id']])->one()->grno;
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
     * Deletes an existing Quran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('quran')) {
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
        $str = $_REQUEST['str'];
        $field =$_REQUEST['field'];
        $val = $_REQUEST['val'];
        if($str!= null)
        {
            $cond = [$field => $val];
                
            if(Quran::updateAll($cond,'id IN('.$str.')'))
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
     * Finds the Quran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
