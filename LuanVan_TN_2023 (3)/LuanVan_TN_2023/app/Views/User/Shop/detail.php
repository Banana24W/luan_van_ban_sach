<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
<input id="baseUrl" value="" style="display: none;" />
<!--************************************
				Inner Banner Start
		*************************************-->
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?= base_url() ?>/resources/images/parallax/bgparallax-07.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-innerbannercontent">
                    <h1>Tất cả sản phẩm</h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="<?=base_url('/')?>">Trang Chủ</a></li>
                        <li><a href="javascript:void(0);">Sản Phẩm</a></li>
                        <li class="tg-active">Chi Tiết Sản Phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!--************************************
				Inner Banner End
		*************************************-->
<!--************************************
				Main Start
		*************************************-->
<main id="tg-main" class="tg-main tg-haslayout">
    <!--************************************
					News Grid Start
			*************************************-->
    <div class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div id="tg-twocolumns" class="tg-twocolumns">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
                        <div id="tg-content" class="tg-content">

                            <div class="tg-productdetail">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <form method="POST" action="<?= base_url('gio-hang/them') ?>" id="themgia">
                                            <input type="hidden" name="product_id" value="<?= $product['ma_sach'] ?>">
                                            <div class="tg-postbook">
                                                <style>
                                                    .tg-featureimg {
                                                        display: flex;
                                                        flex-direction: column;
                                                        align-items: center;
                                                    }

                                                    .tg-featureimg img {
                                                        max-width: 100%;
                                                        height: auto;
                                                    }

                                                    .tg-smallimages {
                                                        display: flex;
                                                        justify-content: center;
                                                    }

                                                    .tg-smallimages img {
                                                        width: 75px;
                                                        height: 75px;
                                                        margin-right: 5px;
                                                        cursor: pointer;
                                                    }
                                                </style>
                                                <script>
                                                    var images = [
                                                        <?php foreach ($productImage as $row) : ?> '<?= base_url() ?>\uploads\product\<?= $row['image'] ?>',
                                                        <?php endforeach ?>
                                                    ];

                                                    function displayImage(index) {
                                                        var mainImage = document.getElementById('mainImage');
                                                        var imageTag = mainImage.getElementsByTagName('img')[0];
                                                        imageTag.src = images[index];
                                                    }
                                                </script>
                                                <figure class="tg-featureimg" id="mainImage">
                                                    <img id="images" src="<?= base_url() ?>/uploads/product/<?= $product['anh_dai_dien'] ?>" alt="">
                                                    <div class="tg-smallimages">
                                                        <?php if (isset($productImage)) : ?>
                                                            <?php foreach ($productImage as $index => $row) : ?>
                                                                <img class="w-75 h-75" src="<?= base_url() ?>/uploads/product/<?= $row['image'] ?>" alt="Image" onclick="updateMainImage('<?= base_url() ?>/uploads/product/<?= $row['image'] ?>')">
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    </div>
                                                </figure>
                                                <script>
                                                    function updateMainImage(imageUrl) {
                                                        document.getElementById('images').src = imageUrl;
                                                    }
                                                </script>
                                                <div class="tg-postbookcontent">
                                                    <ul class="tg-delevrystock">
                                                        <li><i class="icon-rocket"></i><span>Nhiều ưu đãi về chi phí vận chuyển</span></li>
                                                        <li><i class="icon-checkmark-circle"></i><span>Giao hàng nhanh trong 2 ngày </span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="tg-productcontent">
                                            <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
                                            <div class="tg-booktitle">
                                                <h3><?= $product['ten_sach'] ?></h3>
                                            </div>
                                            <div class="tg-description" style="font-size: 200px;">
                                                <span class="tg-bookprice">
                                                    <?php if ($product['khuyen_mai'] == 0) : ?>
                                                        <ins name="don_gia"> <?= number_format($product['gia']) ?>đ</ins>

                                                    <?php else : ?>
                                                        <ins name="don_gia"><?= number_format($product['gia'] - ($product['gia'] * ($product['khuyen_mai'] / 100))); ?>đ</ins>
                                                        <del><?= number_format($product['gia']); ?>đ</del>
                                                    <?php endif; ?>
                                                </span>
                                                <script>
                                                    // Bắt sự kiện submit của form
                                                    var form = document.getElementById('themgia'); // Thay thế 'themgia' bằng ID của form thực tế
                                                    form.addEventListener('submit', function(event) {


                                                        // Lấy giá trị của don_gia từ phần tử trong form
                                                        var donGiaElement = form.querySelector('ins[name="don_gia"]');
                                                        var price = donGiaElement.innerText.trim();

                                                        // Tạo đối tượng FormData và thêm giá trị price vào
                                                        var formData = new FormData();
                                                        formData.append('price', price);

                                                        // Gửi yêu cầu POST đến controller sử dụng fetch
                                                        fetch('/gio-hang/them', {
                                                                method: 'POST',
                                                                body: formData
                                                            })
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                // Xử lý phản hồi từ controller (nếu cần)
                                                                console.log(data);
                                                            })
                                                            .catch(error => {
                                                                // Xử lý lỗi (nếu có)
                                                                console.error(error);
                                                            });
                                                    });
                                                </script>
                                                <span class="tg-bookwriter">Tiết Kiệm Được <?= number_format($product['gia'] - ($product['gia'] - ($product['gia'] * ($product['khuyen_mai'] / 100)))) ?>đ </span>
                                            </div>
                                            <span class="tg-starss">
                                                <style>
                                                    .tg-starss {
                                                        display: inline-block;
                                                        font-size: 20px;
                                                    }

                                                    .tg-starss .filled-stars:before {
                                                        content: "\2605";
                                                        color: #FFD700;
                                                    }

                                                    .tg-starss .half-star:before {
                                                        content: "\2605";
                                                        color: #FFD700;
                                                        position: relative;
                                                        overflow: hidden;
                                                        width: 0.5em;
                                                    }

                                                    .tg-starss .empty-stars:before {
                                                        content: "\2606";
                                                        color: #ccc;
                                                    }
                                                </style>
                                                <span class="tg-starss">
                                                    <?php
                                                    $danhGia = $product['danh_gia']; // Giá trị đánh giá
                                                    $soSaoTron = floor($danhGia); // Số lượng ngôi sao tròn
                                                    $soSaoLe = ceil($danhGia); // Số lượng ngôi sao lẻ
                                                    // Hiển thị ngôi sao tròn
                                                    for ($i = 1; $i <= $soSaoTron; $i++) {
                                                        echo '<span class="filled-stars"></span>'; // Ngôi sao màu vàng
                                                    }
                                                    // Hiển thị ngôi sao nửa
                                                    if ($danhGia - $soSaoTron > 0) {
                                                        echo '<span class="half-star"></span>'; // Nửa ngôi sao màu vàng
                                                    }
                                                    // Hiển thị ngôi sao không có màu
                                                    $soSaoTrong = 5 - $soSaoLe; // Số lượng ngôi sao không có màu
                                                    for ($i = 1; $i <= $soSaoTrong; $i++) {
                                                        echo '<span class="empty-stars"></span>'; // Ngôi sao không có màu
                                                    }
                                                    ?>
                                                </span>
                                                <span><?php echo $danhGia; ?> </span>
                                            </span>
                                            <br>
                                            <div class="tg-sectionhead" style="padding-top: 10px;">
                                                <h2>Chi Tiết Về Sách </h2>
                                            </div>
                                            <ul class="tg-productinfo">
                                                <li><span>Năm Xuất Bản:</span><span><?= $product['nam_xuat_ban'] ?></span></li>
                                                <li><span>Tác Giả:</span><span><?= $product['tac_gia'] ?></span></li>
                                                <li><span>Thể Loại:</span><span><?= $product['name'] ?></span></li>
                                                <li><span>Số Trang:</span><span><?= $product['so_trang'] ?> Trang</span></li>
                                                <li><span>Năm Xuất Bản:</span><span><?= $product['nam_xuat_ban'] ?></span></li>
                                                <li><span>Nhà Xuất Bản:</span><span><?= $product['name_nxb'] ?></span></li>
                                                <li><span>Lần Tái Bản:</span><span><?= $product['lan_tai_ban'] ?></span></li>
                                                <li><span>Số Lượng Sách Còn Lại: </span><span> <?= $product['so_luong'] ?></span></li>
                                            </ul>
                                        </div>
                                        <div class="tg-quantityholder" style="padding-bottom: 10px;">
                                            <em class="minus" onclick="decreaseQuantity()">-</em>
                                            <input type="text" class="result" value="1" id="quantity1" name="quantity">
                                            <em class="plus" onclick="increaseQuantity()">+</em>
                                        </div>
                                        <script>
                                            var quantityInput = document.getElementById('quantity1');
                                            var maxQuantity = <?= $product['so_luong'] ?>;

                                            function decreaseQuantity() {
                                                var currentQuantity = parseInt(quantityInput.value);
                                                if (currentQuantity > 1) {
                                                    quantityInput.value = currentQuantity - 1;
                                                }
                                            }

                                            function increaseQuantity() {
                                                var currentQuantity = parseInt(quantityInput.value);
                                                if (currentQuantity < maxQuantity) {
                                                    quantityInput.value = currentQuantity + 1;
                                                }
                                            }
                                            // Kiểm tra giá trị nhập vào trường số lượng
                                            quantityInput.addEventListener('change', function() {
                                                var currentQuantity = parseInt(quantityInput.value);
                                                if (isNaN(currentQuantity) || currentQuantity < 1) {
                                                    quantityInput.value = 1;
                                                } else if (currentQuantity > maxQuantity) {
                                                    quantityInput.value = maxQuantity;
                                                }
                                            });
                                        </script>
                                        <button type="submit" style="width: 250px;" class="tg-btn tg-active tg-btn-lg" href="">Thêm Vào Giỏ Hàng</button>
                                        </form>
                                    </div>

                                    <div class="tg-productdescription" style="padding-top: 10px;">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="tg-sectionhead">
                                                <h2>Mô tả về sách</h2>
                                            </div>
                                            <ul class="tg-themetabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#description" data-toggle="tab">Mô Tả</a></li>
                                                <li role="presentation"><a href="#review" data-toggle="tab">Đánh Giá</a></li>
                                            </ul>
                                            <div class="tg-tab-content tab-content">
                                                <div role="tabpanel" class="tg-tab-pane tab-pane active" id="description">
                                                    <div class="tg-description">

                                                        <p><?= $product['mo_ta_sach'] ?></p>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tg-tab-pane tab-pane" id="review">
                                                    <div class="tg-commentsarea">
                                                        <div class="tg-sectionhead">
                                                            <h2>Có <?=$commentCount?> Bình luận</h2>
                                                        </div>
                                                        <ul id="tg-comments" class="tg-comments">
                                                            
                                                                <?php foreach ($comment as $row) : ?>
                                                                    <?php if ($row['status'] == 1) : ?>
                                                                    <li>
                                                                        <div class="tg-authorbox">
                                                                            <figure class="tg-authorimg">
                                                                                <img src="<?= base_url() ?>resources/images/author/imag-24.jpg" alt="image description">
                                                                            </figure>
                                                                            <div class="tg-authorinfo">
                                                                                <div class="tg-authorhead">
                                                                                    <div class="tg-leftarea">
                                                                                        <div class="tg-authorname">
                                                                                            <h2><?=$row['user']?></h2>
                                                                                            <span>Đăng ngày: <?=$row['updated_at']?></span>
                                                                                            <span>Đánh giá: <?=$row['danh_gia']?> Sao</span>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="tg-description">
                                                                                    <p><?=$row['binh_luan']?></p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tg-bottomarrow"></div>
                                                                        </div>
                                                                    </li>
                                                                    <?php endif; ?>
                                                                <?php endforeach ?>
                                                           
                                                        </ul>
                                                    </div>
                                                    <div class="tg-leaveyourcomment">

                                                        <form class="tg-formtheme tg-formleavecomment" action="<?= base_url('cua-hang/thembinhluan') ?>" method="post">
                                                            <fieldset>
                                                                <style>
                                                                    .rating {
                                                                        unicode-bidi: bidi-override;
                                                                        direction: rtl;
                                                                        text-align: center;
                                                                        width: 350px;
                                                                        height: 150px;
                                                                    }

                                                                    .rating input[type="radio"] {
                                                                        display: none;
                                                                        /* Ẩn input radio mặc định */
                                                                    }

                                                                    .rating label {
                                                                        display: inline-block;
                                                                        position: relative;
                                                                        width: 2.1em;
                                                                        font-size: 30px;
                                                                        color: #ccc;
                                                                        /* Màu mặc định cho ngôi sao chưa được chọn */
                                                                        cursor: pointer;
                                                                    }

                                                                    .rating label:before {
                                                                        content: "\2605";
                                                                        position: absolute;
                                                                        color: gold;
                                                                        /* Màu vàng cho ngôi sao chọn */
                                                                        top: 0;
                                                                        left: 0;
                                                                    }

                                                                    .rating input[type="radio"]:checked~label {
                                                                        color: gold;
                                                                        /* Màu vàng cho ngôi sao đã chọn */
                                                                    }
                                                                </style>
                                                                <div class="form-group">
                                                                    <h2>Đánh giá sản phẩm</h2>
                                                                    <p>Hãy chọn số sao để đánh giá sản phẩm:</p>

                                                                    <div class="rating">
                                                                        <input type="hidden" name="product_id" value="<?= $product['ma_sach'] ?>">
                                                                        <input type="radio" name="rating" value="5" id="star5" /><label for="star5">&#9733;</label>
                                                                        <input type="radio" name="rating" value="4" id="star4" /><label for="star4">&#9733;</label>
                                                                        <input type="radio" name="rating" value="3" id="star3" /><label for="star3">&#9733;</label>
                                                                        <input type="radio" name="rating" value="2" id="star2" /><label for="star2">&#9733;</label>
                                                                        <input type="radio" name="rating" value="1" id="star1" /><label for="star1">&#9733;</label>
                                                                    </div>


                                                                </div>

                                                                <div class="form-group">
                                                                    <textarea placeholder="Comment" name="comment"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="tg-btn tg-active">Submit</button>

                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                        <script>
                                                            const submitButton = document.querySelector('.tg-btn');
                                                            submitButton.addEventListener('click', submitForm);

                                                            function submitForm() {
                                                                const rating = selectedRating;
                                                                const comment = document.querySelector('textarea').value;

                                                                const data = {
                                                                    rating: rating,
                                                                    comment: comment
                                                                };

                                                                const url = '/cua-hang/thembinhluan'; // Thay thế URL_CUA_CONTROLLER bằng URL thích hợp của controller

                                                                fetch(url, {
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'Content-Type': 'application/json'
                                                                        },
                                                                        body: JSON.stringify(data)
                                                                    })
                                                                    .then(response => response.json())
                                                                    .then(result => {
                                                                        // Xử lý kết quả trả về từ controller (nếu có)
                                                                        console.log(result);
                                                                    })
                                                                    .catch(error => {
                                                                        // Xử lý lỗi (nếu có)
                                                                        console.error(error);
                                                                    });
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
                        <aside id="tg-sidebar" class="tg-sidebar">
                            
                            <div class="tg-widget tg-catagories">
                                <div class="tg-widgettitle">
                                    <h3>Loại Sách</h3>
                                </div>

                                <?php foreach ($category as $categorys) : ?>

                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li><a href=""><span><?= $categorys['ten_loai_sach'] ?></span><em> <?= $bookCounts[$categorys['ma_loai_sach']] ?? 0; ?></em></a></li>
                                        </ul>
                                    </div>
                                <?php endforeach ?>

                            </div>
                            <div class="tg-widget tg-widgettrending">
                                
                                <div class="tg-widget tg-widgettrending">
                                <div class="tg-widgettitle">
                                    <h3>Trending Posts</h3>
                                </div>
                                <div class="tg-widgetcontent">
                                    <ul>
                                        <li>
                                            <?php if (!empty($post)) : ?>
                                                <?php foreach ($post as $posts) : ?>
                                                    <article class="tg-post">
                                                        <figure><a href="javascript:void(0);"><img src="<?= base_url() ?>\uploads\postss\<?= $posts['hinh_anh'] ?>" alt="image description"></a></figure>
                                                        <div class="tg-postcontent">
                                                            <div class="tg-posttitle">
                                                                <h3><a href="javascript:void(0);"><?= $posts['ten_bai_viet'] ?></a></h3>
                                                            </div>
                                                            <span class="tg-bookwriter">Người Đăng: <a href="javascript:void(0);"><?= $posts['username'] ?></a></span>
                                                        </div>
                                                    </article>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Hiện không có bài viết nào</td>
                                                </tr>
                                            <?php endif ?>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            </div>
                            
                            
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
					News Grid End
			*************************************-->
</main>
<!--************************************
				Main End
		*************************************-->
<?= $this->endSection() ?>