<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SchoolExam;
use app\models\SchoolExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use app\models\SchoolExamSemester;
use yii\web\ForbiddenHttpException;

/**
 * SchoolExamController implements the CRUD actions for SchoolExam model.
 */
class SchoolExamController extends Controller
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
     * Lists all SchoolExam models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('school_exam')) {
            $searchModel = new SchoolExamSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single SchoolExam model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('school_exam')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new SchoolExam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('school_exam')) {
            $model = new SchoolExam();

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                
                $postdata = Yii::$app->request->post();
                $model->i_by = Yii::$app->user->identity->id;
                $model->i_at = time();
                $model->u_by = Yii::$app->user->identity->id;
                $model->u_at = time();
//                echo "<pre>";
//                print_r($postdata);exit;
                if ($model->save()) {
                    $i = 1;
                    foreach ($postdata['schoolexam']['semester_mark'] as $sem) {
                        $semesterObj = new SchoolExamSemester();
                        $semesterObj['class_id'] = $model->class_id;
                        $semesterObj['subclass_id'] = $model->subclass_id;
                        $semesterObj['standard_id'] = $model->id;
                        $semesterObj['semester'] = 'Semester' . $i;
                        $semesterObj['semester_marks'] = $sem;
                        $semesterObj['i_by'] = Yii::$app->user->identity->id;
                        $semesterObj['i_date'] = time();
                        $semesterObj['u_by'] = Yii::$app->user->identity->id;
                        $semesterObj['u_date'] = time();
                        $semesterObj->save();
                        $i++;
                    }
                }
                return $this->redirect(['index']);
            } else {
//                print_r($model->getErrors());exit;
                return $this->render('create', [
                            'model' => $model,
                            'classList' => $classList,
                            'subclassList' => $subclassList,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing SchoolExam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('school_exam')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing SchoolExam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('school_exam')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    /**
     * Set Semester input box for standard
     */
    public function actionGetSemesters($number)
    {
        return $this->renderPartial('get-semesters', ['number' => $number]);
//        for($i=0; $i<$number; $i++) {
//            echo '<div class="form-group row">';
//            echo "<label class='control-label col-sm-3'>Semester ". $i + 1 ."</label>";
//            echo '<div class="col-sm-5 field-schoolexam-semester">';
//            echo '<input type="text" name="schoolexam[semester][]" id="schoolexam-semester" class="form-control">';
//            echo '</div>';
//            echo '</div>';
//            
//            echo '<div class="form-group row">';
//            echo "<label class='control-label col-sm-3'>Semester ". $i + 1 ." Marks</label>";
//            echo '<div class="col-sm-5 field-schoolexam-semester_mark">';
//            echo '<input type="text" name="schoolexam[semester_mark][]" id="schoolexam-semester_mark" class="form-control">';
//            echo '</div>';
//            echo '</div>';
//        }
    }
    
    /**
     * Finds the SchoolExam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolExam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolExam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
