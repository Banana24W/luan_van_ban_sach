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
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Mã đơn đặt hàng</th>
                        <th>Tên người mua</th>
                        <th>Loại thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                <?php if (isset($order) && !empty($order)) : ?>
                        <?php foreach ($order as $item) : ?>
                            <tr>
                                <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                    <span class="font-weight-bold"><?= $item['ma_don_hang'] ?></span>
                                </td>
                                <td>
                                    <span class="font-weight-bold">
                                    <?= $item['Ten_nguoi_nhan'] ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                <?= PAYMENT_METHOD[$item['payment_method']] ?>
                                </td>
                                <td class="align-middle">
                                <?= CHECKOUT_STATUS[$item['trang_thai_don_hang']] ?>
                                </td>
                                <td class="align-middle"><a href="<?= base_url('giao-dich/lich-su-mua/chi-tiet') . '/' . $item['ma_don_hang'] ?>" class="btn btn-sm btn-primary">Xem</button></td>
                                <td class="align-middle"><a href="<?= base_url('giao-dich/lich-su-mua/huy-don') . '/' . $item['ma_don_hang'] ?>" class="btn btn-sm btn-primary">Hủy</button></td>
                            </tr>
                            <?php endforeach ?>
                    <?php else : ?>
                        <td colspan="5">Không có lịch sử giao dịch.</td>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- Cart End -->
<?= $this->endSection() ?>