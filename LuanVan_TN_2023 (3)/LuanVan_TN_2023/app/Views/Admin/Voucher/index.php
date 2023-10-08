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
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Danh sách Voucher</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-block">

                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Mã Voucher</th>
                                                <th style="width: 30px;">Ngày Bắt Đầu</th>
                                                <th style="width: 30px;">Ngày Kết Thúc</th>
                                                <th style="width: 30px;">Loại Voucher</th>
                                                <th style="width: 30px;">Trạng Thái</th>
                                                <th style="width: 70px;">Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($voucher) || !empty($voucher)) : ?>
                                                <?php foreach ($voucher as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['ma_voucher'] ?> </td>
                                                        <td><?= $item['ngay_bat_dau'] ?></td>
                                                        <td> <?= $item['ngay_ket_thuc'] ?></td>
                                                        <td>
                                                            <?php if ($item['loai_khuyen_mai'] == 0) : ?>
                                                                <span>Voucher Vận Chuyển</span>
                                                            <?php else : ?>
                                                                <span>Voucher Giá Trị Dơn Hàng</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox-fade fade-in-primary d-flex justify-content-center">
                                                                <label>
                                                                    <input type="checkbox" id="checkbox2" name="status" value="" <?= $item['status'] == 1 ? 'checked' : '' ?>>
                                                                    <span class="cr">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>

                                                            <div class="btn-group btn-group-sm">
                                                                <a href="<?= base_url('dashboard/voucher/manage/detail/' . $item['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                </a>
                                                                <a href="javascript:void(0)" onclick="delete_product('<?= $item['id']  ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                    <span class="icofont icofont-ui-delete"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>


<?= $this->endSection() ?>