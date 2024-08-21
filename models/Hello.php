<?php

namespace app\models;
use yii\base\Model;


class Hello extends Model{
    public $username;
    public $website;
    public $email;

    public function setUser($user,$web,$email){
        $this-> username = $user;
        $this-> website = $web;
        $this-> email = $email;
    }
    public function getUser(){
        return $this->username.'<br/>'.$this->website.'<br/>'.$this->email;
    }
}