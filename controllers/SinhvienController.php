<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Khaosathocphan;
use app\models\Sinhvien;
use app\models\Cautraloi;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use app\models\SurveySearch;

class SinhvienController extends Controller
{
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }

    public function actionViewSurveys()
    {
        $userId = Yii::$app->user->identity->id;
        $sinhvien = Sinhvien::findOne(['Userid' => $userId]);
        $searchModel = new SurveySearch();
        $dataProviderSearch = $searchModel->search(Yii::$app->request->queryParams);
        $year = Yii::$app->request->get('year');
        $semester = Yii::$app->request->get('semester');
        $year_seme = get_object_vars ( $searchModel );
        //print_r ( $year_seme );
        $year = $year_seme["year"];
        // $semester = $year_seme["semester"];




        if (!$sinhvien) {
            throw new NotFoundHttpException('Sinh viên không tồn tại.');
        }

        $sinhvienId = $sinhvien->Svid;

        $query = Khaosathocphan::find()
            ->joinWith('lhp')
            ->joinWith('lhp.hp')
            ->joinWith('lhp.sinhviens')
            ->joinWith('lhp.namhoc')
            ->where(['sinhvien.Svid' => $sinhvienId]);

        // if ($searchModel->hocKyNamHoc) {
        //     list($namid, $hocKy) = explode('_', $searchModel->hocKyNamHoc);
        //     $query->andFilterWhere(['lhp.Namid' => $namid]);
        //     $query->andFilterWhere(['lhp.HocKy' => $hocKy]);
        // }
        if ($year) {
            $query->andWhere(['namhoc.Namid' => $year]);
        }

        if ($semester) {
            $query->andWhere(['namhoc.Hocky' => $semester]);
        }   

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        

        return $this->render('view-surveys', [
            'searchModel' =>  $searchModel,
            'dataProvider' => $dataProvider,
            'sinhvienId' => $sinhvienId,
            'dataProviderSearch' => $dataProviderSearch,
        ]);
    }

    // public function actionSearchSurveys()
    // {
    //     $searchModel = new SurveySearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('view-surveys', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //         'sinhvienId' => Yii::$app->user->identity->id,
    //     ]);
    // }
    public function actionSurvey($id)
    {
        $survey = Khaosathocphan::findOne($id);

        if (!$survey) {
            throw new NotFoundHttpException('Khảo sát không tồn tại.');
        }

        $fileContent = file_get_contents($survey->q->Q_file);
        $questions = explode("\n", $fileContent);

        if (Yii::$app->request->isPost) {
            $answers = Yii::$app->request->post('answers', []);
            $userId = Yii::$app->user->identity->id;
            $sinhvien = Sinhvien::findOne(['Userid' => $userId]);

            if (!$sinhvien) {
                throw new NotFoundHttpException('Sinh viên không tồn tại.');
            }

            foreach ($answers as $qid => $answer) {
                $answerModel = new Cautraloi();
                $answerModel->Ksid = $id;
                $answerModel->Svid = $sinhvien->Svid;
                $answerModel->Content_Ans = $answer;
                $answerModel->save();
            }

            $survey->TrangThai = 'Completed';
            $survey->save();

            return $this->redirect(['view-surveys']);
        }

        return $this->render('survey', [
            'survey' => $survey,
            'questions' => $questions,
        ]);
    }
}

// namespace app\controllers;

// use Yii;
// use app\models\Khaosathocphan;
// use app\models\Hocphan;
// use app\models\Lophoc;
// use yii\web\Controller;
// use yii\web\ForbiddenHttpException;

// class SinhvienController extends Controller
// {
//     public function actionIndex()
//     {
//         $userId = Yii::$app->user->identity->Userid;
//         $surveyList = Khaosathocphan::find()
//             ->joinWith('hocphan')
//             ->where(['khaosathocphan.Svid' => $userId])
//             ->all();

//         return $this->render('index', [
//             'surveyList' => $surveyList,
//         ]);
//     }
// }
