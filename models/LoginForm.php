<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rememberMe;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        
        return [
            // email_id and password are both required
            [['email'],'email'],
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //echo '<pre>';print_r($user);die;
            
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('user_id', 'Incorrect email id or password.');
            }
            //print_r($user); die;
        }
    }

    /**
     * Logs in a user using the provided email_id and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe=='1' ? 3600*24*30 : 0); //, $this->rememberMe ? 3600*24*30 : 0
        } else {
            return false;
        }
    }
    
    public function login_socially_logged_in_user($User)
    {
        $dbUser = User::findBySociallyLoggedInUser($User);
        if(Yii::$app->user->login($dbUser))
            return true;
        else
            return false;
    }

    /**
     * Finds user by [[email_id]]
     *
     * @return User|null
     */
    public function getUser()
    {
        //var_dump($this->_user); die;
        if ($this->_user === false)
        {
            $this->_user = User::findByUsername($this->email);
        }
        //print_r($this->_user); die;
        return $this->_user;
    }
}