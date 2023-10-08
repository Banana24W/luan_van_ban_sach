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
                                            <form class="md-float-material card-block" id="j-forms" action="<?= base_url('dashboard/posts/manage/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="posts_id" value="<?= !empty($posts['ma_bai_viet']) ? $posts['ma_bai_viet'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Tên bài viết</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên bài viết" value="<?= !empty($posts['ten_bai_viet']) ? $posts['ten_bai_viet'] : set_value('ten_bai_viet') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Nội dung bài viết</h5>
                                                        <small>Mộ tả về sản phẩm, có thể sử dụng link hình ảnh trong mô tả.</small>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="description" id="editor2" required><?= !empty($posts['mo_ta']) ? $posts['mo_ta'] : set_value('mo_ta') ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                        <label for="menu_id">Danh mục Bài Viết</label>
                                                        <div class="input-group">
                                                            <select name="category" class="form-control js-example-basic-single">
                                                                <option value="">Danh mục Bài Viết</option>
                                                                <?php if (isset($category)) : ?>
                                                                    <?php foreach ($category as $item) : ?>

                                                                        <option value="<?= $item['ma_loai_bai_viet'] ?>" <?= !empty($posts['ma_loai_bai_viet']) && $posts['ma_loai_bai_viet'] == $item['ma_loai_bai_viet'] ? 'selected' : '' ?>><?= $item['ten_loai_bai_viet'] ?></option>

                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                               
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control" required>
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($posts['status'])  && $posts['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
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
                                                        <?php if (!empty($posts['hinh_anh'])) : ?>
                                                            <ul id="product-image" class="jFiler-items-list jFiler-items-default">
                                                                <li class="jFiler-item" data-jfiler-index="0" id="img-<?= !empty($posts['ma_bai_viet']) ? $posts['ma_bai_viet'] : set_value('ma_bai_viet') ?>">
                                                                    <div class="jFiler-item-container">
                                                                        <div class="jFiler-item-inner">
                                                                            <div class="jFiler-item-icon pull-left">
                                                                                <i class="icon-jfi-file-o jfi-file-type-image jfi-file-ext-png"></i>
                                                                            </div>
                                                                            <div class="jFiler-item-info pull-left">
                                                                                <div class="jFiler-item-title" title="<?= $posts['hinh_anh'] ?>">
                                                                                    <a href="<?= base_url('uploads/postss/' . $posts['hinh_anh']) ?>" target="_blank" rel="noopener noreferrer">
                                                                                        <?= $posts['hinh_anh'] ?>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="jFiler-item-others">
                                                                                    <span><?= @get_file_size(POST_IMAGE_PATH . $posts['hinh_anh'], 2) ?? 0 ?> MB</span>
                                                                                    <span>type: <?= @getimagesize(POST_IMAGE_PATH . $posts['hinh_anh'])['mime'] ?? 'unknown' ?></span>
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

                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu</button>
                                                            <a href="<?= base_url('dashboard/posts/manage') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
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