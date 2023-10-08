<?= $this->extend('User/layout') ?>
<?= $this->section('content') ?>
<input style="display:none;" id="baseUrl" value="" />
<input id="baseUrl" value="" style="display: none;" />


<!--************************************
				Inner Banner Start
		*************************************-->
<div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?=base_url()?>resources/images/parallax/bgparallax-07.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-innerbannercontent">
                    <h1>Bài Viết Liên Quan</h1>
                    <ol class="tg-breadcrumb">
                        <li><a href="<?= base_url('/') ?>">Trang Chủ</a></li>
                        <li class="tg-active">Bài Viết</li>
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
                            <div class="tg-newsgrid">
                                <div class="tg-sectionhead">
                                    <h2><span>Tin Tức & Bài Báo Mới Nhất</span>Có Gì Mới ?</h2>
                                </div>
                                <div class="row">
                                    <?php if (!empty($post)) : ?>
                                        <?php foreach ($post as $posts) : ?>
                                            <div class="col-xs-6 col-sm-12 col-md-6 col-lg-4">
                                                <article class="tg-post">
                                                    <figure><a href="<?= base_url('bai-viet/chi-tiet') . '/' . $posts['ma_bai_viet'] ?>"><img src="<?= base_url() ?>\uploads\postss\<?= $posts['hinh_anh'] ?>" alt="image description"></a></figure>
                                                    <div class="tg-postcontent">
                                                        <ul class="tg-bookscategories">
                                                            <li><a href="javascript:void(0);">Thể Loại: <?=$posts['name'] ?></a></li>     
                                                        </ul>
                                                        <div class="tg-themetagbox"><span class="tg-themetag">Nổi bậc</span></div>
                                                        <div class="tg-posttitle">
                                                            <h3><a href="javascript:void(0);"><?=$posts['ten_bai_viet']?></a></h3>
                                                        </div>
                                                        <span class="tg-bookwriter">Người đăng: <a href="javascript:void(0);"><?=$posts['username']?></a></span>
                                                       
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Hiện không có bài viết nào</td>
                                        </tr>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
                        <aside id="tg-sidebar" class="tg-sidebar">
                            <div class="tg-widget tg-widgetsearch">
                                <form class="tg-formtheme tg-formsearch">
                                    <div class="form-group">
                                        <button type="submit"><i class="icon-magnifier"></i></button>
                                        <input type="search" name="search" class="form-group" placeholder="Search Here">
                                    </div>
                                </form>
                            </div>
                            <div class="tg-widget tg-catagories">
                                <div class="tg-widgettitle">
                                    <h3>Loại Bài Viết</h3>
                                </div>

                                <?php foreach ($category as $categorys) : ?>

                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li><a href="javascript:void(0);"><span><?= $categorys['ten_loai_bai_viet'] ?></span><em> <?= $bookCounts[$categorys['ma_loai_bai_viet']] ?? 0; ?></em></a></li>
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
                                                        <h3><a href="javascript:void(0);"><?=$posts['ten_bai_viet']?></a></h3>
                                                    </div>
                                                    <span class="tg-bookwriter">Người Đăng: <a href="javascript:void(0);"><?=$posts['username']?></a></span>
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