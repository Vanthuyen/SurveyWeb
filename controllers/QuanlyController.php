<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\Users;

class QuanlyController extends Controller{

    public function actionUsers(){

        $users = new Users;
        
        $table_users = $users->get_All_users();
        // var_dump($table_users);exit;
        $one_users = $users->get_Users(2); 
        return $this-> render('index',['user'=>$table_users,'one'=>$one_users]);
    }
}