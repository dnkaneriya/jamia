<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Student;
use app\models\StudentSearch;
use app\models\Studenteducation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->selectedstudent(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPending()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->pendingstudent(Yii::$app->request->queryParams);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionGetdistrict($id)
    {
        if(isset($_REQUEST['id']) && $_REQUEST['id'] != null){
            $districts = Yii::$app->params['indian_all_district'][$id];
            $select = '<select name="Student[district]" id="student-district">';
            $select .= '<option value="">--Select District--</option>';
            foreach($districts as $district){
                $select .= '<option value="'.$district.'">'.$district.'</option>';
            }
            $select .= '</select>';
            echo $select;
        }else{
            $select = '<select name="Student[district]" id="student-district">';
            $select .= '<option value="">--Select District--</option>';
            $select .= '</select>';
            
            echo $select;
        }
        die;
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
        $education = new Studenteducation();

        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);die;
            $numbers = rand(1111, 9999);
            //$model->grno = $numbers;
            $model->grno = '';
            //$model->contact_no = '';
            if(isset($params['Student']['divison_id']) && $params['Student']['divison_id'] != null){
                $model->divison_id = $params['Student']['divison_id'];
            }else{
                $model->divison_id = '';
            }
            if(isset($params['Student']['class_id']) && $params['Student']['class_id'] != null){
                $model->class_id = $params['Student']['class_id'];
            }else{
                $model->class_id = '';
            }
            if(isset($params['Student']['sub_class_id']) && $params['Student']['sub_class_id'] != null){
                $model->sub_class_id = $params['Student']['sub_class_id'];
            }else{
                $model->sub_class_id = '';
            }
            if($params['Student']['fees'] == '0'){
                $model->fees = 'N';
            }else{
                $model->fees = 'Y';
            }
            
            if($model->validate())
            {
                if(isset($_FILES['Student']['name']['image']) && $_FILES['Student']['name']['image'] != null)
                {
                    //var_dump($oldimage);die;
                    $new_image['name'] = $_FILES['Student']['name']['image'];
                    $new_image['type'] = $_FILES['Student']['type']['image'];
                    $new_image['tmp_name'] = $_FILES['Student']['tmp_name']['image'];
                    $new_image['error'] = $_FILES['Student']['error']['image'];
                    $new_image['size'] = $_FILES['Student']['size']['image'];
                    $image = $new_image;
                    $name = Yii::$app->mycomponent->uploadUserImage($image, Yii::getAlias('@webroot')."/".Yii::$app->params['userimage'].'/', 200, 200);
                    $model->image = Yii::$app->params['userimage'].'/'.$name['image'];
                }
                
                $date = $params['Student']['dob_dd'];
                $month = $params['Student']['dob_mm'];
                $year = $params['Student']['dob_yy'];
                $dob = $month.'/'.$date.'/'.$year;
                
                $model->dob = strtotime($dob);
                $model->date = time();
                $model->is_continue = 'P';
                $model->is_selected = 'P';
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->i_by = Yii::$app->user->id;
                $model->i_date = time();
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save()){
                    $education->student_id = $model->id;
                    $education->madrasa_name = $params['Studenteducation']['madrasa_name'];
                    $education->school_standard = $params['Studenteducation']['school_standard'];
                    
                    if($params['Studenteducation']['nazra'] == 1){
                        $education->nazra = 'Y';
                        $education->nazra_para = $params['Studenteducation']['nazra_para'];
                    }else{
                        $education->nazra = 'N';
                        $education->nazra_para = '';
                    }
                    
                    if($params['Studenteducation']['hifz'] == 1){
                        $education->hifz = 'Y';
                        $education->hifz_para = $params['Studenteducation']['hifz_para'];
                    }else{
                        $education->hifz = 'N';
                        $education->hifz_para = '';
                    }
                    
                    if($params['Studenteducation']['arabic'] == 1){
                        $education->arabic = 'Y';
                    }else{
                        $education->arabic = 'N';
                    }
                    
                    if($params['Studenteducation']['urdu'] == 1){
                        $education->urdu = 'Y';
                    }else{
                        $education->urdu = 'N';
                    }
                    
                    $education->school_name = $params['Studenteducation']['school_name'];
                    if(isset($params['Studenteducation']['school_medium']) && $params['Studenteducation']['school_medium'] != null){
                        $education->school_medium = $params['Studenteducation']['school_medium'];
                    }else{
                        $education->school_medium = 'E';
                    }
                    //$education->school_class = $params['Studenteducation']['school_class'];
                    $education->grade = $params['Studenteducation']['grade'];
                    
                    $education->i_by = Yii::$app->user->id;
                    $education->i_date = time();
                    $education->u_by = Yii::$app->user->id;
                    $education->u_date = time();
                    $education->save();
                    return $this->redirect(['pending']);
                }
            }else{
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
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $education = Studenteducation::find()->where(['student_id'=>$id])->one();
        $oldimage = $model->image;
        
        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);die;
            $numbers = rand(1111, 9999);
            //$model->grno = $numbers;
            $model->grno = '';
            if(isset($params['Student']['divison_id']) && $params['Student']['divison_id'] != null){
                $model->divison_id = $params['Student']['divison_id'];
            }else{
                $model->divison_id = '';
            }
            if(isset($params['Student']['class_id']) && $params['Student']['class_id'] != null){
                $model->class_id = $params['Student']['class_id'];
            }else{
                $model->class_id = '';
            }
            if(isset($params['Student']['sub_class_id']) && $params['Student']['sub_class_id'] != null){
                $model->sub_class_id = $params['Student']['sub_class_id'];
            }else{
                $model->sub_class_id = '';
            }
            if($params['Student']['fees'] == '0'){
                $model->fees = 'N';
            }else{
                $model->fees = 'Y';
            }
            if($model->validate())
            {
                if(isset($_FILES['Student']['name']['image']) && $_FILES['Student']['name']['image'] != null)
                {
                    //var_dump($oldimage);die;
                    if($oldimage != '' && $oldimage != null && file_exists(Yii::getAlias('@webroot').'/'.$oldimage))
                    {
                        unlink(Yii::getAlias('@webroot')."/".$oldimage);
                    }
                    
                    $new_image['name'] = $_FILES['Student']['name']['image'];
                    $new_image['type'] = $_FILES['Student']['type']['image'];
                    $new_image['tmp_name'] = $_FILES['Student']['tmp_name']['image'];
                    $new_image['error'] = $_FILES['Student']['error']['image'];
                    $new_image['size'] = $_FILES['Student']['size']['image'];
                    $image = $new_image;
                    $name = Yii::$app->mycomponent->uploadUserImage($image, Yii::getAlias('@webroot')."/".Yii::$app->params['userimage'].'/', 200, 200);
                    $model->image = Yii::$app->params['userimage'].'/'.$name['image'];
                }else{
                    $model->image = $oldimage;
                }
                
                if($params['Student']['is_selected'] == 'Y'){
                    Yii::$app->mailer->compose()
                    ->setTo($params['Student']['email'])
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setSubject(Yii::$app->params['apptitle'].' : Jamiah Student Selection')
                    ->setTextBody("You are selected.")
                    ->send();
                }
                
                $date = $params['Student']['dob_dd'];
                $month = $params['Student']['dob_mm'];
                $year = $params['Student']['dob_yy'];
                $dob = $month.'/'.$date.'/'.$year;
                
                $model->dob = strtotime($dob);
                $model->is_continue = 'P';
                $model->is_selected = 'P';
                $model->is_active = 'Y';
                $model->is_deleted = 'N';
                $model->u_by = Yii::$app->user->id;
                $model->u_date = time();
                if($model->save()){
                    $education->student_id = $model->id;
                    $education->madrasa_name = $params['Studenteducation']['madrasa_name'];
                    
                    if($params['Studenteducation']['nazra'] == 1){
                        $education->nazra = 'Y';
                        $education->nazra_para = $params['Studenteducation']['nazra_para'];
                    }else{
                        $education->nazra = 'N';
                        $education->nazra_para = '';
                    }
                    
                    if($params['Studenteducation']['hifz'] == 1){
                        $education->hifz = 'Y';
                        $education->hifz_para = $params['Studenteducation']['hifz_para'];
                    }else{
                        $education->hifz = 'N';
                        $education->hifz_para = '';
                    }
                    
                    if($params['Studenteducation']['arabic'] == 1){
                        $education->arabic = 'Y';
                    }else{
                        $education->arabic = 'N';
                    }
                    
                    if($params['Studenteducation']['urdu'] == 1){
                        $education->urdu = 'Y';
                    }else{
                        $education->urdu = 'N';
                    }
                    $education->school_standard = $params['Studenteducation']['school_standard'];                    
                    $education->school_name = $params['Studenteducation']['school_name'];
                    if(isset($params['Studenteducation']['school_medium']) && $params['Studenteducation']['school_medium'] != null){
                        $education->school_medium = $params['Studenteducation']['school_medium'];
                    }else{
                        $education->school_medium = 'E';
                    }
                    //$education->school_class = $params['Studenteducation']['school_class'];
                    $education->grade = $params['Studenteducation']['grade'];
                    
                    $education->u_by = Yii::$app->user->id;
                    $education->u_date = time();
                    $education->save();
                    return $this->redirect(['pending']);
                }
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

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(isset($_REQUEST['id']))
        {
            $model = $this->findModel($_REQUEST['id']);
            $model->is_deleted = "Y";
            $model->u_by = Yii::$app->user->id;
            $model->u_date = time();
            $model->save(false);
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
                
            if(Student::updateAll($cond,'id IN('.$str.')'))
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
    
    public function actionSelected()
    {
        $str = $_REQUEST['str'];
        $field =$_REQUEST['field'];
        $val = $_REQUEST['val'];
        $series = $_REQUEST['series'];
        $count = count(explode(",",$str));
        
        /*for($i=0;$i<=$count;$i++){
            $a[] = $series++;
            $cond = ['grno'=>$a];
        }*/
        
        //echo "<pre>";print_r($cond);
        
        if($str!= null)
        {
            //$cond = ['grno'=>$a, $field => $val];
            //echo "<pre>";print_r($cond);die;    
            if(Student::updateAll($cond,'id IN('.$str.')'))
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
