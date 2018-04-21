<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use yii\db\Query;
use app\models\Mark;
use app\models\Room;
use app\models\Attendance;
use app\models\Hostel;
use app\models\Student;
use app\models\StudentProgress;
use app\models\Subject;
use app\models\SchoolSubject;
use yii\base\DynamicModel;
use app\models\ExamMaster;
use app\models\Weightheight;
use app\models\TajwidClass;
use app\models\SchoolExam;
use yii\web\ForbiddenHttpException;
use kartik\mpdf\Pdf;
use app\models\SchoolExamSemester;
/**
 * Controller to display all reports
 */
Class ReportController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                        [
                        'actions' => ['index'],
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

    public function actionClassResult() {
        if (Yii::$app->user->can('islamic_exam')) {
            $model = new \yii\base\DynamicModel([
                'year', 'class', 'subclass', 'division', 'exam'
            ]);
            $model->addRule(['year', 'class', 'subclass', 'exam'], 'required');

            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }
            $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
            $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
            $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');


            return $this->render('class-result', [
                        'model' => $model,
                        'yearList' => $yearList,
                        'classList' => $classList,
                        'examList' => $examList,
                        'subclassList' => $subclassList,
                        'divisionList' => $divisionList,
            ]);
       } else {
            throw new ForbiddenHttpException;
        }
    }

    public function actionClassResultReport() {
        $postdata = Yii::$app->request->post();
        $year = $postdata['year'];
        $exam = $postdata['exam'];
        $class = $postdata['class'];
        $subclass = $postdata['subclass'];
        $division = $postdata['division'];

        $subClassdata = Subclass::findOne(['id' => $subclass]);
        $divisondata = Division::findOne(['id' => $division]);
        $examdatadata = ExamMaster::findOne(['id' => $exam]);
        $query = new Query();
        $query->select(['sm.id', "CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname", 'grno'])
                ->from('student_master sm')
                ->where(['class_id' => $class, 'sub_class_id' => $subclass]);
        if (isset($division) && $division != '') {
            $query->andWhere(['divison_id' => $division]);
        }
        $det = $query->createCommand()->queryAll();

        $query2 = new Query();
        $query2->select(['id', 'name_en'])
                ->from('subject_master')
                ->where(['class_id' => $class, 'subclass_id' => $subclass]);
        $det2 = $query2->createCommand()->queryAll();
        $i = 0;
        foreach ($det as $student) {
            $j = 0;
            $total = 0;
            foreach ($det2 as $subject) {
                $mark = Mark::findOne(['class_id' => $class, 'subclass_id' => $subclass, 'year' => $year, 'exam_id' => $exam, 'subject_id' => $subject['id'], 'student_id' => $student['id']]);
                $det[$i]['subject'][$subject['id']] = (isset($mark->marks) && $mark->marks != '') ? $mark->marks : '';
                $total += (isset($mark->marks) && $mark->marks != '') ? $mark->marks : 0;
                $j++;
            }
            $per = ($total / count($det2));
            $det[$i]['total'] = $total;
            $det[$i]['per'] = $per;
            $i++;
        }
//        echo "<pre>";
//        print_r($det);exit;
        return $this->renderPartial('class-result-report', [
                    'data' => $det,
                    'subjects' => $det2,
                    'subClassdata'=>$subClassdata,
                    'divisondata'=>$divisondata,
                    'examdatadata'=>$examdatadata,
                    'year'=>$year,
        ]);
    }
    
    public function actionPrintClassResultReport() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $exam = Yii::$app->getRequest()->getQueryParam('exam');
        $class = Yii::$app->getRequest()->getQueryParam('class');
        $subclass = Yii::$app->getRequest()->getQueryParam('subclass');
        $division = Yii::$app->getRequest()->getQueryParam('division');
        
        
        $subClassdata = Subclass::findOne(['id' => $subclass]);
        $divisondata = Division::findOne(['id' => $division]);
        $examdatadata = ExamMaster::findOne(['id' => $exam]);
        $query = new Query();
        $query->select(['sm.id', "CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname", 'grno'])
                ->from('student_master sm')
                ->where(['class_id' => $class, 'sub_class_id' => $subclass]);
        if (isset($division) && $division != '') {
            $query->andWhere(['divison_id' => $division]);
        }
        $det = $query->createCommand()->queryAll();

        $query2 = new Query();
        $query2->select(['id', 'name_en'])
                ->from('subject_master')
                ->where(['class_id' => $class, 'subclass_id' => $subclass]);
        $det2 = $query2->createCommand()->queryAll();
        $i = 0;
        foreach ($det as $student) {
            $j = 0;
            $total = 0;
            foreach ($det2 as $subject) {
                $mark = Mark::findOne(['class_id' => $class, 'subclass_id' => $subclass, 'year' => $year, 'exam_id' => $exam, 'subject_id' => $subject['id'], 'student_id' => $student['id']]);
                $det[$i]['subject'][$subject['id']] = (isset($mark->marks) && $mark->marks != '') ? $mark->marks : '';
                $total += (isset($mark->marks) && $mark->marks != '') ? $mark->marks : 0;
                $j++;
            }
            $per = ($total / count($det2));
            $det[$i]['total'] = $total;
            $det[$i]['per'] = $per;
            $i++;
        }
        $content = $this->renderPartial('print-class-result-report', [
                    'data' => $det,
                    'subjects' => $det2,
                    'subClassdata'=>$subClassdata,
                    'divisondata'=>$divisondata,
                    'examdatadata'=>$examdatadata,
                    'year'=>$year,
        ]);
        $pdf = new Pdf([
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'methods' => [ 
             'SetFooter'=>['{PAGENO}'],
            ]
        ]);
      return $pdf->render(); 
    }
    public function actionSchoolExamResult() {
        if (Yii::$app->user->can('islamic_exam')) {
            $model = new \yii\base\DynamicModel([
                'year', 'class', 'subclass', 'standard', 'exam'
            ]);
            $model->addRule(['year', 'class', 'subclass', 'standard'], 'required');

            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }
            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
            $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');
            $standardList = ArrayHelper::map(SchoolExam::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'standard');
            
            return $this->render('school-exam-result', [
                'model' => $model,
                'yearList' => $yearList,
                'classList' => $classList,
                'subclassList' => $subclassList,
                'standardList' => $standardList,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    public function actionSchoolResultReport() {
        $postdata = Yii::$app->request->post();
        $year = $postdata['year'];
        $class = $postdata['class'];
        $subclass = $postdata['subclass'];
        $standard = $postdata['standard'];

        $query = new Query();
        $query->select(['sm.id', "CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname", 'grno'])
                ->from('student_master sm')
                ->where(['class_id' => $class, 'sub_class_id' => $subclass, 'school_standard' => $standard]);
        
        $det = $query->createCommand()->queryAll();
        
        $query2 = new Query();
        $query2->select(['id', 'name_en'])
                ->from('school_subject')
                ->where(['class_id' => $class, 'subclass_id' => $subclass]);
        $det2 = $query2->createCommand()->queryAll();
        $i = 0;
//        print_r($det);exit;
        foreach ($det as $student) {
            $j = 0;
            $total = 0;
            foreach ($det2 as $subject) {
                $mark = SchoolExamMarks::findOne(['class_id' => $class, 'subclass_id' => $subclass, 'year' => $year, 'subject_id' => $subject['id'], 'student_id' => $student['id']]);
                $det[$i]['subject'][$subject['id']] = (isset($mark->marks) && $mark->marks != '') ? $mark->marks : '';
                $total += (isset($mark->marks) && $mark->marks != '') ? $mark->marks : 0;
                $j++;
            }
            $per = ($total / count($det2));
            $det[$i]['total'] = $total;
            $det[$i]['per'] = $per;
            $i++;
        }
//        echo "<pre>";
//        print_r($det);exit;
        return $this->renderPartial('school-result-report', [
                    'data' => $det,
                    'subjects' => $det2,
        ]);
    }
    public function actionHostelRoom() {
//        if (Yii::$app->user->can('hostel_student')) {
            $model = new DynamicModel([
                'room'
            ]);
            $roomList = ArrayHelper::map(Room::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'room_no');
            return $this->render('hostel-room', [
                        'model' => $model,
                        'roomList' => $roomList,
            ]);
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

    public function actionHostelRoomReport() {
        $postdata = Yii::$app->request->post();
        $room_no = $postdata['room'];
        //print_r($room);die;
        $query = new Query();
        $query->select(['h.grno', "CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname", 'h.bed_id', 'h.is_monitor'])->from('hostel_master h')->innerjoin('student_master sm', 'h.student_id = sm.id')->where(['h.room_id' => $room_no]);
        $hostel_data = $query->createCommand()->queryAll();


        $query1 = new Query();
        $query1->select(["CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname","CONCAT(`sm`.`surname_ar`,' ',`sm`.`firstname_ar`,' ',`sm`.`lastname_ar`) AS fullname_ar"])->from('hostel_master h')->innerjoin('student_master sm', 'h.student_id = sm.id')->where(['h.room_id' => $room_no, 'h.is_monitor' => '1']);
        $hostel_data1 = $query1->createCommand()->queryAll();
        $monitor_en = $hostel_data1[0]['fullname'];
        $monitor_ar = $hostel_data1[0]['fullname_ar'];
        $room_no = Room::findOne(['is_deleted' => 'N', 'is_active' => 'Y', 'id' => $room_no])->room_no;
        return $this->renderPartial('hostel-room-report', [
                    'data' => $hostel_data,
                    'room_no' => $room_no,
                    'monitor_en' => $monitor_en,
                    'monitor_ar'=>$monitor_ar,
                        // 'subjects' => $det2,
        ]);
    }
    
    public function actionPrintHostelRoomReport() {
        $postdata = Yii::$app->request->get();
        $room_no = $postdata['room'];
        $query = new Query();
        $query->select(['h.grno', "CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname", 'h.bed_id', 'h.is_monitor'])->from('hostel_master h')->innerjoin('student_master sm', 'h.student_id = sm.id')->where(['h.room_id' => $room_no]);
        $hostel_data = $query->createCommand()->queryAll();


        $query1 = new Query();
        $query1->select(["CONCAT(`sm`.`surname_en`,' ',`sm`.`firstname_en`,' ',`sm`.`lastname_en`) AS fullname","CONCAT(`sm`.`surname_ar`,' ',`sm`.`firstname_ar`,' ',`sm`.`lastname_ar`) AS fullname_ar"])->from('hostel_master h')->innerjoin('student_master sm', 'h.student_id = sm.id')->where(['h.room_id' => $room_no, 'h.is_monitor' => '1']);
        $hostel_data1 = $query1->createCommand()->queryAll();
        $monitor_en = $hostel_data1[0]['fullname'];
        $monitor_ar = $hostel_data1[0]['fullname_ar'];
        $room_no = Room::findOne(['is_deleted' => 'N', 'is_active' => 'Y', 'id' => $room_no])->room_no;
        $content = $this->renderPartial('print-hostel-room-report', [
                    'data' => $hostel_data,
                    'room_no' => $room_no,
                    'monitor_en' => $monitor_en,
                    'monitor_ar'=>$monitor_ar,
                     
        ]);
        
        $pdf = new Pdf([
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'methods' => [ 
             'SetFooter'=>['{PAGENO}'],
            ]
        ]);
      return $pdf->render(); 
    }

    public function actionStudentIcard() {
//        if (Yii::$app->user->can('identity_card')) {
            $model = new DynamicModel([
                'class',
                'subclass',
                'division',
                'student_id',
            ]);

            $model->addRule(['class', 'subclass', 'division', 'student_id'], 'required');

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
            $divisionList = ArrayHelper::map(Division::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'division');
            $studentList = ArrayHelper::map(Student::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0]), 'id', 'grno');

            if ($postdata = Yii::$app->request->post()) {
                $doc = \app\models\StudentDocument::findOne(['student_id' => $postdata['DynamicModel']['student_id'], 'doc_type' => 'Profile']);
                $profileImage = isset($doc->doc_path) ? $doc->doc_path : '/img/user.png';
                $student_id = $postdata['DynamicModel']['student_id'];

                return $this->redirect(['student/student-icard', 'id' => $student_id, 'profileImage' => $profileImage]);
            }

            return $this->render('student-icard', [
                        'model' => $model,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'divisionList' => $divisionList,
                        'studentList' => $studentList,
            ]);
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

    public function actionIslamicMarksheet() {
//        if (Yii::$app->user->can('islamic_exam')) {
            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }

            $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
            $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
            $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
            $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
            $model = new DynamicModel([
                'year', 'exam_id', 'class_id', 'subclass_id', 'division_id', 'student_id'
            ]);

            $model->addRule(['year', 'exam_id', 'class_id', 'subclass_id', 'division_id', 'student_id'], 'required');

            if ($postdata = Yii::$app->request->post()) {
                return $this->redirect([
                            'show-islamic-marksheet',
                            'year' => $postdata['DynamicModel']['year'],
                            'exam_id' => $postdata['DynamicModel']['exam_id'],
                            'class_id' => $postdata['DynamicModel']['class_id'],
                            'subclass_id' => $postdata['DynamicModel']['subclass_id'],
                            'division_id' => $postdata['DynamicModel']['division_id'],
                            'student_id' => $postdata['DynamicModel']['student_id'],
                ]);
            }


            return $this->render('islamic-marksheet', [
                        'model' => $model,
                        'yearList' => $yearList,
                        'examList' => $examList,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'divisionList' => $divisionList,
                        'studentList' => $studentList,
            ]);
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

    public function actionShowIslamicMarksheet() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $exam_id = Yii::$app->getRequest()->getQueryParam('exam_id');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);
        $subClass = Subclass::findOne(['id' => $subclass_id]);
        $divison = Division::findOne(['id' => $division_id]);
        $examdata = ExamMaster::findOne(['id' => $exam_id]);
        $query = new Query();
        $query->select(['m.marks','s.name_en', 's.name_ar', 'e.total_marks'])
                ->from('marks_master m')
                ->leftJoin('subject_master s', 'm.subject_id=s.id')
                ->leftJoin('exam_master e', 'm.exam_id=e.id')
                ->where(['m.exam_id' => $exam_id, 'm.year' => $year, 'm.class_id' => $class_id, 'm.subclass_id' => $subclass_id, 'm.division_id' => $division_id, 'm.student_id' => $student_id]);
        $markdata = $query->createCommand()->queryAll();
        $totalMarks = 0;
        $obtainedMarks = 0;
        $per = 0;
        $totalSub = 0;
        foreach ($markdata as $mdata) {
            $totalMarks += $mdata['total_marks'];
            $obtainedMarks += $mdata['marks'];
            $totalSub++;
        }

        if ($totalSub > 0) {
            $per = ($obtainedMarks / $totalMarks) * 100;
        }
        
        return $this->render('show-islamic-marksheet', [
                    'year' => $year,
                    'student' => $student,
                    'examdata' => $examdata,
                    'markdata' => $markdata,
                    'obtainedMarks' => $obtainedMarks,
                    'per' => $per,
                    'subClass'=>$subClass,
                    'divison'=>$divison,
        ]);
    }
    
    public function actionPrintShowIslamicMarksheet() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $exam_id = Yii::$app->getRequest()->getQueryParam('exam_id');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);
        $subClass = Subclass::findOne(['id' => $subclass_id]);
        $divison = Division::findOne(['id' => $division_id]);
        $examdata = ExamMaster::findOne(['id' => $exam_id]);
        $query = new Query();
        $query->select(['m.marks','s.name_en', 's.name_ar', 'e.total_marks'])
                ->from('marks_master m')
                ->leftJoin('subject_master s', 'm.subject_id=s.id')
                ->leftJoin('exam_master e', 'm.exam_id=e.id')
                ->where(['m.exam_id' => $exam_id, 'm.year' => $year, 'm.class_id' => $class_id, 'm.subclass_id' => $subclass_id, 'm.division_id' => $division_id, 'm.student_id' => $student_id]);
        $markdata = $query->createCommand()->queryAll();
        $totalMarks = 0;
        $obtainedMarks = 0;
        $per = 0;
        $totalSub = 0;
        foreach ($markdata as $mdata) {
            $totalMarks += $mdata['total_marks'];
            $obtainedMarks += $mdata['marks'];
            $totalSub++;
        }

        if ($totalSub > 0) {
            $per = ($obtainedMarks / $totalMarks) * 100;
        }
        
        $content = $this->renderPartial('print-show-islamic-marksheet', [
                    'year' => $year,
                    'student' => $student,
                    'examdata' => $examdata,
                    'markdata' => $markdata,
                    'obtainedMarks' => $obtainedMarks,
                    'per' => $per,
                    'subClass'=>$subClass,
                    'divison'=>$divison,
        ]);
        
        $pdf = new Pdf([
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'methods' => [ 
             'SetFooter'=>['{PAGENO}'],
            ]
        ]);
      return $pdf->render(); 
    }
    
    

    public function actionGetStudentList($division_id, $class_id, $subclass_id) {
        $students = Student::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0, 'class_id' => $class_id, 'sub_class_id' => $subclass_id, 'divison_id' => $division_id]);

        echo "<option value=''>Select Student</option>";
        foreach ($students as $student) {
            echo "<option value='" . $student['id'] . "'>" . $student['grno'] . "</option>";
        }
    }

    public function actionTajwidMarksheet() {
//        if (Yii::$app->user->can('tajwid_exam')) {
            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }
            //$divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
            //$standardList = ArrayHelper::map(SchoolExam::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'standard');
            $classList = ArrayHelper::map(TajwidClass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'class_name');
            $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
            $model = new DynamicModel([
                'year', 'class_id', 'student_id'
            ]);

            $model->addRule(['year', 'class_id', 'student_id'], 'required');

            if ($postdata = Yii::$app->request->post()) {
                return $this->redirect([
                            'show-tajwid-marksheet',
                            'year' => $postdata['DynamicModel']['year'],
                            'class_id' => $postdata['DynamicModel']['class_id'],
                            'student_id' => $postdata['DynamicModel']['student_id'],
                ]);
            }
            return $this->render('tajwid-marksheet', [
                        'model' => $model,
                        'yearList' => $yearList,
                        'classList' => $classList,
                        'studentList' => $studentList,
            ]);
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

    public function actionShowTajwidMarksheet() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);
        //$examdata = ExamMaster::findOne(['id' => $exam_id]);
        $query = new Query();
        $query->select(['m.marks', 's.subject_name'])
                ->from('tajwid_marks m')
                ->leftJoin('tajwid_subject s', 'm.subject_id=s.id')
                ->where(['m.year' => $year, 'm.student_id' => $student_id, 'm.class_id' => $class_id]);
        $markdata = $query->createCommand()->queryAll();

        $query1 = new Query();
        $query1->select(['total_marks'])->from('tajwid_exam')->limit(1);
        $total_marks = $query1->createCommand()->queryAll();
        
        $totalMarks = 0;
        $obtainedMarks = 0;
        $per = 0;
        $totalSub = 0;
        foreach ($markdata as $mdata) {
            $totalMarks += 100;
            $obtainedMarks += $mdata['marks'];
            $totalSub++;
        }

        if ($totalSub > 0) {
            $per = ($obtainedMarks / $totalMarks) * 100;
        }
        
        return $this->render('show-tajwid-marksheet', [
                    'year' => $year,
                    'total_marks' => $total_marks[0]['total_marks'],
                    'markdata' => $markdata,
            'obtainedMarks' => $obtainedMarks,
            'per' => $per,
        ]);
    }

    public function actionGetTajwidStudentList($class_id) {
        $students = Student::find()->where(['is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0, 'class_id' => $class_id])->andWhere(['<>', 'grno', ''])->all();
        echo "<option value=''>Select Student</option>";
        foreach ($students as $student) {
            echo "<option value='" . $student['id'] . "'>" . $student['grno'] . "</option>";
        }
        exit;
    }

    public function actionSchoolMarksheet() {

//      if (Yii::$app->user->can('school_exam')) {
            $yearList = [];
            for ($i = 1430; $i <= 1600; $i++) {
                $yearList[$i] = $i;
            }
            $standardList = ArrayHelper::map(SchoolExam::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'standard');
            $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
            $model = new DynamicModel([
                'year', 'standard_id', 'student_id'
            ]);

            $model->addRule(['year', 'standard_id', 'student_id'], 'required');

            if ($postdata = Yii::$app->request->post()) {
                return $this->redirect([
                            'show-school-marksheet',
                            'year' => $postdata['DynamicModel']['year'],
                            'standard_id' => $postdata['DynamicModel']['standard_id'],
                            'student_id' => $postdata['DynamicModel']['student_id'],
                            
                ]);
            }
            return $this->render('school-marksheet', [
                        'model' => $model,
                        'yearList' => $yearList,
                        'standardList' => $standardList,
                        'studentList' => $studentList,
            ]);
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

    public function actionShowSchoolMarksheet() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $standard_id = Yii::$app->getRequest()->getQueryParam('standard_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);
        //$examdata = ExamMaster::findOne(['id' => $exam_id]);
        $query = new Query();
        $query->select(['m.marks', 's.name_en', 'ss.total_mark'])
                ->from('school_exam_marks m')
                ->leftJoin('school_exam ss', 'ss.id=m.standard_id')
                ->leftJoin('school_subject s', 'm.subject_id=s.id')
                ->where(['m.year' => $year, 'm.student_id' => $student_id, 'm.standard_id' => $standard_id]);
        $markdata = $query->createCommand()->queryAll();
        $totalMarks = 0;
        $obtainedMarks = 0;
        $per = 0;
        $totalSub = 0;

        foreach ($markdata as $mdata) {
            $totalMarks += $mdata['total_mark'];
            $obtainedMarks += $mdata['marks'];
            $totalSub++;
        }
        if ($totalSub > 0) {
            $per = ($obtainedMarks / $totalSub) * 100;
        }

//        echo '<pre>';
//        print_r($markdata);die;
//        $query1 = new Query();
//        $query1->select(['total_marks'])->from('tajwid_exam')->limit(1);
//        $total_marks = $query1->createCommand()->queryAll();                        
        return $this->render('show-school-marksheet', [
                    'year' => $year,
                    'markdata' => $markdata,
                    'obtainedMarks' => $obtainedMarks,
                    'per' => $per,
                    'student'=>$student,
        ]);
    }
    
    public function actionPrintShowSchoolMarksheet() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $standard_id = Yii::$app->getRequest()->getQueryParam('standard_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);
        //$examdata = ExamMaster::findOne(['id' => $exam_id]);
        $query = new Query();
        $query->select(['m.marks', 's.name_en', 'ss.total_mark'])
                ->from('school_exam_marks m')
                ->leftJoin('school_exam ss', 'ss.id=m.standard_id')
                ->leftJoin('school_subject s', 'm.subject_id=s.id')
                ->where(['m.year' => $year, 'm.student_id' => $student_id, 'm.standard_id' => $standard_id]);
        $markdata = $query->createCommand()->queryAll();
        $totalMarks = 0;
        $obtainedMarks = 0;
        $per = 0;
        $totalSub = 0;

        foreach ($markdata as $mdata) {
            $totalMarks += $mdata['total_mark'];
            $obtainedMarks += $mdata['marks'];
            $totalSub++;
        }
        if ($totalSub > 0) {
            $per = ($obtainedMarks / $totalSub) * 100;
        }

        $content = $this->renderPartial('print-show-school-marksheet', [
                    'year' => $year,
                    'markdata' => $markdata,
                    'obtainedMarks' => $obtainedMarks,
                    'per' => $per,
                    'student'=>$student,
        ]);
        
        $pdf = new Pdf([
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'methods' => [ 
             'SetFooter'=>['{PAGENO}'],
            ]
        ]);
      return $pdf->render();
        
        
    }

    public function actionGetSchoolStudentList($standard_id) {
        $students = Student::find()->where(['is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0, 'school_standard' => $standard_id])->andWhere(['<>', 'grno', ''])->all();
        echo "<option value=''>Select Student</option>";
        foreach ($students as $student) {
            echo "<option value='" . $student['id'] . "'>" . $student['grno'] . "</option>";
        }
        exit;
    }

    public function actionQuranReport() {
        $yearList = [];
        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }
        $monthList = Yii::$app->params['islamic_month_en'];
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', '']), 'id', 'grno');

        $model = new DynamicModel([
            'year', 'month', 'class_id', 'subclass_id', 'division_id', 'student_id'
        ]);

        $model->addRule(['year', 'month', 'class_id', 'subclass_id', 'division_id', 'student_id'], 'required');

        if ($postdata = Yii::$app->request->post()) {
            return $this->redirect(['show-quran-report', 'year' => $postdata['DynamicModel']['year'], 'month' => $postdata['DynamicModel']['month'], 'class_id' => $postdata['DynamicModel']['class_id'], 'subclass_id' => $postdata['DynamicModel']['subclass_id'], 'division_id' => $postdata['DynamicModel']['division_id'], 'student_id' => $postdata['DynamicModel']['student_id']]);
        }

        return $this->render('quran-report', [
                    'model' => $model,
                    'yearList' => $yearList,
                    'monthList' => $monthList,
                    'classList' => $classList,
                    'subclassList' => $subclassList,
                    'divisionList' => $divisionList,
                    'studentList' => $studentList,
        ]);
    }

    public function actionShowQuranReport() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $month = Yii::$app->getRequest()->getQueryParam('month');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);

        $quranArr = [];
        for ($i = 1; $i <= 30; $i++) {
            $quran = \app\models\Quran::findOne(['student_id' => $student_id, 't_year' => $year, 't_month' => $month, 'day' => $i]);

            $quranArr[$i]['para_no'] = isset($quran->para_no) ? $quran->para_no : '-';
            $quranArr[$i]['line_no'] = isset($quran->line_no) ? $quran->line_no : '-';
        }
        
        $attendanceObj = Attendance::findAll(['t_year' => $year, 't_month' => $month, 'student_id' => $student_id]);
        
        $attendance = [];
        
        foreach($attendanceObj as $att) {
            $attendance[$att->day]['class'] = $att['class'];
            $attendance[$att->day]['hostel'] = $att['hostel'];
        }
        
        $weightheight = Weightheight::findOne(['t_year' => $year, 't_month' => $month, 'student_id' => $student_id]);
        
        return $this->render('show-quran-report', [
            'year' => $year,
            'month' => $month,
            'student' => $student,
            'quranArr' => $quranArr,
            'weightheight' => $weightheight,
            'attendance' => $attendance,
        ]);
    }

    public function actionTarbiyatCard() {
        $yearList = [];
        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }
        $monthList = Yii::$app->params['islamic_month_en'];
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', '']), 'id', 'grno');

        $model = new DynamicModel([
            'year', 'class_id', 'subclass_id', 'division_id', 'student_id'
        ]);

        $model->addRule(['year', 'class_id', 'subclass_id', 'division_id', 'student_id'], 'required');

        if ($postdata = Yii::$app->request->post()) {

            $tarbiyat = \app\models\Tarbiyatcard::findOne(['student_id' => $postdata['DynamicModel']['student_id'], 't_year' => $postdata['year']]);

            if (!empty($tarbiyat) && count($tarbiyat) > 0) {
                return $this->redirect(['tarbiyatcard/view', 'id' => $tarbiyat->id]);
            } else {
                return $this->render('progress-report', [
                            'model' => $model,
                            'yearList' => $yearList,
                            'classList' => $classList,
                            'subclassList' => $subclassList,
                            'divisionList' => $divisionList,
                            'studentList' => $studentList,
                ]);
            }
        }

        return $this->render('progress-report', [
                    'model' => $model,
                    'yearList' => $yearList,
                    'monthList' => $monthList,
                    'classList' => $classList,
                    'subclassList' => $subclassList,
                    'divisionList' => $divisionList,
                    'studentList' => $studentList,
        ]);
    }

    public function actionProgressReport() {
        $yearList = [];
        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }

        $monthList = Yii::$app->params['islamic_month_en'];
        $examList = ArrayHelper::map(ExamMaster::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
        
        $model = new DynamicModel([
            'year', 'month', 'class_id', 'subclass_id', 'division_id', 'student_id'
        ]);

        $model->addRule(['year', 'month', 'class_id', 'subclass_id', 'division_id', 'student_id'], 'required');

        if ($postdata = Yii::$app->request->post()) {
            return $this->redirect(['show-progress-report', 'year' => $postdata['DynamicModel']['year'], 'month' => $postdata['DynamicModel']['month'], 'class_id' => $postdata['DynamicModel']['class_id'], 'subclass_id' => $postdata['DynamicModel']['subclass_id'], 'division_id' => $postdata['DynamicModel']['division_id'], 'student_id' => $postdata['DynamicModel']['student_id']]);
        }

        return $this->render('progress-report', [
                    'model' => $model,
                    'yearList' => $yearList,
                    'monthList' => $monthList,
                    'examList' => $examList,
                    'classList' => $classList,
                    'subclassList' => $subclassList,
                    'divisionList' => $divisionList,
                    'studentList' => $studentList,
        ]);
    }

    public function actionShowProgressReport() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $month = Yii::$app->getRequest()->getQueryParam('month');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $division_id = Yii::$app->getRequest()->getQueryParam('division_id');
        $student_id = Yii::$app->getRequest()->getQueryParam('student_id');

        $student = Student::findOne(['id' => $student_id]);
        $weightheight = Weightheight::findOne(['t_year' => $year, 't_month' => $month, 'student_id' => $student_id]);

        $islamicSubjects = Subject::find()->where(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id])->asArray()->all();
        $schoolSubjects = SchoolSubject::find()->where(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id, 'subclass_id' => $subclass_id])->asArray()->all();

        $attendanceObj = Attendance::findAll(['t_year' => $year, 't_month' => $month, 'student_id' => $student_id]);
        
        $attendance = [];
        
        foreach($attendanceObj as $att) {
            $attendance[$att->day]['class'] = $att['class'];
            $attendance[$att->day]['hostel'] = $att['hostel'];
        } 
       
//        echo "<pre>";
//        print_r($attendance);exit;
//        
//        print_r($islamicSubjects);
//        echo "<br>";
//        
//        print_r($schoolSubjects);
        $i = 0;
        foreach ($islamicSubjects as $obj) {
            $rating = StudentProgress::findOne(['year' => $year, 'month' => $month, 'class_id' => $class_id, 'subclass_id' => $subclass_id, 'category' => 1, 'student_id' => $student_id, 'subject_id' => $obj['id']]);
            if (!empty($rating) && count($rating) > 0) {
                $islamicSubjects[$i]['rating'] = $rating->rating;
            }
            $i++;
        }

        $j = 0;
        foreach ($schoolSubjects as $obj1) {
            $rating = StudentProgress::findOne(['year' => $year, 'month' => $month, 'class_id' => $class_id, 'subclass_id' => $subclass_id, 'category' => 2, 'student_id' => $student_id, 'subject_id' => $obj1['id']]);
            if (!empty($rating) && count($rating) > 0) {
                $schoolSubjects[$j]['rating'] = $rating->rating;
            }
            $j++;
        }

        return $this->render('show-progress-report', [
                    'islamicSubjects' => $islamicSubjects,
                    'schoolSubjects' => $schoolSubjects,
                    'student' => $student,
                    'weightheight' => $weightheight,
                    'attendance' => $attendance,
                    'month' => $month,
        ]);
    }

}
