<?= $this->extend('Admin/layout') ?>
<?= $this->section('css') ?>
<!-- Select 2 css -->
<link rel="stylesheet" href="<?= base_url() ?>\templates\libraries\bower_components\select2\css\select2.min.css">

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        background-color: white !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #01a9ac !important;
    }
</style>
<?= $this->endSection() ?>

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
                                    <h4><?= $title ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <!-- Main-body start -->

                <!-- Page-header start -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product edit card start -->
                            <div class="card">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php $errors = session()->getFlashdata('error_msg') ?>
                                        <?php if (!empty($errors)) :  ?>
                                            <?php if (!is_array($errors)) : ?>
                                                <div class="alert alert-danger mb-1">
                                                    <?= $errors ?>
                                                </div>
                                            <?php else : ?>
                                                <?php foreach ($errors as $error) : ?>
                                                    <div class="alert alert-danger mb-1">
                                                        <?= $error ?>
                                                    </div>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <div class="product-edit">
                                            <form class="md-float-material card-block" id="j-forms" action="<?= base_url('dashboard/voucher/manage/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="voucher_id" value="<?= !empty($voucher['id']) ? $voucher['id'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Mã Voucher</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="voucher" name="ma_voucher" readonly placeholder="Mã Voucher" value="<?= !empty($voucher['ma_voucher']) ? $voucher['ma_voucher'] : set_value('ma_voucher') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Loại Khuyến Mãi</label>
                                                        <select name="voucher_category" class="form-control" id="loai_khuyen_mai" onchange="generateVoucher()" required>
                                                            <?php foreach (VOUCHER_CATEGORY as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($voucher['loai_khuyen_mai']) && $voucher['loai_khuyen_mai'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Số Lượng Khuyến Mãi</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="so_luong" name="soluong" placeholder="Số Lượng" value="<?= !empty($voucher['so_luong']) ? $voucher['so_luong'] : set_value('so_luong') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Phần Trăm Khuyến Mãi</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="phan_tram" name="phanttram" placeholder="Phần Trăm Khuyến Mãi" value="<?= !empty($voucher['so_luong']) ? $voucher['so_luong'] : set_value('so_luong') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Ngày Bắt Đầu Khuyến Mãi</label>
                                                        <div class="input-group">
                                                            <input type="datetime-local" class="form-control" id="date_start" name="date_start" value="<?= !empty($voucher['ngay_bat_dau']) ? $voucher['ngay_bat_dau'] : set_value('ngay_bat_dau') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Ngày Kết Thúc Khuyến Mãi</label>
                                                        <div class="input-group">
                                                            <input type="datetime-local" class="form-control" id="date_end" name="date_end" value="<?= !empty($voucher['ngay_ket_thuc']) ? $voucher['ngay_ket_thuc'] : set_value('ngay_ket_thuc') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control" required>
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($voucher['status'])  && $voucher['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>



                                                </div>
                                                <script>
                                                    function generateVoucher() {
                                                        var loai_khuyen_mai = document.getElementById('loai_khuyen_mai').value;
                                                        var voucher = '';

                                                        if (loai_khuyen_mai == '0') {
                                                            voucher = 'VC';
                                                        } else {
                                                            voucher = 'DH';
                                                        }

                                                        voucher += generateRandomNumbers(5);

                                                        // Assign the generated voucher code to the input field
                                                        document.getElementById('voucher').value = voucher;
                                                    }

                                                    function generateRandomNumbers(length) {
                                                        var numbers = '123456789';
                                                        var randomNumbers = '';
                                                        for (var i = 0; i < length; i++) {
                                                            randomNumbers += numbers.charAt(Math.floor(Math.random() * numbers.length));
                                                        }
                                                        return randomNumbers;
                                                    }

                                                    function checkDateValidity() {
                                                        var dateStart = document.getElementById('date_start').value;
                                                        var dateEnd = document.getElementById('date_end').value;

                                                        if (dateStart && dateEnd && dateEnd < dateStart) {
                                                            alert("Ngày kết thúc không được nhỏ hơn ngày bắt đầu");
                                                            document.getElementById('date_end').value = ''; // Xóa giá trị ngày kết thúc không hợp lệ
                                                        }
                                                    }

                                                    document.getElementById('date_start').addEventListener('change', checkDateValidity);
                                                    document.getElementById('date_end').addEventListener('change', checkDateValidity);
                                                </script>


                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu</button>
                                                            <a href="<?= base_url('dashboard/voucher/manage') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
<!-- Select 2 js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\cleave\dist\cleave.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\select2\js\select2.full.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\jquery.quicksearch.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\advance-elements\select2-custom.js"></script>
<!-- Clone form -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\j-pro\js\jquery-cloneya.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\j-pro\js\custom\cloned-form.js"></script>
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');


    var cleave = new Cleave('.cleave1', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    var cleave2 = new Cleave('.cleave2', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });







    function delete_image(id, imgName) {
        const is_confirm = confirm(`Bạn muốn xóa hình ảnh "${imgName}" không?`);
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

        fetch('<?= base_url('dashboard/posts/manage/delete/image') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`img-${id}`).remove()
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