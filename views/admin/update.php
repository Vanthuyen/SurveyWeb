<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Hocphan;
use app\models\Lophoc;
use app\models\Cauhoi;
use app\models\Namhoc;

/* @var $this yii\web\View */
/* @var $model app\models\TaoKhaoSat */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Cập nhật khảo sát: ' . $model->Ksid;
$this->params['breadcrumbs'][] = ['label' => 'Khảo sát', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ksid, 'url' => ['view', 'id' => $model->Ksid]];
$this->params['breadcrumbs'][] = 'Cập nhật';

// $hocphans = ArrayHelper::map(Hocphan::find()->all(), 'Hpid', 'TenHocPhan');
// $lophocs = ArrayHelper::map(Lophoc::find()->all(), 'LHPid', 'LopHocPhan');
// $cauhois = ArrayHelper::map(Cauhoi::find()->all(), 'Qid', 'Q_type');
// $years = ArrayHelper::map(Namhoc::find()->all(), 'Namid', 'NamHoc');
// $semesters = ['1' => 'Học kỳ 1', '2' => 'Học kỳ 2'];

?>

<div class="khaosat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="khaosat-form">

        <?php $form = ActiveForm::begin(); ?>  

            <?= $form->field($model, 'Hpid')->dropDownList(
                ArrayHelper::map($model->getHocphanList(), 'Hpid', function($hp) {
                    return $hp->TenHocPhan;
                }),
                ['prompt' => 'Chọn học phần', 'id' => 'hocphan-id']
            ) ?>

            <?= $form->field($model, 'LHPid')->dropDownList(
                // ArrayHelper::map($model->getLophocList(), 'LHPid', function($lph) {
                //     return $lph->LopHocPhan;
                // }),
                ['prompt' => 'Chọn lớp']
            ) ?>

            <?= $form->field($model, 'Qid')->dropDownList(
                ArrayHelper::map($model->getCauhoiList(), 'Qid', function($cauhoi) {
                    return $cauhoi->Q_type ;
                    // . ' (' . $cauhoi->Q_type . ')';
                }),
                ['prompt' => 'Chọn Loại khảo sát']
            ) ?>

            <?= $form->field($model, 'Namid')->dropDownList(
                // ArrayHelper::map($model->getNamhocList(), 'Namid', function($nam) {
                //     return 'Học kỳ ' . $nam->HocKy . ' - ' . $nam->NamHoc;
                // }),
                ['prompt' => 'Chọn Học kỳ - Năm học']
            ) ?>


        <div class="form-group">
            <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<?php
$this->registerJs("
    $('#hocphan-id').change(function(){
        var hpid = $(this).val();
        $.ajax({
            url: '" . \yii\helpers\Url::to(['admin/get-lophoc-by-hocphan']) . "',
            data: {hpid: hpid},
            success: function(data) {
                var data = JSON.parse(data);
                console.log(data);
                var lophocSelect = $('#capnhatkhaosat-lhpid');
                lophocSelect.empty();
                lophocSelect.append('<option>Chọn lớp</option>');
                $.each(data, function(index, value) {
                    lophocSelect.append('<option value=\"' + value.LHPid + '\">' + value.LopHocPhan + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    });

    $('#capnhatkhaosat-lhpid').change(function(){
        var lhpid = $(this).val();
        $.ajax({
            url: '" . \yii\helpers\Url::to(['admin/get-namhoc-by-lophoc']) . "',
            data: {lhpid: lhpid},
            success: function(data) {
                var data = JSON.parse(data);
                var namhocSelect = $('#capnhatkhaosat-namid');
                namhocSelect.empty();
                namhocSelect.append('<option>Chọn Học kỳ - Năm học</option>');
                namhocSelect.append('<option value=\"' + data.Namid + '\">Học kỳ ' + data.HocKy + ' - ' + data.NamHoc + '</option>');
            }
        });
    });
");
?>