<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SchoolExamResult;
use app\models\SchoolExamResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Classes;
use app\models\Subclass;
use app\models\SchoolExam;

/**
 * SchoolExamResultController implements the CRUD actions for SchoolExamResult model.
 */
class SchoolExamResultController extends Controller
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
     * Lists all SchoolExamResult models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolExamResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $classList = ArrayHelper::map(Classes::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'sub_class');
        $standardList = ArrayHelper::map(SchoolExam::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'standard');
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'classList' => $classList,
            'subclassList' => $subclassList,
            'standardList' => $standardList,
        ]);
    }

    /**
     * Displays a single SchoolExamResult model.
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
     * Creates a new SchoolExamResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SchoolExamResult();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SchoolExamResult model.
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
     * Deletes an existing SchoolExamResult model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUpgradeStudent()
    {
        $str = $_POST['str'];
        $ids = explode(",",$str);
        foreach($ids as $id) {
            $res = SchoolExamResult::findOne(['id' => $id]);
            if(!empty($res) && count($res) > 0) {
                
                $student = \app\models\Student::findOne(['id' => $res->student_id]);
                $classUpgrade = \app\models\SchoolStandardUpgrade::findOne(['standard_id' => $student->school_standard]);

                if (!empty($classUpgrade) && count($classUpgrade) > 0) {
                    $student->school_standard = $classUpgrade->upgrade_standard_id;
                    $student->save();
                }
            }
        }
    }

    /**
     * Finds the SchoolExamResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolExamResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolExamResult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
