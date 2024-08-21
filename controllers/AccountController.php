<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Nguoidung;
use app\models\Sinhvien;
use yii\web\Response;

class AccountController extends Controller
{
    public function actionCreate()
    {
        $model = new Nguoidung();
        $sinhVienModel = new Sinhvien();

        if ($model->load(Yii::$app->request->post()) && $sinhVienModel->load(Yii::$app->request->post())) {
            $model->Password = Yii::$app->security->generatePasswordHash($model->Password); // Hash the password
            if ($model->save()) {
                $sinhVienModel->Userid = $model->Userid;
                if ($sinhVienModel->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'sinhVienModel' => $sinhVienModel,
        ]);
    }
}
