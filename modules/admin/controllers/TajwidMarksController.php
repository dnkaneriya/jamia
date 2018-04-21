<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TajwidMarks;
use app\models\TajwidMarksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TajwidClass;
use app\models\TajwidSubject;
use yii\helpers\ArrayHelper;
use app\models\Student;
use app\models\TajwidExam;
use app\models\TajwidResult;

/**
 * TajwidMarksController implements the CRUD actions for TajwidMarks model.
 */
class TajwidMarksController extends Controller
{
    public $layout = "//listing";
    public function behaviors()
    {
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
     * Lists all TajwidMarks models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new TajwidMarksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'class_name');
        $tajwidSubjectList = ArrayHelper::map(TajwidSubject::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'subject_name');
//        $studentList = ArrayHelper::map(Student::find()->where(['is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'fullname');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tajwidClassList' => $tajwidClassList,
            'tajwidSubjectList' => $tajwidSubjectList,
//            'studentList' => $studentList,
        ]);
    }

    /**
     * Displays a single TajwidMarks model.
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
     * Creates a new TajwidMarks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TajwidMarks();

        $yearList = [];

        for ($i = 1430; $i <= 1600; $i++) {

            $yearList[$i] = $i;
        }
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_deleted' => 'N']), 'id', 'class_name');
        $tajwidSubjectList = ArrayHelper::map(TajwidSubject::findAll(['is_deleted' => 'N']), 'id', 'subject_name');          
        
        if ($model->load(Yii::$app->request->post())) {
            //&& $model->save()                        
            return $this->redirect(['enter-marks', 'year' => $model->year, 'class_id' => $model->class_id, 'subject_id' => $model->subject_id]);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'studentList' => $studentList,
                'yearList' => $yearList,                 
                'tajwidClassList' => $tajwidClassList,
                'tajwidSubjectList' => $tajwidSubjectList
            ]);
        }
    }
    
       public function actionEnterMarks() {

        $modelMark = new TajwidMarks();

        $year = Yii::$app->getRequest()->getQueryParam('year');        
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');        
        $subject_id = Yii::$app->getRequest()->getQueryParam('subject_id');
        
        $tajwidExamList = TajwidExam::findOne(['is_deleted' => 'N']);
        $exam_id = $tajwidExamList->id;
        
        $requestData = [
            'year' => $year,            
            'class_id' => $class_id,
            'subject_id' => $subject_id,
            'exam_id' => $exam_id,
        ];
        $students = Student::find()->select(['id', 'grno'])->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0,'tajwid_class' => $class_id])->andWhere(['<>', 'grno', ''])->all();        
        $studentArray = [];
        foreach($students as $stu) {
            $studentArray[$stu['id']] = $stu['grno'];
        }
        
        $markArr = [];

        $i = 0;
        foreach ($students as $obj) {
            $studentmark = TajwidMarks::findOne(['student_id' => $obj['id'], 'class_id' => $class_id, 'subject_id' => $subject_id, 'year' => $year]);
            if (!empty($studentmark) && count($studentmark) > 0) {
                $markArr['student'][$i] = $obj['id'];
                $markArr['mark'][$i] = $studentmark->marks;
            }
            $i++;
        }
        $subjects = TajwidSubject::findOne(['id' => $subject_id]);
        
        if ($postdata = Yii::$app->request->post()) {
           // print_r(Yii::$app->request->post());die;
             
            $student = $postdata['student'];            
            $subject = $postdata['subject'];            
            $passing_mark = TajwidExam::findOne(['id' => $postdata['exam_id']])->passing_marks;            
            
            $count = count($student);
            
            for($i = 0;$i<$count;$i++){   
                if($passing_mark > $subject[$i])
                    $res = 'F';
                else
                    $res = 'P';
                
                
                $modelMarkRes = TajwidMarks::findOne(['year' => $postdata['year'], 'class_id' => $postdata['class_id'], 'student_id' => $student[$i],'subject_id' => $postdata['subject_id']]);
                if (empty($modelMarkRes) || count($modelMarkRes) == 0) {
                    $modelMarkRes = new TajwidMarks();
                }
                $modelMarkRes->grno = Student::findOne(['id' => $student[$i]])->grno;
                $modelMarkRes->student_id = $student[$i];
                $modelMarkRes->class_id = $postdata['class_id']; 
                $modelMarkRes->subject_id = $postdata['subject_id'];
                $modelMarkRes->marks = $subject[$i];
                $modelMarkRes->markdate = time();
                $modelMarkRes->year = $postdata['year'];     
                $modelMarkRes->is_active = 'Y';
                $modelMarkRes->is_deleted = 'N';
                $modelMarkRes->i_by = Yii::$app->user->identity->id;
                $modelMarkRes->i_date = time();
                $modelMarkRes->u_by = Yii::$app->user->identity->id;
                $modelMarkRes->u_date = time(); 
                 if (!$modelMarkRes->save()) {
                    print_r($modelMarkRes->getErrors);
                    exit;
                }  
                $result = TajwidResult::findOne(['class_id' => $postdata['class_id'], 'student_id' => $student[$i], 'year' => $year]);                
                if(isset($result->result) && $result->result == 'F') {
                    $res = 'F';
                }
                if (empty($result) || count($result) == 0) {
                    $result = new TajwidResult();                    
                    
                }
                    $result->class_id = $postdata['class_id'];
                    $result->student_id = $student[$i];
                    $result->year = $year;
                    $result->result = $res;
                    $result->is_active = 'Y';
                    $result->is_deleted = 'N';
                    $result->i_by = Yii::$app->user->identity->id;
                    $result->i_date = time();
                    $result->u_by = Yii::$app->user->identity->id;
                    $result->u_date = time();
                    if ($result->save()) {
//                        if($res == 'P') {
//                            $studentObj = Student::findOne(['id' => $result->student_id]);
//                            if(!empty($studentObj) && count($studentObj) > 0) {
//                                $tajwidupgradeObj = \app\models\TajwidClassUpgrade::findOne(['$studentObj' => $result->tajwid_class]);
//                                if(!empty($tajwidupgradeObj) && count($tajwidupgradeObj) > 0) {
//                                    $studentObj->tajwid_class = $tajwidupgradeObj->upgrade_class_id;
//                                    $studentObj->save();
//                                }
//                            }
//                        }
                    }
            }            
           
            return $this->redirect(['index']);
            /*
            $flag = true;
            if ($valid) {                
                try {
                    
                    foreach ($modelMark as $modelMark) {
                        //$modelMark->customer_id = $modelMark->id;
                        $passFlag = true;
                        $res = 'P';
                        $modelMark->is_active = 'Y';
                        $modelMark->is_deleted = 'N';
                        $modelMark->i_by = Yii::$app->user->identity->id;
                        $modelMark->i_date = time();
                        $modelMark->u_by = Yii::$app->user->identity->id;
                        $modelMark->u_date = time();

                        if (!($flag = $modelMark->save(false))) {

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



                            $transaction->rollBack();
                            break;
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }*/
        }

        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y', 'closed_student' => 0, 'class_id' => $class_id])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');
        return $this->render('enter-marks', [
                    'modelMark' => (empty($modelMark)) ? [new TajwidMarks] : $modelMark,
                    'students' => $students,
                    'studentArray' => $studentArray,
                    'studentList' => $studentList,
                    'subjects' => $subjects,
                    'requestData' => $requestData,
                    'markArr' => $markArr,
        ]);
    }


    /**
     * Updates an existing TajwidMarks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TajwidMarks model.
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
     * Finds the TajwidMarks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TajwidMarks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TajwidMarks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     /**

     * Get Subclass List

     */
    public function actionGetSubjectList($id) {

        $model = TajwidSubject::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'tajwid_class_id' => $id]);
        $select = "<option value=''>Select Subject</option>";
        foreach ($model as $obj) {            
            $select .= "<option value='" . $obj['id'] . "'>" . $obj['subject_name'] . "</option>";
        }    
        echo $select;
        exit;
    }
    
}
