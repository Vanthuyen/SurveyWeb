<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Namhoc;

class SurveySearch extends Model
{
    public $year;
    public $semester;
    public $hocKyNamHoc;
    public function rules()
    {
        return [
            [['hocKyNamHoc'], 'safe'],
            [['year', 'semester'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'year' => 'Học kỳ - Năm học',
        ];
    }

    public function search($params)
    {
        $query = Namhoc::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if ($this->hocKyNamHoc) {
            list($namid, $hocKy) = explode('_', $this->hocKyNamHoc);
            $query->andFilterWhere(['lhpid' => $namid]);
            $query->andFilterWhere(['hoc_ky' => $hocKy]);
        }


        // if ($this->year) {
        //     $query->andWhere(['year' => $this->year]);
        // }

        // if ($this->semester) {
        //     $query->andWhere(['semester' => $this->semester]);
        // }

        return $dataProvider;
    }

    public function getNamhockyList()
    {
        return Namhoc::find()->all();
    }
}
