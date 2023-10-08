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
                                    <h4>Danh sách Loại Sách</h4>
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
                                <a href="<?=base_url('dashboard/category/detail')?>"><button style="float: right;" class="btn btn-primary waves-effect waves-light m-r-10">Thêm Loại Sách</button></a>

                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>

                                                <th>Tên Loại Sách</th>
                                                <th style="width: 30px;">Trạng Thái</th>
                                                <th style="width: 70px;">Quản Lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($category) || !empty($category)) : ?>
                                            <?php foreach ($category as $item) : ?>
                                            <tr>

                                                <td><?= $item['ten_loai_sach'] ?></td>
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
                                                        <a href ="<?= base_url('dashboard/category/edit/'.$item['ma_loai_sach']) ?>"  style="margin: 4px;"  class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a>
                                                        <a href ="<?= base_url('dashboard/category/delete/'.$item['ma_loai_sach']) ?>" style="margin: 4px;" onclick="delete_category('<?= $item['ma_loai_sach'] ?>', '<?= $item['ten_loai_sach'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
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
    function delete_category(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa loại sách  "${name}" ?`);
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
