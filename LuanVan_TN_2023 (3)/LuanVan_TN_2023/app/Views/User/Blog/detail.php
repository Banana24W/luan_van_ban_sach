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
							<h1>Bài Viết Liên Quan</h1>
							<ol class="tg-breadcrumb">
								<li><a href="<?=base_url('/')?>">Trang Chủ</a></li>
								<li><a href="javascript:void(0);">Bài Viết</a></li>
								<li class="tg-active">Chi Tiết</li>
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
                            
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<figure class="tg-newsdetailimg">
									<img src="<?= base_url() ?>/uploads/postss/<?= $post['hinh_anh'] ?>" alt="image description"style="width: 100%;height: 500px;">
									<figcaption class="tg-author">
										<img src="<?= base_url() ?>/resources/images/author/imag-26.jpg" alt="image description">
										<div class="tg-authorinfo">
											<span class="tg-bookwriter">Ngời Đăng:  <a href="javascript:void(0);"><?=$post['username']?></a></span>
											
										</div>
									</figcaption>
								</figure>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
								<div id="tg-content" class="tg-content">
									<div class="tg-newsdetail">
										<ul class="tg-bookscategories">
											<li><a href="javascript:void(0);">Thể Loại: <?=$post['name']?></a></li>
                                            <li><a href="javascript:void(0);">Ngày Đăng: <?php
                                                                            $date = $post['created_at']; // Ngày cần định dạng
                                                                            $formattedDate = date('d/m/Y', strtotime($date));
                                                                            echo $formattedDate; // In ra ngày đã được định dạng
                                        ?></a></li>
										</ul>
										<div class="tg-themetagbox"><span class="tg-themetag">Đặc sắc</span></div>
										<div class="tg-posttitle">
											<h3><a href="javascript:void(0);"><?=$post['ten_bai_viet']?></a></h3>
										</div>
										<div class="tg-description">
											<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non proident, sunt in culpa quistan officia deserunt mollit anim id est laborum sed ut perspiciatis unde omnis iste natus.</p>
											<p>Error sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque ipsa quae ab illo inventore veritatis etation quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aute fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
											<blockquote>
												<q>“Adipisicing sed do eiusmod tempor incididunt ut labore etaem dolore magna aliqua enim aliquip commodo consequat.”</q>
												<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
											</blockquote>
											<p>Labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip apeicommodo consequat aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non proident, sunt in culpa quistan officia deserunt mollit anim.</p>
											<p>Laborum sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque ipsa quae ab illo inventore veritatis etation quasi architecto beatae.</p>
										</div>
										
										
										
										
										<div class="tg-leaveyourcomment">
											<div class="tg-sectionhead">
												<h2>Leave Your Comment</h2>
											</div>
											<form class="tg-formtheme tg-formleavecomment">
												<fieldset>
													<div class="form-group">
														<input type="text" name="full name" class="form-control" placeholder="First Name*">
													</div>
													<div class="form-group">
														<input type="text" name="last name" class="form-control" placeholder="Last Name*">
													</div>
													<div class="form-group">
														<input type="email" name="email address" class="form-control" placeholder="Email*">
													</div>
													<div class="form-group">
														<input type="text" name="subject" class="form-control" placeholder="Subject (optional)">
													</div>
													<div class="form-group">
														<textarea placeholder="Comment"></textarea>
													</div>
													<div class="form-group">
														<a class="tg-btn tg-active" href="javascript:void(0);">Submit</a>
													</div>
												</fieldset>
											</form>
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
                                        <?php if (!empty($posts)) : ?>
                                        <?php foreach ($posts as $postss) : ?>
                                            <article class="tg-post">
                                                <figure><a href="javascript:void(0);"><img src="<?= base_url() ?>\uploads\postss\<?= $postss['hinh_anh'] ?>" alt="image description"></a></figure>
                                                <div class="tg-postcontent">
                                                    <div class="tg-posttitle">
                                                        <h3><a href="javascript:void(0);"><?=$postss['ten_bai_viet']?></a></h3>
                                                    </div>
                                                    <span class="tg-bookwriter">Người Đăng: <a href="javascript:void(0);"><?=$postss['usernames']?></a></span>
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