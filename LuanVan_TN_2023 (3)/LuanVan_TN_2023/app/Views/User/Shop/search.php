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
                    <h1>Cửa Hàng</h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="<?=base_url('/')?>">Trang chủ</a></li>
                        <li class="tg-active">Tìm kiếm sản phẩm</li>
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

                            <div class="tg-products">

                                <div class="tg-sectionhead">
                                    <h2><span>Sự Lựa Chọn Của Mọi Người</span></h2>
                                </div>
                                <form class="" action="/cua-hang/search" method="POST">
                                    <div class="search">
                                        <input type="text" name="tukhoa" id="" placeholder="Nhập tên Sản Phẩm Bạn cần Tìm" class="search__input">
                                        <button type="submit" class="search__button" name="timkiem" tabIndex="-1">Search</button>
                                    </div>
                                </form>
                                <?php if (!empty($message)) : ?>
                                <?=$message?>
                                <?php endif ?>
                                <div class="tg-productgrid">

                                    <?php if (!empty($search)) : ?>
                                        <?php foreach ($search as $products) : ?>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">

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
                                            <td colspan="7" class="text-center">Không tìm thấy sách nào tương ứng</td>
                                        </tr>

                                    <?php endif ?>
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