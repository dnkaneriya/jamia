<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Mark;
use app\models\Marksearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Classes;
use app\models\Subclass;
use yii\helpers\ArrayHelper;
use app\models\Student;
use app\models\Subject;
use app\models\Division;
use app\models\ExamMaster;
use app\models\ResultMaster;
use app\models\ClassUpgradeMaster;
/**
 * MarkController implements the CRUD actions for Mark model.
 */
class MarkController extends Controller
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
     * Lists all Mark models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Marksearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		 $dataProvider = $searchModel->groupsearch(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mark model.
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
     * Creates a new Mark model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mark();

        $yearList = [];
        for($i=1430; $i<=1600; $i++) {
            $yearList[$i] = $i;
        }

        $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');

        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
        	$flag = true;
            $saveFlag = false;
            $res = 'P';
            $passing_mark = ExamMaster::findOne(['id' => $params['Mark']['exam_id']])->passing_marks;
            //echo $passing_mark;exit;
				 for($i=0;$i<count($_POST['Mark']['id']);$i++){
					if(isset($_POST['Mark']['marks'][$i])&& $_POST['Mark']['marks'][$i] != ''){
						$newmodel=new Mark();
						$newmodel->grno=$_POST['Mark']['grno'];
						$newmodel->student_id=$_POST['Mark']['student_id'];
						
                        $student = Student::findOne(['id' => $_POST['Mark']['student_id']]);
                        $newmodel->class_id = $student->class_id;
                        $newmodel->subclass_id = $student->sub_class_id;
                        $newmodel->division_id = $student->divison_id;
                        $newmodel->grno = $student->grno;
                        //$newmodel->class_id=$_POST['Mark']['class_id'];
						//$newmodel->subclass_id=$_POST['Mark']['subclass_id'];
						//$newmodel->division_id	=$_POST['Mark']['division_id'];
						$newmodel->subject_id	=$_POST['Mark']['subject'][$i];
						$newmodel->year = $_POST['Mark']['year'];
                        $newmodel->marks	=$_POST['Mark']['marks'][$i];
						if($flag == true && $_POST['Mark']['marks'][$i] < $passing_mark) {
							$flag = false;
						}
						$newmodel->exam_id=$_POST['Mark']['exam_id'];
						$newmodel->markdate = time();
						$newmodel->i_by = Yii::$app->user->identity->id;
						$newmodel->i_date = time();
						$newmodel->u_by = Yii::$app->user->identity->id;
						$newmodel->u_date = time();
						$newmodel->save(false);
					}	 
				}

				if($flag == false) {
					$res = 'F';
				}

				$result = new ResultMaster();
				$result->class_id = $newmodel->class_id;
                $result->subclass_id = $newmodel->subclass_id;
				$result->division_id = $newmodel->division_id;
				$result->student_id = $params['Mark']['student_id'];
				$result->result = $res;
				$result->is_active = 'Y';
				$result->is_deleted = 'N';
				$result->i_by = Yii::$app->user->identity->id;
				$result->i_date = time();
				$result->u_by = Yii::$app->user->identity->id;
				$result->u_date = time();
				if(!$result->save()) {
					print_r($result->getErrors());exit;
				}

                if($res == 'P') {
                    $student = Student::findOne(['id' => $result->student_id]);

                    $class_upgrade = ClassUpgradeMaster::findOne(['class_id' => $student->class_id, 'subclass_id' => $student->sub_class_id, 'is_deleted' => 0]);
                    if(!empty($class_upgrade) && count($class_upgrade) > 0) {
                        $student->class_id = $class_upgrade->upgrade_id;
                        $student->sub_class_id = $class_upgrade->upgrade_subclass_id;
                        $student->save();
                    }
                }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'yearList' => $yearList,
                'classList' => $classList,
                'subclassList' => $subclassList,
                'examList' => $examList,
                'divisionList' => $divisionList,
                'studentList' => $studentList,
            ]);
        }
    }

    /**
     * Updates an existing Mark model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $yearList = [];
        for($i=1430; $i<=1600; $i++) {
            $yearList[$i] = $i;
        }

        $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');

        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            $flag = true;
            $saveFlag = false;
            $res = 'P';
            $passing_mark = ExamMaster::findOne(['id' => $params['Mark']['exam_id']])->passing_marks;
				 for($i=0;$i<count($_POST['Mark']['id']);$i++){
					if(isset($_POST['Mark']['marks'][$i])&& $_POST['Mark']['marks'][$i] != ''){

						$newmodel=Mark::find()->where(['id'=>$_POST['Mark']['id'][$i]])->one();
						$newmodel->marks	=$_POST['Mark']['marks'][$i];
                        $student = Student::findAll(['id' => $_POST['Mark']['student_id']]);
                        $newmodel->class_id = $student->class_id;
                        $newmodel->subclass_id = $student->sub_class_id;
                        $newmodel->division_id = $student->divison_id;
                        $newmodel->year = $_POST['Mark']['year'];
						//$newmodel->exam_id=1;
						if($flag == true && $_POST['Mark']['marks'][$i] < $passing_mark) {
							$flag = false;
						}
						$newmodel->u_by = Yii::$app->user->id;
						$newmodel->u_date = time();
						if($newmodel->save()) {
							$saveFlag == true;
						}
					}	 
				}
				if($flag == flase) {
					$res = 'F';
				}
				//if($saveFlag == true) {
					$result = new ResultMaster();
					$result->class_id = $params['Mark']['class_id'];
					$result->division_id = $params['Mark']['division_id'];
					$result->student_id = $params['Mark']['student_id'];
					$result->result = $res;
					$result->is_active = 'Y';
					$result->is_deleted = 'N';
					$result->i_by = Yii::$app->user->identity->id;
					$result->i_date = time();
					$result->u_by = Yii::$app->user->identity->id;
					$result->u_date = time();
					if(!$result->save()) {
						print_r($result->getErrors());exit;
					}
				//}
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'yearList' => $yearList,
                'classList' => $classList,
                'subclassList' => $subclassList,
                'examList' => $examList,
                'divisionList' => $divisionList,
                'studentList' => $studentList,
            ]);
        }
    }

    public function actionEnterMarks()
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $exam_id = Yii::$app->getRequest()->getQueryParam('exam_id');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $divison_id = Yii::$app->getRequest()->getQueryParam('divison_id');

        $students = Student::find()->where(['class_id' => $class_id, 'subclass_id' => $subclass_id, 'divison_id' => $divison_id])->andWhere(['<>', 'grno', ''])->all();
    }

    /**
     * Get Subclass List
     */
    public function actionGetSubclassList($id)
    {
        $model = Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $id]);
        
        echo "<option value=''>Select Subclass</option>";

        foreach($model as $obj) {
            echo "<option value='".$obj['id']."'>". $obj['sub_class'] ."</options>";
        }
    }

    /**
     * Get Subclass List
     */
    public function actionGetDivisionList($class_id, $subclass_id)
    {
        $model = Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id]);
        
        echo "<option value=''>Select Division</option>";

        foreach($model as $obj) {
            echo "<option value='".$obj['id']."'>". $obj['division'] ."</options>";
        }
    }

    /**
     * Get Subclass List
     */
    public function actionGetStudentList($class_id, $subclass_id, $divison_id)
    {
        $model = Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id]);
        
        echo "<option value=''>Select Division</option>";

        foreach($model as $obj) {
            echo "<option value='".$obj['id']."'>". $obj['division'] ."</options>";
        }
    }

    /**
     * Deletes an existing Mark model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mark model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mark the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mark::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	public function actionGetsubdata()
    {
        if(isset($_REQUEST['id']) && $_REQUEST['id']!=null)
        {
			
			$student = Student::find()->where(['id'=>$_REQUEST['id']])->one();
            if($student != array()){
                $result = Mark::findOne(['student_id' => $_REQUEST['id'], 'year' => $_REQUEST['year'], 'exam_id' => $_REQUEST['exam_id']]);
                if(empty($result) || count($result)==0) {
                    $subject=Subject::find()->where(['subclass_id'=>$student->sub_class_id])->all();
                    if($subject != array()){
                        $str = $this->renderPartial('_getdata', ['model'=>$subject,'student'=>$student]);
                        echo $str;
                        die;
                    }else echo "<div class='alert alert-warning'>Subjects not Avalilable for this Student</div>";die;
                } else {
                    echo "<div class='alert alert-warning'>Marks Already added for this student</div>";die;
                }
            }else
			echo '';die;
           
        }else{
			echo '';die;
		}
    }

}
