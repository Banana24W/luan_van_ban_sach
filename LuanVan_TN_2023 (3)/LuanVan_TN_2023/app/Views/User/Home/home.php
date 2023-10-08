<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
<input id="baseUrl" value="" style="display: none;" />


<!--************************************
				Main Start
		*************************************-->
<main id="tg-main" class="tg-main tg-haslayout">
    <!--************************************
					Best Selling Start
			*************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>Mọi Người Cùng Chọn</span>Sách Bán chạy</h2>
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="tg-bestsellingbooksslider" class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
                        <?php if (!empty($product)) : ?>
                            <?php foreach ($product as $products) : ?>
                                <div class="item">
                                    <div class="tg-postbook">
                                        <figure class="tg-featureimg">
                                            <div class="tg-bookimg">
                                                <div class="tg-frontcover"><img src="<?= base_url() ?>\uploads\product\<?= $products['anh_dai_dien'] ?>" alt="image description"></div>
                                                <div class="tg-backcover"><img src="<?= base_url() ?>\uploads\product\<?= $products['anh_dai_dien'] ?>" alt="image description"></div>
                                            </div>
                                            
                                        </figure>
                                        <div class="tg-postbookcontent">
                                            <ul class="tg-bookscategories">
                                                <li><a href="javascript:void(0);"><?= $products['name'] ?></a></li>
                                                <li>Năm XB: <a href="javascript:void(0);"><?= $products['nam_xuat_ban'] ?></a></li>
                                            </ul>
                                            <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
                                            <div class="tg-booktitle">
                                                <h3><a href="javascript:void(0);"><?= $products['ten_sach'] ?></a></h3>
                                            </div>
                                            <span class="tg-bookwriter">Tác Giả: <a href="javascript:void(0);"><?= $products['tac_gia'] ?></a></span>
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
                                                $danhGia = $products['danh_gia']; // Giá trị đánh giá

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
                                            <span><?php echo $danhGia; ?></span>
                                            <span class="tg-bookprice">
                                                <?php if ($products['khuyen_mai'] == 0) : ?>
                                                    <ins> <?= number_format($products['gia']) ?>đ</ins>

                                                <?php else : ?>
                                                    <ins><?= number_format($products['gia'] - ($products['gia'] * ($products['khuyen_mai'] / 100))); ?>đ</ins>
                                                    <del><?= number_format($products['gia']); ?>đ</del>
                                                <?php endif; ?>
                                            </span>
                                            <a class="tg-btn tg-btnstyletwo" href="<?= base_url('cua-hang/chi-tiet') . '/' . $products['ma_sach'] ?>">
                                                <i class="fa fa-shopping-basket"></i>
                                                <em>Xem Chi Tiết</em>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center">Hiện không có sản phẩm nào</td>
                            </tr>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--************************************
					Best Selling End
			*************************************-->
    <!--************************************
					Featured Item Start
			*************************************-->
   
    <!--************************************
					Featured Item End
			*************************************-->
    <!--************************************
					New Release Start
			*************************************-->

    <!--************************************
					New Release End
			*************************************-->
    <!--************************************
					Collection Count Start
			*************************************-->
    <section class="tg-parallax tg-bgcollectioncount tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?= base_url() ?>/resources/images/parallax/bgparallax-04.jpg">
        <div class="tg-sectionspace tg-collectioncount tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-collectioncounters" class="tg-collectioncounters">
                        <div class="tg-collectioncounter tg-drama">
                            <div class="tg-collectioncountericon">
                                <i class="icon-bubble"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Drama</h2>
                                <h3 data-from="0" data-to="6179213" data-speed="8000" data-refresh-interval="50">6,179,213</h3>
                            </div>
                        </div>
                        <div class="tg-collectioncounter tg-horror">
                            <div class="tg-collectioncountericon">
                                <i class="icon-heart-pulse"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Horror</h2>
                                <h3 data-from="0" data-to="3121242" data-speed="8000" data-refresh-interval="50">3,121,242</h3>
                            </div>
                        </div>
                        <div class="tg-collectioncounter tg-romance">
                            <div class="tg-collectioncountericon">
                                <i class="icon-heart"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Romance</h2>
                                <h3 data-from="0" data-to="2101012" data-speed="8000" data-refresh-interval="50">2,101,012</h3>
                            </div>
                        </div>
                        <div class="tg-collectioncounter tg-fashion">
                            <div class="tg-collectioncountericon">
                                <i class="icon-star"></i>
                            </div>
                            <div class="tg-titlepluscounter">
                                <h2>Fashion</h2>
                                <h3 data-from="0" data-to="1158245" data-speed="8000" data-refresh-interval="50">1,158,245</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--************************************
					Collection Count End
			*************************************-->
    <!--************************************
					Picked By Author Start
			*************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>Một Số Cuốn Sách Hay</span>Được Chọn Bởi Các Tác Giả</h2>
                    </div>
                </div>
                <div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
                    <?php if (!empty($product)) : ?>
                        <?php foreach ($product as $products) : ?>
                            <div class="item">
                                <div class="tg-postbook">
                                    <figure class="tg-featureimg">
                                        <div class="tg-bookimg">
                                            <div class="tg-frontcover"><img src="<?= base_url() ?>\uploads\product\<?= $products['anh_dai_dien'] ?>" alt="image description"></div>
                                        </div>
                                        <div class="tg-hovercontent">
                                            <div class="tg-description">
                                                <p><?= $products['mo_ta_sach'] ?></p>
                                            </div>
                                            <strong class="tg-bookpage">Book Pages: <?= $products['so_trang'] ?></strong>
                                            <strong class="tg-bookcategory">Category: <?= $products['name'] ?></strong>
                                            <strong class="tg-bookprice"><ins> Price: <?= number_format($products['gia']); ?> VNĐ</ins></strong>
                                            <div class="tg-ratingbox"><span class="tg-starss">

                                                    <?php
                                                    $danhGia = $products['danh_gia']; // Giá trị đánh giá
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
                                                <span><?php echo $danhGia; ?></span></span></span>
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="tg-postbookcontent">
                                        <div class="tg-booktitle">
                                            <h3><a href="javascript:void(0);"><?= $products['ten_sach'] ?></a></h3>
                                        </div>
                                        <span class="tg-bookwriter">Tác Giả: <a href="javascript:void(0);"><?= $products['tac_gia'] ?></a></span>
                                        <a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
                                            <i class="fa fa-shopping-basket"></i>
                                            <em>Xem Chi Tiết</em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Hiện không có sản phẩm nào</td>
                        </tr>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
    <!--************************************
					Picked By Author End
			*************************************-->
    <!--************************************
					Testimonials Start
			*************************************-->
    <section class="tg-parallax tg-bgtestimonials tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?= base_url() ?>/resources/images/parallax/bgparallax-05.jpg">
        <div class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
                        <div id="tg-testimonialsslider" class="tg-testimonialsslider tg-testimonials owl-carousel">
                            <div class="item tg-testimonial">
                                <figure><img src="<?= base_url() ?>/resources/images/author/imag-02.jpg" alt="image description"></figure>
                                <blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote>
                                <div class="tg-testimonialauthor">
                                    <h3>Holli Fenstermacher</h3>
                                    <span>Manager @ CIFP</span>
                                </div>
                            </div>
                            <div class="item tg-testimonial">
                                <figure><img src="<?= base_url() ?>/resources/images/author/imag-02.jpg" alt="image description"></figure>
                                <blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote>
                                <div class="tg-testimonialauthor">
                                    <h3>Holli Fenstermacher</h3>
                                    <span>Manager @ CIFP</span>
                                </div>
                            </div>
                            <div class="item tg-testimonial">
                                <figure><img src="<?= base_url() ?>/resources/images/author/imag-02.jpg" alt="image description"></figure>
                                <blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote>
                                <div class="tg-testimonialauthor">
                                    <h3>Holli Fenstermacher</h3>
                                    <span>Manager @ CIFP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--************************************
					Testimonials End
			*************************************-->

    <!--************************************
					Call to Action Start
			*************************************-->
    
    <!--************************************
					Call to Action End
			*************************************-->
    <!--************************************
					Latest News Start
			*************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-sectionhead">
                        <h2><span>Bài viết liên quan </span>Có gì mới ?</h2>
                        
                    </div>
                </div>
                <div id="tg-postslider" class="tg-postslider tg-blogpost owl-carousel">
                    <?php if (!empty($posts)) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <article class="item tg-post">
                                <figure><a href="javascript:void(0);"><img src="<?= base_url() ?>\uploads\postss\<?= $post['hinh_anh'] ?>" alt="image description"></a></figure>
                                <div class="tg-postcontent">
                                    <ul class="tg-bookscategories">
                                        <li><a href="javascript:void(0);"><?= $post['name'] ?></a></li>

                                        <li><a href="javascript:void(0);"><?php
                                                                            $date = $post['created_at']; // Ngày cần định dạng
                                                                            $formattedDate = date('d/m/Y', strtotime($date));
                                                                            echo $formattedDate; // In ra ngày đã được định dạng
                                        ?></a></li>
                                    </ul>
                                    <div class="tg-themetagbox"><span class="tg-themetag">Đặc Sắc</span></div>
                                    <div class="tg-posttitle">
                                        <h3><a href="javascript:void(0);"><?= $post['ten_bai_viet'] ?></a></h3>
                                    </div>
                                    <span class="tg-bookwriter">Người Đăng: <a href="javascript:void(0);"><?= $post['username'] ?></a></span>
                                    <ul class="tg-postmetadata">
                                        <li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
                                    </ul>
                                </div>
                            </article>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Hiện không có sản phẩm nào</td>
                        </tr>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </section>
    <!--************************************
					Latest News End
			*************************************-->
</main>
<!--************************************
				Main End
		*************************************-->
<?= $this->endSection() ?>