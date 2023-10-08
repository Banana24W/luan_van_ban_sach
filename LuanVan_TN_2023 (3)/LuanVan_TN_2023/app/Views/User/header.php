                            <header id="tg-header" class="tg-header tg-headervtwo tg-haslayout">


                                <div class="tg-topbar">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <ul class="tg-addnav">
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <i class="icon-envelope"></i>
                                                            <em>Contact</em>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <i class="icon-question-circle"></i>
                                                            <em>Help</em>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tg-userlogin">
                                                    <figure><a href="javascript:void(0);"><img src="<?= base_url() ?>resources/images/users/img-01.jpg" alt="image description"></a></figure>
                                                    <span>Hi, John </span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tg-middlecontainer">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <strong class="tg-logo"><a href="index-2.html"><img src="<?= base_url() ?>resources/images/logo.png" alt="company name here"></a></strong>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tg-navigationarea">


                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="tg-navigationholder">
                                                    <!-- MAIN NAVIGATION -->
                                                    <?= $this->include("User/navbar") ?>
                                                    <!-- MAIN NAVIGATION -->

                                                    <div class="tg-wishlistandcart">
                                                        
                                                        <div class="dropdown tg-themedropdown tg-minicartdropdown">
                                                            <a href="javascript:void(0);" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="tg-themebadge"><?=$bookCount?></span>
                                                                <i class="icon-cart"></i>
                                                            </a>
                                                            <div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
                                                                <div class="tg-minicartbody">
                                                                    <?php $cartTotal = 0; ?>
                                                                    <?php $cartDiscount = 0; ?>
                                                                    <?php $quantity = 0; ?>
                                                                    <?php $cartFinal = 0; ?>
                                                                    <?php if (isset($cart) && !empty($cart)) : ?>
                                                                        
                                                                        <?php foreach ($cart as $item) : ?>
                                                                            <?php $price = $item['don_gia'] ?>
                                                                            <?php $quantity += $item['quantity'] ?>
                                                                            <?php $subtotal = ($price - ($price * ($item['discount'] / 100))) * $item['quantity']; ?>
                                                                            <?php $cartTotal += $subtotal; ?>
                                                                            <?php $cartDiscount += ($price * ($item['discount'] / 100)) * $item['quantity']; ?>
                                                                            <?php $cartFinal += $subtotal; ?>
                                                                            <div class="tg-minicarproduct">
                                                                                <figure>
                                                                                    <img style="width: 60px;height: 80px;" src="<?= base_url() ?>/uploads/product/<?= $item['anh_dai_dien'] ?>" alt="image description">

                                                                                </figure>
                                                                                <div class="tg-minicarproductdata">
                                                                                    <h5><a href="javascript:void(0);"><?= $item['name'] ?></a></h5>
                                                                                    <h6><a href="javascript:void(0);"><?= number_format($price - ($price * ($item['discount'] / 100))) ?>Đ</a></h6>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach ?>
                                                                      
                                                                    <?php else : ?>
                                                                        <td colspan="5">Không có sản phẩm nào trong giỏ hàng.</td>
                                                                    <?php endif ?>

                                                            
                                                                </div>
                                                                <div class="tg-minicartfoot">
                                                                    <a class="tg-btnemptycart" href="javascript:void(0);">
                                                                        <i class="fa fa-trash-o"></i>
                                                                        
                                                                    </a>
                                                                    <span class="tg-subtotal">Tổng Tiền: <strong><?= number_format($cartTotal) ?>Đ</strong></span>
                                                                    <div class="tg-btns">
                                                                        <a class="tg-btn tg-active" href="<?= base_url('gio-hang')?>">Xem Giỏ Hàng</a>
                                                                        <a class="tg-btn" href="javascript:void(0);">Checkout</a>
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


                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                            </header>
                            <div id="header-banner" class="tg-banner" style="width: 100%;">
                                <?php if (isset($banner) && !empty($banner)) : ?>
                                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($banner as $key => $row) : ?>
                                                <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>" style="height: 410px; ">
                                                    <img style="width: 100%; height: 500px;" class="img-fluid" src="<?= base_url() ?>\uploads\banner\<?= $row['hinh_anh'] ?>" alt="Image">
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#header-carousel" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </a>
                                        <a class="carousel-control-next" href="#header-carousel" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </a>
                                    </div>
                                <?php endif ?>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#header-carousel').carousel({
                                        interval: 2000 // Thời gian chuyển đổi (2 giây)
                                    });
                                });
                            </script>