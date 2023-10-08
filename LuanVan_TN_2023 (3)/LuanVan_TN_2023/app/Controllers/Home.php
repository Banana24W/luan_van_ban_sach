<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\CategoryBookModel;
use App\Models\CategoryPostModel;
use App\Models\DetailCartModel;
use App\Models\PostsModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $datas['title'] = 'Home';
        $datas['category'] = $this->getSubCategory();
        $datas['product'] = $this->product();
        $datas['banner'] = $this->banner();
        $datas['posts'] = $this->posts();
        $datas['cartTotal'] = $this->cartTotal;
        $cartData = $this->cart();
        $datas['cart'] = $cartData['cart'];
        $datas['bookCount'] = $cartData['bookCount'];
        return view('User/Home/home', $datas);
    }
    public function product()
    {
        $productModel = new BookModel();
        $product = $productModel->where('status >= 1')->findAll();
        $categoryBookModel = new CategoryBookModel();
        foreach ($product as $key => $post) {
            $user = $categoryBookModel->find($post['ma_loai_sach']);
            $product[$key]['name'] = $user['ten_loai_sach'];
        }
        return $product;
    }
    public function banner()
    {
        $bannerModel = new BannerModel();
        $banner = $bannerModel->findAll();

        return $banner;
    }
    public function posts()
    {
        $postsModel = new PostsModel();
        $posts = $postsModel->findAll();
        $categoryPostModel = new CategoryPostModel();
        foreach ($posts as $key => $post) {
            $user = $categoryPostModel->find($post['ma_loai_bai_viet']);
            $posts[$key]['name'] = $user['ten_loai_bai_viet'];
        }
        $userModel = new UserModel();
        foreach ($posts as $key => $post) {
            $user = $userModel->find($post['ma_nguoi_dung']);
            $posts[$key]['username'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
        }

        return $posts;
    }
    public function cart()
    {
        $cart_id = session()->get('cart_id');
        $carts_id = session()->get('carts_id');
        $customerID = session()->get('id');
        $cartModel = new CartModel();
        $cartItems = $cartModel
            ->where('ma_don_hang', $carts_id)
            ->where('ma_khach_hang', $customerID)
            ->findAll();
        $carts = $cartModel->where('ma_khach_hang', $customerID)->first();
        $cartss = $cartModel->where('ma_don_hang', $cart_id)->first();
        $productModel = new BookModel();
        $cartdetailmodel = new DetailCartModel();
        $cart = []; // Mảng lưu trữ các sản phẩm
        $bookCount = 0; // Số lượng các loại sách trong giỏ hàng
        if ($cartItems) {
            $bookIDs = []; // Mảng lưu trữ các mã sách đã có trong giỏ hàng
            foreach ($cartItems as $item) {
                    $cartdetais = $cartdetailmodel->where('ma_don_hang',$cart_id)->findAll();
                foreach ($cartdetais as $cartdetail) {
                    if (!in_array($cartdetail['ma_sach'], $bookIDs)) {
                        // Nếu mã sách chưa có trong mảng $bookIDs, tăng biến $bookCount lên 1
                        $bookCount++;
                        $bookIDs[] = $cartdetail['ma_sach'];
                    }
                    $product = $productModel->where('ma_sach', $cartdetail['ma_sach'])->first();
                    $thumbnail = $product['anh_dai_dien'];
                    // Tạo một mảng mới chứa thông tin của sản phẩm
                    if (isset($cart_id)) {
                        $cartItem = [
                            'id' => $carts_id,
                            'ma_sach' => $cartdetail['ma_sach'],
                            'ma_ct_don_hang' => $cartdetail['ma_chi_tiet_don_hang'],
                            'name' => $product['ten_sach'],
                            'don_gia' => $product['gia'],
                            'discount' => $product['khuyen_mai'],
                            'quantity' => $cartdetail['so_luong'],
                            'anh_dai_dien' => $thumbnail,
                        ];
                    }
                    
                    $cart[] = $cartItem; // Thêm sản phẩm vào mảng
                }
            }
        }
        return [
            'cart' => $cart,
            'bookCount' => $bookCount,
        ];
    }
   
}
