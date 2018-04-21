<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TajwidClassUpgrade;
use app\models\TajwidClassUpgradeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TajwidClass;
use yii\helpers\ArrayHelper;

/**
 * TajwidClassUpgradeController implements the CRUD actions for TajwidClassUpgrade model.
 */
class TajwidClassUpgradeController extends Controller
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
     * Lists all TajwidClassUpgrade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TajwidClassUpgradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tajwidClass = ArrayHelper::map(TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'class_name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tajwidClass' => $tajwidClass,
        ]);
    }

    /**
     * Displays a single TajwidClassUpgrade model.
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
     * Creates a new TajwidClassUpgrade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TajwidClassUpgrade();
        
        $tajwidClass = ArrayHelper::map(TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'class_name');
        
        if ($postData = Yii::$app->request->post()) {
            
            $upgradeModel = TajwidClassUpgrade::findOne(['class_id' => $postData['TajwidClassUpgrade']['class_id']] );
            if(empty($upgradeModel) || count($upgradeModel) == 0) {
               $upgradeModel = new TajwidClassUpgrade(); 
            }
            
            $upgradeModel->class_id = $postData['TajwidClassUpgrade']['class_id'];
            $upgradeModel->upgrade_class_id = $postData['TajwidClassUpgrade']['upgrade_class_id'];
            
            $upgradeModel->is_active = 'Y';
            $upgradeModel->is_deleted = 'N';
            $upgradeModel->i_by = Yii::$app->user->identity->id;
            $upgradeModel->i_date = time();
            $upgradeModel->u_by = Yii::$app->user->identity->id;
            $upgradeModel->u_date = time();
            
            $upgradeModel->save();
            
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tajwidClass' => $tajwidClass,
            ]);
        }
    }
    
    public function actionGetUpgradeclassList($id)
    {
        $classes = TajwidClass::find()->where(['is_active' => 'Y', 'is_deleted' => 'N'])->andWhere(['<>', 'id', $id])->all();
        echo "<option value=''>Select class</option>";
        foreach($classes as $class) {
            echo "<option value='".$class['id']."'>".$class['class_name']."</option>";
        }
    }

    /**
     * Updates an existing TajwidClassUpgrade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tajwidClass = ArrayHelper::map(TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']), 'id', 'class_name');
        
        if ($postData = Yii::$app->request->post()) {
            
            $upgradeModel = TajwidClassUpgrade::findOne(['class_id' => $postData['TajwidClassUpgrade']['class_id']] );
            if(empty($upgradeModel) || count($upgradeModel) == 0) {
               $upgradeModel = new TajwidClassUpgrade(); 
            }
            
            $upgradeModel->class_id = $postData['TajwidClassUpgrade']['class_id'];
            $upgradeModel->upgrade_class_id = $postData['TajwidClassUpgrade']['upgrade_class_id'];
            
            $upgradeModel->is_active = 'Y';
            $upgradeModel->is_deleted = 'N';
            $upgradeModel->i_by = Yii::$app->user->identity->id;
            $upgradeModel->i_date = time();
            $upgradeModel->u_by = Yii::$app->user->identity->id;
            $upgradeModel->u_date = time();
            
            $upgradeModel->save();
            
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tajwidClass' => $tajwidClass,
            ]);
        }
    }

    /**
     * Deletes an existing TajwidClassUpgrade model.
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
     * Finds the TajwidClassUpgrade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TajwidClassUpgrade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TajwidClassUpgrade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
