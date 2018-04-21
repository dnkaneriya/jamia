<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_master".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $forgot_password_token
 * @property integer $forgot_password_token_timeout
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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_master';
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
            [['forgot_password_token_timeout', 'role', 'i_by', 'i_date', 'u_by', 'u_date'], 'integer'],
            //[['is_deleted'], 'string'],
            [['email', 'password', 'forgot_password_token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'forgot_password_token' => Yii::t('app', 'Forgot Password Token'),
            'forgot_password_token_timeout' => Yii::t('app', 'Forgot Password Token Timeout'),
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
                'email' => $User->email,
                'password' => $User->password,
                'role' => $User->role,
                'authKey' => "jamiah".$User->id."key",
                'accessToken' => "jamiah".$User->id,
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
        $User = self::find()->where(['email'=>$name])->one();
        if (!count($User))
        {
            return null;
        }
        else
        {
            $dbUser = [
                'id' => $User->id,
                'email' => $User->email,
                'password' => $User->password,
                'authKey' => "jamiah".$User->id."key",
                'accessToken' => "jamiah".$User->id,
            ];
            return new static($dbUser);    
        }
    }
    
    // find by successfully social logged in  user
    public static function findBySociallyLoggedInUser($User)
    {
        $dbUser = [
            'id' => $User->id,
            'email' => $User->email,
            'password' => $User->password,
            'authKey' => "jamiah".$User->id."key",
            'accessToken' => "jamiah".$User->id,
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
