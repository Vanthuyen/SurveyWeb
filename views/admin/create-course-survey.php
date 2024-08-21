<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CreateSurveyForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Course Survey';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="create-course-survey">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="create-course-survey-form">
        <?php $form = ActiveForm::begin([
            'id' => 'create-course-survey-form',
            'method' => 'post',          
        ]); ?>

            <?= $form->field($model, 'Ksid')->textInput() ?>    

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
                <?= Html::submitButton('Create Survey', ['class' => 'btn btn-success']) ?>
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
                var lophocSelect = $('#taokhaosat-lhpid');
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

    $('#taokhaosat-lhpid').change(function(){
        var lhpid = $(this).val();
        $.ajax({
            url: '" . \yii\helpers\Url::to(['admin/get-namhoc-by-lophoc']) . "',
            data: {lhpid: lhpid},
            success: function(data) {
                var data = JSON.parse(data);
                var namhocSelect = $('#taokhaosat-namid');
                namhocSelect.empty();
                namhocSelect.append('<option>Chọn Học kỳ - Năm học</option>');
                namhocSelect.append('<option value=\"' + data.Namid + '\">Học kỳ ' + data.HocKy + ' - ' + data.NamHoc + '</option>');
            }
        });
    });
");
?>