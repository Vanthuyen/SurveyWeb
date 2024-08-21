<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Khaosathocphan */

$this->title = 'Mã sinh viên: ' . $modelsv->Svid;
$this->params['breadcrumbs'][] = ['label' => 'Sinh Viên', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sinhvien-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Sửa', ['update-student', 'id' => $modelsv->Svid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete-student', 'id' => $modelsv->Svid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa Sinh viên này không?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelsv,
        'attributes' => [
            'Svid',
            'Userid',
            [
                'attribute' => 'nguoidung.Username', 
                'label' => 'Tên tài khoản',
                'value' => function($modelsv) {
                    return $modelsv->nguoidung->Username;
                }
            ],
            [
                'attribute' => 'sinhvien.HoLot', 
                'label' => 'Họ Lót',
                'value' => function($modelsv) {
                    return $modelsv->HoLot;
                }
            ],      
            [
                'attribute' => 'sinhvien.Ten', 
                'label' => 'Tên',
                'value' => function($modelsv) {
                    return $modelsv->Ten;
                }
            ], 
            [
                'attribute' => 'sinhvien.NgaySinh', 
                'label' => 'Ngày Sinh',
                'value' => function($modelsv) {
                    return $modelsv->NgaySinh;
                }
            ],    
            [
                'attribute' => 'sinhvien.GioiTinh', 
                'label' => 'Giới Tính',
                'value' => function($modelsv) {
                    return $modelsv->GioiTinh;
                }
            ],     
            [
                'attribute' => 'sinhvien.Sdt',   
                'label' => 'Số điện thoại',
                'value' => function($modelsv) {
                    return $modelsv->Sdt;
                }
            ],
            [
                'attribute' => 'sinhvien.Email', 
                'label' => 'Email',
                'value' => function($modelsv) {
                    return $modelsv->Email;
                }
            ],           
        ],
    ]) ?>

</div>
