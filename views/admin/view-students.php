
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Danh Sách Sinh Viên';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Thêm sinh viên', ['create-student'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvidersv,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url, $modelsv) {
                        return Html::a('Xem', ['view-info-student', 'id' => $modelsv->Svid], ['class' => 'btn btn-primary']);
                    },
                    'update' => function($url, $modelsv) {
                        return Html::a('Sửa', ['update-student', 'id' => $modelsv->Svid], ['class' => 'btn btn-warning']);
                    },
                    'delete' => function($url, $modelsv) {
                        return Html::a('Xóa', ['delete-student', 'id' => $modelsv->Svid], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Bạn có chắc chắn muốn xóa sinh viên này không?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],            
        ],
    ]); ?>
</div>

