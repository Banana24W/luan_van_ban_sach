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
                                    <h4>Danh sách Nhà Xuất Bản</h4>
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
                                <a href="<?=base_url('dashboard/nxb/detail')?>"><button style="float: right;" class="btn btn-primary waves-effect waves-light m-r-10">Thêm Nhà Xuất Bản</button></a>

                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>

                                                <th>Tên Nhà Xuất Bản</th>
                                                <th style="width: 30px;">Trạng Thái</th>
                                                <th style="width: 70px;">Quản Lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($NXB) || !empty($NXB)) : ?>
                                            <?php foreach ($NXB as $item) : ?>
                                            <tr>

                                                <td><?= $item['ten_nha_xuat_ban'] ?></td>
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
                                                    <div style="width: 90px;" class="btn-group btn-group-sm">
                                                        <a href ="<?= base_url('dashboard/nxb/edit/'.$item['ma_nha_xuat_ban']) ?>"  style="margin: 4px;"  class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a>
                                                        <a href ="<?= base_url('dashboard/nxb/delete/'.$item['ma_nha_xuat_ban']) ?>" style="margin: 4px;" onclick="delete_account('<?= $item['ma_nha_xuat_ban'] ?>', '<?= $item['ten_nha_xuat_ban'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
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

        fetch('<?= base_url('dashboard/nxb/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    
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
