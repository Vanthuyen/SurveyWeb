<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SurveySearch;
// use app\models\Survey;
use app\models\Khaosathocphan;

class SurveySearchController extends Controller
{
    public function actionViewSurveys()
    {
        $searchModel = new SurveySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sinhvien/view-surveys', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sinhvienId' => Yii::$app->user->identity->id,
        ]);
    }
}
