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
                                    <h4>Danh sách Banner</h4>
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
                                                <th style="width: 10px;text-align: center;">Mã Banner</th>
                                                <th style="width: 50px;text-align: center;">Ảnh</th>
                                                <th style="width: 10px;text-align: center;">Trạng Thái</th>
                                                <th style="width: 10px;text-align: center;">Quản Lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($banner) || !empty($banner)) : ?>
                                                <?php foreach ($banner as $item) : ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $item['ma_banner'] ?> </td>
                                                        <td  style="text-align: center;">
                                                            <?php if (!empty($item['hinh_anh'])) : ?>
                                                                <img src="<?= base_url('uploads/banner/' . $item['hinh_anh']) ?>" alt="Banner Image" width="100px" height="100px">
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
                                                        <td style="text-align: center;">

                                                        <div class="btn-group btn-group-sm">
                                                                        <a href="<?= base_url('dashboard/banner/manage/detail/'.$item['ma_banner']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                            <span class="icofont icofont-ui-edit"></span>
                                                                        </a>
                                                                        <a href="javascript:void(0)" onclick="delete_product('<?= $item['ma_banner'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
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
<script>
    function delete_account(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa tài khoản "${name}" ?`);
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

        fetch('<?= base_url('dashboard/category/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`menu-${id}`).remove()
                    return
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>

<?= $this->endSection() ?>