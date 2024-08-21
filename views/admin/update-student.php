<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sinhvien */
/* @var $userModel app\models\Nguoidung */

$this->title = 'Cập nhật Sinh viên: ' . $model->Svid;
$this->params['breadcrumbs'][] = ['label' => 'Sinh viên', 'url' => ['view-students']];
$this->params['breadcrumbs'][] = ['label' => $model->Ten, 'url' => ['view-student', 'id' => $model->Svid]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="student-form">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($userModel, 'Username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($userModel, 'Password')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'HoLot')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'Ten')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'NgaySinh')->input('date') ?>
        <?= $form->field($model, 'GioiTinh')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
