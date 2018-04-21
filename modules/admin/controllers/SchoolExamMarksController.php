<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SchoolExamMarks;
use app\models\SchoolExamMarksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use app\models\SchoolExamSemester;
use app\models\SchoolSubject;
use app\models\Student;
use app\models\SchoolExam;
use yii\web\ForbiddenHttpException;

/**
 * SchoolExamMarksController implements the CRUD actions for SchoolExamMarks model.
 */
class SchoolExamMarksController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SchoolExamMarks models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('school_exam')) {
            $searchModel = new SchoolExamMarksSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
            $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');
            $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'semesterList' => $semesterList,
                        'divisionList' => $divisionList,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single SchoolExamMarks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->user->can('school_exam')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new SchoolExamMarks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('school_exam')) {
            $model = new SchoolExamMarks();

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
            $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');
            $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
            $subjectList = ArrayHelper::map(SchoolSubject::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name_en');
            $standardList = ArrayHelper::map(SchoolExam::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'standard');

            $yearList = [];

            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }

            if ($model->load(Yii::$app->request->post())) {
                return $this->redirect(['enter-marks', 'year' => $model->year, 'class_id' => $model->class_id, 'subclass_id' => $model->subclass_id, 'division_id' => $model->division_id, 'standard_id' => $model->standard_id, 'semester_id' => $model->semester_id, 'subject_id' => $model->subject_id]);
                //return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'classList' => $classList,
                    'subclassList' => $subclassList,
                    'semesterList' => $semesterList,
                    'yearList' => $yearList,
                    'divisionList' => $divisionList,
                    'standardList' => $standardList,
                    'subjectList' => $subjectList,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing SchoolExamMarks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('school_exam')) {
            $model = $this->findModel($id);

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
            $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');
            $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');

            $yearList = [];

            for ($i = 1430; $i <= 1600; $i++) {

                $yearList[$i] = $i;
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'classList' => $classList,
                            'subclassList' => $subclassList,
                            'semesterList' => $semesterList,
                            'yearList' => $yearList,
                            'divisionList' => $divisionList,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    public function actionGetSubjectList($class_id, $subclass_id)
    {
        $subjects = SchoolSubject::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id]);
        
        echo "<option value=''>Select Subject</options>";
        foreach($subjects as $sub) {
            echo "<option value='". $sub['id'] ."'>". $sub['name_en'] ."</option>";
        }
    }
    
    public function actionGetSemesterList($id)
    {
        $semesters = SchoolExamSemester::findAll(['standard_id' => $id, 'is_active' => 'Y', 'is_deleted' => 'N']);
        
        echo "<option value=''>Select Semester</option>";
        foreach($semesters as $semester) {
            echo "<option value='".$semester['id']."'>".$semester['semester']."</option>";
        }
    }

    public function actionEnterMarks() {
        if (Yii::$app->user->can('school_exam')) {
            $modelsMark = new SchoolExamMarks;

            $year = Yii::$app->getRequest()->getQueryParam('year');
            $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
            $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
            $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
            $standard_id = Yii::$app->getRequest()->getQueryParam('standard_id');
            $semester_id = Yii::$app->getRequest()->getQueryParam('semester_id');
            $subject_id = Yii::$app->getRequest()->getQueryParam('subject_id');

            $requestData = [
                'year' => $year,
                'class_id' => $class_id,
                'subclass_id' => $subclass_id,
                'division_id' => $division_id,
                'standard_id' => $standard_id,
                'semester_id' => $semester_id,
                'subject_id' => $subject_id,
            ];

            $students = Student::find()->select(['id', 'grno'])->where(['class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'school_standard' => $standard_id, 'is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all();

            $studentArray = [];
            foreach ($students as $stu) {
                $studentArray[$stu['id']] = $stu['grno'];
            }

            $markArr = [];

            $i = 0;
            foreach ($students as $obj) {
                $studentmark = SchoolExamMarks::findOne(['student_id' => $obj['id'], 'class_id' => $class_id, 'subclass_id' => $subclass_id, 'division_id' => $division_id, 'semester_id' => $semester_id, 'subject_id' => $subject_id, 'year' => $year]);
                if (!empty($studentmark) && count($studentmark) > 0) {
                    $markArr['student'][$i] = $obj['id'];
                    $markArr['mark'][$i] = $studentmark->marks;
                }
                $i++;
            }

            $subjects = SchoolSubject::findOne(['id' => $subject_id]);
            $res = 'P';
            if ($postdata = Yii::$app->request->post()) {
                //print_r($postdata);exit;    
                $passFlag = true;
                $res = 'P';

                //$passing_mark = ExamMaster::findOne(['id' => $postdata['exam_id']])->passing_marks;

                for ($i = 0; $i < count($students); $i++) {
                    
                    $modelMark = SchoolExamMarks::findOne(['student_id' => $postdata['student'][$i], 'class_id' => $postdata['class_id'], 'subclass_id' => $postdata['subclass_id'], 'division_id' => $postdata['division_id'], 'semester_id' => $postdata['semester_id'], 'subject_id' => $postdata['subject_id'], 'year' => $postdata['year']]);
                    if (empty($modelMark) || count($modelMark) == 0) {
                        $modelMark = new SchoolExamMarks();
                    }
                    
                    $modelMark->year = $postdata['year'];
                    $modelMark->class_id = $postdata['class_id'];
                    $modelMark->subclass_id = $postdata['subclass_id'];
                    $modelMark->standard_id = $postdata['standard_id'];
                    $modelMark->semester_id = $postdata['semester_id'];
                    $modelMark->division_id = $postdata['division_id'];
                    $modelMark->subject_id = $postdata['subject_id'];
                    $modelMark->student_id = $postdata['student'][$i];

                    $modelMark->grno = Student::findOne(['id' => $modelMark->student_id])->grno;
                    $modelMark->marks = $postdata['mark'][$i];
                    $modelMark->markdate = time();
                    $modelMark->is_active = 'Y';
                    $modelMark->is_deleted = 'N';
                    $modelMark->i_by = Yii::$app->user->identity->id;
                    $modelMark->i_date = time();
                    $modelMark->u_by = Yii::$app->user->identity->id;
                    $modelMark->u_date = time();

                    $modelMark->save();
                    
                    $standard = SchoolExam::findOne(['id' => $postdata['standard_id']]);
                    
                    $marks = SchoolExamMarks::findAll(['standard_id' => $postdata['standard_id'], 'year' => $postdata['year'], 'student_id' => $postdata['student'][$i]]);
                    
                    if(!empty($standard) && count($standard) > 0) {

                        if(count($marks) == $standard->no_of_semester) {
//                            echo $postdata['student'][$i]."<<<";
                            $query = (new \yii\db\Query())->from('school_exam_marks');
                            $query->where(['standard_id' => $postdata['standard_id'], 'year' => $postdata['year'], 'student_id' => $postdata['student'][$i], 'subject_id' => $postdata['subject_id']]);
                             $sum = $query->sum('marks');
                             
//                           
                            if($sum < $standard->passing_mark) {
                                $res = 'F';
                            } else {
                                $res = 'P';
                            }
                            
                            $result = \app\models\SchoolExamResult::findOne(['standard_id' => $postdata['standard_id'], 'year' => $postdata['year'], 'student_id' => $postdata['student'][$i]]);
                            if(empty($result) || count($result) == 0) {
                                $result = new \app\models\SchoolExamResult();
                            }
                            $result->class_id = $postdata['class_id'];
                            $result->subclass_id = $postdata['subclass_id'];
                            $result->standard_id = $postdata['standard_id'];
                            $result->student_id = $postdata['student'][$i];
                            $result->grno = Student::findOne(['id' => $modelMark->student_id])->grno;
                            $result->year = $postdata['year'];
                            $result->result = $res;
                            $result->is_active = 'Y';
                            $result->is_deleted = 'N';
                            $result->i_by = Yii::$app->user->identity->id;
                            $result->i_date = time();
                            $result->u_by = Yii::$app->user->identity->id;
                            $result->u_date = time();
                            $result->save();
                        }
                    }
                }

                return $this->redirect(['index']);
                $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0, 'class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'school_standard' => $standard_id])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

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
            
            $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0, 'class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id, 'school_standard' => $standard_id])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
            return $this->render('enter-marks', [
                        'modelsMark' => $modelsMark,
                        'students' => $students,
                        'studentArray' => $studentArray,
                        'studentList' => $studentList,
                        'subjects' => $subjects,
                        'requestData' => $requestData,
                        'markArr' => $markArr,
                ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing SchoolExamMarks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SchoolExamMarks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolExamMarks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SchoolExamMarks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
