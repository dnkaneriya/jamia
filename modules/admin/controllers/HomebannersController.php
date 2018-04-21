<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Homebanners;
use app\models\HomebannersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * HomebannersController implements the CRUD actions for Homebanners model.
 */
class HomebannersController extends Controller
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
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Homebanners models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('cms')) {
            $searchModel = new HomebannersSearch();
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
     * Displays a single Homebanners model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('cms')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Homebanners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('cms')) {
            $model = new Homebanners();

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($_FILES);die;
                //if($model->validate())
                //{
                if (isset($_FILES['Homebanners']['name']['banner']) && $_FILES['Homebanners']['name']['banner'] != null) {
                    list($width, $height) = getimagesize($_FILES['Homebanners']['tmp_name']['banner']);
                    //var_dump($oldimage);die;
                    $new_image['name'] = $_FILES['Homebanners']['name']['banner'];
                    $new_image['type'] = $_FILES['Homebanners']['type']['banner'];
                    $new_image['tmp_name'] = $_FILES['Homebanners']['tmp_name']['banner'];
                    $new_image['error'] = $_FILES['Homebanners']['error']['banner'];
                    $new_image['size'] = $_FILES['Homebanners']['size']['banner'];
                    $image = $new_image;
                    $name = Yii::$app->mycomponent->uploadUserImage($image, Yii::getAlias('@webroot') . "/" . Yii::$app->params['homebanner'] . '/', $width, $width);
                    $model->banner = Yii::$app->params['homebanner'] . '/' . $name['image'];
                }

                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->i_by = Yii::$app->user->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
                /* }else{
                  return $this->render('update', [
                  'model' => $model,
                  ]);
                  } */
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
     * Updates an existing Homebanners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('cms')) {
            $model = $this->findModel($id);
            $oldimage = $model->banner;

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($params);die;
                //if($model->validate())
                //{
                if (isset($_FILES['Homebanners']['name']['banner']) && $_FILES['Homebanners']['name']['banner'] != null) {
                    list($width, $height) = getimagesize($_FILES['Homebanners']['tmp_name']['banner']);
                    //var_dump($oldimage);die;
                    if ($oldimage != '' && $oldimage != null && file_exists(Yii::getAlias('@webroot') . '/' . $oldimage)) {
                        unlink(Yii::getAlias('@webroot') . "/" . $oldimage);
                    }

                    $new_image['name'] = $_FILES['Homebanners']['name']['banner'];
                    $new_image['type'] = $_FILES['Homebanners']['type']['banner'];
                    $new_image['tmp_name'] = $_FILES['Homebanners']['tmp_name']['banner'];
                    $new_image['error'] = $_FILES['Homebanners']['error']['banner'];
                    $new_image['size'] = $_FILES['Homebanners']['size']['banner'];
                    $image = $new_image;
                    $name = Yii::$app->mycomponent->uploadUserImage($image, Yii::getAlias('@webroot') . "/" . Yii::$app->params['homebanner'] . '/', $width, $width);
                    $model->banner = Yii::$app->params['homebanner'] . '/' . $name['image'];
                } else {
                    $model->image = $oldimage;
                }

                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
                /* }else{
                  return $this->render('update', [
                  'model' => $model,
                  ]);
                  } */
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
     * Deletes an existing Homebanners model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('cms')) {
            if (isset($_REQUEST['id'])) {
                $model = $this->findModel($_REQUEST['id']);
                $model->is_deleted = "Y";
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                $model->save(false);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }
    
    public function actionChange()
    {
        $str = $_REQUEST['str'];
        $field =$_REQUEST['field'];
        $val = $_REQUEST['val'];
        if($str!= null)
        {
            $cond = [$field => $val];
                
            if(Homebanners::updateAll($cond,'id IN('.$str.')'))
            {
                if($_REQUEST['field'] == 'is_deleted')
                {
                    $msg = 'Data successfully deleted';
                }
                else{
                    $msg = 'Data successfully updated';
                }
                $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                
            }
            else
            {
                if($_REQUEST['field'] == 'is_deleted')
                    $msg = 'Unable to delete data. Please try again.';
                else
                    $msg = 'Unable to update data. Please try again.';
                    
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            }
        }
        $this->redirect(['index']);
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
    
    public function actionActive()
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_active = $_REQUEST['val'];
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            $model->save(false);
        }
    }

    /**
     * Finds the Homebanners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Homebanners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Homebanners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
