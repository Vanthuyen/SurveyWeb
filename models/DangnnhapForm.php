<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class DangnnhapForm extends Model
{
    public $Username;
    public $Password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Password'], 'required'],
            ['Password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates the password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !Yii::$app->security->validatePassword($this->Password, $user->Password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Nguoidung|null
     */
    protected function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Nguoidung::findByUsername($this->Username);
        }

        return $this->_user;
    }
}
