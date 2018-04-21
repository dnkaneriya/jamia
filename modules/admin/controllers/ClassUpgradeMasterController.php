<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ClassUpgradeMaster;
use app\models\ClassUpgradeMasterSearch;
use app\models\Classes;
use app\models\Subclass;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

/**
 * ClassUpgradeMasterController implements the CRUD actions for ClassUpgradeMaster model.
 */
class ClassUpgradeMasterController extends Controller
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
     * Lists all ClassUpgradeMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('islamic_class')) {
            $searchModel = new ClassUpgradeMasterSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $classList = ArrayHelper::map(Classes::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'name');

            $subclassList = ArrayHelper::map(Subclass::findAll(['is_deleted' => 'N', 'is_active' => 'Y']), 'id', 'sub_class');

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
     * Displays a single ClassUpgradeMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('islamic_class')) {
            
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new ClassUpgradeMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        if(Yii::$app->user->can('islamic_class')) {
            $model = new ClassUpgradeMaster();

            if ($postdata = Yii::$app->request->post()) {

                $model->class_id = $postdata['ClassUpgradeMaster']['class_id'];
                $model->subclass_id = $postdata['ClassUpgradeMaster']['subclass_id'];
                $model->upgrade_id = $postdata['ClassUpgradeMaster']['upgrade_id'];
                $model->upgrade_subclass_id = $postdata['ClassUpgradeMaster']['upgrade_subclass_id'];
                $model->is_active = 1;
                $model->is_deleted = 0;
                $model->i_by = Yii::$app->user->id;
                $model->i_at = time();
                $model->u_by = Yii::$app->user->id;
                $model->u_at = time();

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
     * Get Subclass List
     */
    public function actionGetSubclassList($id)
    {
        $model = Subclass::findAll(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $id]);
        
        echo "<option value=''>Select Subclass</option>";

        foreach($model as $obj) {
            echo "<option value='".$obj['id']."'>". $obj['sub_class'] ."</options>";
        }
    }


    /**
     * Get Upgrade Subclasses of previous Class
     */
    public function actionGetUpgradesubclassList($subclass_id, $class_id)
    {
        //$class_id = Subclass::findOne(['id' => $id])->class_id;

        $model = Subclass::find()->where(['is_active' => 'Y', 'is_deleted' => 'N', 'class_id' => $class_id])->andWhere(['<>', 'id', $subclass_id])->all();

        echo "<option value=''>Select Subclass</option>";

        foreach($model as $obj) {
            echo "<option value='".$obj['id']."'>". $obj['sub_class'] ."</options>";
        }
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
     * Updates an existing ClassUpgradeMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('islamic_class')) {
            $model = $this->findModel($id);

            if ($postdata = Yii::$app->request->post()) {

                $model->class_id = $postdata['ClassUpgradeMaster']['class_id'];
                $model->subclass_id = $postdata['ClassUpgradeMaster']['subclass_id'];
                $model->upgrade_id = $postdata['ClassUpgradeMaster']['upgrade_id'];
                $model->upgrade_subclass_id = $postdata['ClassUpgradeMaster']['upgrade_subclass_id'];
                $model->is_active = 1;
                $model->is_deleted = 0;
                $model->u_by = Yii::$app->user->id;
                $model->u_at = time();


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
     * Deletes an existing ClassUpgradeMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('islamic_class')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the ClassUpgradeMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClassUpgradeMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClassUpgradeMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
