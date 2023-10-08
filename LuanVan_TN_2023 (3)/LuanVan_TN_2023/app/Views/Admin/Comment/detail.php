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
                                    <h4>Sản phẩm trong đơn hàng</h4>
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
                                        <div class="table-responsive">
                                            <div class="table-content">
                                                <div class="project-table">
                                                    <table class="table dt-responsive nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th width="50%" class="text-center">Tên sản phẩm</th>
                                                                <th width="20%" class="text-center">Số lượng</th>
                                                                <th width="20%" class="text-center">Đơn giá</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($cart)) : ?>
                                                                <?php foreach ($cart as $cart) : ?>

                                                                    <tr id="product-<?= $cart['ma_sach'] ?>">
                                                                        <td style="text-align: center;" class="font-weight-bold"><?= $cart['name'] ?></th>
                                                                        <td style="text-align: center;" class="font-weight-bold"><?= $cart['quantity'] ?></th>
                                                                        <td style="text-align: center;" class="font-weight-bold"><?= $cart['don_gia'] ?></th>
                                                                    </tr>

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

<script>
    function delete_product(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa sản phẩm "${name}" ?`);
        if (!is_confirm) {
            return
        }

        const data = new FormData();
        data.append('id', id);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= base_url('dashboard/product/manage/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`product-${id}`).remove()
                    return true
                }
                console.log(result)

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return false
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>

<?= $this->endSection() ?>