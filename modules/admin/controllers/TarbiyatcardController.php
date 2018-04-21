<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Tarbiyatcard;
use app\models\TarbiyatcardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Student;
use app\models\Subjectoption;
use app\models\Tarbiyatsubject;

/**
 * TarbiyatcardController implements the CRUD actions for Tarbiyatcard model.
 */
class TarbiyatcardController extends Controller {

    public $layout = "//listing";

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'dashboardgraph'],
                'rules' => [
                        [
                        'actions' => ['index', 'create', 'update', 'delete', 'change'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return true;
                        },
                    ],
                        [
                        'actions' => ['login', 'logout', 'forgotpassword'],
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
     * Lists all Tarbiyatcard models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TarbiyatcardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarbiyatcard model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        
        $tarbiyatcard = Tarbiyatcard::find()->where(['student_id' => $model->student_id, 't_year' => $model->t_year])->all();
        $tarbiyatSub = Tarbiyatsubject::findAll(['is_deleted' => 'N', 'is_active' => 'Y']);
        $totalSub = count($tarbiyatSub);
        return $this->render('view', [
            'tarbiyatcard_arr' => $tarbiyatcard,
            'tarbiyatSub' => $tarbiyatSub,
            'totalSub' => $totalSub,
        ]);
    }

    /**
     * Creates a new Tarbiyatcard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tarbiyatcard();

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);echo count($params['Tarbiyatcard']['tarbiyat_subject_id']);die;
            if ($model->validate()) {
//                print_r($params);exit;
                if (count($params['Tarbiyatcard']['tarbiyat_subject_id']) > 0) {
                    for ($i = 0; $i < count($params['Tarbiyatcard']['tarbiyat_subject_id']); $i++) {
                        $tarbiyatcard = Tarbiyatcard::findOne(['student_id' => $params['Tarbiyatcard']['student_id'], 't_year' => $params['Tarbiyatcard']['t_year'], 't_month' => $params['Tarbiyatcard']['t_month'], 'tarbiyat_subject_id' => $params['Tarbiyatcard']['tarbiyat_subject_id'][$i]]);
                        if(empty($tarbiyatcard) || count($tarbiyatcard) == 0) {
                            $tarbiyatcard = new Tarbiyatcard();
                        }
                        
                        $tarbiyatcard->student_id = $params['Tarbiyatcard']['student_id'];
                        $tarbiyatcard->grno = Student::find()->where(['id' => $params['Tarbiyatcard']['student_id']])->one()->grno;
                        $tarbiyatcard->t_year = $params['Tarbiyatcard']['t_year'];
                        $tarbiyatcard->t_month = $params['Tarbiyatcard']['t_month'];
                        $tarbiyatcard->tarbiyat_subject_id = $params['Tarbiyatcard']['tarbiyat_subject_id'][$i];
                        $tarbiyatcard->selected_option = $params['Tarbiyatcard']['selected_option'][$tarbiyatcard->tarbiyat_subject_id];
                        $tarbiyatcard->i_by = Yii::$app->user->id;
                        $tarbiyatcard->i_date = time();
                        $tarbiyatcard->u_by = Yii::$app->user->id;
                        $tarbiyatcard->u_date = time();
                        $tarbiyatcard->save();
                    }
                }
                return $this->redirect(['index']);
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
    }

    /**
     * Updates an existing Tarbiyatcard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->request->post();
            if ($model->validate()) {
                if (count($params['Tarbiyatcard']['tarbiyat_subject_id']) > 0) {
                    for ($i = 0; $i < count($params['Tarbiyatcard']['tarbiyat_subject_id']); $i++) {
                        $tarbiyatcard = Tarbiyatcard::find()->where(['student_id' => $model->student_id, 'tarbiyat_subject_id' => $params['Tarbiyatcard']['tarbiyat_subject_id'][$i], 't_year' => $model->t_year, 't_month' => $model->t_month])->one();
                        if ($tarbiyatcard == array())
                            $tarbiyatcard = new Tarbiyatcard();
                        $tarbiyatcard->student_id = $params['Tarbiyatcard']['student_id'];
                        $tarbiyatcard->grno = Student::find()->where(['id' => $params['Tarbiyatcard']['student_id']])->one()->grno;
                        $tarbiyatcard->t_year = $params['Tarbiyatcard']['t_year'];
                        $tarbiyatcard->t_month = $params['Tarbiyatcard']['t_month'];
                        $tarbiyatcard->tarbiyat_subject_id = $params['Tarbiyatcard']['tarbiyat_subject_id'][$i];
                        $tarbiyatcard->selected_option = $params['Tarbiyatcard']['selected_option'][$tarbiyatcard->tarbiyat_subject_id];
                        $tarbiyatcard->u_by = Yii::$app->user->id;
                        $tarbiyatcard->u_date = time();
                        $tarbiyatcard->save();
                    }
                }
                return $this->redirect(['index']);
            }else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tarbiyatcard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        if (isset($_REQUEST['id'])) {
            $model = $this->findModel($_REQUEST['id']);
            Tarbiyatcard::updateAll(['is_deleted' => 'Y', 'u_by' => Yii::$app->user->id, 'u_date' => time()], 'student_id = ' . $model->student_id . ' AND t_year = ' . $model->t_year . ' AND t_month = ' . $model->t_month);
        }
    }

    /*
     *  Set Page Number for paggination
     */

    public function actionPage() {
        if (isset($_REQUEST['size']) && $_REQUEST['size'] != null) {
            \Yii::$app->session->set('user.size', $_REQUEST['size']);
        }
    }

    public function actionSubjectoptions($id) {
        $html = '';
        //$html = '<select name="Tarbiyatcard[selected_option_id]" class="form-control" id="tarbiyatcard-selected_option_id">';
        if (isset($_REQUEST['id']) && $_REQUEST['id'] != null) {
            $options = Subjectoption::find()->where(['tarbiyat_subject_id' => $id])->all();
            if (!empty($options)) {
                $array = array(
                    'A' => 'Regular without any person tell', 'B' => 'Regular but in month some time lazy',
                    'C' => 'Regular but always lazy', 'D' => 'Not Regular'
                );
                foreach ($options as $option) {
                    $html .= '<option value="' . $option->id . '">' . $array[$option->options] . '</option>';
                }
            } else {
                $html .= '<option value="">-Select Subject Option-</option>';
            }
        } else {
            $html .= '<option value="">-Select Subject Option-</option>';
        }
        //$html .= '</select>';

        return $html;
    }

    public function actionTarbiyatcardlist() {
        if (isset($_REQUEST['id'])) {
            $tarbiyatcard = Tarbiyatcard::find()->where(['id' => $_REQUEST['id']])->one();
            $tarbiyatcardlist = Tarbiyatcard::find()->where(['student_id' => $tarbiyatcard->student_id, 'is_deleted' => 'N', 't_year' => $tarbiyatcard->t_year, 't_month' => $tarbiyatcard->t_month])->all();
            return $this->renderPartial('tarbiyatcardbyid', [
                        'model' => $tarbiyatcard,
                        'tarbiyatcardlist' => $tarbiyatcardlist,
            ]);
        }
    }

    /**
     * Finds the Tarbiyatcard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tarbiyatcard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tarbiyatcard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
