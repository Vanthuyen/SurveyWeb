<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Sinhvien".
 *
 * @property int $Svid
 * @property string $HoLot
 * @property string $Ten
 * @property string|null $NgaySinh
 * @property string|null $GioiTinh
 * @property string|null $Sdt
 * @property string|null $Email
 * @property int|null $Userid
 */
class Sinhvien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Sinhvien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Svid', 'HoLot', 'Ten'], 'required'],
            [['Svid', 'Userid'], 'integer'],
            [['NgaySinh'], 'safe'],
            [['HoLot', 'Email'], 'string', 'max' => 100],
            [['Ten'], 'string', 'max' => 50],
            [['GioiTinh'], 'string', 'max' => 10],
            [['Sdt'], 'string', 'max' => 15],
            [['Svid'], 'unique'],
            [['Userid'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoidung::class, 'targetAttribute' => ['Userid' => 'Userid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Svid' => 'Svid',
            'HoLot' => 'Họ Lót',
            'Ten' => 'Tên',
            'NgaySinh' => 'Ngay Sinh',
            'GioiTinh' => 'Gioi Tinh',
            'Sdt' => 'Sdt',
            'Email' => 'Email',
            'Userid' => 'Userid',
        ];
    }

    public function getNguoidung()
    {
        return $this->hasOne(Nguoidung::class, ['Userid' => 'Userid']);
    }

    public function getLhp()
    {
        return $this->hasMany(Lophoc::class, ['LHPid' => 'LHPid']);
    }
}
