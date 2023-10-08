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
                                    <h4>Danh sách Sản Phẩm</h4>
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
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a style="color: black;" class="nav-link active" data-toggle="tab" href="#allProducts">Tất cả sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a style="color: black;" class="nav-link" data-toggle="tab" href="#ProductsActive">Sản phẩm đang hoạt động</a>
                                </li>
                                <li class="nav-item">
                                    <a style="color: black;" class="nav-link" data-toggle="tab" href="#ProductDiscount">Sản phẩm phẩm giảm giá</a>
                                </li>
                                <a href="<?= base_url('dashboard/product/manage/detail') ?>"><button style="float: right;" class="btn btn-primary waves-effect waves-light m-r-10">Thêm Sản Phẩm</button></a>
                            </ul>

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
                                                                <th width="50%" class="text-center">Tên sản phẩm</th>
                                                                <th width="20%" class="text-center">Trạng thái</th>
                                                                <th width="10%" class="text-center"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($products)) : ?>
                                                                <?php foreach ($products as $product) : ?>

                                                                    <tr id="product-<?= $product['ma_sach'] ?>">
                                                                        <td style="text-align: center;" class="font-weight-bold"><?= $product['ten_sach'] ?></th>
                                                                        <td width="10%" class="text-center"><?= PRODUCT_STATUS[$product['status']] ?></td>
                                                                        <td class="text-center">
                                                                            <div class="btn-group btn-group-sm">
                                                                                <a href="<?= base_url('dashboard/product/manage/detail/' . $product['ma_sach']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                    <span class="icofont icofont-ui-edit"></span>
                                                                                </a>
                                                                                <a href="javascript:void(0)" onclick="delete_product('<?= $product['ma_sach'] ?>', '<?= $product['ten_sach'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                    <span class="icofont icofont-ui-delete"></span>
                                                                                </a>
                                                                            </div>
                                                                        </td>
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
                                <div class="tab-pane fade" id="ProductsActive">

                                    <div class="card">
                                        <div class="table-responsive">
                                            <div class="table-content">
                                                <div class="project-table">
                                                    <table class="table dt-responsive nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th width="50%" class="text-center">Tên sản phẩm</th>
                                                                <th width="20%" class="text-center">Trạng thái</th>
                                                                <th width="10%" class="text-center"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($products)) : ?>
                                                                <?php foreach ($products as $product) : ?>
                                                                    <?php if ($product['status'] == 1) : ?>
                                                                        <tr id="product-<?= $product['ma_sach'] ?>">
                                                                            <td style="text-align: center;" class="font-weight-bold"><?= $product['ten_sach'] ?></th>
                                                                            <td width="10%" class="text-center"><?= PRODUCT_STATUS[$product['status']] ?></td>
                                                                            <td class="text-center">
                                                                                <div class="btn-group btn-group-sm">
                                                                                    <a href="<?= base_url('dashboard/product/manage/detail/' . $product['ma_sach']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                        <span class="icofont icofont-ui-edit"></span>
                                                                                    </a>
                                                                                    <a href="javascript:void(0)" onclick="delete_product('<?= $product['ma_sach'] ?>', '<?= $product['ten_sach'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                        <span class="icofont icofont-ui-delete"></span>
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

                                </div>
                                <div class="tab-pane fade" id="ProductDiscount">

                                    <div class="card">
                                        <div class="table-responsive">
                                            <div class="table-content">
                                                <div class="project-table">
                                                    <table class="table dt-responsive nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th width="50%" class="text-center">Tên sản phẩm</th>
                                                                <th width="50%" class="text-center">Giảm Giá</th>
                                                                <th width="20%" class="text-center">Trạng thái</th>
                                                                <th width="10%" class="text-center">Quản Lý</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($products)) : ?>
                                                                <?php foreach ($products as $product) : ?>
                                                                    <?php if ($product['khuyen_mai'] > 0) : ?>
                                                                        <tr id="product-<?= $product['ma_sach'] ?>">
                                                                            <td style="text-align: center;" class="font-weight-bold"><?= $product['ten_sach'] ?></th>
                                                                            <td style="text-align: center;" class="font-weight-bold"><?= $product['khuyen_mai'] ?></th>
                                                                            <td width="10%" class="text-center"><?= PRODUCT_STATUS[$product['status']] ?></td>
                                                                            <td class="text-center">
                                                                                <div class="btn-group btn-group-sm">
                                                                                    <a href="<?= base_url('dashboard/product/manage/detail/' . $product['ma_sach']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                        <span class="icofont icofont-ui-edit"></span>
                                                                                    </a>
                                                                                    <a href="javascript:void(0)" onclick="delete_product('<?= $product['ma_sach'] ?>', '<?= $product['ten_sach'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                        <span class="icofont icofont-ui-delete"></span>
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
                    // If result.success is not true, reload the page
                    window.location.reload();
                    return
                }


                if (result.error) {
                    msgbox_error(result.message)
                    return
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>

<?= $this->endSection() ?>