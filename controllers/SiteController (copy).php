<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\LoginForm;
use app\models\User;
use yii\web\Session;
use yii\widgets\ActiveForm;
use app\models\Contactus;
use app\models\Videosearch;
use app\models\Video;
use app\models\Blog;

class SiteController extends Controller
{
    public $layout="//web-default";
    //public $enableCsrfValidation = false;
    //public function behaviors()
    //{
    //     return [
    //        'access' => [
    //            'class' => AccessControl::className(),
    //            'only' => ['index','logout','timezone'],
    //            'rules' => [
    //                [
    //                    'actions' => ['index','logout','timezone'],
    //                    'allow' => true,
    //                    'roles' => ['@'],
    //                ],
    //            ],
    //        ],
    //        'verbs' => [
    //            'class' => VerbFilter::className(),
    //            'actions' => [
    //                //'delete' => ['post'],
    //            ],
    //        ],
    //    ];
    //}
    
    
    public function actions()
    {
        return [
            //'error' => [
            //    'class' => 'yii\web\ErrorAction',
            //],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
     public function actionError()
     {
        $exception = Yii::$app->errorHandler->exception;
        if(Yii::$app->user->identity->user_type == 'A')
        {
            $flash_msg = \Yii::$app->params['msg_error'].' '.$exception->getMessage().\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            return $this->redirect(['admin/default/index']);
        }
        elseif(Yii::$app->user->identity->user_type == 'T')
        {
            //$flash_msg = \Yii::$app->params['msg_error'].' '.$exception->getMessage().\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $exception->getMessage());
            return $this->redirect(['/']);
        }
        elseif(Yii::$app->user->identity->user_type == 'P')
        {
            //$flash_msg = \Yii::$app->params['msg_error'].' '.$exception->getMessage().\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $exception->getMessage());
            return $this->redirect(['/']);
        }
        else{
            Yii::$app->user->logout(false);
            return $this->redirect(['index']);
        }
        //Yii::$app->user->logout(false);
        //return $this->redirect(['login']);
     }
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionMitos()
    {
        return $this->render('mitos');
    }
    public function actionSintomas()
    {
        return $this->render('sintomas');
    }
    public function actionTratamentos()
    {
        return $this->render('Tratamentos');
    }
    public function actionVideos()
    {
        $searchModel = new Videosearch();
        $dataProvider = $searchModel->front(Yii::$app->request->queryParams);

        return $this->render('videos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionVideo_play()
    {
        //print_r($_REQUEST);die;
        if(!Yii::$app->request->isAjax)
            throw new NotFoundHttpException('The requested page does not exist.');
        
        $id = $_REQUEST['id'];
        
        $model = Video::find()->where(['id'=>$id])->one();
        
        $str = $this->renderPartial('_video', ['model'=>$model]);
        echo $str;
        die;
    }
    public function actionImprensa()
    {
        return $this->render('imprensa');
    }
    
    public function actionWorks()
    {
        return $this->render('works');
    }
    
    /*
     * Verify Email ID
     */
    public function actionEmailverification()
    {
        $this->layout = 'emailverification';
        $data = array();
        if(isset($_REQUEST['args']) && $_REQUEST['args'] != null)
        {
            $data = User::find()->where(['md5(id)'=>$_REQUEST['args']])->andwhere(['user_type'=>'U'])->one();
            if($data)
            {
                if($data->email_verified == 'Y')
                {
                    $flash_msg = \Yii::$app->params['msg_success'].' '.Yii::$app->params['already_verified_user'].\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                }
                else
                if($data->email_verified  == 'N')
                {
                    $data->email_verified  = 'Y';
                    if($data->save())
                    {
                        $flash_msg = \Yii::$app->params['msg_success'].Yii::$app->params['email_successfully_verified'].\Yii::$app->params['msg_end'];
                        Yii::$app->mycomponent->sendwelcomeemail($data->email,$data->name);
                        \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    }
                    else
                    {
                        $flash_msg = \Yii::$app->params['msg_error'].' '.Yii::$app->params['something_going_wrong'].\Yii::$app->params['msg_end'];
                        \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    }
                }
                else
                {
                    $flash_msg = \Yii::$app->params['msg_error'].' '.Yii::$app->params['something_going_wrong'].\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                }
            }
            else
            {
                $flash_msg = \Yii::$app->params['msg_error'].' '.Yii::$app->params['something_going_wrong'].\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);    
            }
        }
        else
        {
            $flash_msg = \Yii::$app->params['msg_error'].' '.Yii::$app->params['something_going_wrong'].\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
        }
        return $this->render('emailverification');
    }
    
    /*
     * Verify Email ID
     */
    public function actionAcknowledgement()
    {
        $this->layout = 'emailverification';
        return $this->render('acknowledgement');
    }
    
    public function actionEmailverified()
    {
        $this->layout = 'emailverification';
        return $this->render('emailverified');
    }
    
    /*
     * Reset password request
     */
    public function actionResetpassword()
    {
        if(isset($_REQUEST['args']) && $_REQUEST['args'] != null)
        {
            //echo $_REQUEST['args'];die;
            $data = User::find()->where(['forgot_password_token'=>$_REQUEST['args'],'is_deleted'=>'N'])->one();
            
            if(!$data)
            {
                $msg = Yii::$app->params['error_forgot_password_link_expired'];
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                return $this->redirect('acknowledgement');
            }
            
            $oldmodel = $data;
            $data->scenario='resetpassword';
            $data->password= "";
            
             if (Yii::$app->request->isAjax && $data->load(Yii::$app->request->post())) {
                echo  json_encode(ActiveForm::validate($data));
                die;
            }
            //print_r($data);die;
            if($data)
            {
                //echo $data->forgot_password_token_timeout
                if($data->forgot_password_token_timeout == '' || $data->forgot_password_token_timeout+(60*60) < time())
                {
                    
                    $msg = Yii::$app->params['error_forgot_password_link_expired'];
                    $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    return $this->redirect('acknowledgement');
                }
                else
                {
                    
                    $this->layout='login';
                    if(isset($_POST['User']) && $_POST['User']!=array())
                    {
                        if(isset($_POST['User']['password'])&& $_POST['User']['password']!=null)
                        {
                            $data->password=md5($_POST['User']['password']);
                            //$data->PasswordConfirm=md5($_POST['User']['PasswordConfirm']);
                        }
                        else
                        {
                            $data->password=$oldmodel->password;
                        }
                        $data->forgot_password_token = null;
                        $data->forgot_password_token_timeout = null;
                       $data->u_date=time();
                       if($data->save(false))
                       {
                            //return $this->render('resetpassword',['model'=>$model]);
                            $msg = 'Password has been successfully changed.';
                            $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                            return $this->redirect('acknowledgement');
                       }
                       else
                       {
                            $msg = 'Something went wrong please try again.';
                            $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                            return $this->render('acknowledgement');
                       }
                    }
                    else
                        return $this->render('resetpassword',['model'=>$data]);
                }
            }
            else
            {
                $msg = Yii::$app->params['error_forgot_password_link_expired'];
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                return $this->redirect('acknowledgement');
            }
        }
        else
        {
            $msg = 'No such data found.';
            $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
            \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            return $this->redirect('acknowledgement');
        }
        
    }
    
    
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $params = Yii::$app->request->post();
        $model = new LoginForm();
        $user = new User();
        $user1 = new User();
        
        if(isset($params['facebookid']) && $params['facebookid'] != '')
        {
            $type = array('P','T');
            $exist = User::find()->where(['user_type'=>$type,'is_deleted'=>'N','facebook_id'=>$params['facebookid']])->one();
            if($exist != array())
            {
                $model->login_socially_logged_in_user($exist);
                return $this->redirect(['user/dashboard']);
            }else{
                $msg = "You have to register with facebook first.";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('login_msg', $flash_msg);
                return $this->redirect(['index']);
            }
        }
        elseif(isset($params['googleid']) && $params['googleid'] != '')
        {
            $type = array('P','T');
            $exist = User::find()->where(['user_type'=>$type,'is_deleted'=>'N','google_id'=>$params['googleid']])->one();
            if($exist != array())
            {
                $model->login_socially_logged_in_user($exist);
                return $this->redirect(['user/dashboard']);
            }else{
                $msg = "You have to register with google first.";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('login_msg', $flash_msg);
                return $this->redirect(['index']);
            }
        }
        elseif($model->load(Yii::$app->request->post()) && $model->login())
        {
            if(isset($_POST['LoginForm']['rememberMe']) && $_POST['LoginForm']['rememberMe'] =="1")
            {
                $cookies = Yii::$app->response->cookies;
                // add a new cookie to the response to be sent
                
                $no = rand(1,9);
                
                $v1 = $_POST['LoginForm']['email'];
                $v2 = $_POST['LoginForm']['password'];
                
                for($i=1;$i<=$no;$i++){
                    $v1 = base64_encode($v1);
                    $v2 = base64_encode($v2);
                }
                
                $cookies->add(new \yii\web\Cookie([
                    'name' => Yii::$app->params['appcookiename'].'email',
                    'value' => $v1,
                ]));
                
                $cookies->add(new \yii\web\Cookie([
                    'name' => Yii::$app->params['appcookiename'].'password',
                    'value' => $v2,
                ]));
                
                $cookies->add(new \yii\web\Cookie([
                    'name' => Yii::$app->params['appcookiename'].'turns',
                    'value' => $no,
                ]));
            }else{
                $cookies = Yii::$app->response->cookies;
                $cookies->remove(Yii::$app->params['appcookiename'].'email');
                unset($cookies[Yii::$app->params['appcookiename'].'email']);
                 $cookies->remove(Yii::$app->params['appcookiename'].'password');
                unset($cookies[Yii::$app->params['appcookiename'].'password']);
                $cookies->remove(Yii::$app->params['appcookiename'].'turns');
                unset($cookies[Yii::$app->params['appcookiename'].'turns']);

            }
            return $this->redirect(['user/dashboard']);
        }else{
            if($model->load(Yii::$app->request->post()))
            {
                $msg = "Email address or password are wrong";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                //\Yii::$app->getSession()->setFlash('flash_msg', $msg);
                \Yii::$app->getSession()->setFlash('login_msg', $flash_msg);
            }
            return $this->redirect(['index']);
        }
    }
    
    public function actionSignup()
    {
        $user = new User();
        if($user->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            if(isset($params['facebookid']) && $params['facebookid'] != '')
            {
                $type = array('P','T');
                $exist = User::find()->where(['user_type'=>$type,'is_deleted'=>'N','facebook_id'=>$params['facebookid']])->one();
                if($exist == array())
                {
                    if(isset($params['firstname']) && $params['firstname'] != '')
                    $user->first_name = $params['firstname'];
                    
                    if(isset($params['lastname']) && $params['lastname'] != '')
                    $user->last_name = $params['lastname'];
                    
                    if(isset($params['username']) && $params['username'] != '')
                    $user->username = $params['username'];
                    
                    //if(isset($params['email']) && $params['email'] != '')
                    //$user->email = $params['email'];
                    
                    $user->facebook_id = $params['facebookid'];
                    
                    if(isset($params['imageurl']) && $params['imageurl'] != '')
                    $user->facebook_image = $params['imageurl'];
                    
                    $user->user_type = $params['User']['user_type'];
                    
                    $user->is_deleted = 'N';
                    $user->i_date = time();
                    $user->u_date = time();
                    if($user->save(false)){
                        $login = new LoginForm();
                        $login->login_socially_logged_in_user($user);
                        
                        return $this->redirect(['user/dashboard']);
                    }
                }else{
                    if($exist->user_type == $params['User']['user_type'])
                    {
                        $login = new LoginForm();
                        $login->login_socially_logged_in_user($exist);
                        
                        return $this->redirect(['user/dashboard']);
                    
                    }else{
                        $msg = "You have already register as Tasker.";
                        if($exist->user_type == 'P')
                        $msg = "You have already register as Poster.";
                        
                        $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                        //\Yii::$app->getSession()->setFlash('flash_msg', $msg);
                        \Yii::$app->getSession()->setFlash('signup_msg', $flash_msg);
                        
                        return $this->redirect(['index']);
                    }
                    
                }
                
            }elseif(isset($params['googleid']) && $params['googleid'] != '')
            {
                $type = array('P','T');
                $exist = User::find()->where(['user_type'=>$type,'is_deleted'=>'N','google_id'=>$params['googleid']])->one();
                if($exist == array())
                {
                    if(isset($params['firstname']) && $params['firstname'] != '')
                    $user->first_name = $params['firstname'];
                    
                    if(isset($params['lastname']) && $params['lastname'] != '')
                    $user->last_name = $params['lastname'];
                    
                    if(isset($params['username']) && $params['username'] != '')
                    $user->username = $params['username'];
                    
                    //if(isset($params['email']) && $params['email'] != '')
                    //$user->email = $params['email'];
                    
                    $user->google_id = $params['googleid'];
                    
                    if(isset($params['imageurl']) && $params['imageurl'] != '')
                    $user->google_image = str_replace("?sz=50","?sz=550",$params['imageurl']);
                    
                    $user->user_type = $params['User']['user_type'];
                    
                    $user->is_deleted = 'N';
                    $user->i_date = time();
                    $user->u_date = time();
                    if($user->save(false)){
                        
                        $login = new LoginForm();
                        $login->login_socially_logged_in_user($user);
                        
                        return $this->redirect(['user/dashboard']);
                    }
                }else{
                    if($exist->user_type == $params['User']['user_type'])
                    {
                        $login = new LoginForm();
                        $login->login_socially_logged_in_user($exist);
                        
                        return $this->redirect(['user/dashboard']);
                    }else{
                        $msg = "You have already register as Tasker.";
                        if($exist->user_type == 'P')
                        $msg = "You have already register as Poster.";
                        
                        $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                        \Yii::$app->getSession()->setFlash('signup_msg', $flash_msg);
                        return $this->redirect(['index']);
                    }
                }
                
            }else{
                $existEmail = User::find()->where(['is_deleted'=>'N','email'=>$params['User']['email']])->one();
                if(isset($existEmail->email) && $existEmail->email != null){
                    $msg = "Email already exists.";
                    $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('signup_msg', $flash_msg);
                    //\Yii::$app->getSession()->setFlash('flash_msg', $msg);
                    
                    return $this->redirect(['index']); 
                }else{
                    if($user->validate())
                    {
                        $user->password = md5($params['User']['password']);
                    }
                    
                    $user->is_deleted = 'N';
                    $user->i_date = time();
                    $user->u_date = time();
                    if($user->save(false)){
                        $login = new LoginForm();
                        $login->email = $user->email;
                        $login->password = $params['User']['password'];
                        //$login->rememberMe = 1;
                        $login->login();
                        
                        return $this->redirect(['user/dashboard']);
                    }
                }
            }
        }else{
            return $this->redirect(['index']); 
        }
    }
    
    public function actionForgotpassword()
    {
        
        $this->layout = 'login';
        $model = new User();
        //echo "1";die;
        $model->scenario='forgotpassword';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            echo  json_encode(ActiveForm::validate($model));
            die;
        }
        
        if($model->load(Yii::$app->request->post()))
        {
            $params = Yii::$app->request->post();
            $post = User::find()->where(['email'=>$params['User']['email'],'user_type'=>'A','is_deleted'=>'N'])->one();
            if(isset($post->id))
            {
                $post->forgot_password_token = Yii::$app->mycomponent->randomstring('forgot_password_token');
                $post->forgot_password_token_timeout = time();
                
                if($post->save(false))
                {
                    Yii::$app->mailer->compose('@app/mail/layouts/forgotpassword', [
                            'username' => $post->name,
                            'link_token' => $post->forgot_password_token,
                    ])
                    ->setTo($params['User']['email'])
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setSubject(Yii::$app->params['apptitle'].' : Reset Password Request')
                    //->setTextBody("Your new Password is : ".$pass)
                    ->send();
                    $msg = "Password has been sent to your email";
                    $flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                }
                else
                {
                    
                    //print_r($post->getErrors());die;
                    $msg = "Please try again";
                    $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                    \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                    //Yii::$app->getSession()->setFlash('error', 'Failed to send email');
                }
            }
            else
            {
                $msg = "No such email found";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            }
            return $this->redirect(['login']);
        }
    
        return $this->render('forgotpassword',[
                            'model' => $model 
                            ]);
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        
         //Yii::$app->user->identity = Null;
        //print_r(Yii::$app->user); die;
        //print_r(Yii::$app->user->identity); die;
        return $this->redirect(['login']);
    }

    public function actionContact()
    {
        $this->layout="//web-pages";
        $model = new Contactus();
        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->request->post();
            if(isset(Yii::$app->user->id) && Yii::$app->user->id != '')
            $model->user_id = Yii::$app->user->id;
            if($model->validate())
            {
                $model->datetime = time();
                if($model->save(false))
                return $this->refresh();
                
            }else{
               return $this->render('availability', [
                    'model' => $model,
                ]); 
            }
        }else{
            return $this->render('contact',[
                        'model' => $model 
                        ]);
        }
    }
    
    

    public function actionAbout()
    {
        $this->layout="//web-pages";
        return $this->render('about');
    }
}
