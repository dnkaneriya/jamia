<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SchoolExamSemester;
use app\models\SchoolExamSemesterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use yii\web\ForbiddenHttpException;

/**
 * SchoolExamSemesterController implements the CRUD actions for SchoolExamSemester model.
 */
class SchoolExamSemesterController extends Controller
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
     * Lists all SchoolExamSemester models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('school_class')) {
            $searchModel = new SchoolExamSemesterSearch();
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
     * Displays a single SchoolExamSemester model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('school_class')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new SchoolExamSemester model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('school_class')) {
            
            $model = new SchoolExamSemester();

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');

            if ($model->load(Yii::$app->request->post())) {

                $model->i_by = Yii::$app->user->identity->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->identity->id;
                $model->u_date = time();

                if (!$model->save()) {
                    print_r($model->getErrors());
                    exit;
                }
                return $this->redirect(['index']);
            } else {
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
     * Updates an existing SchoolExamSemester model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('school_class')) {
            $model = $this->findModel($id);

            $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
            $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');

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
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing SchoolExamSemester model.
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
     * Finds the SchoolExamSemester model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolExamSemester the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolExamSemester::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
