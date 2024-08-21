<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Giangvien".
 *
 * @property int $Gvid
 * @property string $HoLot
 * @property string $Ten
 * @property string|null $NgaySinh
 * @property string|null $GioiTinh
 * @property string|null $Sdt
 * @property string|null $Email
 * @property string|null $MaBoMon
 * @property string|null $ChucVu
 */
class Giangvien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Giangvien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Gvid', 'HoLot', 'Ten'], 'required'],
            [['Gvid'], 'integer'],
            [['NgaySinh'], 'safe'],
            [['HoLot', 'Email', 'ChucVu'], 'string', 'max' => 100],
            [['Ten', 'MaBoMon'], 'string', 'max' => 50],
            [['GioiTinh'], 'string', 'max' => 10],
            [['Sdt'], 'string', 'max' => 15],
            [['Gvid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Gvid' => 'Gvid',
            'HoLot' => 'Ho Lot',
            'Ten' => 'Ten',
            'NgaySinh' => 'Ngay Sinh',
            'GioiTinh' => 'Gioi Tinh',
            'Sdt' => 'Sdt',
            'Email' => 'Email',
            'MaBoMon' => 'Ma Bo Mon',
            'ChucVu' => 'Chuc Vu',
        ];
    }
}
