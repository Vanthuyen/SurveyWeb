<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Danh Sách Khảo Sát';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="survey-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Thêm khảo sát', ['create-course-survey'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Ksid',

            // [
            //     'attribute' => 'lhp.LHPid',
            //     'label' => 'Mã lớp học phần',
            // ],
            [
                'attribute' => 'lhp.LopHocPhan',
                'label' => 'Tên lớp học phần',
            ],
            [
                'attribute' => 'hp.TenHocPhan', 
                'label' => 'Tên học phần',
                'value' => function($model) {
                    return $model->lhp->hp->TenHocPhan;
                }
            ],
            [
                'attribute' => 'Q_type',
                'value' => function($model) {
                    return $model->q->Q_type;
                },
                'label' => 'Loại câu hỏi',
            ],
            [
                'attribute' => 'namhoc.NamHoc', 
                'label' => 'Năm học',
                'value' => function($model) {
                    return $model->lhp->namhoc->NamHoc;
                }
            ],
            [
                'attribute' => 'namhoc.HocKy', 
                'label' => 'Học kỳ',
                'value' => function($model) {
                    return $model->lhp->namhoc->HocKy;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('Xem', ['view', 'id' => $model->Ksid], ['class' => 'btn btn-primary']);
                    },
                    'update' => function($url, $model) {
                        return Html::a('Sửa', ['update', 'id' => $model->Ksid], ['class' => 'btn btn-warning']);
                    },
                    'delete' => function($url, $model) {
                        return Html::a('Xóa', ['delete', 'id' => $model->Ksid], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Bạn có chắc chắn muốn xóa khảo sát này không?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],            
        ],
    ]); ?>
</div>

