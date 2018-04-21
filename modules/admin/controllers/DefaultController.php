<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\web\Session;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\LoginForm;
use app\models\User;

class DefaultController extends Controller
{
    public $defaultAction = 'login';
    
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
    
    public function actionIndex()
    {
        $this->layout = '//dashboard';
        return $this->render('index');
    }
    
    public function actionLogin()
    {
        $this->layout = '//login';
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['default/index']);
        }
        
        $model = new LoginForm();
        $user = new User();
        $user1 = new User();
        
        //var_dump($model->login()); die;
        if($model->load(Yii::$app->request->post()) && $model->login())
        {
            
            /*if(isset($_POST['LoginForm']['rememberMe']) && $_POST['LoginForm']['rememberMe'] =="1")
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

            }*/
            return $this->redirect(['default/index']);
        } else {
            if($model->load(Yii::$app->request->post()))
            {
                $msg = "Email address or password are wrong";
                $flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                \Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
            }
            return $this->render('login', [
                'model' => $model,
                'user'=>$user,
                'user1'=>$user1,
            ]);
        }
    }
    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        return $this->redirect(['login']);
    }
    public function actionForgotpassword()
    {
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
            $post = User::find()->where(['email'=>$params['User']['email']])->one();
            if(isset($post->id))
            {
                // set forgot password token, which will passed in url
                $random_str = time().rand(10000,99999);
                $post->forgot_password_token = md5($random_str);
                $post->forgot_password_token_timeout = time();
                
                if($post->save(false))
                {
                    Yii::$app->mailer->compose('@app/mail/layouts/forgotpassword', [
                            'username' => $post->first_name,
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
        return $this->redirect(['login']);
    }
}
