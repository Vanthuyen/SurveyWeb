<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Hocphan;
use app\models\Lophoc;
use app\models\Cauhoi;
use app\models\Namhoc;
use app\models\Khaosathocphan;
/**
 * CreateSurveyForm is the model behind the create survey form.
 */
class TaoKhaoSat extends Model
{
    public $Hpid;
    public $Ksid;
    public $TenHocPhan;
    public $LHPid;
    public $Qid;
    public $Q_type;
    public $Q_file;
    public $Namid;
    public $NamHoc;
    public $HocKy;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'LHPid', 'Qid','Ksid'], 'required'],
            [['Hpid', 'LHPid', 'Qid','Ksid','Namid'], 'integer'],
            [['TenHocPhan', 'Q_type', 'Q_file','NamHoc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Ksid' => 'Mã Khảo sát',
            'Hpid' => 'Học phần',
            'TenHocPhan' => 'Tên học phần',
            'LHPid' => 'Lớp học phần',
            'Qid' => 'Câu hỏi',
            'Q_type' => 'Loại câu hỏi',
            'Q_file' => 'File câu hỏi',
            'Namid' => 'Học kỳ - Năm học',
            'NamHoc'=> 'Năm Học',
            'HocKy' => 'Học kỳ',
        ];
    }

    /**
     * Get list of Hocphan
     */
    public function getHocphanList()
    {
        return Hocphan::find()->all();
    }

    /**
     * Get list of Lophoc
     */
    public function getLophocList()
    {
        return Lophoc::find()->all();
    }

    /**
     * Get list of Cauhoi
     */
    public function getCauhoiList()
    {
        return Cauhoi::find()->all();
    }

    /**
     * Get list of Namhoc
     */
    public function getNamhocList()
    {
        return Namhoc::find()->all();
    }

    public function saveSurvey()
    {
        $khaosat = new Khaosathocphan();
        $khaosat->LHPid = $this->LHPid;
        $khaosat->Ksid = $this->Ksid;
        $khaosat->Qid = $this->Qid;
        $khaosat->Hpid = $this->Hpid;
        return $khaosat->save();
        // if ($khaosat->save()) {
        //     return true;
        // } else {
        //     Yii::error('Failed to save Survey: ' . json_encode($khaosat->getErrors()));
        //     return false;
        // }
    }

    public function saveHocphan()
    {
        $hocphan = new Hocphan();
        $hocphan->Hpid = $this->Hpid;
        $hocphan->TenHocPhan = $this->TenHocPhan;
        return $hocphan->save();
    }
    public function saveLophoc()
    {
        $lophoc = new Lophoc();
        $lophoc->LHPid = $this->LHPid;
        $lophoc->Namid = $this->Namid;
        $lophoc->HocKy = $this->HocKy;
        return $lophoc->save();
    }
}
