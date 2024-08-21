<?php

namespace app\controllers;
use app\models\Users;
use Yii;
class LoginController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Users;
        if ($model->load(Yii::$app->request->post())){
            $request = Yii::$app->request->post('Users');
            $username = $request['user_name'];
            $password = $request['password'];

            // echo $username;exit;
            if ($model-> Login($username,$password)== true){
                // echo 'Đăng nhập thành công';
                Yii::$app->session->setFlash('LoginOK');
            }
            else{
                Yii::$app->session->setFlash('LoginFalse');
                // $this-> redirect(Yii::$app->request->referrer);
                
            }
        }
        return $this->render('index',['model'=>$model]);
    }

}
