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
					<h1>Đơn đặt hàng</h1>
					<ol class="tg-breadcrumb">
						<li><a href="javascript:void(0);">Trang Chủ</a></li>
						<li class="tg-active">Đơn đặt hàng</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
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
                        <th>Ngày đặt hàng</th>
                        <th>Phương thức thanh toán</th>

                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (isset($order) && !empty($order)) : ?>
                        <?php foreach ($order as $item) : ?>
                            <tr>
                                <td class="align-middle">
                                    <span class="font-weight-bold"><a href=""><?= $item['name'] ?></a></span><br>
                                </td>
                                <td class="align-middle">
                                    <?php $price = $item['don_gia'] - ($item['don_gia'] * ($item['discount'] / 100)) ?>
                                    <?= number_format($price) ?>Đ
                                    <span style="text-decoration: line-through;"><?= number_format($item['don_gia']) ?>Đ</span>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <?= $item['quantity'] ?>
                                    </div>
                                </td>
                                <td class="align-middle"><?= number_format($item['quantity'] * $price) ?></td>
                                <td><?=$item['ngay_dat']?></td>
                                <td> <?= PAYMENT_METHOD[$item['phuong_thuc']] ?></td>
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
                    <h4 class="font-weight-semi-bold m-0">Thông tin khách hàng</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium"><?= $order[0]['dia_chi'] ?></h6>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('giao-dich/lich-su-mua') ?>"><button class="btn btn-block btn-primary my-3 py-3">Quay lại</button></a>

        </div>

    </div>
</div>
<!-- Cart End -->
<?= $this->endSection() ?>