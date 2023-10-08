<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
<input id="baseUrl" value="" style="display: none;" />


<!--************************************
				Inner Banner Start
		*************************************-->
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?= base_url() ?>/resources/images/parallax/bgparallax-07.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-innerbannercontent">
                    <h1>Thông tin </h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="<?=base_url('/')?>">Trang chủ</a></li>
                        <li class="tg-active">Xem Thông tin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!--************************************
				Inner Banner End
		*************************************-->
<!--************************************
				Main Start
		*************************************-->
<main id="tg-main" class="tg-main tg-haslayout">
    <!--************************************
					Contact Us Start
			*************************************-->
    <div class="tg-sectionspace tg-haslayout">
        <div class="container ">
            <div class=" col-md-12 mb-5 d-flex justify-content-center">

                <div class="border border-primary p-3  col-md-7 rounded">
                    <h4 class="font-weight-bold text-center text-dark mb-5 ">Thông Tin Cá Nhân</h4>
                    <div class="col-12 mb-3">
                        <?php $errors = session()->getFlashdata('error_msg') ?>
                        <?php if (!empty($errors)) :  ?>
                            <?php if (!is_array($errors)) : ?>
                                <div class="alert alert-danger mb-1">
                                    <?= $errors ?>
                                </div>
                            <?php else : ?>
                                <?php foreach ($errors as $error) : ?>
                                    <div class="alert alert-danger mb-1">
                                        <?= $error ?>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                    <?php if (isset($customer)) : ?>

                        <form action="<?= base_url('User/capnhat') ?>" method="POST" class="mx-auto mt-5">
                            <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                            <div class="form-group">
                                <label class="font-weight-bold">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control border border-primary py-4 rounded" name="email" value="<?= $customer['email'] ?>" disabled required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tên tài khoản<span class="text-danger">*</span></label>
                                <input type="text" class="form-control border py-4 border-primary rounded" value="<?= $customer['username'] ?>" disabled required />
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Họ<span class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-primary py-4 rounded" name="firstname" value="<?= $customer['first_name'] ?>" required />
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Tên<span class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-primary py-4 rounded" name="lastname" value="<?= $customer['last_name'] ?>" required />
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Mật khẩu<span class="text-danger">*</span></label>
                                <input type="password" class="form-control border border-primary py-4 rounded" name="password" placeholder="Để trống nếu không thay đổi mật khẩu." />
                            </div>
                            <?php foreach ($addresses as $address) : ?>
                                <?php if ($address['status'] == 1) : ?>
                                    <div class="address-wrapper">
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input class="form-control border border-primary py-4 rounded" type="text" name="telephone" placeholder="Phone" value="0<?= $address['phone'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ nhận hàng</label>
                                            <input class="form-control border border-primary py-4 rounded" type="text" name="address1" placeholder="Address" value="<?= $address['diachi'] ?>">
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach; ?>

                            <div class="p-2">
                                <button class="btn btn-primary btn-block border-0 py-3 rounded" type="submit" id="btnUpdate">Chỉnh sửa</button>
                            </div>
                        </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
					Contact Us End
			*************************************-->
</main>
<!--************************************
				Main End
		*************************************-->

<?= $this->endSection() ?>