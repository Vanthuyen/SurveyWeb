<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Namhoc".
 *
 * @property int $Namid
 * @property string $NamHoc
 * @property string $HocKy
 */
class Namhoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Namhoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Namid', 'NamHoc', 'HocKy'], 'required'],
            [['Namid'], 'integer'],
            [['NamHoc', 'HocKy'], 'string', 'max' => 20],
            [['Namid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Namid' => 'Namid',
            'NamHoc' => 'Năm Học',
            'HocKy' => 'Học Kỳ',
        ];
    }

    public static function getHocKyNamHocList()
    {
        $data = self::find()->all();
        $result = [];
        foreach ($data as $item) {
            $result[$item->Namid . '_1'] = 'Học kỳ 1 - ' . $item->NamHoc;
            $result[$item->Namid . '_2'] = 'Học kỳ 2 - ' . $item->NamHoc;
        }
        return $result;
    }
}
