<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Nguoidung;
use app\models\Sinhvien;
use app\models\Khaosathocphan;
use app\models\Capnhatkhaosat;
use app\models\Cauhoi;
use app\models\TaoKhaoSat;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\Lophoc;
use app\models\Namhoc;
use yii\helpers\ArrayHelper;

class AdminController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view-surveys'],
                'rules' => [
                    [
                        'actions' => ['index', 'view-surveys'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionCreateStudent()
    {
        $nguoidungModel = new Nguoidung();
        $sinhvienModel = new Sinhvien();

        if ($nguoidungModel->load(Yii::$app->request->post()) && $sinhvienModel->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Hash the password
                $nguoidungModel->Password = Yii::$app->security->generatePasswordHash($nguoidungModel->Password);
                $nguoidungModel->isAdmin = 0; 

                if ($nguoidungModel->save()) {
                    // Set the Userid in the Sinhvien model
                    $sinhvienModel->Userid = $nguoidungModel->Userid;

                    if ($sinhvienModel->save()) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Student account created successfully.');
                        return $this->redirect(['admin/index']);
                    } else {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Error saving student information: ' . json_encode($sinhvienModel->errors));
                    }
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Error saving user information: ' . json_encode($nguoidungModel->errors));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Transaction error: ' . $e->getMessage());
                throw $e;
            }
        }

        return $this->render('create-student', [
            'nguoidungModel' => $nguoidungModel,
            'sinhvienModel' => $sinhvienModel,
        ]);
    }


    
    public function actionCreateCourseSurvey()
    {
        
        $model = new TaoKhaoSat();

        if ($model->load(Yii::$app->request->post())) {
            // $year_seme = get_object_vars ( $model );
            // Yii::debug($year_seme);

            if ($model->validate()) {
                Yii::info('Model validated successfully');
                    // Yii::$app->session->setFlash('info', 'Infor ' . json_encode($model));
                if ($model->saveSurvey()) {
                    Yii::$app->session->setFlash('success', 'Survey created successfully.');
                    return $this->redirect(['admin/index']);
                } else {
                    Yii::error('Failed to save survey');
                    Yii::$app->session->setFlash('error', 'Failed to create survey.');
                }
            } else {
                Yii::error('Validation errors: ' . json_encode($model->getErrors()));
            }
        } else {
            Yii::info('POST data not loaded into the model');
            // Yii::$app->session->setFlash('error', 'POST data not loaded into the model ' . json_encode($model->getErrors()));
        }

        return $this->render('create-course-survey', [
            'model' => $model,
        ]);
    }

    public function actionViewSurveys()
    {
        $query = Khaosathocphan::find()
            ->joinWith('lhp')
            ->joinWith('lhp.hp')
            ->joinWith('lhp.namhoc')
            ->orderBy(['Ksid' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view-surveys', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }
    
    public function actionUpdate($id)
    {
        $survey = $this->findModel($id);
        $model = new Capnhatkhaosat();
    
        // Populate form model with survey data
        $model->Ksid = $survey->Ksid;
        $model->Hpid = $survey->lhp->hp->Hpid;
        $model->LHPid = $survey->LHPid;
        $model->Qid = $survey->Qid;
        $model->Namid = $survey->lhp->namhoc->Namid;
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $survey->LHPid = $model->LHPid;
            $survey->Qid = $model->Qid;
            $survey->lhp->namhoc->Namid = $model->Namid;
            // $survey->Namid = $model->Namid;
    
            if ($survey->save()) {
                Yii::$app->session->setFlash('success', 'Survey updated successfully.');
                return $this->redirect(['view-surveys']);
            }
        }
    
        return $this->render('update', [
            'model' => $model
        ]); 
        // $model = $this->findModel($id);
        // $KsModel = $model->lhp->namhoc;
        // if ($model->load(Yii::$app->request->post())) {
        //     if ($model->save()){
        //         Yii::$app->session->setFlash('success', 'Survey updated successfully.');
        //         return $this->redirect(['view', 'id' => $model->Ksid]);
        //     }else {
        //         Yii::$app->session->setFlash('error', 'Failed to update survey.');
        //     }
        // }

    
        // // Lấy dữ liệu cần thiết cho dropdown list
        // $taoKhaoSatModel = new TaoKhaoSat();
        // $taoKhaoSatModel->Hpid = $model->Hpid;
        // $taoKhaoSatModel->LHPid = $model->LHPid;
        // $taoKhaoSatModel->Qid = $model->Qid;
        // // $taoKhaoSatModel->Q_type = $model->Q_type;
        // // $taoKhaoSatModel->Namid = $model->Namid; // Hoặc điều chỉnh theo cấu trúc của bạn
        // // $taoKhaoSatModel->HocKy = $model->HocKy;
    
        // return $this->render('update', [
        //     'model' => $model,
        //     'KsModel' => $KsModel
        // ]);
    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
    
        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        if (($model = Khaosathocphan::findOne($id)) !== null) {
            return $model;
        }
    
        throw new NotFoundHttpException('Khảo sát không tồn tại.');
    }


    public function actionViewStudents()
    {
        $query = Sinhvien::find()
        ->joinWith('nguoidung')
        ->orderBy(['Svid' => SORT_ASC]);

        $dataProvidersv = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view-students', [
            'dataProvidersv' => $dataProvidersv,
        ]);
        // // Lấy danh sách sinh viên từ cơ sở dữ liệu
        // $students = Sinhvien::find()->all();
        
        // // Đếm số lượng sinh viên
        // $studentCount = count($students);

        // // Render view và truyền danh sách sinh viên cùng số lượng
        // return $this->render('view-students', [
        //     'students' => $students,
        //     'studentCount' => $studentCount,
        // ]);


    }
    protected function findModelsv($id)
    {
        if (($modelsv = Sinhvien::findOne($id)) !== null) {
            return $modelsv;
        }
    
        throw new NotFoundHttpException('Sinh viên không tồn tại.');
    }
    
    public function actionViewInfoStudent($id)
    {
        return $this->render('view-info-student', [
            'modelsv' => $this->findModelsv($id)
        ]);
    }


    public function actionUpdateStudent($id)
    {
        $model = $this->findModelsv($id);
        $userModel = $model->nguoidung;

        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post())) {
            if ($model->save() && $userModel->save()) {
                Yii::$app->session->setFlash('success', 'Student updated successfully.');
                return $this->redirect(['view-info-student', 'id' => $model->Svid]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update student.');
            }
        }

        return $this->render('update-student', [
            'model' => $model,
            'userModel' => $userModel,
        ]);
    }

    public function actionDeleteStudent($id)
    {
        $model = $this->findModelsv($id);
        $userModel = $model->nguoidung;

        if ($model->delete() && $userModel->delete()) {
            Yii::$app->session->setFlash('success', 'Student deleted successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to delete student.');
        }

        return $this->redirect(['view-students']);
    }
    // public function actionGetLophocByHocphan($hpid)
    // {
    //     Yii::$app->session->setFlash('infor', 'học phần id' . $hpid);
    //     $lophocList = Lophoc::find()->where(['Hpid' => $hpid])->all();
    //     Yii::$app->session->setFlash('infor', 'lophoc' . json_encode($lophocList));
    //     return \yii\helpers\Json::encode($lophocList);
    // }

    // public function actionGetNamhocByLophoc($lhpid)
    // {
    //     $namhoc = Lophoc::find()->where(['LHPid' => $lhpid])->one()->NamHoc;
    //     Yii::$app->session->setFlash('error', 'POST data not loaded into the model ' . json_encode($model->getErrors()));
    //     return \yii\helpers\Json::encode($namhoc);
    // }  
    public function actionGetLophocByHocphan($hpid)
    {
        $lophocList = Lophoc::find()->where(['Hpid' => $hpid])->all();
        return \yii\helpers\Json::encode($lophocList);

    }
    

    public function actionGetNamhocByLophoc($lhpid)
    {
        $namhoc = Lophoc::find()->where(['LHPid' => $lhpid])->one()->namhoc;
        return \yii\helpers\Json::encode($namhoc);
    }

    // public function actionGetLophocByHp($hpid)
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     $lophocs = Lophoc::find()->where(['Hpid' => $hpid])->all();
    //     return ArrayHelper::map($lophocs, 'LHPid', 'LopHocPhan');
    // }

    // public function actionGetNamhocByLh($lhpid)
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     $lophoc = Lophoc::findOne($lhpid);
    //     $namhoc = Namhoc::findOne($lophoc->Namid);
    //     return [
    //         'Namid' => $namhoc->Namid,
    //         'HocKy' => $namhoc->HocKy,
    //         'NamHoc' => $namhoc->NamHoc
    //     ];
    // }
}

