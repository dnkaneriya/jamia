<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TajwidResult;
use app\models\TajwidResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TajwidClass;
use yii\helpers\ArrayHelper;

/**
 * TajwidResultController implements the CRUD actions for TajwidResult model.
 */
class TajwidResultController extends Controller
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
     * Lists all TajwidResult models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TajwidResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tajwidClassList = ArrayHelper::map(TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'class_name');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tajwidClassList' => $tajwidClassList,
        ]);
    }

    /**
     * Displays a single TajwidResult model.
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
     * Creates a new TajwidResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TajwidResult();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TajwidResult model.
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
    
    public function actionUpgradeStudent()
    {
        $str = $_POST['str'];
        $ids = explode(",",$str);
        foreach($ids as $id) {
            $res = TajwidResult::findOne(['id' => $id]);
            if(!empty($res) && count($res) > 0) {
                
                $student = \app\models\Student::findOne(['id' => $res->student_id]);
                $classUpgrade = \app\models\TajwidClassUpgrade::findOne(['class_id' => $student->tajwid_class]);

                if (!empty($classUpgrade) && count($classUpgrade) > 0) {
                    $student->tajwid_class = $classUpgrade->upgrade_class_id;
                    $student->save();
                }
            }
        }
    }

    /**
     * Deletes an existing TajwidResult model.
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
     * Finds the TajwidResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TajwidResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TajwidResult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
