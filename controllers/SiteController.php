<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Session;
use yii\widgets\ActiveForm;

use app\models\LoginForm;
use app\models\User;
use app\models\Student;
use app\models\StudentSearch;
use app\models\Studenteducation;
use app\models\Contact;

class SiteController extends Controller
{
    /*public $defaultAction = 'login';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','dashboardgraph'],
                'rules' => [
                    [
                        'actions' => ['index','dashboardgraph'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login','logout','forgotpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function () {
                        return Yii::$app->response->redirect(['site/login']);
                    },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
        ];
    }*/
   
    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }
    
    public function actionAboutus()
    {
        $this->layout = 'main';
        return $this->render('aboutus');
    }
    
    public function actionContactus()
    {
        $model = new Contact();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);die;
            if($model->validate())
            {
                $model->datetime = time();
                
                if($model->save()){
                    Yii::$app->mailer->compose()
			//->setTo($model->email)
                        //->setTo(Yii::$app->params['adminEmail'])
                        ->setTo('zishans.mz@gmail.com')
			->setFrom($model->email)
			->setSubject(Yii::$app->params['apptitle'].' : Inquiry')
			->setTextBody($model->message)
			->send();
                        
                    $flash_msg = \Yii::$app->params['msg_success'].'Your registration request has been sent successfully.'.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    return $this->redirect(['contactus']);
                }
            }else{
                echo "<pre>";print_r($model->errors);
                return $this->render('contactus', [
                    'model' => $model,
                ]); 
            }
        }
        else {
            return $this->render('contactus', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionStudents()
    {
        $this->layout = 'main';
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->selectedstudent(Yii::$app->request->queryParams);

        return $this->render('students', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    
        //return $this->render('students');
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
    
    public function actionRegister()
    {
        $this->layout = 'main';
        $model = new Student();
        $education = new Studenteducation();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            //echo "<pre>";print_r($params);die;
            $numbers = rand(1111, 9999);
            //$model->grno = $numbers;
            $model->grno = '';
            if(isset($params['Classes']['class_id']) && $params['Classes']['class_id'] != null){
                $model->class_id = $params['Classes']['class_id'];
            }else{
                $model->class_id = '';
            }
            $model->divison_id = '';
            $model->sub_class_id = '';
            /*if($params['Student']['fees'] == 'N'){
                $model->fees = 'N';
                $model->amount = '';
            }else{
                $model->fees = 'Y';
                $model->fees = $params['Student']['amount'];
            }*/
            
            if($model->validate())
            {
                /*if(isset($_FILES['Student']['name']['image']) && $_FILES['Student']['name']['image'] != null)
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
                }*/
                $date = $params['Student']['dob_dd'];
                $month = $params['Student']['dob_mm'];
                $year = $params['Student']['dob_yy'];
                $dob = $month.'/'.$date.'/'.$year;
                //echo "<pre>";print_r(strtotime($dob));die;
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
                    }
					if(isset($params['Studenteducation']['school_standard']) && $params['Studenteducation']['school_standard'] != null){
                        $education->school_standard = $params['Studenteducation']['school_standard'];
                    }
                    //$education->school_class = $params['Studenteducation']['school_class'];
                    $education->grade = $params['Studenteducation']['grade'];
                    
                    //$education->i_by = $model->id;
                    $education->i_date = time();
                    //$education->u_by = $model->id;
                    $education->u_date = time();
                    $education->save();
                    $flash_msg = \Yii::$app->params['msg_success'].'Your registration request has been sent successfully.'.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    return $this->redirect(['register']);
                }
            }else{
                echo "<pre>";print_r($model->errors);
                return $this->render('register', [
                    'model' => $model,
                ]); 
            }
        }
        else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
        
        /*return $this->render('register', [
            //'model' => $model
        ]);*/
    }
}
