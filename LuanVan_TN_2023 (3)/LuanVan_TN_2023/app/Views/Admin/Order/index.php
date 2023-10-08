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
                                    <h4>Danh sách đơn hàng</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Tablist start -->


                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="allProducts">
                                    <div class="card">
                                        <!-- Rest of the code for the product list -->
                                        <div class="table-responsive">

                                            <div class="table-content">

                                                <div class="project-table">

                                                    <table class="table dt-responsive nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th width="10%" class="text-center">Mã đơn hàng</th>
                                                                <th width="25%" class="text-center">Người nhận</th>
                                                                <th width="25%" class="text-center">Tổng tiền</th>
                                                                <th width="10%" class="text-center">Trạng thái</th>
                                                                <th width="10%" class="text-center">Quản lý</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($order)) : ?>
                                                                <?php foreach ($order as $orders) : ?>
                                                                    <?php if (!empty($orders['tong_tien'])) : ?>
                                                                        <tr id="product-<?= $orders['ma_don_hang'] ?>">
                                                                            <td style="text-align: center;" class="font-weight-bold"><?= $orders['ma_don_hang'] ?></th>
                                                                            <td style="text-align: center;" class="font-weight-bold"><?= $orders['Ten_nguoi_nhan'] ?></th>
                                                                            <td style="text-align: center;" class="font-weight-bold"><?= $orders['tong_tien'] ?></th>
                                                                            <td width="40%" class="text-center">
                                                                                <select name="status" class="form-control" required onchange="updateStatus(this,<?= $orders['ma_don_hang'] ?>)">
                                                                                    <?php foreach (CHECKOUT_STATUS as $key => $val) : ?>
                                                                                        <option value="<?= $key ?>" <?= !empty($orders['trang_thai_don_hang'])  && $orders['trang_thai_don_hang'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                                    <?php endforeach ?>
                                                                                </select>
                                                                                <script>
                                                                                    function updateStatus(selectElement, orderID) {
                                                                                        var statusValue = selectElement.value;
                                                                                        var formData = new FormData();
                                                                                        formData.append('order_id', orderID);
                                                                                        formData.append('status', statusValue);
                                                                                        var requestOptions = {
                                                                                            method: 'POST',
                                                                                            body: formData,
                                                                                            redirect: 'follow'
                                                                                        };
                                                                                        fetch('manage/capnhat', requestOptions)
                                                                                            .then(response => response.json())
                                                                                            .then(data => {
                                                                                                // Xử lý phản hồi từ server
                                                                                                console.log(data);
                                                                                                // Kiểm tra phản hồi thành công và cập nhật trạng thái trên trang
                                                                                                if (data.success) {
                                                                                                    var statusElement = document.querySelector('#status-' + orderID);
                                                                                                    if (statusElement) {
                                                                                                        statusElement.textContent = data.message;
                                                                                                    }
                                                                                                }
                                                                                            })
                                                                                            .catch(error => {
                                                                                                // Xử lý lỗi nếu có
                                                                                                console.error(error);
                                                                                            });
                                                                                    }
                                                                                </script>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div class="btn-group btn-group-sm">
                                                                                    <a href="<?= base_url('dashboard/order/manage/detail/' . $orders['ma_don_hang']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                        <span class="icofont icofont-ui-check"></span>
                                                                                    </a>

                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            <?php else : ?>
                                                                <tr>
                                                                    <td colspan="7" class="text-center">Hiện không có sản phẩm nào</td>
                                                                </tr>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product list card end -->
                                </div>


                            </div>
                            <!-- Tablist end -->
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <?php if (!empty($pager)) : ?>
                                <?= $pager->links('default', 'default_full') ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>