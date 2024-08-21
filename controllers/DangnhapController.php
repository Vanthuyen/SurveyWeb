<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\DangnnhapForm;

class DangnhapController extends Controller
{
    public function actionLogin()
    {
        $model = new DangnnhapForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index']);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    // Other actions...
}

