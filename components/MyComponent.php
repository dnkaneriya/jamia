<?php

namespace app\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\web\Session;
use app\models\User;
use app\models\Job;

class MyComponent extends Component
{
    
    /* Page and Media Uploads*/
    public function uploadUserImage($image, $uploadDir, $w, $thumbnail_width)
    {
            $imagePath = '';		
            $thumbnailPath = '';
            
            if (trim($image['tmp_name']) != '')
            {
                    $ext = substr(strrchr($image['name'], "."), 1);
                    
                    $imagePath = 'thumb-'.md5(rand() * time()) . ".$ext";
                    
                    list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 
                    
                    $this->createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $w,$height);
            }
            $arr['image'] = $imagePath;
            return $arr;
    }
    public function createThumbnail($srcFile, $destFile, $width, $quality = 90)
    {
            $thumbnail = '';
            
            if (file_exists($srcFile)  && isset($destFile))
            {
                    $size        = getimagesize($srcFile);
                    $w           = number_format($width, 0, ',', '');
                    $h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
                    
                    $thumbnail =  $this->copyImage($srcFile, $destFile, $w, $h, $quality);
            }
            
            // return the thumbnail file name on sucess or blank on fail
            
            return basename($thumbnail);
    }
    
    function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
    {
        $tmpSrc     = pathinfo(strtolower($srcFile));
        $tmpDest    = pathinfo(strtolower($destFile));
        $size       = getimagesize($srcFile);
            
        if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg")
        {
                $destFile  = substr_replace($destFile, 'jpg', -3);
                $dest      = imagecreatetruecolor($w, $h);
                
              // imageantialias($dest, TRUE);
        }
        elseif ($tmpDest['extension'] == "png" || $tmpDest['extension'] == "jpeg")
        {
               $dest = imagecreatetruecolor($w, $h);
               //imageantialias($dest, TRUE);			
        }
        else
        {
              return false;
        }
        
        switch($size[2])
        {
           case 1:       //GIF
               $src = imagecreatefromgif($srcFile);
               break;
           case 2:       //JPEG
               $src = imagecreatefromjpeg($srcFile);
               break;
           case 3:       //PNG
               $src = imagecreatefrompng($srcFile);
               break;
           default:
               return false;
               break;
        }
        
        imagecolortransparent($dest, imagecolorallocatealpha($dest, 0, 0, 0, 127));
        imagealphablending($dest, false);
        imagesavealpha($dest, true);
        imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);
        
        switch($size[2])
        {
           case 1:
           case 2:
               imagejpeg($dest,$destFile, $quality);
               break;
           case 3:
               imagepng($dest,$destFile);
        }
        return $destFile;
    }
    
    public function timestamp_to_date($timestamp=null,$timezone=null,$format=null)
    {
        if($timezone != '')
            date_default_timezone_set($timezone);
        
        if(!$format)
        {
            if(isset(Yii::$app->params['dateformat']) && Yii::$app->params['dateformat'] != null)
                $format = Yii::$app->params['dateformat'];
            else
                $format = 'd-m-Y';
        }
        
        if(isset($timestamp))
        {
            $session = Yii::$app->session;
            if ($session->isActive && $session->get('admintimezone') != '')
            {
                date_default_timezone_set($session->get('admintimezone'));
            }
            //echo $timezone; 
            //if ($timezone != null)
            //{
            //    //echo $timezone; die;
            //    date_default_timezone_set($timezone);
            //}
            
            return date($format,$timestamp);
        }
        else
        {
            return date($format,0);
        }
    }
    
    public function date_to_timestamp($date=null,$format=null)
    {
        if(!$format)
        {
            if(isset(Yii::$app->params['dateformat']) && Yii::$app->params['dateformat'] != null)
                $format = Yii::$app->params['dateformat'];
            else
                $format = 'd-m-Y';
        }
        
        if($date)
        {
            $datetime = DateTime::createFromFormat($format, '10-25-2012 10:10');
            $timestamp = $datetime->getTimestamp();
        }
        else
        {
            $datetime = DateTime::createFromFormat($format, '01-01-1970 00:00');
            $timestamp = $datetime->getTimestamp();
        }
        
        return $timestamp;
    }
    public function timeDiff1($old = 0,$timezone=null)
    {
        if(isset($timezone) && $timezone != null)
        {
            date_default_timezone_set($timezone);
        }
        
        $current = time();
        //$old = 1363164299;
        $difference = $current - $old;
        $years = abs(floor($difference / 31536000));
        $months = abs(floor(($difference-($years * 31536000))/2592000));
        $days = abs(floor(($difference-($years * 31536000))/86400));
        $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
        $mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
        $timeString = "";
        if($years > 0)
        {
            //$timeString = $months > 1 ? $months . " days ago" : $months . " day ago";
            $timeString = $years . "y";
        }
        elseif($months > 0)
        {
            //$timeString = $months > 1 ? $months . " days ago" : $months . " day ago";
            $timeString = $months . "m";
        }
        elseif($days > 0)
        {
            //$timeString = $days > 1 ? $days . " days ago" : $days . " day ago";
             $timeString = $days . "d";
        }
        elseif($hours > 0)
        {
            //$timeString = $hours > 1 ? $hours . " hours ago" : $hours . " hour ago";
             $timeString = $hours . "h";
        }
        elseif($mins > 0)
        {
            //$timeString = $mins > 1 ? $mins . " mins ago" : $mins . " min ago";
            $timeString = $mins . "min";
        }else{
            $timeString = "now";
        }
        return $timeString;
    }
    
    
    public function getuserprofileimage($user,$size=null)
    {
        if($user != array())
        {
            if(isset($user->profile_image) && $user->profile_image != null && $user->profile_image != '')
            {
                if($size == 'thumb' && file_exists(Yii::getAlias('@webroot').'/'.Yii::$app->params['userimage'].'/thumb-'.$user->profile_image))
                    return Url::to('@web/'.Yii::$app->params['userimage'].'/thumb-'.$user->profile_image,true);
                else
                if(file_exists(Yii::getAlias('@webroot').'/'.Yii::$app->params['userimage'].'/'.$user->profile_image))
                    return Url::to('@web/'.Yii::$app->params['userimage'].'/'.$user->profile_image,true);
                else
                    return Url::to('@web/img/user.png',true);
            }
            //else
            //if(isset($user->fb_id) && $user->fb_id != null)
            //{
            //    if($size == 'thumb')
            //        return "https://graph.facebook.com/".$user->fb_id."/picture?type=small";
            //    else
            //        return "https://graph.facebook.com/".$user->fb_id."/picture?type=large";
            //}
            else
            {
                return Url::to('@web/img/user.png',true);
            }
        }
        else
        {
            return Url::to('@web/img/user.png',true);
        }
    }
    
    public function sendsms($number,$content)
    {
        //try
        //{
            if(isset($number) && $number != '' &&
               isset($content) && $content != '')
            {
                //require dirname(__FILE__).'/../vendor/twilio/Services/Twilio.php';
                //Yii::import('application.vendors.twilio.Services.Twilio');
                require Yii::getAlias('@vendor').'/twilio/Services/Twilio.php';
                
                //$account_sid = 'AC99f2dd85bbda2246c9ad2243d693bf96'; 
                //$auth_token = '1a6e0ca9cfc351082e50bc353a6f80c5';
                //$client = new \Lookups_Services_Twilio($account_sid, $auth_token);
                // 
                //$number = $client->phone_numbers->get("+18425114545316151");
                //echo '<pre>'; print_r($number);
                //die;
                
                try {
                    
                $account_sid = 'AC99f2dd85bbda2246c9ad2243d693bf96'; 
                $auth_token = '1a6e0ca9cfc351082e50bc353a6f80c5';
                $client = new \Services_Twilio($account_sid, $auth_token);
                
                $asd = $client->account->messages->create(array(
                        'To' => $number, 
                        'From' => Yii::$app->params['sender_mobile_number'], 
                        'Body' => $content));
                }
                catch (Services_Twilio_RestException $e) {
                    return false;
                    echo $e->getMessage();
                    die;
                }
                //echo '<pre>';
                //print_r($asd); die;
            }
        //}
        //catch(Exception $e)
        //{
        //    
        //}
    }
   
    
    // send welcome email to registered user, using email id and name
    public function sendwelcomeemail($email,$name)
    {
        $content = "Hello $name, <br>Welcome to ".Yii::$app->params['appName'];
        Yii::$app->mailer->compose('@app/mail/layouts/welcomeemail',['content'=>$content])
                 ->setTo($email)
                 ->setFrom(\Yii::$app->params['adminEmail'])
                 ->setSubject('Welcome to '.Yii::$app->params['appName'])
                 //->setHtmlBody("Dear ".$name.", Welcome To Crossfit.")
                 ->send();
        
    }
    
    //for sending pushnotification
    public static function pushnotification_iphone_array($deviceToken, $body)
    {
        try
        {
            if(isset($deviceToken) && $deviceToken != array())
            {
                //$pem_file = Yii::app()->basepath.'/pem/dev_moviereview.pem';//for developer
                if(Yii::$app->params['ios_push_environment'] == 'prod')
                    $pem_file = Yii::app()->basepath.Yii::$app->params['ios_prod_file'];//for live
                else
                    $pem_file = Yii::app()->basepath.Yii::$app->params['ios_dev_file'];//for live
                
                foreach($deviceToken as $key=>$device1)
                {
                    if($device1 != array())
                    {
                        $ctx = stream_context_create();
                        stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_file);
                        
                        if(Yii::$app->params['ios_push_environment'] == 'prod')
                            $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 600, STREAM_CLIENT_CONNECT, $ctx); // for live
                        else
                            $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx); // for developer
                        
                        if (!$fp)
                        {
                            // error
                        }
                        else
                        {
                            foreach($device1 as $key=>$device)
                            {
                                try
                                {
                                    if($device != '')
                                    {
                                        $payload = json_encode($body);
                                        $time = time()+(30*24*60*60);
                                        $msg = chr(0) . $time . pack("n",32) . pack('H*', str_replace(' ', '', $device)) . pack("n",strlen($payload)) . $payload;
                                        fwrite($fp, $msg);
                                    }
                                }
                                catch(Exception $e)
                                {
                                    echo 'Not Sent due to...';
                                    print_r($e); die;
                                }
                            }
                        }
                        fclose($fp);
                    }
                }
            }
        }
        catch(Exception $e)
        {
            echo 'Not Sent due to...';
            print_r($e); die;
        }
    }
   
    public static function pushnotification_android_array($deviceToken,$body)
    {
        if(isset($deviceToken) && $deviceToken != null && $deviceToken != array())
        {
            $url = 'https://android.googleapis.com/gcm/send';
            $serverApiKey = Yii::$app->params['android_server_api_key'];
            
            $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverApiKey
            );
            
            foreach($deviceToken as $key=>$value)
            {
                $data = array(
                       'registration_ids' => $value,
                       'data' => $body
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                if ($headers)
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
                $response = curl_exec($ch);
                curl_close($ch);
            }
        }
    }
    
    
    
    //for sending pushnotification
    public static function pushnotification_iphone($deviceToken, $body)
    {
        //return true;
        try{
            if(isset($deviceToken) && $deviceToken != null)
            {
                //$pem_file = Yii::getAlias('@webroot').'/pem/dev_tracmojo.pem';//for developer
                $pem_file = Yii::getAlias('@webroot').'/pem/dist_tracmojo.pem';//for live
                
                $ctx = stream_context_create();
                stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_file);
                 
                //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx); // for developer
                $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx); // for live
                 
                if (!$fp)
                {
                    // error
                }
                else
                {
                    if(strlen($deviceToken) == 64)
                    {
                        $payload = json_encode($body);
                        $time = time()+(30*24*60*60);
                        $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
                        fwrite($fp, $msg);
                        fclose($fp);
                    }
                }
            }
        }
        catch(Exception $e)
        {
            
        }
    }
    
    public static function pushnotification_android($deviceToken, $body)
    {
        //return true;
        
        if(isset($deviceToken) && $deviceToken != null)
        {
            $url = 'https://android.googleapis.com/gcm/send';
            $serverApiKey = "AIzaSyD-94C1L_7RQrBY71H09A7Ddws2yu4Oy1k";
            
            $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverApiKey
            );
            
            $data = array(
               'registration_ids' => array($deviceToken),
               'data' => $body
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($headers)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
            $response = curl_exec($ch);
            //echo '<pre>';
            //print_r($response); die;
            curl_close($ch);
        }
    }
    
    private function setHeader($status)
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . Yii::$app->params['response_text'][$status];
        $content_type="application/json; charset=utf-8";
        header($status_header);
        header('Content-type: ' . $content_type);
        header('X-Powered-By: ' . "Crossfit");
    }
    
	public function validate_user($value,$encrypted_data)
	{
        $secretkey = Yii::$app->params['encryption_key'];
        $user = hash_hmac('sha256', $value, $secretkey);
        if($user != $encrypted_data)
        {
            $this->setHeader(403);
            echo json_encode(array('code'=>403,'status'=>'error','message'=>utf8_encode(Yii::$app->params['error_user_have_not_access'])));
            die;
        }
        //return $user;
	}
    
   
    public function gettimedifference($time)
    {
        $current = time();
        $difference = $current - $time;
        $years = abs(floor($difference / 31536000));
        $days = abs(floor(($difference-($years * 31536000))/86400));
        $hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
        $mins =  abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
        
        $timeString = "";
        if($days > 0)
        {
            $timeString = $days > 1 ? $days . " days " : $days . " day ";
        }
        elseif($hours > 0)
        {
            $timeString = $hours > 1 ? $hours . " hours " : $hours . " hour ";
        }
        elseif($mins > 0)
        {
            $timeString = $mins > 1 ? $mins . " mins " : $mins . " min ";
        }
        else
        {
            $timeString = $difference > 1 ? $difference . " secs " : $difference . " sec ";
        }
        return $timeString;
    }
    
    public static function get_day_name($timestamp) {
        $date = date('m/d/Y', $timestamp);
        if($date == date('m/d/Y')) {
          $day_name = 'Today';
        } else if($date == date('m/d/Y',time() - (24 * 60 * 60))) {
          $day_name = 'Yesterday';
        }
        else
            $day_name  = $date;
        
        return $day_name;
    }
    
    public function randomstring($id)
    {
        $random_str = time().rand(10000,99999);
        $res = md5($random_str);
        $check = User::find()->where([$id=>$res])->one();
        if($check)
        {
            $code = Yii::$app->mycomponent->randomstring($id);
            return $code;
        }
        return $res;
    }
    
    public function dashboardcount()
    {
        $result['user'] = User::find()->where(['is_deleted'=>'N','user_type'=>'U'])->count();
        //$result['post'] = Post::find()->where(['is_deleted'=>'N'])->count();
        $result['post'] = 0;;
        return $result;
    }
    public function dashboardgraph($t1=0,$t2=0)
    {
        if($t1==0)
        $t1 = strtotime(date("m/d/Y", strtotime("-1 month")));
        if($t2==0)
        $t2 = strtotime(date('m/d/Y'))+86400;
        
        //$t1=0;
        //$t2=time();
        
        $result['newcandidate'] = 0; /*User::find()->where(['is_deleted'=>'N','user_type'=>'C'])->andWhere(['between','i_date',$t1,$t2])->count();*/
        $result['newemployer'] = 0; //User::find()->where(['is_deleted'=>'N','user_type'=>'E'])->andWhere(['between','i_date',$t1,$t2])->count();
        $result['newjob'] = 0;//Job::find()->where(['is_deleted'=>'N'])->andWhere(['between','i_date',$t1,$t2])->count();
        
        $values = array_values($result);
        
        $max = max($values);
        if($max < 100)
        {
            $max = 100;
        }
        $max = ceil($max / 10) * 10;
        $length = $max / 5;
         
        $data[] = array('data'=>$result['newcandidate'],'label'=>"Candidates");
        $data[] = array('data'=>$result['newemployer'],'label'=>"Employers");
        $data[] = array('data'=>$result['newjob'],'label'=>"Jobs");
         
        $m = array('newcandidate'=>"New Candidates",'newemployer'=>"New Employers",'newjob'=>"New Jobs");
        
        $str = '<ul class="y-axis">';
        for($i=5;$i>=1;$i--)
        {
            $str.= '<li><span>'.($i*$length).'</span></li>';
        }
        $str.= '<li><span>0</span></li>';
        $str.= '</ul>';
        //echo $str; die;
        foreach($m as $key=>$value){ 
            $str.= '<div class="bar"><div class="title">'.$value.'</div><div class="value tooltips" data-original-title="'.$result[$key].'" data-toggle="tooltip" data-placement="top" style="height: '.(($result[$key]*100)/$max).'%;"></div></div>';
			}
        $result['html'] = $str;
        $result['data'] = $data;
        return $result;
    }
}


?>