<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Jamia;
use app\models\Jamiasearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Jamiaimage;
use yii\web\ForbiddenHttpException;
/**
 * JamiaController implements the CRUD actions for Jamia model.
 */
class JamiaController extends Controller
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
                        'actions' => ['index','create','update','delete','change','page'],
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
     * Lists all Jamia models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('jamiah')) {
            $searchModel = new Jamiasearch();
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
     * Displays a single Jamia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('jamiah')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Jamia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('jamiah')) {
            $model = new Jamia();

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                //echo "<pre>";print_r($params);print_r($_FILES);die;
                if ($model->validate()) {
                    if (isset($params['Jamia']['album_date']) && $params['Jamia']['album_date'] != null)
                        $model->album_date = strtotime($params['Jamia']['album_date']);
                    $model->i_by = Yii::$app->user->id;
                    $model->i_date = time();
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save()) {
                        if (isset($_FILES['Jamiaimage']['tmp_name']['image']) && $_FILES['Jamiaimage']['tmp_name']['image'] != array()) {
                            $i = 0;
                            $eids = array();
                            foreach ($_FILES['Jamiaimage']['tmp_name']['image'] as $pro_image) {
                                if (isset($_FILES['Jamiaimage']['tmp_name']['image'][$i]) && $_FILES['Jamiaimage']['tmp_name']['image'][$i] != '') {
                                    if ($params['Jamiaimage']['id'][$i] > 0) {
                                        $exp = Jamiaimage::find()->where(['id' => $params['Jamiaimage']['id'][$i]])->one();
                                        $oldimage = $exp->image;
                                    } else {
                                        $exp = new Jamiaimage();
                                        $exp->i_date = time();
                                        $exp->i_by = Yii::$app->user->id;
                                        $oldimage = '';
                                    }
                                    $exp->jamia_id = $model->id;

                                    if (isset($_FILES['Jamiaimage']['name']['image'][$i]) && $_FILES['Jamiaimage']['name']['image'][$i] != null) {
                                        //var_dump($oldimage);die;
                                        if ($oldimage != '' && $oldimage != null && file_exists(Yii::getAlias('@webroot') . '/' . $oldimage)) {
                                            unlink(Yii::getAlias('@webroot') . "/" . $oldimage);
                                        }
                                        $image = $_FILES['Jamiaimage']['name']['image'][$i];
                                        $ext = substr(strrchr($image, "."), 1);
                                        $fileName = "Jamiaimage_" . md5(rand() * time()) . ".$ext";
                                        $exp->image = Yii::$app->params['jamiaimage'] . '/' . $fileName;

                                        move_uploaded_file($_FILES['Jamiaimage']['tmp_name']['image'][$i], Yii::getAlias('@webroot') . "/" . $exp->image);
                                    } else {
                                        $exp->image = $oldimage;
                                    }
                                    $exp->u_by = Yii::$app->user->id;
                                    $exp->u_date = time();
                                    $exp->save(false);
                                    $eids[] = $exp->id;
                                }
                                $i += 1;
                            }
                            if ($eids != array()) {
                                $cond = ['is_deleted' => 'Y', 'u_by' => Yii::$app->user->id, 'u_date' => time()];
                                $str = implode(',', $eids);
                                Jamiaimage::deleteAll('jamia_id = ' . $model->id . ' and id NOT IN(' . $str . ')');
                            }
                        }

                        return $this->redirect(['index']);
                    }
                } else {
                    return $this->render('create', [
                                'model' => $model,
                    ]);
                }
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
     * Updates an existing Jamia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('jamiah')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $params = Yii::$app->request->post();
                // echo "<pre>";print_r($params);print_r($_FILES);die;
                if ($model->validate()) {
                    if (isset($params['Jamia']['album_date']) && $params['Jamia']['album_date'] != null)
                        $model->album_date = strtotime($params['Jamia']['album_date']);
                    $model->u_by = Yii::$app->user->id;
                    $model->u_date = time();
                    if ($model->save()) {
                        if (isset($_FILES['Jamiaimage']['tmp_name']['image']) && $_FILES['Jamiaimage']['tmp_name']['image'] != array()) {
                            $i = 0;
                            $eids = array();
                            foreach ($_FILES['Jamiaimage']['tmp_name']['image'] as $pro_image) {
                                if (isset($_FILES['Jamiaimage']['tmp_name']['image'][$i]) && $_FILES['Jamiaimage']['tmp_name']['image'][$i] != '') {
                                    if ($params['Jamiaimage']['id'][$i] > 0) {
                                        $exp = Jamiaimage::find()->where(['id' => $params['Jamiaimage']['id'][$i]])->one();
                                        $oldimage = $exp->image;
                                    } else {
                                        $exp = new Jamiaimage();
                                        $exp->i_date = time();
                                        $exp->i_by = Yii::$app->user->id;
                                        $oldimage = '';
                                    }
                                    $exp->jamia_id = $model->id;

                                    if (isset($_FILES['Jamiaimage']['name']['image'][$i]) && $_FILES['Jamiaimage']['name']['image'][$i] != null) {
                                        //var_dump($oldimage);die;
                                        if ($oldimage != '' && $oldimage != null && file_exists(Yii::getAlias('@webroot') . '/' . $oldimage)) {
                                            unlink(Yii::getAlias('@webroot') . "/" . $oldimage);
                                        }
                                        $image = $_FILES['Jamiaimage']['name']['image'][$i];
                                        $ext = substr(strrchr($image, "."), 1);
                                        $fileName = "Jamiaimage_" . md5(rand() * time()) . ".$ext";
                                        $exp->image = Yii::$app->params['jamiaimage'] . '/' . $fileName;

                                        move_uploaded_file($_FILES['Jamiaimage']['tmp_name']['image'][$i], Yii::getAlias('@webroot') . "/" . $exp->image);
                                    } else {
                                        $exp->image = $oldimage;
                                    }
                                    $exp->u_by = Yii::$app->user->id;
                                    $exp->u_date = time();
                                    $exp->save(false);
                                    $eids[] = $exp->id;
                                }
                                $i += 1;
                            }
                            if ($eids != array()) {
                                $cond = ['is_deleted' => 'Y', 'u_by' => Yii::$app->user->id, 'u_date' => time()];
                                $str = implode(',', $eids);
                                Jamiaimage::deleteAll('jamia_id = ' . $model->id . ' and id NOT IN(' . $str . ')');
                            }
                        }
                    }
                    return $this->redirect(['index']);
                } else {

                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
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
     * Deletes an existing Jamia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('jamiah')) {
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
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
    }
	
	public function actionChange()
    {
        $str = $_REQUEST['str'];
        $field =$_REQUEST['field'];
        $val = $_REQUEST['val'];
        if($str!= null)
        {
            $cond = [$field => $val];
                
            if(Jamia::updateAll($cond,'id IN('.$str.')'))
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

    /**
     * Finds the Jamia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jamia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jamia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
