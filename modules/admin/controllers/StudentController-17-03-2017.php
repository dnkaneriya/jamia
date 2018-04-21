<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Classes;
use app\models\Subclass;
use app\models\Division;
use app\models\Student;
use app\models\TajwidClass;
use app\models\SchoolExam;
use app\models\StudentSearch;
use app\models\Studenteducation;
use app\models\Studenteducationsearch;

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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tajwidClassList = TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']);
        $standardList = SchoolExam::findAll(['is_active' => 'Y', 'is_deleted' => 'N']);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tajwidClassList' => $tajwidClassList,
            'standardList' => $standardList,
        ]);
    }
	
	public function actionSelected()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->selectedstudent(Yii::$app->request->queryParams);

        return $this->render('selected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Shows all closed students
     */
    public function actionClosedStudents()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['closed_student' => 1]);
        
        $tajwidClassList = TajwidClass::findAll(['is_active' => 'Y', 'is_deleted' => 'N']);
        $standardList = SchoolExam::findAll(['is_active' => 'Y', 'is_deleted' => 'N']);
        
//        echo "<pre>";
//        print_r($dataProvider);exit;
        
        return $this->render('closed-students', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tajwidClassList' => $tajwidClassList,
            'standardList' => $standardList,
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
    
    public function actionConfirm()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->confirmedstudent(Yii::$app->request->queryParams);

        return $this->render('confirm', [
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
        $model = $this->findModel($id);
        $searchModel = new Studenteducationsearch();
        $dataProvider = $searchModel->studenteducationsearch(Yii::$app->request->queryParams, $id);
        
        return $this->render('view', [
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }
    
    /**
     * View student Identity card
     * @param type $id
     */
    public function actionStudentIcard($id)
    {
        $student = Student::findOne(['id' => $id]);
        $class = Classes::findOne(['id' => $student->class_id]);
        $class_name = '';
        if(!empty($class) && count($class) > 0) {
            $class_name = $class->name;
        }
        
        $subclass = Subclass::findOne(['id' => $student->sub_class_id]);
        $subclass_name = '';
        if(!empty($subclass) && count($subclass) > 0) {
            $subclass_name = $subclass->sub_class;
        }
        
        $division = Division::findOne(['id' => $student->divison_id]);
        $division_name = '';
        if(!empty($division) && count($division) > 0) {
            $division_name = $division->division;
        }
        
        $dob = date("d/m/Y", strtotime($student->dob));
        return $this->render('student-icard', [
            'student' => $student,
            'class_name' => $class_name,
            'subclass_name' => $subclass_name,
            'division_name' => $division_name,
            'dob' => $dob,
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
                $model->amount = '';
            }else{
                $model->fees = 'Y';
                $model->amount = $params['Student']['amount'];
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
//            $model->grno = '';
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
                $model->amount = '';
            }else{
                $model->fees = 'Y';
                $model->amount = $params['Student']['amount'];
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
                
                /*if($params['Student']['is_selected'] == 'Y'){
                    Yii::$app->mailer->compose()
                    ->setTo($params['Student']['email'])
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setSubject(Yii::$app->params['apptitle'].' : Jamiah Student Selection')
                    ->setTextBody("You are selected.")
                    ->send();
                }*/
                
                $date = $params['Student']['dob_dd'];
                $month = $params['Student']['dob_mm'];
                $year = $params['Student']['dob_yy'];
                $dob = $month.'/'.$date.'/'.$year;
                
                $model->dob = strtotime($dob);
                $model->is_continue = 'P';
                //$model->is_selected = 'P';
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
    
    /*public function actionSelected()
    {
        $str = $_REQUEST['str'];
        $series = $_REQUEST['series'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->grno = $series;
			$model->is_selected = 'Y';
			$model->save();
			$series+=1;
            if($model->email != ''){
                Yii::$app->mailer->compose()
						->setTo($model->email)
						->setFrom(Yii::$app->params['adminEmail'])
						->setSubject(Yii::$app->params['apptitle'].' : Jamiah Student Selection')
						->setTextBody("You are selected.")
						->send();
			}
            //$model->save();
            if($model->mobile_no != ''){
                $username = 'muhammadzishanshaikh@yahoo.in';
                $hash = 'e11a14551e58798c8f3de11cf533f093a122bbef';
                
                // Message details
                //$numbers = array(919712448227);
                $numbers = $model->mobile_no;
                $sender = urlencode('TXTLCL');
                $message = rawurlencode('You are selected.');
                //echo "<pre>";print_r($numbers);
                //$numbers = implode(',', $numbers);
                
                // Prepare data for POST request
                $data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message, "test" => true);
             
                // Send the POST request with cURL
                $ch = curl_init('http://api.textlocal.in/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                //echo "<pre>";print_r($response);
                curl_close($ch);
            }
		}
        //die;
		$msg = 'Student selected successfully!!';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        $this->redirect(['pending']);
    }*/
    
    public function actionSelectedstudent()
    {
        $str = $_REQUEST['str'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->is_selected = 'Y';
			$model->save();
			/*if($model->email != ''){
                Yii::$app->mailer->compose()
						->setTo($model->email)
						->setFrom(Yii::$app->params['adminEmail'])
						->setSubject(Yii::$app->params['apptitle'].' : Jamiah Student Selection')
						->setTextBody("You are selected.")
						->send();
			}
            //$model->save();
            if($model->mobile_no != ''){
                $username = 'muhammadzishanshaikh@yahoo.in';
                $hash = 'e11a14551e58798c8f3de11cf533f093a122bbef';
                
                // Message details
                //$numbers = array(919712448227);
                $numbers = $model->mobile_no;
                $sender = urlencode('TXTLCL');
                $message = rawurlencode('You are selected.');
                //echo "<pre>";print_r($numbers);
                //$numbers = implode(',', $numbers);
                
                // Prepare data for POST request
                $data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message, "test" => true);
             
                // Send the POST request with cURL
                $ch = curl_init('http://api.textlocal.in/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                //echo "<pre>";print_r($response);
                curl_close($ch);
            }*/
		}
        //die;
		$msg = 'Student selected successfully!!';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        $this->redirect(['pending']);
    }
    
    public function actionAllocategr()
    {
        $str = $_REQUEST['str'];
        $series = $_REQUEST['series'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->grno = $series;
			$model->is_selected = 'C';
			$model->save();
			$series+=1;
            //$model->save();
        }
        //die;
		$msg = 'GR No. allocated to students!!';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        $this->redirect(['index']);
    }
    
	public function actionAllocatedivision()
    {
        $str = $_REQUEST['str'];
        $division = $_REQUEST['division'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->divison_id = $division;
			$model->save();
        }
        //die;
		$msg = 'Division allocated';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        die;
    }

    public function actionAllocatesubclass()
    {
        $str = $_REQUEST['str'];
        $subclass = $_REQUEST['subclass'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->sub_class_id = $subclass;
			$model->save();
        }
        //die;
		$msg = 'Subclass allocated';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        die;
    }
    
    public function actionAllocatetajwidclass()
    {
        $str = $_REQUEST['str'];
        $tajwidclass = $_REQUEST['tajwidclass'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->tajwid_class = $tajwidclass;
			$model->save();
        }
        //die;
		$msg = 'Tajwid class allocated';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        die;
    }
    
    public function actionAllocatestandard()
    {
        $str = $_REQUEST['str'];
        $standard = $_REQUEST['standard'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
			$model->school_standard = $standard;
			$model->save();
        }
        //die;
		$msg = 'standard allocated';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        die;
    }
    
    public function actionStudentcerti()
    {
        $str = $_REQUEST['str'];
        $certi = $_REQUEST['certi'];
        $strvalues = explode(",",$str);
		foreach($strvalues as $value){
			$model = Student::find()->where(['id'=>$value])->one();
                        if($certi == 'hafiz') {
                            $model->hafiz_student = 1;
                        } else if($certi == 'aalim') {
                            $model->aalim_student = 1;
                        } else if($certi == 'close') {
                            $model->closed_student = 1;
                        }
			$model->save();
        }
        //die;
		$msg = 'Student Closed';
		$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
		\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        die;
    }
	
    public function actionExport()
    {
        $str = $_REQUEST['str'];
        $redirect = $_REQUEST['redirect'];
        
        $output = "";
		$query=Student::find()->where(['is_deleted'=>'N']);
        if($str){
            $query->andWhere('id IN('.$str.')');
        }
		if($redirect == 'pending')
			$query->andWhere(['is_selected'=>'P']);
		else if($redirect == 'selected')
			$query->andWhere(['is_selected'=>'Y']);
		else
			$query->andWhere(['is_selected'=>'C']);
		
		$students=$query->all();

		if($redirect == 'pending' || $redirect == 'selected')
        	$output .= '"Sr.No","Registration Status","How Old","Name","Street","Taluka","City","District","Pincode","State","Date of Birth","Mobile No. 1","Mobile No. 2","Fees","Amount","Registration Date","Email","Mother Name","Father Name","Grandfather Name","Parent Occupation","Parent Income","Class","Blood Group","Madrasa Name","Nazra","Nazra Para","Hifz","Hifz Para","Arabic","Urdu","School Name","Standard","Medium","Grade"';
		else
			$output .= '"Sr.No","GR No","Registration Status","How Old","Name","Street","Taluka","City","District","Pincode","State","Date of Birth","Mobile No. 1","Mobile No. 2","Fees","Amount","Registration Date","Email","Mother Name","Father Name","Grandfather Name","Parent Occupation","Parent Income","Class","Blood Group","Madrasa Name","Nazra","Nazra Para","Hifz","Hifz Para","Arabic","Urdu","School Name","Standard","Medium","Grade"';
        
        $output .="\n";
        $i = 1;
        foreach($students as $val)
        {
            $name = $val->surname_en.' '.$val->firstname_en.' '.$val->lastname_en;
			if($val->grno != '')
				$grno=$val->grno;
            $state = Yii::$app->params['indian_all_states'][$val->state];
			if($val->fees == 'Y') $fees='Yes'; else $fees='No';
			if($val->register_status == 'N') $register_status='New'; else $register_status='Old';
			if($val->how_old != '') $how_old=$val->how_old.' Year'; else $how_old='';			
            $division = Division::find()->where(['id'=>$val->divison_id])->one();
            if($division){
                $divisionName = $division->division;
            }else{
                $divisionName = '';
            }
            
            $subclass = Subclass::find()->where(['id'=>$val->sub_class_id])->one();
            if($subclass){
                $subclassName = $subclass->sub_class;
            }else{
                $subclassName = '';
            }
            
            $class = Classes::find()->where(['id'=>$val->class_id])->one();
            if($class){
                $className = $class->name;
            }else{
                $className = '';
            }
            
            $education = Studenteducation::find()->where(['student_id'=>$val->id])->one();
            if($education){
                $madrasaName = $education->madrasa_name;
                if($education->nazra == 'Y'){
                    $nazra = 'Yes';
                    $nazra_para = $education->nazra_para;
                }else{
                    $nazra = 'No';
                    $nazra_para = '';
                }
                if($education->hifz == 'Y'){
                    $hifz = 'Yes';
                    $hifz_para = $education->hifz_para;
                }else{
                    $hifz = 'No';
                    $hifz_para = '';
                }
                if($education->arabic == 'Y'){
                    $arabic = 'Yes';
                }else{
                    $arabic = 'No';
                }
                if($education->urdu == 'Y'){
                    $urdu = 'Yes';
                }else{
                    $urdu = 'No';
                }
                $schoolName = $education->school_name;
                $standard = $education->school_standard;
                if($education->school_medium == 'U'){
                    $medium = 'Urdu';
                }elseif($education->school_medium == 'E'){
                    $medium = 'English';
                }elseif($education->school_medium == 'H'){
                    $medium = 'Hindi';
                }elseif($education->school_medium == 'O'){
                    $medium = 'Other';
                }
                $grade = $education->grade;
            }else{
                $madrasaName = '';
                $nazra = '';
                $nazra_para = '';
                $hifz = '';
                $hifz_para = '';
                $arabic = '';
                $urdu = '';
                $schoolName = '';
                $standard = '';
                $medium = '';
                $grade = '';
            }
            if($redirect == 'pending' || $redirect == 'selected')
	            $output .='"'.$i.'","'.$register_status.'","'.$how_old.'","'.$name.'","'.$val->street.'","'.$val->taluka.'","'.$val->city.'","'.$val->district.'","'.$val->pincode.'","'.$state.'","'.date('d M Y', $val->dob).'","'.$val->mobile_no.'","'.$val->parent_mobile.'","'.$fees.'","'.$val->amount.'","'.date('d M Y', $val->i_date).'","'.$val->email.'","'.$val->mother_name.'","'.$val->father_name.'","'.$val->grandfather_name.'","'.$val->parent_occupation.'","'.$val->parent_income.'","'.$className.'","'.$val->bloodgroup.'","'.$madrasaName.'","'.$nazra.'","'.$nazra_para.'","'.$hifz.'","'.$hifz_para.'","'.$arabic.'","'.$urdu.'","'.$schoolName.'","'.$standard.'","'.$medium.'","'.$grade.'"';
			else
	            $output .='"'.$i.'","'.$grno.'","'.$register_status.'","'.$how_old.'","'.$name.'","'.$val->street.'","'.$val->taluka.'","'.$val->city.'","'.$val->district.'","'.$val->pincode.'","'.$state.'","'.date('d M Y', $val->dob).'","'.$val->mobile_no.'","'.$val->parent_mobile.'","'.$fees.'","'.$val->amount.'","'.date('d M Y', $val->i_date).'","'.$val->email.'","'.$val->mother_name.'","'.$val->father_name.'","'.$val->grandfather_name.'","'.$val->parent_occupation.'","'.$val->parent_income.'","'.$className.'","'.$val->bloodgroup.'","'.$madrasaName.'","'.$nazra.'","'.$nazra_para.'","'.$hifz.'","'.$hifz_para.'","'.$arabic.'","'.$urdu.'","'.$schoolName.'","'.$standard.'","'.$medium.'","'.$grade.'"';
            
            $output .="\n";
            $i++;
        }
        $filename = date('d-m-Y')."-student.csv";
        
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        
        echo $output;
        exit;
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
