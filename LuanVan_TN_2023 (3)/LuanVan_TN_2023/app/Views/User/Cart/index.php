<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
<input id="baseUrl" value="" style="display: none;" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\libraries\assets\pages\notification\notification.css">


<!--************************************
				Inner Banner Start
		*************************************-->
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?= base_url() ?>/resources/images/parallax/bgparallax-07.jpg">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="tg-innerbannercontent">
					<h1>Sản Phẩm</h1>
					<ol class="tg-breadcrumb">
						<li><a href="javascript:void(0);">Trang Chủ</a></li>
						<li class="tg-active">Giỏ Hàng</li>
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

	<div class="tg-sectionspace tg-haslayout">
		<div class="container">
			<div class="row">
				<style>
					.container-fluid {
						padding-top: 20px;
					}

					.row {
						padding-left: 15px;
						padding-right: 15px;
					}

					.table-responsive {
						margin-bottom: 20px;
					}

					.table-bordered {
						border: 1px solid #dee2e6;
					}

					.bg-secondary {
						background-color: #32a852;
						color: #fff;
					}

					.text-dark {
						color: #343a40;
					}

					th,
					td {
						vertical-align: middle;
					}

					.font-weight-bold {
						font-weight: bold;
					}

					.input-group.quantity {
						width: 100px;
						margin: auto;
					}

					.form-control.form-control-sm {
						background-color: #c1f2cc;
						text-align: center;
						color: #343a40;
					}

					.align-middle {
						vertical-align: middle;
					}

					.btn-sm {
						padding: 0.25rem 0.5rem;
						font-size: 0.875rem;
					}

					.btn-primary {
						color: #fff;
						background-color: #3498db;
						border-color: #3498db;
						transition: background-color 0.3s ease;
					}

					.btn-primary:hover {
						background-color: #2980b9;
					}

					.fa {
						display: inline-block;
						font-style: normal;
						font-weight: 400;
						line-height: 1;
						text-align: center;
						text-transform: none;
						vertical-align: -0.125em;
						-webkit-font-smoothing: antialiased;
						-moz-osx-font-smoothing: grayscale;
					}

					.fa-times::before {
						content: "\f00d";
					}

					.col-lg-4 {
						padding-left: 0;
						padding-right: 0;
					}

					.card.border-secondary {
						border-color: #32a852;
					}

					.card-header.bg-secondary {
						background-color: #32a852;
						border-color: #32a852;
						color: #fff;
					}

					.font-weight-semi-bold {
						font-weight: 600;
					}

					.card-body {
						padding: 1.25rem;
					}

					.d-flex {
						display: flex;
					}

					.justify-content-between {
						justify-content: space-between;
					}

					.mb-3 {
						margin-bottom: 1rem;
					}

					.pt-1 {
						padding-top: 0.25rem;
					}

					.font-weight-medium {
						font-weight: 500;
					}

					.card-footer.border-secondary {
						border-color: #32a852;
						background-color: transparent;
					}

					.mt-2 {
						margin-top: 0.5rem;
					}

					.font-weight-bold {
						font-weight: bold;
					}

					.btn-block {
						display: block;
						width: 100%;
					}

					.btn-success {
						color: #fff;
						background-color: #43d8c9;
						border-color: #43d8c9;
						transition: background-color 0.3s ease;
					}

					.btn-success:hover {
						background-color: #3abbb1;
					}

					.my-3 {
						margin-top: 1rem;
						margin-bottom: 1rem;
					}

					tbody tr:hover {
						background-color: #fce5cd;
						transition: background-color 0.3s ease;
					}

					.input-group .btn-minus,
					.input-group .btn-plus {
						/* ... Previous styles ... */
						background-color: #fff;
						color: #32a852;
						box-shadow: 0 0 5px rgba(50, 168, 82, 0.3);

						background-color: #fff;
						box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
					}

					.card-footer::before {
						/* ... Previous styles ... */
						background-color: #32a852;
					}
				</style>
				<!-- Cart Start -->
				<div class="container-fluid pt-5">
					<div class="row px-xl-5">
						<div class="col-lg-8 table-responsive mb-5">
							<table class="table table-bordered text-center mb-0">
								<thead class="bg-secondary text-dark">
									<tr>
										<th>Sản Phẩm</th>
										<th>Giá</th>
										<th>Số lượng</th>
										<th>Tổng cộng</th>
										<th>Xóa</th>
									</tr>
								</thead>
								<tbody class="align-middle">
									<?php $cartTotal = 0; ?>
									<?php $cartDiscount = 0; ?>
									<?php $quantity = 0; ?>
									<?php $cartFinal = 0; ?>
									<?php if (isset($cart) && !empty($cart)) : ?>
										<?php foreach ($cart as $item) : ?>
											<?php $price = $item['don_gia'] ?>
											<?php $quantity += $item['quantity'] ?>
											<?php $subtotal = ($price - ($price * ($item['discount'] / 100))) * $item['quantity']; ?>
											<?php $cartTotal += $subtotal; ?>
											<?php $cartDiscount += ($price * ($item['discount'] / 100)) * $item['quantity']; ?>
											<?php $cartFinal += $subtotal; ?>

											<tr id="cart- ?>">
												<td class="align-middle">
													<span class="font-weight-bold"><?= $item['name'] ?></span><br>
												</td>
												<td class="align-middle">
													<?= number_format($price - ($price * ($item['discount'] / 100))) ?>Đ
												</td>
												<td class="align-middle">
													<div class="input-group quantity mx-auto" style="width: 100px;">
														<input type="text" id="quantity<?= $item['ma_ct_don_hang'] ?>" oninput="update_product(<?= $item['ma_ct_don_hang'] ?>,'<?= $item['ma_sach'] ?>')" min="1" max="100" class="form-control form-control-sm bg-secondary text-center" value="<?= $item['quantity'] ?>">
													</div>
												</td>
												<td class="align-middle"><?= number_format($subtotal) ?>Đ</td>
												<td class="align-middle"><button class="btn btn-sm btn-primary" onclick="delete_product(<?= $item['ma_ct_don_hang'] ?>, '<?= $item['ma_sach'] ?>', '<?= $item['name'] ?>')"><i class="fa fa-times"></i></button></td>
											</tr>
										<?php endforeach ?>
									<?php else : ?>
										<td colspan="5">Không có sản phẩm nào trong giỏ hàng.</td>
									<?php endif ?>
								</tbody>

							</table>
						</div>

						<div class="col-lg-4">

							<div class="card border-secondary mb-5">
								<div class="card-header bg-secondary border-0">
									<h4 class="font-weight-semi-bold m-0">Giỏ hàng</h4>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-between mb-3 pt-1">
										<h6 class="font-weight-medium">Tiền hàng</h6>
										<h6 class="font-weight-medium"><?= number_format($cartTotal) ?>Đ</h6>
									</div>
									<div class="d-flex justify-content-between mb-3 pt-1">
										<h6 class="font-weight-medium">Giảm giá</h6>
										<h6 class="font-weight-medium" id="giam_gia"><?= number_format($cartDiscount) ?>Đ</h6>
									</div>
									<div class="d-flex justify-content-between mb-3 pt-1">
										<h6 class="font-weight-medium">Giảm giá Voucher</h6>
										<h6 class="font-weight-medium" id="discount"></h6>
									</div>
									<div class="d-flex justify-content-between">
										<h6 class="font-weight-medium">Vận chuyển</h6>
										<h6 class="font-weight-medium" id="vchuyen">25,000 Đ</h6>
									</div>
								</div>
								<div class="card-footer border-secondary bg-transparent">
									<div class="d-flex justify-content-between mt-2">
										<?php if (!empty($cart)) : ?>
											<h5 class="font-weight-bold" id="tong_tiens<?= $carts['ma_don_hang'] ?>">Tổng tiền</h5>
										<?php endif; ?>
										<h5 class="font-weight-bold" id="tong_tien"><?= number_format($cartFinal + 25000) ?>Đ</h5>
									</div>
									<?php if (!empty($cart)) : ?>
										<a href="<?= base_url('giao-dich/thanh-toan') ?>"><button id="pay" class="btn btn-block btn-primary my-3 py-3" data-ma-don-hang="<?= $carts['ma_don_hang'] ?>">Thanh toán </button></a>
									<?php endif; ?>
								</div>
							</div>
							<form class="mb-5" action="">
								<div class="input-group">
									<input type="text" class="form-control p-4" id="ma_voucher" placeholder="Mã giảm giá">
									<div class="input-group-append">
										<button class="btn btn-primary" id="apply">Áp dụng</button>
									</div>
								</div>
							</form>
							<a href="<?= base_url('cua-hang') ?>"><button class="btn btn-block btn-success my-3 py-3">Tiếp tục mua hàng</button></a>
						</div>
						<script>
							// Lắng nghe sự kiện click vào nút "Áp dụng"
							document.getElementById('apply').addEventListener('click', function(e) {
								e.preventDefault();
								
								// Lấy giá trị mã giảm giá từ trường input
								var discountCode = document.getElementById('ma_voucher').value;
								// Lấy giá trị tổng tiền từ phần tử HTML
								var tongTienElement = document.getElementById('tong_tien');
								var tongTien = tongTienElement.textContent;
								var vchyenElenment = document.getElementById('vchuyen');
								var vchuyen = vchyenElenment.textContent;
								// Tạo đối tượng FormData
								var formData = new FormData();
								formData.append('discount_code', discountCode);
								formData.append('tong_tien', tongTien);
								formData.append('van_chuyen', vchuyen);
								
								// Thiết lập các tùy chọn yêu cầu
								var requestOptions = {
									method: 'POST',
									body: formData,
									redirect: 'follow'
								};

								// Gửi yêu cầu Ajax đến server
								fetch('/gio-hang/apply-discount', requestOptions)
									.then(response => response.json())
									.then(data => {
										// Xử lý kết quả giảm giá
										if (data.error) {
											var discountElement = document.getElementById('discount');
											discountElement.textContent = data.error; // Hiển thị thông báo lỗi
										} else {
											var cartDiscount = data.discounted_amount;
											// Hiển thị số tiền giảm giá trong ô "Giảm giá Voucher"
											var discountElement = document.getElementById('discount');
											discountElement.textContent = cartDiscount + 'Đ';
											// Tính lại tổng tiền sau khi áp dụng giảm giá từ voucher
											var cartTotalElement = document.getElementById('tong_tien');
											var vanChuyenElement = document.getElementById('vchuyen');
											var cartDiscountElement = parseInt(discountElement.textContent.replace(/[^0-9]/g, ''));
											var cartTotal = parseInt(cartTotalElement.textContent.replace(/[^0-9]/g, ''));
											var vanChuyen = parseInt(vanChuyenElement.textContent.replace(/[^0-9]/g, ''));
											var tongTien = cartTotal - cartDiscountElement;

											// Hiển thị tổng tiền sau khi áp dụng giảm giá từ voucher
											tongTienElement.textContent = tongTien.toLocaleString() + "Đ";
										}
									})
									.catch(error => {
										var discountElement = document.getElementById('discount');
										discountElement.textContent = 'Đã xảy ra lỗi.'; // Hiển thị thông báo lỗi chung
										console.error('Error:', error);
									});
							});
							document.getElementById('pay').addEventListener('click', function(e) {
								e.preventDefault();
								// Lấy giá trị tổng tiền từ phần tử HTML
								var tongTienElement = document.getElementById('tong_tien');
								var tongTien = tongTienElement.textContent;
								// Lấy tất cả các nút "Pay" trong trang
								var payButtons = document.querySelectorAll('.pay-button');
								// Lấy giá trị ma_don_hang từ thuộc tính data
								var maDonHang = this.getAttribute('data-ma-don-hang');
								// Tạo đối tượng FormData
								var formData = new FormData();
								formData.append('tong_tien', tongTien);
								formData.append('ma_don_hang', maDonHang);
								// Thiết lập các tùy chọn yêu cầu
								var requestOptions = {
									method: 'POST',
									body: formData,
									redirect: 'follow'
								};
								// Gửi yêu cầu Ajax đến server
								fetch('/gio-hang/save', requestOptions)
									.then(response => response.json())
									.then(data => {
										// Xử lý kết quả
										console.log(data);
										if (data.success) {
											// Chuyển hướng đến trang "giaodich/thanhtoan"
											window.location.href = '/giao-dich/thanh-toan';
										}
									})
									.catch(error => {
										console.error('Error:', error);
									});
							});

							
						</script>
					</div>
				</div>
				<!-- Cart End -->
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
<script>
	// JavaScript function update_product
	function update_product(id, ms) {
		const quantity = document.getElementById(`quantity${id}`).value;
		const data = new FormData();
		data.append('ma_ct_don_hang', id);
		data.append('ma_sach', ms);
		data.append(`quantity${id}`, quantity);

		var requestOptions = {
			method: 'POST',
			body: data,
			redirect: 'follow'
		};

		fetch('/gio-hang/sua', requestOptions)
			.then(response => response.json())
			.then(result => {
				if (result.success) {
					setTimeout(function() {
						location.reload();
					}, 1500);
				} else {
					console.log(result);
					const error = result.error;
					if (error) {
						msgbox_error(error);
					}
				}
			})
			.catch(error => msgbox_error(error));
	}

	function delete_product(id, ms, name) {
		const is_confirm = confirm(`Bạn muốn xóa sản phẩm "${name}" ?`);
		if (!is_confirm) {
			return;
		}

		const data = new FormData();
		data.append('ma_ct_don_hang', id);
		data.append('ma_sach', ms);
		var requestOptions = {
			method: 'POST',
			body: data,
			redirect: 'follow'
		};

		fetch('/gio-hang/xoa', requestOptions)
			.then(response => response.json())
			.then(result => {
				if (result.success) {
					setTimeout(function() {
						location.reload();
					}, 1500);
					return true;
				} else {
					console.log(result);
					const error = result.result.error;
					if (error) {
						msgbox_error(error);
						return false;
					}
				}
			})
			.catch(error => msgbox_error(error));
	}
</script>

<?= $this->endSection() ?>