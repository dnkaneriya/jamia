<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\StudentProgress;
use app\models\StudentProgressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Classes;
use app\models\Subclass;
use app\models\Student;
use yii\helpers\ArrayHelper;

/**
 * StudentProgressController implements the CRUD actions for StudentProgress model.
 */
class StudentProgressController extends Controller {

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
     * Lists all StudentProgress models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StudentProgressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'classList' => $classList,
                    'subclassList' => $subclassList,
        ]);
    }

    /**
     * Displays a single StudentProgress model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StudentProgress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StudentProgress();

        $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');

        $yearList = [];
        for ($i = 1430; $i <= 1600; $i++) {
            $yearList[$i] = $i;
        }
        $monthList = Yii::$app->params['islamic_month_en'];

        if ($model->load(Yii::$app->request->post())) {

            return $this->redirect(['enter-rating', 'year' => $model->year, 'month' => $model->month, 'class_id' => $model->class_id, 'subclass_id' => $model->subclass_id, 'subject_id' => $model->subject_id, 'category' => $model->category]);

            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'yearList' => $yearList,
                        'classList' => $classList,
                        'subclassList' => $subclassList,
                        'monthList' => $monthList,
            ]);
        }
    }

    /**
     * Enter All Student Ratings
     */
    public function actionEnterRating() {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $class_id = Yii::$app->getRequest()->getQueryParam('class_id');
        $subclass_id = Yii::$app->getRequest()->getQueryParam('subclass_id');
        $month = Yii::$app->getRequest()->getQueryParam('month');
        $category = Yii::$app->getRequest()->getQueryParam('category');
        $subject_id = Yii::$app->getRequest()->getQueryParam('subject_id');

        $requestData = [
            'year' => $year,
            'month' => $month,
            'class_id' => $class_id,
            'subclass_id' => $subclass_id,
            'category' => $category,
            'subject_id' => $subject_id,
        ];

        $students = Student::find()->select(['id', 'grno'])->where(['class_id' => $class_id, 'sub_class_id' => $subclass_id, 'is_active' => 'Y', 'is_deleted' => 'N', 'closed_student' => 0])->andWhere(['<>', 'grno', ''])->orderBy('grno ASC')->all();
        $stuData = [];
        $i = 0;

        foreach ($students as $stu) {
            $obj = StudentProgress::findOne(['student_id' => $stu['id'], 'year' => $year, 'month' => $month, 'subject_id' => $subject_id, 'category' => $category, 'is_active' => 'Y', 'is_deleted' => 'N']);

            if (!empty($obj) && count($obj) > 0) {
                $stuData[$i]['rating'] = $obj->rating;
                $stuData[$i]['rating'] = $obj->rating;
            }
            $i++;
        }

        if ($postdata = Yii::$app->request->post()) {
            //print_r($postdata);exit;
            for ($i = 0; $i < count($students); $i++) {
                //$grno = Student::findOne(['id' => $postdata['student'][$i]])->grno;
                $spmodel = StudentProgress::findOne(['year' => $postdata['year'], 'month' => $postdata['month'], 'student_id' => $postdata['student_id'][$i], 'subject_id' => $subject_id, 'category' => $category, 'is_active' => 'Y', 'is_deleted' => 'N']);
                if (empty($spmodel) || count($spmodel) == 0) {
                    $spmodel = new StudentProgress();
                }

                $spmodel->year = $postdata['year'];
                $spmodel->month = $postdata['month'];
                $spmodel->class_id = $postdata['class_id'];
                $spmodel->subclass_id = $postdata['subclass_id'];
                $spmodel->category = $postdata['category'];
                $spmodel->subject_id = $postdata['subject_id'];
                $spmodel->student_id = $postdata['student_id'][$i];
                $spmodel->grno = $postdata['grno'][$i];
                $spmodel->rating = $postdata['rating'][$i];
                $spmodel->is_active = 'Y';
                $spmodel->is_deleted = 'N';
                $spmodel->i_by = Yii::$app->user->identity->id;
                $spmodel->i_date = time();
                $spmodel->u_by = Yii::$app->user->identity->id;
                $spmodel->u_date = time();

                if (!$spmodel->save()) {
                    print_r($spmodel->getErrors());
                    exit;
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('enter-rating', [
                    'students' => $students,
                    'requestData' => $requestData,
                    'stuData' => $stuData,
        ]);
    }

    /**
     * Fetch Subject on basis of selected Category
     */
    public function actionGetSubjectList($id, $class_id, $subclass_id) {
        $subjects = [];
        if ($id == 1) {
            $subjects = \app\models\Subject::findAll(['class_id' => $class_id, 'subclass_id' => $subclass_id, 'is_active' => 'Y', 'is_deleted' => 'N']);
        } else if ($id == 2) {
            $subjects = \app\models\SchoolSubject::findAll(['class_id' => $class_id, 'subclass_id' => $subclass_id, 'is_active' => 'Y', 'is_deleted' => 'N']);
        }

        echo "<option>Select Subject</option>";
        foreach ($subjects as $subject) {
            echo "<option value='" . $subject['id'] . "'>" . $subject['name_en'] . "</option>";
        }
    }

    /**
     * Updates an existing StudentProgress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
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
     * Deletes an existing StudentProgress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentProgress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentProgress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StudentProgress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
