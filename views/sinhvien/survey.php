<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tham Gia Khảo Sát';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p><?= Html::encode($survey->q->Q_file) ?></p>

<div class="survey-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($questions as $index => $question): ?>
        <div class="form-group">
            <label><?= Html::encode($question) ?></label>
            <?= Html::textarea("answers[$index]", '', ['class' => 'form-control']) ?>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
