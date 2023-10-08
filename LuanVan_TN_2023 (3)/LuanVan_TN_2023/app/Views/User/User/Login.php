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
					<h1>Xem thông tin</h1>
					<ol class="tg-breadcrumb">
						<li><a href="<?=base_url('/')?>">Trang chủ</a></li>
						<li class="tg-active">Xem thông tin</li>
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
		<div class="container">
			<div class="row">
				<div class="tg-contactus">
					<form class="form-login" action="<?= base_url('User/Userlogin') ?>" method="post">
						<div class="container">
							<div class="col-12">
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
							<div>
								<label for="username"><b style="font-size:15px;">Tên Đăng Nhập</b></label>
								<input style="width: 500px;height: 30px;" type="text" placeholder="Nhập tên đăng nhập..." name="username">
								<br>
								<label for="passsword"><b style="font-size:15px;">Mật Khẩu</b></label>
								<input style="width: 500px;height: 30px;" type="password" placeholder="Nhập mật khẩu..." name="password">
								<br>
								<br>
								<button style="padding: 0 50px; justify-content: center;align-items: center;" type="submit">Login</button>
							</div>
						</div>
					</form>

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