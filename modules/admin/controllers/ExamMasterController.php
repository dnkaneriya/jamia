<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ExamMaster;
use app\models\ExamMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * ExamMasterController implements the CRUD actions for ExamMaster model.
 */
class ExamMasterController extends Controller
{

    public $layout="//listing";
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ExamMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('islamic_exam')) {
            $searchModel = new ExamMasterSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single ExamMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('islamic_exam')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new ExamMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('islamic_exam')) {
            $model = new ExamMaster();

            if ($postdata = Yii::$app->request->post()) {
                
                if(isset($postdata['ExamMaster']['class_upgrade']) && $postdata['ExamMaster']['class_upgrade']!='') {
                    $examModel = ExamMaster::findOne(['class_upgrade' => 1]);
                    if(!empty($examModel) && count($examModel) > 0) {
                        $examModel->class_upgrade = 0;
                        $examModel->save();
                    }
                    $model->class_upgrade = $postdata['ExamMaster']['class_upgrade'];
                }
                
                $model->name = $postdata['ExamMaster']['name'];
                $model->total_marks = $postdata['ExamMaster']['total_marks'];
                $model->passing_marks = $postdata['ExamMaster']['passing_marks'];
                
                
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->i_by = Yii::$app->user->identity->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->identity->id;
                $model->u_date = time();

                $model->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing ExamMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('islamic_exam')) {
            $model = $this->findModel($id);

            if ($postdata = Yii::$app->request->post()) {
                
                if(isset($postdata['ExamMaster']['class_upgrade']) && $postdata['ExamMaster']['class_upgrade']!='') {
                    $examModel = ExamMaster::findOne(['class_upgrade' => 1]);
                    if(!empty($examModel) && count($examModel) > 0) {
                        $examModel->class_upgrade = 0;
                        $examModel->save();
                    }
                    $model->class_upgrade = $postdata['ExamMaster']['class_upgrade'];
                }
                
                $model->name = $postdata['ExamMaster']['name'];
                $model->total_marks = $postdata['ExamMaster']['total_marks'];
                $model->passing_marks = $postdata['ExamMaster']['passing_marks'];

                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->u_by = Yii::$app->user->identity->id;
                $model->u_date = time();

                $model->save();

                return $this->redirect(['index']);
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
     * Deletes an existing ExamMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('islamic_exam')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the ExamMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExamMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
