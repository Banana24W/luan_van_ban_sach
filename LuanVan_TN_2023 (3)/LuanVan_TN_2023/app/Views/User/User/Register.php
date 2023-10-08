<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
<input id="baseUrl" value="" style="display: none;" />


<!--************************************
				Inner Banner Start
		*************************************-->
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?= base_url() ?>resources\images\parallax\bgparallax-07.jpg">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tg-innerbannercontent">
					<h1>Đăng Ký</h1>
					<ol class="tg-breadcrumb">
						<li><a href="<?=base_url('/')?>">Trang Chủ</a></li>
						<li class="tg-active">Đăng Ký</li>
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
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tg-sectionhead">
							<h2><span>Chào bạn !!!</span>Hãy trở thành thành viên của chúng tôi để nhận các ưu đãi</h2>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

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
						<form class="form-register" action="<?= base_url('User/Save') ?>" method="post">
							<input type="hidden" name="id" value="">
							<div>
								<input type="text" style="width: 500px;" name="first_name" placeholder="FirstName...." required />
							</div>
							<br>
							<div>
								<input type="text" style="width: 500px;" name="last_name" placeholder="LastName...." required />
							</div>
							<br>
							<div>
								<input type="text" style="width: 500px;" name="username" placeholder="UserName...." required />
							</div>
							<br>
							<div>
								<input type="password" style="width: 500px;" name="password" placeholder="Password...." required />
							</div>
							<br>
							<div>
								<input type="email" style="width: 500px;" name="email" placeholder="Email...." required />
							</div>
							<br>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div>
							<div>
								<input type="text" style="width: 500px;" name="address" placeholder="Chi Tiết Số Nhà ,Tên Đường...." required />
							</div>
							<br>

							<select class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm" name="city">
								<option value="" selected>Chọn Tỉnh,Thành Phố</option>
							</select>
							<br>
							<br>
							<select class="form-select form-select-sm mb-3" id="district" aria-label=".form-select-sm" name="district">
								<option value="" selected>Chọn quận huyện</option>
							</select>
							<br>
							<br>
							<select class="form-select form-select-sm" id="ward" aria-label=".form-select-sm" name="ward">
								<option value="" selected>Chọn phường xã</option>
							</select>
							<br>
							<br>
							<div>
								<input type="tel" style="width: 500px;" name="phone" placeholder="Phone...." required />
							</div>
						</div>
						<br>
						<button type="submit" class="registerbtn">Đăng Ký</button>
						</form>

						<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
						<script>
							var provinces = document.getElementById("city");
							var districts = document.getElementById("district");
							var wards = document.getElementById("ward");

							var Parameter = {
								url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
								method: "GET",
								responseType: "application/json",
							};

							var promise = axios(Parameter);
							promise.then(function(result) {
								renderProvinces(result.data);
							});

							function renderProvinces(data) {
								for (const province of data) {
									provinces.options[provinces.options.length] = new Option(
										province.Name,
										province.Id
									);
								}

								provinces.onchange = function() {
									districts.length = 1;
									wards.length = 1;
									const selectedProvince = data.find(
										province => province.Id === this.value
									);
									for (const district of selectedProvince.Districts) {
										districts.options[districts.options.length] = new Option(
											district.Name,
											district.Id
										);
									}
								};

								districts.onchange = function() {
									wards.length = 1;
									const selectedProvince = data.find(
										province => province.Id === provinces.value
									);
									const selectedDistrict = selectedProvince.Districts.find(
										district => district.Id === this.value
									);
									for (const ward of selectedDistrict.Wards) {
										wards.options[wards.options.length] = new Option(
											ward.Name,
											ward.Id
										);
									}
								};
							}
						</script>
					</div>

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