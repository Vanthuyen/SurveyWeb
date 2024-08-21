<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cautraloi".
 *
 * @property int $Aid
 * @property string $Content_Ans
 * @property int $Ksid
 * @property int $Svid
 *
 * @property Khaosathocphan $ks
 * @property Sinhvien $sv
 */
class Cautraloi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cautraloi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Content_Ans', 'Ksid', 'Svid'], 'required'],
            [['Content_Ans'], 'string'],
            [['Ksid', 'Svid'], 'integer'],
            [['Ksid'], 'exist', 'skipOnError' => true, 'targetClass' => Khaosathocphan::class, 'targetAttribute' => ['Ksid' => 'Ksid']],
            [['Svid'], 'exist', 'skipOnError' => true, 'targetClass' => Sinhvien::class, 'targetAttribute' => ['Svid' => 'Svid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Aid' => 'Aid',
            'Content_Ans' => 'Content Ans',
            'Ksid' => 'Ksid',
            'Svid' => 'Svid',
        ];
    }

    /**
     * Gets query for [[Ks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKs()
    {
        return $this->hasOne(Khaosathocphan::class, ['Ksid' => 'Ksid']);
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
}
