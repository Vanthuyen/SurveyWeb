<?php
/* @var $this yii\web\View */

$this->title = 'Admin Dashboard';
?>
<div class="admin-index">
    <div class="jumbotron">
        <h1>Admin Dashboard</h1>
        <p class="lead">Chào mừng đến với Admin Dashboard. Chọn một hành động bên dưới:</p>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Tạo tài khoản sinh viên</h2>
            <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['admin/create-student']) ?>">Tạo tài khoản</a></p>
        </div>
        <div class="col-lg-6">
            <h2>Tạo Khảo sát</h2>
            <p><a class="btn btn-lg btn-primary" href="<?= \yii\helpers\Url::to(['admin/create-course-survey']) ?>">Tạo Khảo sát</a></p>
        </div>
        <div class="col-lg-6">
            <h2>Xem danh sách sinh viên</h2>
            <a class="btn btn-lg btn-primary" href="<?= \yii\helpers\Url::to(['admin/view-students']) ?>">Xem danh sách</a></p>
        </div>

        <div class="col-lg-6">
            <h2>Xem danh sách khảo sát</h2>
            <a class="btn btn-lg btn-info" href="<?= \yii\helpers\Url::to(['admin/view-surveys']) ?>">Xem danh sách</a></p>
        </div>
    </div>
</div>
