<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Khaosathocphan */

$this->title = 'Mã khảo sát: ' . $model->Ksid;
$this->params['breadcrumbs'][] = ['label' => 'Khảo sát', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khaosathocphan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Sửa', ['update', 'id' => $model->Ksid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->Ksid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa khảo sát này không?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Ksid',
            'LHPid',
            // [
            //     'attribute' => 'Qid',
            //     'value' => $model->q->Q_file,
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
            // 'TrangThai',
        ],
    ]) ?>

</div>
