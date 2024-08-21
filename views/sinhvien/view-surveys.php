<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Namhoc;
use app\models\Hocphan;
use app\models\SurveySearch;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $sinhvienId integer */ // Thêm khai báo biến này
/* @var $searchModel app\models\SurveySearch */

$this->title = 'Danh sách khảo sát';
$this->params['breadcrumbs'][] = $this->title;

$years = ArrayHelper::map(Namhoc::find()->all(), 'Namid', 'NamHoc');
// $semesters = ['1' => 'Học kỳ 1', '2' => 'Học kỳ 2'];
$hocKyNamHoc = Namhoc::getHocKyNamHocList();
?>

<div class="survey-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['view-surveys'],
    ]); ?>


    <div class="row">
        <div class="col-lg-4">
        <?= $form->field($searchModel, 'year')->dropDownList(
                ArrayHelper::map($searchModel->getNamhockyList(), 'Namid', function($namhk) {
                    return 'Học kỳ ' . $namhk->HocKy . ' - ' . $namhk->NamHoc;
                }),
                ['prompt' => 'Chọn Học kỳ - Năm học']
            ) ?>
        </div>
        <div class="col-lg-4">
            <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary','style' => 'margin-top: 24px;']) ?>
        </div>
    </div>
    <?php  ArrayHelper::map($searchModel, 'year', 'semester');?>


    <?php ActiveForm::end();?>

    <br>
    <?php
    
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Ksid',
            'LHPid',
            [
                'attribute' => 'lhp.LopHocPhan',
                'label' => 'Lớp học phần',
                'value' => function($model) {
                    return $model->lhp->LopHocPhan;
                }
            ],
            [
                'attribute' => 'hp.TenHocPhan',
                'label' => 'Tên học phần',
                'value' => function($model) {
                    return $model->lhp->hp->TenHocPhan;
                }
            ],
            [    
                'attribute' => 'namhoc.NamHoc', // Hiển thị cột năm học
                'label' => 'Năm học',
                'value' => function($model) {
                    return $model->lhp->namhoc->NamHoc;
                }
            ],
            [    
                'attribute' => 'namhoc.HocKy', // Hiển thị cột năm học
                'label' => 'Học kỳ',
                'value' => function($model) {
                    return $model->lhp->namhoc->HocKy;
                }
            ],
            [
                'attribute' => 'TrangThai',
                'value' => function($model) use ($sinhvienId) {
                    return $model->isCompletedByStudent($sinhvienId) ? 'Đã hoàn thành' : 'Chưa thực hiện';
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function($url, $model) use ($sinhvienId) {
                        if ($model->isCompletedByStudent($sinhvienId)) {
                            return ''; // Ẩn nút nếu khảo sát đã hoàn thành
                        } else {
                            return Html::a('Tham gia khảo sát', ['survey', 'id' => $model->Ksid], ['class' => 'btn btn-primary']);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
</div>
