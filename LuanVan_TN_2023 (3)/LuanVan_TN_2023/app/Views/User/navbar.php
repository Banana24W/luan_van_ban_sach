                                    <nav id="tg-nav" class="tg-nav">
                                    	<div class="navbar-header">
                                    		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                    			<span class="sr-only">Toggle navigation</span>
                                    			<span class="icon-bar"></span>
                                    			<span class="icon-bar"></span>
                                    			<span class="icon-bar"></span>
                                    		</button>
                                    	</div>
                                    	<div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                    		<ul>
                                    			
                                    			<li class="menu-item-has-children current-menu-item">
                                    				<a href="<?= base_url('/')?>">Home</a>
                                    				
                                    			</li>

                                    			<li class="menu-item-has-children">
                                    				<a href="<?= base_url('cua-hang') ?>" class="nav-item nav-link <?= url_is('cua-hang*') ? 'active' : '' ?>">Shop</a>

                                    			</li>
                                    			<?php $user = session()->get() ?>
                                    			<?php if (isset($user['isLogin']) && $user['isLogin']) : ?>
                                    				<li><a href="<?=base_url('User/Logout') ?>">Đăng Xuất ( <?= $user['last_name'] ?>)</a></li>
                                    				<li><a href="<?=base_url('giao-dich/lich-su-mua') ?>">Xem Lịch Sử Đơn Hàng</a></li>
													<li><a href="<?=base_url('User/Xemthongtin') ?>">Xem Thông Tin</a></li>
                                    			<?php else : ?>
                                    				<li><a href="<?= base_url('User/Login') ?>">Đăng Nhập</a></li>
                                    				<li><a href="<?= base_url('User/Register') ?>">Đăng Ký</a></li>
                                    			<?php endif ?>
                                    			<li class="menu-item-has-children">
                                    				<a href="<?= base_url('bai-viet')?>">Bài Viết</a>
                                    				
                                    			</li>
												<li class="menu-item-has-children">
                                    				<a href="<?= base_url('cua-hang/search')?>">Tìm Kiếm </a>
                                    				
                                    			</li>
                                    			
                                    		</ul>
                                    	</div>
                                    </nav>