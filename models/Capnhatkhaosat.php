<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Hocphan;
use app\models\Lophoc;
use app\models\Cauhoi;
use app\models\Namhoc;

class Capnhatkhaosat extends Model
{
    public $Ksid;
    public $Hpid;
    public $LHPid;
    public $Qid;
    public $Namid;

    public function rules()
    {
        return [
            [['Hpid', 'LHPid', 'Qid'], 'required'],
            [['Hpid', 'LHPid', 'Qid', 'Namid','Ksid'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Ksid' => 'Mã khảo sát',
            'LHPid' => 'Lớp học phần',
            'Qid' => 'Loại câu hỏi',
            'Hpid' => 'Học phần',
            'Namid' => 'Học kỳ - Năm học'
        ];
    }

    public function getHocphanList()
    {
        return Hocphan::find()->all();
    }

    public function getLophocList($hpid = null)
    {
        if ($hpid) {
            return Lophoc::find()->where(['Hpid' => $hpid])->all();
        }
        return [];
    }

    public function getCauhoiList()
    {
        return Cauhoi::find()->all();
    }

    public function getNamhocList()
    {
        return Namhoc::find()->all();
    }

    // public function getNamhocList($lhpid = null)
    // {
    //     if ($lhpid) {
    //         return Namhoc::find()->where(['LHPid' => $lhpid])->all();
    //     }
    //     return [];
    // }
    public function saveUpdate()
    {
        $khaosat = new Khaosathocphan();
        $khaosat->Ksid = $this->Ksid;
        $khaosat->LHPid = $this->LHPid;
        $khaosat->Qid = $this->Qid;
        $khaosat->Hpid = $this->Hpid;
        return $khaosat->save();
    }
}
