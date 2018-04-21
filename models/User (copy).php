<?php

namespace app\models;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "user_master".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $mobile_number
 * @property string $gender
 * @property integer $dob
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $zipcode
 * @property string $image
 * @property string $facebook_id
 * @property string $facebook_image
 * @property string $google_id
 * @property string $google_image
 * @property string $user_type
 * @property string $is_verified
 * @property string $is_deleted
 * @property integer $i_by
 * @property integer $i_date
 * @property integer $u_by
 * @property integer $u_date
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
    public $PasswordConfirm;
    public $old_password;
    public $full_image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'],'required','on'=>['forgotpassword']],
            [['password','PasswordConfirm'],'required' ,'on'=>['admin','resetpassword']],
            [['PasswordConfirm'], 'compare', 'compareAttribute' => 'password'],
            [['gender', 'user_type', 'accepted_terms', 'quiz_start', 'quiz_complete', 'is_verified', 'is_deleted'], 'string'],
            [['forgot_password_token_timeout', 'role', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            [['user_type'], 'required'],
            [['dob'], 'safe'],
            [['first_name', 'last_name', 'username', 'email', 'password', 'mobile_number', 'phone_type', 'address', 'city', 'country', 'zipcode', 'latitude', 'longitude', 'work_from_city', 'tasker_type', 'hour_per_week', 'working_area', 'image', 'right_person_for_job', 'when_not_tasking', 'tasking_make_sure', 'have_vehicle', 'vehicle_type', 'notify_task_aloted', 'notify_amount_received', 'notify_task_cancelled', 'notify_task_accept', 'notify_task_update', 'notify_tasker_message', 'notify_amount_deducted', 'notify_task_completed', 'facebook_id', 'facebook_image', 'google_id', 'google_image', 'forgot_password_token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'mobile_number' => Yii::t('app', 'Mobile Number'),
            'phone_type' => Yii::t('app', 'Phone Type'),
            'gender' => Yii::t('app', 'Gender'),
            'dob' => Yii::t('app', 'Dob'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'zipcode' => Yii::t('app', 'Zipcode'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'work_from_city' => Yii::t('app', 'Work From City'),
            'tasker_type' => Yii::t('app', 'Tasker Type'),
            'image' => Yii::t('app', 'Image'),
            'facebook_id' => Yii::t('app', 'Facebook ID'),
            'facebook_image' => Yii::t('app', 'Facebook Image'),
            'google_id' => Yii::t('app', 'Google ID'),
            'google_image' => Yii::t('app', 'Google Image'),
            'user_type' => Yii::t('app', 'User Type'),
            'is_verified' => Yii::t('app', 'Is Verified'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'i_by' => Yii::t('app', 'I By'),
            'i_date' => Yii::t('app', 'I Date'),
            'u_by' => Yii::t('app', 'U By'),
            'u_date' => Yii::t('app', 'U Date'),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        
        $User = self::find()->where(["id" => $id])->one();
        if (!count($User))
        {
            return null;
        }
        else
        {
            $dbUser = [
                'id' => $User->id,
                'first_name' => $User->first_name,
                'email' => $User->email,
                'password' => $User->password,
                'authKey' => "cronica".$User->id."key",
                'accessToken' => "cronica".$User->id,
            ];
            return new static($dbUser);    
        }
    }


    /**
     * Finds user by name
     *
     * @param  string      $name
     * @return static|null
     */
    public static function findByUsername($name)
    {
        $User = self::find()->where(['email'=>$name,'is_deleted'=>'N'])->one();
        if (!count($User))
        {
            return null;
        }
        else
        {
            $dbUser = [
                'id' => $User->id,
                'first_name' => $User->first_name,
                'email' => $User->email,
                'password' => $User->password,
                'authKey' => "cronica".$User->id."key",
                'accessToken' => "cronica".$User->id,
            ];
            return new static($dbUser);    
        }
    }
    
    // find by successfully social logged in  user
    public static function findBySociallyLoggedInUser($User)
    {
        $dbUser = [
            'id' => $User->id,
            'first_name' => $User->first_name,
            'email' => $User->email,
            'password' => $User->password,
            'authKey' => "cronica".$User->id."key",
            'accessToken' => "cronica".$User->id,
        ];

        return new static($dbUser);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
