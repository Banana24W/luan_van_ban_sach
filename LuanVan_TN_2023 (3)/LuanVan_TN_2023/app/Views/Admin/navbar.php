<?php
$menu = [
    [
        'url' => base_url('dashboard'),
        'active' => 'dashboard',
        'name' => 'Dashboard',
        'icon' => '<i class="feather icon-home"></i>',
    ],
    [
        'url' => '',
        'active' => 'dashboard/admin',
        'name' => 'Quản lý Tài khoản',
        'icon' => '<i class="feather icon-user"></i>',
        'sub_menu' => [
            [
                'url' => '',
                'name' => 'Quản trị',
                'active' => 'dashboard/admin',
                'sub_menu' => [
                    [
                        'url' => base_url('dashboard/admin/manage'),
                        'name' => 'Danh sách Admin',
                    ],
                    [
                        'url' => base_url('dashboard/role'),
                        'name' => 'Danh sách Cấp Bậc',
                    ],
                ]
            ],
            
            [
                'url' => '',
                'name' => 'Người dùng',
                'active' => 'dashboard/user',
                'sub_menu' => [
                    [
                        'url' => base_url('dashboard/user/'),
                        'name' => 'Danh sách',
                    ],     
                ]
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Nhà Xuất Bản',
        'active' => 'dashboard/nxb',
        'icon' => '<i class="fa fa-bars"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/nxb'),
                'name' => 'Danh sách',
            ],
           
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Danh Mục Sách',
        'active' => 'dashboard/category',
        'icon' => '<i class="fa fa-bars"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/category'),
                'name' => 'Danh sách',
            ],
          
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Sách',
        'active' => 'dashboard/product',
        'icon' => '<i class="feather icon-shopping-cart"></i>',
        'sub_menu' => [
                    [
                        'url' => base_url('dashboard/product/manage'),
                        'name' => 'Danh sách',
                    ],
            ]   
    ],
    [
        'url' => '',
        'name' => 'Quản lý Danh Mục Bài Viết',
        'active' => 'dashboard/categorypost',
        'icon' => '<i class="fa fa-bars"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/categorypost'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    
   
   
    [
        'url' => '',
        'name' => 'Quản lý Bài viết',
        'active' => 'dashboard/posts',
        'icon' => '<i class="fa fa-info"></i>',
        'sub_menu' => [

            [
                'url' => base_url('dashboard/posts/manage'),
                'name' => 'Danh sách',
            ],
        ]
    ],
   

    [
        'url' => '',
        'name' => 'Quản lý Banner',
        'active' => 'dashboard/banner',
        'icon' => '<i class="fa fa-photo"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/banner/manage'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/banner/manage/detail'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Voucher',
        'active' => 'dashboard/voucher',
        'icon' => '<i class="fa fa-credit-card-alt"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/voucher/manage'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/voucher/manage/detail'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản Lý Đơn Hàng',
        'active' => 'dashboard/order',
        'icon' => '<i class="fa fa-credit-card-alt"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/order/manage'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản Lý Bình Luận',
        'active' => 'dashboard/comment',
        'icon' => '<i class="fa fa-info"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/comment/manage'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    
    
    

 
];
?>

<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Bảng điều khiển</div>
        <ul class="pcoded-item pcoded-left-item">
            <?php foreach ($menu as $row) : ?>
                <?php $classActive = url_is($row['active'] . '*') ? ' pcoded-trigger' : '' ?>
                <li class="<?= !empty($row['url']) ? '' : 'pcoded-hasmenu' ?> <?= $classActive ?>">
                    <a href="<?= !empty($row['url']) ? $row['url'] : 'javascript:void(0)' ?>">
                        <span class="pcoded-micon"><?= $row['icon'] ?></span>
                        <span class="pcoded-mtext"><?= $row['name'] ?></span>
                    </a>
                    <?php if (!empty($row['sub_menu'])) : ?>
                        <ul class="pcoded-submenu">
                            <?php foreach ($row['sub_menu'] as $sub) : ?>
                                <?php if (!empty($sub['sub_menu'])) : ?>
                                    <?php $subClassActive = url_is($sub['active'] . '*') ? ' pcoded-trigger' : '' ?>
                                    <li class="pcoded-hasmenu <?= $subClassActive ?>">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-mtext"><?= $sub['name'] ?></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <?php foreach ($sub['sub_menu'] as $val) : ?>
                                                <li class="<?= url_is(str_replace(base_url(), '', $val['url'])) ? 'active' : '' ?>">
                                                    <a href="<?= $val['url'] ?>">
                                                        <span class="pcoded-mtext"><?= $val['name'] ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li class="<?= url_is(str_replace(base_url(), '', $sub['url'])) ? 'active' : '' ?>">
                                        <a href="<?= $sub['url'] ?>">
                                            <span class="pcoded-mtext"><?= $sub['name'] ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</nav>