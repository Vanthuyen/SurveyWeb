<?php

namespace app\models;

use Yii;
use app\models\Hocphan;
use app\models\Lophoc;
use app\models\Cauhoi;
use app\models\Namhoc;
/**
 * This is the model class for table "khaosathocphan".
 *
 * @property int $Ksid
 * @property int|null $LHPid
 * @property string|null $TrangThai
 * @property int|null $Qid
 * @property int|null $Hpid
 *
 * @property Cautraloi[] $cautralois
 * @property Hocphan $hp
 * @property Lophoc $lHP
 * @property Cauhoi $q
 */
class Khaosathocphan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'khaosathocphan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Ksid'], 'required'],
            [['Ksid', 'LHPid', 'Qid', 'Hpid'], 'integer'],
            [['TrangThai'], 'string', 'max' => 50],
            [['Ksid'], 'unique'],
            [['Hpid'], 'exist', 'skipOnError' => true, 'targetClass' => Hocphan::class, 'targetAttribute' => ['Hpid' => 'Hpid']],
            [['LHPid'], 'exist', 'skipOnError' => true, 'targetClass' => Lophoc::class, 'targetAttribute' => ['LHPid' => 'LHPid']],
            [['Qid'], 'exist', 'skipOnError' => true, 'targetClass' => Cauhoi::class, 'targetAttribute' => ['Qid' => 'Qid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Ksid' => 'Mã khảo sát',
            'LHPid' => 'Mã lớp học phần',
            'TrangThai' => 'Trạng Thái',
            'Qid' => 'Qid',
            'Hpid' => 'Hpid',
        ];
    }

    /**
     * Gets query for [[Cautralois]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCautralois()
    {
        return $this->hasMany(Cautraloi::class, ['Ksid' => 'Ksid']);
    }

    /**
     * Gets query for [[Hp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHp()
    {
        return $this->hasOne(Hocphan::class, ['Hpid' => 'Hpid']);
    }

    /**
     * Gets query for [[LHP]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLhp()
    {
        return $this->hasOne(Lophoc::class, ['LHPid' => 'LHPid']);
    }

    /**
     * Gets query for [[Q]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQ()
    {
        return $this->hasOne(Cauhoi::class, ['Qid' => 'Qid']);
    }

    public function isCompletedByStudent($svid)
    {
        return Cautraloi::find()->where(['Ksid' => $this->Ksid, 'Svid' => $svid])->exists();
    }
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
}
