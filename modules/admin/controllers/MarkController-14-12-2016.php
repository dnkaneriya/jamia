<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Model;
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
class MarkController extends Controller {

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

     * Lists all Mark models.

     * @return mixed

     */
    public function actionIndex() {

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
    public function actionView($id) {

        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**

     * Creates a new Mark model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */
    public function actionCreate() {

        $model = new Mark();

        $model->scenario = 'marks_options';

        $yearList = [];

        for ($i = 1430; $i <= 1600; $i++) {

            $yearList[$i] = $i;
        }



        $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['enter-marks', 'year' => $model->year, 'exam_id' => $model->exam_id, 'class_id' => $model->class_id, 'subclass_id' => $model->subclass_id, 'division_id' => $model->division_id, 'subject_id' => $model->subject_id]);
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
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $yearList = [];

        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }

        $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');



        if ($postdata = Yii::$app->request->post()) {
            $params = Yii::$app->request->post();
            $flag = true;
            $saveFlag = false;
            $res = 'P';
//            print_r($model);
//            echo "<br>";
//            print_r($postdata);exit;

            $passing_mark = ExamMaster::findOne(['id' => $model->exam_id])->passing_marks;
            $i = 0;
            foreach ($postdata['Mark']['ids'] as $mark_id) {
                $markModel = Mark::findOne(['id' => $mark_id]);
                $markModel->marks = $postdata['Mark']['marks'][$i];
                if ($flag == true && $postdata['Mark']['marks'][$i] < $passing_mark) {
                    $flag = false;
                }
                $markModel->save();
                $i++;
            }



            if ($flag == false) {

                $res = 'F';
            }

            $resObject = ResultMaster::findOne(['student_id' => $postdata['student_id'], 'class_id' => $model->class_id, 'subclass_id' => $model->subclass_id, 'division_id' => $model->division_id]);

            $old_result = $resObject->result;

            if ($old_result != $res) {

                $resObject->result = $res;

                $resObject->save();



                $student = Student::findOne(['id' => $postdata['student_id']]);

                if ($res == 'F') {

                    $classUpgradeObject = ClassUpgradeMaster::findOne(['upgrade_id' => $student->class_id, 'upgrade_subclass_id' => $student->sub_class_id]);

                    if (!empty($classUpgradeObject) && count($classUpgradeObject) != '') {
                        $student->class_id = $classUpgradeObject->class_id;
                        $student->sub_class_id = $classUpgradeObject->subclass_id;
                        $student->save();
                    }
                } else if ($res == 'P') {

                    $classUpgradeObject = ClassUpgradeMaster::findOne(['class_id' => $student->class_id, 'subclass_id' => $student->sub_class_id]);

                    if (!empty($classUpgradeObject) && count($classUpgradeObject) != '') {
                        $student->class_id = $classUpgradeObject->upgrade_id;
                        $student->sub_class_id = $classUpgradeObject->upgrade_subclass_id;
                        $student->save();
                    }
                }
            }
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

    public function actionEnterMarks() {

        $modelsMark = [new Mark];

        $year = Yii::$app->getRequest()->getQueryParam('year');
        $exam_id = Yii::$app->getRequest()->getQueryParam('exam_id');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
        $subject_id = Yii::$app->getRequest()->getQueryParam('subject_id');

        $requestData = [
            'year' => $year,
            'exam_id' => $exam_id,
            'class_id' => $class_id,
            'subclass_id' => $subclass_id,
            'division_id' => $division_id,
            'subject_id' => $subject_id,
        ];

        $students = Student::find()->select(['id', 'grno'])->where(['class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'grno', ''])->all();
        
        $studentArray = [];
        foreach($students as $stu) {
            $studentArray[$stu['id']] = $stu['grno'];
        }
        
        $markArr = [];

        $i = 0;
        foreach ($students as $obj) {
            $studentmark = Mark::findOne(['student_id' => $obj['id'], 'class_id' => $class_id, 'subclass_id' => $subclass_id, 'division_id' => $division_id, 'subject_id' => $subject_id, 'year' => $year, 'exam_id' => $exam_id]);
            if (!empty($studentmark) && count($studentmark) > 0) {
                $markArr['student'][$i] = $obj['id'];
                $markArr['mark'][$i] = $studentmark->marks;
            }
            $i++;
        }

        $subjects = Subject::findOne(['id' => $subject_id]);

        if ($postdata = Yii::$app->request->post()) {
            //print_r($postdata);exit;    
            $passFlag = true;
            $res = 'P';

            $passing_mark = ExamMaster::findOne(['id' => $postdata['exam_id']])->passing_marks;

            for($i=0; $i<count($students); $i++) {
                
                $modelMark = Mark::findOne(['student_id' => $postdata['student'][$i], 'class_id' => $postdata['class_id'], 'subclass_id' => $postdata['subclass_id'], 'division_id' => $postdata['division_id'], 'subject_id' => $postdata['subject_id'], 'year' => $postdata['year'], 'exam_id' => $postdata['exam_id']]);
                if(empty($modelMark) || count($modelMark) == 0) {
                    $modelMark = new Mark();
                }

                $modelMark->year = $postdata['year'];
                $modelMark->exam_id = $postdata['exam_id'];
                $modelMark->class_id = $postdata['class_id'];
                $modelMark->subclass_id = $postdata['subclass_id'];
                $modelMark->division_id = $postdata['division_id'];
                $modelMark->subject_id = $postdata['subject_id'];
                $modelMark->student_id = $postdata['student'][$i];

                $modelMark->grno = Student::findOne(['id' => $modelMark->student_id])->grno;
                $modelMark->marks = $postdata['mark'][$i];
                $modelMark->is_active = 'Y';
                $modelMark->is_deleted = 'N';
                $modelMark->i_by = Yii::$app->user->identity->id;
                $modelMark->i_date = time();
                $modelMark->u_by = Yii::$app->user->identity->id;
                $modelMark->u_date = time();

                $modelMark->save();

                if ($passFlag == true && $modelMark->marks < $passing_mark) {
                    $passFlag = false;
                    $res = 'F';
                }
                $result = ResultMaster::findOne(['class_id' => $postdata['class_id'], 'subclass_id' => $postdata['subject_id'], 'division_id' => $postdata['division_id'], 'student_id' => $modelMark->student_id]);
                //echo '<pre>';
                //print_r($is_available);die;

                if (empty($result) || count($result) == 0) {
                    $result = new ResultMaster();
                }

                // $result = new ResultMaster();

                $result->class_id = $modelMark->class_id;
                $result->subclass_id = $modelMark->subclass_id;
                $result->division_id = $modelMark->division_id;
                $result->student_id = $modelMark->student_id;
                $result->result = $res;
                $result->is_active = 'Y';
                $result->is_deleted = 'N';
                $result->i_by = Yii::$app->user->identity->id;
                $result->i_date = time();
                $result->u_by = Yii::$app->user->identity->id;
                $result->u_date = time();
                if (!$result->save()) {
                    print_r($result->getErrors);
                    exit;
                }

            }

            return $this->redirect(['index']);
        }

        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

        return $this->render('enter-marks', [
                    'modelsMark' => (empty($modelsMark)) ? [new Mark] : $modelsMark,
                    'students' => $students,
                    'studentArray' => $studentArray,
                    'studentList' => $studentList,
                    'subjects' => $subjects,
                    'requestData' => $requestData,
                    'markArr' => $markArr,
        ]);
    }

    /**

     * Get Subclass List

     */
    public function actionGetSubclassList($id) {

        $model = Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $id]);



        echo "<option value=''>Select Subclass</option>";



        foreach ($model as $obj) {

            echo "<option value='" . $obj['id'] . "'>" . $obj['sub_class'] . "</option>";
        }
    }

    /**

     * Get Division List

     */
    public function actionGetDivisionList($class_id, $subclass_id) {

        $model = Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id]);



        echo "<option value=''>Select Division</option>";



        foreach ($model as $obj) {

            echo "<option value='" . $obj['id'] . "'>" . $obj['division'] . "</option>";
        }
    }
    
    /**
     * Get Subject List
     */
    public function actionGetSubjectList($class_id, $subclass_id) {
        $model = Subject::findAll(['class_id' => $class_id, 'subclass_id' => $subclass_id, 'is_deleted' => 'N', 'is_active' => 'Y']);
        echo "<option value=''>Select Subject</option>";
        print_r($model);
        foreach ($model as $obj) {

            echo "<option value='" . $obj['id'] . "'>" . $obj['name_en'] . "</option>";
        }
    }

    /**

     * Get Subclass List

     */
    public function actionGetStudentList($class_id, $subclass_id, $divison_id) {

        $model = Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id]);



        echo "<option value=''>Select Division</option>";



        foreach ($model as $obj) {

            echo "<option value='" . $obj['id'] . "'>" . $obj['division'] . "</options>";
        }
    }


    /**

     * Deletes an existing Mark model.

     * If deletion is successful, the browser will be redirected to the 'index' page.

     * @param integer $id

     * @return mixed

     */
    public function actionDelete($id) {

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
    protected function findModel($id) {

        if (($model = Mark::findOne($id)) !== null) {

            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetsubdata() {

        if (isset($_REQUEST['id']) && $_REQUEST['id'] != null) {



            $student = Student::find()->where(['id' => $_REQUEST['id']])->one();

            if ($student != array()) {

                $result = Mark::findOne(['student_id' => $_REQUEST['id'], 'year' => $_REQUEST['year'], 'exam_id' => $_REQUEST['exam_id']]);

                if (empty($result) || count($result) == 0) {

                    $subject = Subject::find()->where(['subclass_id' => $student->sub_class_id])->all();

                    if ($subject != array()) {

                        $str = $this->renderPartial('_getdata', ['model' => $subject, 'student' => $student]);

                        echo $str;

                        die;
                    } else
                        echo "<div class='alert alert-warning'>Subjects not Avalilable for this Student</div>";die;
                } else {

                    echo "<div class='alert alert-warning'>Marks Already added for this student</div>";

                    die;
                }
            } else
                echo '';die;
        }else {

            echo '';

            die;
        }
    }

}
