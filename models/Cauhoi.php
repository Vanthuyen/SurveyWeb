<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cauhoi".
 *
 * @property int $Qid
 * @property string $Q_file
 * @property string $Q_type
 *
 * @property Khaosathocphan[] $khaosathocphans
 */
class Cauhoi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cauhoi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Q_file', 'Q_type'], 'required'],
            [['Q_file'], 'string', 'max' => 255],
            // [['Q_type'], 'string', 'max' => 50],
            [['Q_file'], 'file', 'extensions' => 'txt, pdf, doc, docx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Qid' => 'Qid',
            'Q_file' => 'Q File',
            'Q_type' => 'Q Type',
        ];
    }

    /**
     * Gets query for [[Khaosathocphans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhaosathocphans()
    {
        return $this->hasMany(Khaosathocphan::class, ['Qid' => 'Qid']);
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->Q_file->saveAs('uploads/' . $this->Q_file->baseName . '.' . $this->Q_file->extension);
            return true;
        }
        return false;
    }
}
