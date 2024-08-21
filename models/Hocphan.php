<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Hocphan".
 *
 * @property int $Hpid
 * @property string $TenHocPhan
 * @property int $TinChi
 * @property int|null $Gvid
 */
class Hocphan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Hocphan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Hpid', 'TenHocPhan', 'TinChi'], 'required'],
            [['Hpid', 'TinChi', 'Gvid'], 'integer'],
            [['TenHocPhan'], 'string', 'max' => 255],
            [['Hpid'], 'unique'],
            [['Gvid'], 'exist', 'skipOnError' => true, 'targetClass' => Giangvien::class, 'targetAttribute' => ['Gvid' => 'Gvid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Hpid' => 'Hpid',
            'TenHocPhan' => 'Ten Hoc Phan',
            'TinChi' => 'Tin Chi',
            'Gvid' => 'Gvid',
        ];
    }

    public function getLhp()
    {
        return $this->hasMany(Lophoc::class, ['Hpid' => 'Hpid']);
    }

}
