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
                                        <?php
                                        if (!$NXB) {
                                            $message = 'Bạn cần có danh mục trước mới có thể thêm sản phẩm';
                                            $redirectUrl = 'dashboard/nxb/detail';
                                            $basename = $redirectUrl;
                                            $baseUrl = 'http://localhost:8080/';
                                            echo '<script>';
                                            echo 'alert("' . $message . '");';
                                            echo 'window.location.href = "' . $baseUrl . $basename . '";';
                                            echo '</script>';
                                        }
                                        if (!$category) {
                                            $message = 'Bạn cần có danh mục trước mới có thể thêm sản phẩm';
                                            $redirectUrl = 'dashboard/category/detail';
                                            $basename = $redirectUrl;
                                            $baseUrl = 'http://localhost:8080/';
                                            echo '<script>';
                                            echo 'alert("' . $message . '");';
                                            echo 'window.location.href = "' . $baseUrl . $basename . '";';
                                            echo '</script>';
                                        }

                                        ?>
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
                                            <form class="md-float-material card-block" id="j-forms" action="<?= base_url('dashboard/product/manage/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?= !empty($product['ma_sach']) ? $product['ma_sach'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Tên sản phẩm</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên dòng sản phẩm" value="<?= !empty($product['ten_sach']) ? $product['ten_sach'] : set_value('ten_sach') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Lần Tái Bản</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave2" min="0" name="lantaiban" id="lantaiban" placeholder="Lần Tái Bản" value="<?= !empty($product['lan_tai_ban']) ? $product['lan_tai_ban'] : set_value('lan_tai_ban') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Mô tả về sản phẩm</h5>
                                                        <small>Mộ tả về sản phẩm, có thể sử dụng link hình ảnh trong mô tả.</small>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="description" id="editor2" required><?= !empty($product['mo_ta_sach']) ? $product['mo_ta_sach'] : set_value('mo_ta_sach') ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Giá</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave1" min="0" id="price" name="price" placeholder="Giá sản phẩm" value="<?= !empty($product['gia']) ? $product['gia'] : set_value('gia') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Tên Tác Giả</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave1" min="0" id="author" name="author" placeholder="Tên Tác Giả" value="<?= !empty($product['tac_gia']) ? $product['tac_gia'] : set_value('tac_gia') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="slug">Giảm giá (%)</label>
                                                        <div class="input-group">
                                                            <input type="number" max="100" min="0" class="form-control" name="discount" placeholder="Giảm giá" value="<?= !empty($product['khuyen_mai']) ? $product['khuyen_mai'] : set_value('khuyen_mai') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Số lượng</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave2" min="0" name="quantity" id="quantity" placeholder="Số lượng" value="<?= !empty($product['so_luong']) ? $product['so_luong'] : set_value('so_luong') ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="namxuatban">Năm Xuất Bản</label>
                                                        <div class="input-group">
                                                            <select class="form-control" name="namxuatban" id="namxuatban" required>
                                                                <option value="">Chọn Năm</option>
                                                                <?php
                                                                $currentYear = date('Y');
                                                                for ($year = $currentYear; $year >= $currentYear - 100; $year--) {
                                                                    $selected = (!empty($product['nam_xuat_ban']) && $product['nam_xuat_ban'] == $year) ? 'selected' : '';
                                                                    echo '<option value="' . $year . '"' . $selected . '>' . $year . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="menu_id">Danh mục Sách</label>
                                                        <div class="input-group">
                                                            <select name="category" class="form-control js-example-basic-single">
                                                                <option value="">Danh mục Sách</option>
                                                                <?php if (isset($category)) : ?>
                                                                    <?php foreach ($category as $item) : ?>

                                                                        <option value="<?= $item['ma_loai_sach'] ?>" <?= !empty($product['ma_loai_sach']) && $product['ma_loai_sach'] == $item['ma_loai_sach'] ? 'selected' : '' ?>><?= $item['ten_loai_sach'] ?></option>

                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="menu_id">Danh mục Nhà Xuất Bản</label>
                                                        <div class="input-group">
                                                            <select name="nxb" class="form-control js-example-basic-single">
                                                                <option value="">Danh mục Nhà Xuất Bản</option>
                                                                <?php if (isset($NXB)) : ?>
                                                                    <?php foreach ($NXB as $item) : ?>

                                                                        <option value="<?= $item['ma_nha_xuat_ban'] ?>" <?= !empty($product['ma_nha_xuat_ban']) && $product['ma_nha_xuat_ban'] == $item['ma_nha_xuat_ban'] ? 'selected' : '' ?>><?= $item['ten_nha_xuat_ban'] ?></option>

                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control" required>
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($product['status'])  && $product['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="name">Số Trang</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cleave2" min="0" name="sotrang" id="sotrang" placeholder="Số Trang" value="<?= !empty($product['so_trang']) ? $product['so_trang'] : set_value('so_trang') ?>" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mb-3 mt-3">
                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>Ảnh đại diện sản phẩm</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hãy chọn thật kỹ ảnh để tránh xảy ra sai sót.</h6>
                                                        <?php $uri = service('uri'); ?>
                                                        <input type="file" name="anhdaidien" id="filer_input" <?= !empty($uri->getSegment(5)) ? '' : 'required' ?>>
                                                        <?php if (!empty($product['anh_dai_dien'])) : ?>
                                                            <ul id="product-image" class="jFiler-items-list jFiler-items-default">
                                                                <li class="jFiler-item" data-jfiler-index="0" id="img-<?= !empty($product['ma_sach']) ? $product['ma_sach'] : set_value('ma_sach') ?>">
                                                                    <div class="jFiler-item-container">
                                                                        <div class="jFiler-item-inner">
                                                                            <div class="jFiler-item-icon pull-left">
                                                                                <i class="icon-jfi-file-o jfi-file-type-image jfi-file-ext-png"></i>
                                                                            </div>
                                                                            <div class="jFiler-item-info pull-left">
                                                                                <div class="jFiler-item-title" title="<?= $product['anh_dai_dien'] ?>">
                                                                                    <a href="<?= base_url('uploads/product/' . $product['anh_dai_dien']) ?>" target="_blank" rel="noopener noreferrer">
                                                                                        <?= $product['anh_dai_dien'] ?>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="jFiler-item-others">
                                                                                    <span><?= @get_file_size(PRODUCT_IMAGE_PATH . $product['anh_dai_dien'], 2) ?? 0 ?> MB</span>
                                                                                    <span>type: <?= @getimagesize(PRODUCT_IMAGE_PATH . $product['anh_dai_dien'])['mime'] ?? 'unknown' ?></span>
                                                                                    <span class="jFiler-item-status"></span>
                                                                                </div>
                                                                                <div class="jFiler-item-assets">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        <?php endif ?>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>Ảnh khác Của Sản Phẩm sản phẩm.</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hãy chọn thật kỹ ảnh để tránh xảy ra sai sót.Tối Đa 4 Ảnh </h6>
                                                        <?php $uri = service('uri');  ?>
                                                        <input type="file" name="images[]" id="filer_input" <?= !empty($uri->getSegment(5)) ? '' : 'required' ?> multiple>
                                                        <?php if (isset($images)) : ?>
                                                            <ul id="product-image" class="jFiler-items-list jFiler-items-default">
                                                                <?php foreach ($images as $image) : ?>
                                                                    <li class="jFiler-item" data-jfiler-index="0" id="img-<?= $image['id'] ?>">
                                                                        <div class="jFiler-item-container">
                                                                            <div class="jFiler-item-inner">
                                                                                <div class="jFiler-item-icon pull-left"><i class="icon-jfi-file-o jfi-file-type-image jfi-file-ext-png"></i></div>
                                                                                <div class="jFiler-item-info pull-left">
                                                                                    <div class="jFiler-item-title" title="<?= $image['image'] ?>"><a href="<?= base_url('uploads/product/' . $image['image']) ?>" target="_blank" rel="noopener noreferrer"><?= $image['image'] ?></a></div>
                                                                                    <div class="jFiler-item-others"><span><?= @get_file_size(PRODUCT_IMAGE_PATH . $image['image'], 2) ?? 0 ?> MB</span><span>type: <?= @getimagesize(PRODUCT_IMAGE_PATH . $image['image'])['mime'] ?? 'unknow' ?></span><span class="jFiler-item-status"></span></div>
                                                                                    <div class="jFiler-item-assets">
                                                                                        <ul class="list-inline">
                                                                                            <li><a onclick="delete_image(<?= $image['id'] ?>, '<?= $image['image'] ?>')" class="icon-jfi-trash jFiler-item-trash-action"></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach ?>
                                                            </ul>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu</button>
                                                            <a href="<?= base_url('dashboard/product/manage') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
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

        fetch('<?= base_url('dashboard/product/manage/delete/image') ?>', requestOptions)
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