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
                        <li class="tg-active">Thanh Toán</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .container-fluid {
        padding-top: 2rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    .custom-control-label {
        border-radius: 0.25rem;
        padding: 0.5rem;
        border: 1px solid #ced4da;
        width: 100%;
    }

    .card {
        border-radius: 0.25rem;
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header {
        background-color: #28a745;
        color: #fff;
        border-bottom: none;
        padding: 0.75rem 1.25rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    .card-footer {
        border-top: none;
        padding: 0.75rem 1.25rem;
    }

    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        width: 100%;
    }
</style>
<!-- Checkout Start -->
<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container-fluid pt-5">
        <form action="<?= base_url('giao-dich/thanh-toan') ?>" method="post" id="main">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <input type="hidden" name="customer_id" value="<?= $customer['id'] ?>">
                        <input type="hidden" name="carts_id" value="<?= $carts['ma_don_hang'] ?>">
                        <h4 class="font-weight-semi-bold mb-4">Địa chỉ thanh toán</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Họ</label>
                                <input class="form-control" type="text" name="firstname" placeholder="FirstName" value="<?= $customer['first_name'] ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tên</label>
                                <input class="form-control" type="text" name="lastname" placeholder="LastName" value="<?= $customer['last_name'] ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" placeholder="example@email.com" value="<?= $customer['email'] ?>">
                            </div>
                            <style>
                                .change-address-btn {
                                    text-align: right;
                                    margin-top: 10px;
                                }

                                .hidden {
                                    display: none;
                                }

                                .show {
                                    display: block;
                                }

                                .address-list {
                                    list-style-type: none;
                                    padding: 0;
                                    margin: 0;
                                }

                                .address-list li {
                                    margin-bottom: 10px;
                                }

                                .address-list li span {
                                    display: inline-block;
                                    margin-left: 10px;
                                }

                                .add-address {
                                    margin-top: 10px;
                                }
                            </style>
                            <?php foreach ($addresses as $address) : ?>
                                <?php if ($address['status'] == 1) : ?>
                                    <div class="address-wrapper">
                                        <div class="col-md-6 form-group">
                                            <label>Số điện thoại</label>
                                            <input class="form-control" type="text" name="telephone" placeholder="Phone" value="0<?= $address['phone'] ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Địa chỉ nhận hàng</label>
                                            <input class="form-control" type="text" name="address1" placeholder="Address" value="<?= $address['diachi'] ?>">
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <div class="change-address-btn">
                                <input class="btn btn-primary" onclick="toggleAddress()" type="button" value="Thay đổi địa chỉ">

                            </div>
                            <div id="myDIV" class="hidden">

                                <h4>Danh sách địa chỉ</h4>

                                <!-- Hiển thị danh sách địa chỉ -->
                                <select name="selectedAddress">
                                    <?php foreach ($addresses as $address) : ?>
                                        <?php if ($address['status'] == 0) : ?>
                                            <option value="<?= $address['id'] ?>">
                                                Tên Người Nhận <?=$carts['Ten_nguoi_nhan']?>,Số điện Thoại: 0<?= $address['phone'] ?>,Địa Chỉ: <?= $address['diachi'] ?>
                                            </option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </select>


                                <input class="btn btn-primary add-address" style="width: 350px;height: 50px;" id="dat_mat_dinh" value="Đặt làm địa chỉ mặc định">
                            </div>
                            <div style="padding-top: 10px;"><input class="btn btn-primary" onclick="toggleAddresss()" type="button" value="Thêm địa chỉ"></div>


                            <script>
                                function toggleAddress() {
                                    var myDIV = document.getElementById("myDIV");
                                    myDIV.classList.toggle("hidden");
                                    myDIV.classList.toggle("show");
                                }

                                function toggleAddresss() {
                                    var myDIV = document.getElementById("them_dia_chi");
                                    myDIV.classList.toggle("hidden");
                                    myDIV.classList.toggle("show");
                                }
                                document.getElementById("dat_mat_dinh").addEventListener("click", function(event) {
                                    var selectedAddressId = document.querySelector('select[name="selectedAddress"]').value;

                                    var formData = new FormData();
                                    formData.append('address_id', selectedAddressId);

                                    // Gửi yêu cầu AJAX để cập nhật trạng thái địa chỉ
                                    fetch('/giao-dich/capnhatdiachi', {
                                            method: 'POST',
                                            body: formData
                                        })
                                        .then(response => response.json())
                                        .then(result => {
                                            if (result.success) {
                                                location.reload(); // Reload lại trang
                                            } else {
                                                // Xử lý phản hồi không thành công (nếu cần)
                                            }
                                        })
                                        .catch(error => {
                                            console.error(error);
                                            // Xử lý lỗi (nếu cần)
                                        });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Tổng số đặt hàng</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                            <?php $cartTotal = 0; ?>
                            <?php $cartDiscount = 0; ?>
                            <?php $quantity = 0; ?>
                            <?php foreach ($cartProducts as $item) : ?>
                                <input type="hidden" name="product_id[]" value="<?= $item['productID'] ?>">
                                <input type="hidden" name="quantity[]" value="<?= $item['quantity'] ?>">
                                <div class="d-flex justify-content-between">
                                    <p>
                                        <b>Tên Sách :</b><?= $item['productName'] ?>
                                        <br>
                                        <b>Số lượng:</b> <?= $item['quantity'] ?>
                                        <br>
                                    </p>
                                    <p class="text-muted ml-2"><b>Giá Bán: </b><?= $item['productPrice'] ?>Đ</p>
                                </div>
                            <?php endforeach ?>
                            <hr class="mt-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium"><b>Tiền hàng(Tạm tính)</b></h6>
                                <h6 class="font-weight-medium"><?= $checkoutTotal['price'] ?>Đ</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium"><b>Giảm giá</b></h6>
                                <h6 class="font-weight-medium"><?= $checkoutTotal['discount'] ?>Đ</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium"><b>Giảm giá Voucher</b></h6>
                                <h6 class="font-weight-medium"><?= $checkoutTotal['discount_voucher'] ?>Đ</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium"><b> Phí vận chuyển</b></h6>
                                <h6 class="font-weight-medium">25,000Đ</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold"><b>Tổng tiền</b></h5>
                                <input type="hidden" value="<?= $checkoutTotal['discount'] ?>">
                                <input type="hidden" name="total" value="<?= $checkoutTotal['total'] ?>">
                                <h5 class="font-weight-bold"><?= $checkoutTotal['total'] ?>Đ</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" value="0" id="paypal">
                                    <label class="custom-control-label" for="paypal">Ví MoMo</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" value="1" id="directcheck" checked>
                                    <label class="custom-control-label" for="directcheck">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" id="dat_hang">Đặt hàng</button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
        <!-- Form thêm địa chỉ (ban đầu ẩn) -->
        <style>
            .form-container {

                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
            }

            .form-wrapper {
                width: 500px;
                padding: 20px;
                background-color: #f2f2f2;
                margin: 100px auto;
            }

            .form-wrapper label {
                display: block;
                margin-top: 10px;
            }

            .form-wrapper input[type="text"],
            .form-wrapper input[type="tel"],
            .form-wrapper select {
                width: 100%;
                padding: 5px;
                margin-top: 5px;
            }

            .form-wrapper input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 15px;
                border: none;
                cursor: pointer;
            }

            .form-wrapper input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>

        <div id="them_dia_chi" class="hidden" style="padding-top: 20px;">
            <!-- Nội dung của form -->
            <fieldset>
                <form id="address" action="<?= base_url('giao-dich/themdiachi') ?>" method="post">
                    <div class="form-container">
                        <div class="form-wrapper">
                            <div>
                                <input type="text" name="address" placeholder="Chi Tiết Số Nhà, Tên Đường...." required />
                            </div>
                            <br>
                            <select class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm" name="city">
                                <option value="" selected>Chọn Tỉnh, Thành Phố</option>
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
                                <input type="hidden" name="customer_id" value="<?= $customer['id'] ?>">
                                <input type="tel" name="phone" placeholder="Phone...." required />
                            </div>
                            <br>
                            <input id="them" type="submit" value="Lưu địa chỉ">
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>

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
            document.getElementById('address').addEventListener('submit', function(event) {
                var form = event.target;
                var formData = new FormData(form);
                // Gửi yêu cầu AJAX để lưu địa chỉ
                axios.post(form.action, formData)
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
            });
        </script>


    </div>
</main>

<!-- Checkout End -->
<?= $this->endSection() ?>