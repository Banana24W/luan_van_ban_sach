<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-12">
                            <div class="page-header-title">
                                <div class="d-inline">

                                    <h4><?= $title ?></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">

                    <!--profile cover end-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- tab content start -->
                            <div class="tab-content">
                                <!-- tab panel personal start -->
                                <div class="tab-pane active" id="personal" role="tabpanel">
                                    <!-- personal card start -->
                                    <div class="card">
                                        <div class="card-header">

                                            <!-- <div class="alert alert-danger">
                                                <div class="col-10">
                                                    Error
                                                </div>
                                                <div class="col-1 text-right">
                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                </div>
                                            </div> -->

                                            <!-- <div class="alert alert-danger mb-1">
                                                <div class="row">
                                                    <div class="col-11">
                                                        Error
                                                    </div>
                                                    <div class="col-1 text-right">
                                                        <span aria-hidden="true" id="remove-alert">&times;</span>
                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>

                                        <div class="card-block">
                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form action="<?= base_url('dashboard/admin/manage/save') ?>" method="post">
                                                            <input type="hidden" name="id" value="">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="username">Tên tài khoản</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="<?= $user['username'] ?>" name="username" readonly placeholder="Tên ..." required autofocus>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="email">Email</label>
                                                                        <div class="input-group">
                                                                            <input type="email" class="form-control" id="inputWarning1" readonly value="<?= $user['email'] ?>" name="email" placeholder="Email ..." required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="password">Mật khẩu</label>
                                                                        <div class="input-group">
                                                                            <input type="password" name="password" value="<?= $user['password'] ?>" class="form-control"  placeholder="" required>
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-outline-secondary" type="button" id="showHidePasswordBtn">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="role">Cấp bậc</label>
                                                                        <div class="input-group">

                                                                            <select name="category" class="form-control js-example-basic-single">
                                                                                <option value="">Danh mục role</option>
                                                                                <?php if (isset($role)) : ?>
                                                                                    <?php foreach ($role as $item) : ?>
                                                                                        <option value="<?= $item['role_id'] ?>" <?= !empty($user['role']) && $user['role'] == $item['role_id'] ? 'selected' : '' ?>><?= $item['role_name'] ?></option>
                                                                                    <?php endforeach ?>
                                                                                <?php endif ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- end of table col-lg-6 -->
                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <select name="status" class="form-control" required>
                                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                                <option value="<?= $key ?>" <?= !empty($user['status'])  && $user['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->
                                                                </div>
                                                                <!-- end of row -->
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">

                                                                        <button type="submit" class="btn btn-primary btn-round waves-effect waves-light m-r-20">Lưu</button>
                                                                        <a href="<?= base_url('dashboard/admin/detail') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end of edit info -->
                                                        </form>
                                                    </div>
                                                    <!-- end of col-lg-12 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                        </div>
                                        <!-- end of card-block -->
                                    </div>
                                    <!-- personal card end-->
                                </div>

                            </div>
                            <!-- tab content end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main body end -->
    </div>
</div>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    var showHidePasswordBtn = document.getElementById('showHidePasswordBtn');
    showHidePasswordBtn.addEventListener('click', function() {
        var passwordInput = document.querySelector('input[name="password"]');
        var passwordType = passwordInput.getAttribute('type');
        passwordInput.setAttribute('type', passwordType === 'password' ? 'text' : 'password');
        
        // Thay đổi biểu tượng
        var icon = passwordType === 'password' ? 'fa fa-eye-slash' : 'fa fa-eye';
        showHidePasswordBtn.querySelector('i').className = icon;
    });
});
</script>
<?= $this->endSection() ?>