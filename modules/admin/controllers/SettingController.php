<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Setting;
use app\models\SettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends Controller
{
    public $layout="//listing";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','dashboardgraph'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','change'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                                        {
                                            return true;
                                        },
                    ],
                    [
                        'actions' => ['login','logout','forgotpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function () {
                        return Yii::$app->response->redirect(['admin/default/login']);
                    },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Setting model.
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
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Setting();

        if ($model->load(Yii::$app->request->post()))
        {
            //echo "<pre>";print_r($model->errors);
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);
            if($model->validate())
            {
                $model->i_by = Yii::$app->user->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save())
                return $this->redirect(['index']);
            }else{
                echo "<pre>";print_r($model->errors);
               return $this->render('update', [
                    'model' => $model,
                ]); 
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);die;
            if($model->validate())
            {
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save())
                return $this->redirect(['index']);
            }else{
               return $this->render('update', [
                    'model' => $model,
                ]); 
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionActive()
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_active = $_REQUEST['val'];
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            $model->save(false);
            if($_REQUEST['val'] == 'Y')
            {
                $message = 'Setting has been activated.';
            }else{
                $message = 'Setting has been deactivated.';
            }
            /*$from = Yii::$app->params['adminEmail'];
            $to = $user->email;
            $subject = 'Job Status Changed.';
            $content = $message;
            Yii::$app->mycomponent->sendemail($to,$subject,$content,$from);*/
        }
    }
    
    /*
     *  Set Page Number for paggination
     */
    public function actionPage()
    {
        if(isset($_REQUEST['size']) && $_REQUEST['size']!=null)
        {
         \Yii::$app->session->set('user.size',$_REQUEST['size']);
        }
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
