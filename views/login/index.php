<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php
    if (Yii::$app->session->hasFlash('LoginFalse')){
?>
    <div class="alert alert-danger">Đăng nhập thất bại</div>
<?php
}
?>
<?php
    if (Yii::$app->session->hasFlash('LoginOK')){
?>
    <div class="alert alert-success">Đăng nhập thành công</div>
<?php
}
?>

<div class="login-container">
    <h2>Login</h2>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'login-form']]) ?>

    <?= $form->field($model, 'user_name')->textInput(['placeholder' => 'User name'])->label(false) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
    
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>

    <?php ActiveForm::end() ?>
</div>

<style>
.login-container {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.login-form .form-group {
    margin-bottom: 15px;
}

.btn-block {
    width: 100%;
}
</style>