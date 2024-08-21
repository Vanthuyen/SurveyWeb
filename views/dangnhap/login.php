<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Login</h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'Password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
