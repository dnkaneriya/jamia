<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ResultMaster;
use app\models\ResultMasterSearch;
use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use app\models\Student;
use app\models\ClassUpgradeMaster;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * ResultMasterController implements the CRUD actions for ResultMaster model.
 */
class ResultMasterController extends Controller
{

    public $layout="//listing";
    
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
     * Lists all ResultMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResultMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');
        $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');
        $divisionList = ArrayHelper::map(Division::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'division');
        $studentList = ArrayHelper::map(Student::find()->where(['is_deleted' => 'N', 'is_active' => 'Y'])->andWhere(['<>', 'grno', ''])->all(), 'id', 'grno');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'classList' => $classList,
            'subclassList' => $subclassList,
            'divisionList' => $divisionList,
            'studentList' => $studentList,
        ]);
    }

    /**
     * Displays a single ResultMaster model.
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
     * Creates a new ResultMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResultMaster();

        if ($postdata = Yii::$app->request->post()) {

            $model->class_id = $postdata['ResultMaster']['class_id'];
            $model->division_id = $postdata['ResultMaster']['division_id'];
            $model->student_id = $postdata['ResultMaster']['student_id'];
            $model->result = $postdata['ResultMaster']['result'];

            $model->is_active = 'Y';
            $model->is_deleted = 'N';
            $model->i_by = Yii::$app->user->id;
            $model->i_date = time();
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
  
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Fetch Divisions of classes
     */
    public function actionFetchDivisions($id)
    {
        $model = Division::findAll(['class_id' => $id, 'is_active' => 'Y', 'is_deleted' => 'N']);
        
        if(empty($model) || count($model) == 0) {
            echo "<option>No Divisions Found!<options>";
        } else {
            echo "<option value=''>Select Division</option>";
            foreach ($model as $obj) {
                # code...
                echo "<option value='". $obj['id'] ."'>" . $obj['division'] . "</option>";
            }
        }
    }

    /**
     * Fetch Students on basis of division id
     */
    public function actionFetchStudents($id)
    {
        $model = Student::find()->where(['divison_id' => $id, 'is_active' => 'Y', 'is_deleted' => 'N'])->andWhere('grno != ""')->all();
        if(empty($model) || count($model) == 0) {
            echo "<option>No Students Found!<options>";
        } else {
            echo "<option value=''>Select Student</option>";
            foreach ($model as $obj) {
                # code...
                echo "<option value='". $obj['id'] ."'>" . $obj['grno'] . "</option>";
            }
        }   
    }

    /**
     * Fetch Student Result
     */
    public function actionShowStudentMarks($id)
    {
        $query = new Query;
        $query->select(['sm.name_ar', 'mm.marks'])
            ->from('marks_master mm')
            ->leftJoin('subject_master sm', 'mm.subject_id=sm.id')
            ->where(['mm.student_id' => $id])
            ->all();
        $det = $query->createCommand()->queryAll();
        
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Subject</th>";
        echo "<th>Marks</th>";
        echo "</tr>";
        echo "</thead>";
        foreach($det as $obj) {
            echo "<tr>";
                echo "<td>". $obj['name_ar'] ."</td>";
                echo "<td>". $obj['marks'] ."</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<div class='row'>";
            echo "<label class='col-sm-3'>Result</label>";
            echo "<div class='col-sm-8'>";
            echo "<input type='radio' name='ResultMaster[result]' id='resultmaster-result_pass' value='P'>
            <label class='control-label' for='resultmaster-result_pass'>Pass</label>";
            echo "<input type='radio' name='ResultMaster[result]' id='resultmaster-result_fail' value='F'>
            <label class='control-label' for='resultmaster-result_fail'>Fail</label>";
            echo "</div>";
        echo "</div>";
    }

    public function actionUpgradeClass()
    {
        $model = new ClassUpgradeMaster();

        if($postdata = Yii::$app->request->post()) {
            $model->class_id = $postdata['ClassUpgradeMaster']['class_id'];
            $model->upgrade_id = $postdata['ClassUpgradeMaster']['upgrade_id'];
            $model->is_active = 'Y';
            $model->is_deleted = 'N';
            $model->i_by = Yii::$app->user->id;
            $model->i_at = time();
            $model->u_by = Yii::$app->user->id;
            $model->u_at = time();

            if(!$model->save()) {
                print_r($model->getErrors());
            }

            return $this->redirect(['upgrade-class']);
        }

        return $this->render('upgradeClass', ['model' => $model]);
    }

    /**
     * Get class list to upgrade
     */
    public function actionGetUpgradeClassList($id)
    {
        $model = Classes::find()->where(['is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'id', $id])->all();

        echo "<option value=''>Select Upgrade Class</options>";

        foreach ($model as $obj) {
            # code...
            echo "<option value='".$obj['id']."'>".$obj['name']."</option>";
        }
    }


    /**
     * Updates an existing ResultMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($postdata = Yii::$app->request->post()) {

            $model->class_id = $postdata['ClassUpgradeMaster']['class_id'];
            $model->upgrade_id = $postdata['ClassUpgradeMaster']['upgrade_id'];
            $model->is_active = 'Y';
            $model->is_deleted = 'N';
            $model->u_by = Yii::$app->user->id;
            $model->u_at = time();

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ResultMaster model.
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
     * Finds the ResultMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ResultMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResultMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
