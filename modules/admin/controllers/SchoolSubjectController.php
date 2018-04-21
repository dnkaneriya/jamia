<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SchoolSubject;
use app\models\SchoolSubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Classes;
use app\models\Subclass;
use app\models\SchoolExamSemester;
use yii\helpers\ArrayHelper;

/**
 * SchoolSubjectController implements the CRUD actions for SchoolSubject model.
 */
class SchoolSubjectController extends Controller
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
     * Lists all SchoolSubject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
        $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'classList' => $classList,
            'subclassList' => $subclassList,
            'semesterList' => $semesterList,
        ]);
    }

    /**
     * Displays a single SchoolSubject model.
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
     * Creates a new SchoolSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SchoolSubject();

        $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
        $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');

        if ($model->load(Yii::$app->request->post())) {

            $model->i_by = Yii::$app->user->identity->id;
            $model->i_date = time();
            $model->u_by = Yii::$app->user->identity->id;
            $model->u_date = time();

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'classList' => $classList,
                'subclassList' => $subclassList,
                'semesterList' => $semesterList,
            ]);
        }
    }

    /**
     * Updates an existing SchoolSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
        $semesterList = ArrayHelper::map(SchoolExamSemester::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'semester');

        if ($model->load(Yii::$app->request->post())) {

            $model->i_by = Yii::$app->user->identity->id;
            $model->i_date = time();
            $model->u_by = Yii::$app->user->identity->id;
            $model->u_date = time();

            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'classList' => $classList,
                'subclassList' => $subclassList,
                'semesterList' => $semesterList,
            ]);
        }
    }

    /**
     * Deletes an existing SchoolSubject model.
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
     * Finds the SchoolSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolSubject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
