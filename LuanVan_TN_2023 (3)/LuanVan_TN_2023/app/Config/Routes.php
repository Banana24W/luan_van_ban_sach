<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('admin-login', 'Admin\Login::index');
$routes->post('admin-login', 'Admin\Login::authLogin');
$routes->get('logout', 'Admin\Login::logout');

$routes->group('', function ($routes) {
    $routes->get('', 'Home::index');
    $routes->group('User', function ($routes) {
        $routes->get('Login', 'UserController::login');
        $routes->get('Register', 'UserController::register');
        $routes->post('Save', 'UserController::save');
        $routes->post('Userlogin', 'UserController::userLogin');
        $routes->get('Logout', 'UserController::logout');
        $routes->get('Xemthongtin', 'UserController::xemthongtin');
        $routes->post('capnhat', 'UserController::capnhatthongtin');
    });
    $routes->group('cua-hang', function ($routes) {
        $routes->get('', 'ShopController::index');
        $routes->get('chi-tiet/:any', 'ShopController::detail');
        $routes->get('search', 'ShopController::search');
        $routes->post('search', 'ShopController::search');
        $routes->post('thembinhluan', 'ShopController::addcomment');
    });
    $routes->group('gio-hang', function ($routes) {
        $routes->get('', 'CartController::index');
        $routes->post('them', 'CartController::addProductToCart');
        $routes->post('tao-gh/:any', 'CartController::addProductToCarts');
        $routes->post('sua', 'CartController::updateProductCart');
        $routes->post('xoa', 'CartController::delete');
        $routes->post('apply-discount', 'CartController::applyDiscount');
        $routes->post('save', 'CartController::luuDonHang');
    });
    $routes->group('bai-viet', function ($routes) {
        $routes->get('', 'BlogController::index');
        $routes->get('chi-tiet/:any', 'BlogController::detail');
    });
    $routes->group('giao-dich', function ($routes) {
        $routes->get('lich-su-mua', 'OrderContrroller::index');
        $routes->get('lich-su-mua/chi-tiet/:any', 'OrderContrroller::detail');
        $routes->get('lich-su-mua/huy-don/:any', 'OrderContrroller::huyDonHang');
        $routes->get('thanh-toan', 'OrderContrroller::checkout');
        $routes->post('thanh-toan', 'OrderContrroller::processCheckouts');
        $routes->post('themdiachi', 'OrderContrroller::addAddress');
        $routes->post('capnhatdiachi', 'OrderContrroller::updateAddressStatus');
        $routes->get('checkout', 'PaymentController::checkout');
        $routes->get('momo', 'PaymentController::index');
      
    });
});

$routes->group('dashboard', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\Home::index');
    $routes->get('bieudo', 'Admin\Home::getChartData');

    $routes->group('admin', function ($routes) {
        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Admin::index');
            $routes->get('detail/:any', 'Admin\Admin::detail');
            $routes->get('detail', 'Admin\Admin::detail');
            $routes->post('delete', 'Admin\Admin::delete');
        });
    });

    $routes->group('user', function ($routes) {
        $routes->get('/', 'Admin\UserAdmin::index');
        $routes->get('detail/:any', 'Admin\UserAdmin::detail');
        $routes->post('save', 'Admin\UserAdmin::save');
        $routes->get('detail', 'Admin\UserAdmin::detail');
    });

    $routes->group('category', function ($routes) {
        $routes->get('/', 'Admin\Category::index');
        $routes->get('detail', 'Admin\Category::detail');
        $routes->post('save', 'Admin\Category::save');

        $routes->get('edit/:any', 'Admin\Category::edit');
        $routes->post('update/:any', 'Admin\Category::update');
        $routes->get('delete/:any', 'Admin\Category::delete');
    });
    $routes->group('categorypost', function ($routes) {
        $routes->get('/', 'Admin\CategoryPost::index');
        $routes->get('detail', 'Admin\CategoryPost::detail');
        $routes->post('save', 'Admin\CategoryPost::save');

        $routes->get('edit/:any', 'Admin\CategoryPost::edit');
        $routes->post('update/:any', 'Admin\CategoryPost::update');
        $routes->get('delete/:any', 'Admin\CategoryPost::delete');
    });


    $routes->group('posts', function ($routes) {
        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Posts::index');
            $routes->get('detail', 'Admin\Posts::detail');
            $routes->get('detail/:any', 'Admin\Posts::detail');

            $routes->post('save', 'Admin\Posts::save');
            $routes->post('delete', 'Admin\Posts::delete');
            $routes->post('delete/image', 'Admin\Posts::deleteImage');
            $routes->post('action-status', 'Admin\Posts::changeStatus');
        });
    });
    $routes->group('product', function ($routes) {

        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Product::index');
            $routes->get('detail', 'Admin\Product::detail');
            $routes->get('detail/:any', 'Admin\Product::detail');

            $routes->post('save', 'Admin\Product::save');
            $routes->post('delete', 'Admin\Product::delete');
            $routes->post('delete/image', 'Admin\Product::deleteImage');
            $routes->post('action-status', 'Admin\Product::changeStatus');
        });
    });
    $routes->group('order', function ($routes) {
        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Order::index');
            $routes->get('detail', 'Admin\Order::detail');
            $routes->get('detail/:any', 'Admin\Order::detail');
            $routes->post('capnhat', 'Admin\Order::Status');
            
        });
    });
    $routes->group('comment', function ($routes) {
        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Comment::index');
            $routes->get('detail', 'Admin\Comment::detail');
            $routes->get('detail/:any', 'Admin\Comment::detail');
            $routes->post('capnhat', 'Admin\Comment::Status');
            
        });
    });
    $routes->group('banner', function ($routes) {
        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Banner::index');
            $routes->get('detail', 'Admin\Banner::detail');
            $routes->get('detail/:any', 'Admin\Banner::detail');

            $routes->post('save', 'Admin\Banner::save');
            $routes->post('delete', 'Admin\Banner::delete');
            $routes->post('delete/image', 'Admin\Banner::deleteImage');
            $routes->post('action-status', 'Admin\Banner::changeStatus');
        });
    });
    $routes->group('nxb', function ($routes) {
        $routes->get('/', 'Admin\NhaXuatBan::index');
        $routes->get('detail', 'Admin\NhaXuatBan::detail');
        $routes->post('save', 'Admin\NhaXuatBan::save');

        $routes->get('edit/:any', 'Admin\NhaXuatBan::edit');
        $routes->post('update/:any', 'Admin\NhaXuatBan::update');
        $routes->get('delete/:any', 'Admin\NhaXuatBan::delete');
    });
    $routes->group('role', function ($routes) {
        $routes->get('/', 'Admin\Role::index');
        $routes->get('detail', 'Admin\Role::detail');
        $routes->post('save', 'Admin\Role::save');

        $routes->get('edit/:any', 'Admin\Role::edit');
        $routes->post('update/:any', 'Admin\Role::update');
        $routes->get('delete/:any', 'Admin\Role::delete');
    });
    $routes->group('voucher', function ($routes) {
        $routes->group('manage', function ($routes) {
            $routes->get('/', 'Admin\Voucher::index');
            $routes->get('detail', 'Admin\Voucher::detail');
            $routes->get('detail/:any', 'Admin\Voucher::detail');

            $routes->post('save', 'Admin\Voucher::save');
            $routes->post('delete', 'Admin\Voucher::delete');
            $routes->post('delete/image', 'Admin\Voucher::deleteImage');
            $routes->post('action-status', 'Admin\Voucher::changeStatus');
        });
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
