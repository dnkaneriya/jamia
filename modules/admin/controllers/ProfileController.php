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

/**
 * Controller to display all reports
 */
Class ProfileController extends Controller {

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
    
    public function actionUserProfile() {
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

                $student = Student::findOne(['id' => $student_id]);
                $class = Classes::findOne(['id' => $student->class_id]);
                $class_name = '';
                if(!empty($class) && count($class) > 0) {
                    $class_name = $class->name;
                }
                $HostelObj = Hostel::findOne(['is_deleted' => 'N', 'is_active' => 'Y', 'grno' => $student->grno,'student_id'=>$student->id]);
                $roomObj = Room::findOne(['is_deleted' => 'N', 'is_active' => 'Y', 'id' => $HostelObj->room_id]);
                $room_no = $roomObj->room_no;
                $subclass = Subclass::findOne(['id' => $student->sub_class_id]);
                $subclass_name = '';
                if(!empty($subclass) && count($subclass) > 0) {
                    $subclass_name = $subclass->sub_class;
                }

                $division = Division::findOne(['id' => $student->divison_id]);
                $division_name = '';
                if(!empty($division) && count($division) > 0) {
                    $division_name = $division->division;
                }

                $dob = date("d/m/Y", $student->dob);
                
                return $this->render('profile', [
                        'student' => $student,
                        'class_name' => $class_name,
                        'subclass_name' => $subclass_name,
                        'division_name' => $division_name,
                        'dob' => $dob,
                        'room_no'=>$room_no,
                ]);
                
            }
            
            return $this->render('student-icard', [
                        'model' => $model,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'divisionList' => $divisionList,
                        'studentList' => $studentList,
                        'profileImage'=>$profileImage,
            ]);
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

   
}
