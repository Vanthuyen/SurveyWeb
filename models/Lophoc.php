<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lophoc".
 *
 * @property int $LHPid
 * @property string $LopHocPhan
 * @property int|null $Hpid
 * @property int|null $Svid
 * @property int|null $Gvid
 * @property int|null $Namid
 * @property string|null $HocKy
 *
 * @property Giangvien $gv
 * @property Hocphan $hp
 * @property Khaosathocphan[] $khaosathocphans
 * @property Namhoc $nam
 * @property Sinhvien $sv
 */
class Lophoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lophoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LHPid', 'LopHocPhan'], 'required'],
            [['LHPid', 'Hpid', 'Svid', 'Gvid', 'Namid'], 'integer'],
            [['LopHocPhan'], 'string', 'max' => 100],
            [['HocKy'], 'string', 'max' => 20],
            [['LHPid'], 'unique'],
            [['Hpid'], 'exist', 'skipOnError' => true, 'targetClass' => Hocphan::class, 'targetAttribute' => ['Hpid' => 'Hpid']],
            [['Svid'], 'exist', 'skipOnError' => true, 'targetClass' => Sinhvien::class, 'targetAttribute' => ['Svid' => 'Svid']],
            [['Gvid'], 'exist', 'skipOnError' => true, 'targetClass' => Giangvien::class, 'targetAttribute' => ['Gvid' => 'Gvid']],
            [['Namid'], 'exist', 'skipOnError' => true, 'targetClass' => Namhoc::class, 'targetAttribute' => ['Namid' => 'Namid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LHPid' => 'LhPid',
            'LopHocPhan' => 'Lop Hoc Phan',
            'Hpid' => 'Hpid',
            'Svid' => 'Svid',
            'Gvid' => 'Gvid',
            'Namid' => 'Namid',
            'HocKy' => 'Hoc Ky',
        ];
    }

    /**
     * Gets query for [[Gv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGv()
    {
        return $this->hasOne(Giangvien::class, ['Gvid' => 'Gvid']);
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
     * Gets query for [[Khaosathocphans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhaosathocphans()
    {
        return $this->hasOne(Khaosathocphan::class, ['LHPid' => 'LHPid']);
    }

    /**
     * Gets query for [[Nam]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNam()
    {
        return $this->hasOne(Namhoc::class, ['Namid' => 'Namid']);
    }

    /**
     * Gets query for [[Sv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSv()
    {
        return $this->hasOne(Sinhvien::class, ['Svid' => 'Svid']);
    }

    public function getSinhviens()
    {
        return $this->hasMany(Sinhvien::class, ['Svid' => 'Svid']);
    }

    public function getNamhoc()
    {
        return $this->hasOne(Namhoc::class, ['Namid' => 'Namid']);
    }

    
}
