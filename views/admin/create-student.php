<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $nguoidungModel app\models\Nguoidung */
/* @var $sinhvienModel app\models\Sinhvien */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Student Account';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-create-student">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nguoidung-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($nguoidungModel, 'Username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($nguoidungModel, 'Password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($sinhvienModel, 'Svid')->input('number') ?>
        <?= $form->field($sinhvienModel, 'HoLot')->textInput(['maxlength' => true]) ?>
        <?= $form->field($sinhvienModel, 'Ten')->textInput(['maxlength' => true]) ?>
        <?= $form->field($sinhvienModel, 'NgaySinh')->input('date') ?>
        <?= $form->field($sinhvienModel, 'GioiTinh')->dropDownList([ 'Nam' => 'Nam', 'Nu' => 'Nu', ], ['prompt' => '']) ?>
        <?= $form->field($sinhvienModel, 'Sdt')->textInput(['maxlength' => true]) ?>
        <?= $form->field($sinhvienModel, 'Email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($sinhvienModel, 'Userid')->input('number') ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

