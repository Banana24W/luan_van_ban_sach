<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\CategoryBookModel;
use App\Models\CategoryPostModel;
use App\Models\DetailCartModel;
use App\Models\PostsModel;
use App\Models\UserModel;

class BlogController extends BaseController
{
    public function index()
    {
        $postModel = new PostsModel();
        $productModel = new BookModel();
        $categoryPostModel = new CategoryPostModel();
        $category = $categoryPostModel->findAll();
        $bookCounts = [];

        foreach ($category as $cat) {
            $bookCount = $postModel->where('ma_loai_bai_viet', $cat['ma_loai_bai_viet'])->countAllResults();
            $bookCounts[$cat['ma_loai_bai_viet']] = $bookCount;
        }
        $cartData = $this->cart();
        $datas['cart'] = $cartData['cart'];
        $datas['bookCount'] = $cartData['bookCount'];
        $datas['category'] = $this->getSubCategoryPost();
        $datas['bookCounts'] = $bookCounts;
        $datas['post'] = $this->post();
        return view('User/Blog/index', $datas);
    }
    public function detail()
    {   
        $id = $this->request->getUri()->getSegment(3);
        $postModel = new PostsModel();
        $post=$postModel->where('ma_bai_viet', $id)->first();
        $posts = $postModel->where('status >= 1')->findAll();
        $categoryPostModel = new CategoryPostModel();
        $userModel = new UserModel();

        $category = $categoryPostModel->findAll();
        $bookCounts = [];
        if (!$post) {
            return redirect()->to('');
        }
        foreach ($category as $cat) {
            $bookCount = $postModel->where('ma_loai_bai_viet', $cat['ma_loai_bai_viet'])->countAllResults();
            $bookCounts[$cat['ma_loai_bai_viet']] = $bookCount;
        }
        foreach ($posts as $key => $postss) {
            $user = $userModel->find($postss['ma_nguoi_dung']);
            $posts[$key]['usernames'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
        }
      
        $user = $userModel->find($post['ma_nguoi_dung']);
        $post['username'] = $user['last_name'];

        $categorys = $categoryPostModel->find($post['ma_loai_bai_viet']);
        $post['name'] = $categorys['ten_loai_bai_viet'];
        // Thêm thông tin người dùng vào mảng bài viết
        $cartData = $this->cart();
        $datas['cart'] = $cartData['cart'];
        $datas['bookCount'] = $cartData['bookCount'];
        $datas['category'] = $this->getSubCategoryPost();
        $datas['bookCounts'] = $bookCounts;
        $datas['post'] = $post;
        $datas['posts'] = $posts;
        return view('User/Blog/detail', $datas);
    }
    public function post()
    {
        $postModel = new PostsModel();
        $post = $postModel->where('status >= 1')->findAll();
        $categorypostModel = new CategoryPostModel();
        foreach ($post as $key => $posts) {
            $category = $categorypostModel->find($posts['ma_loai_bai_viet']);
            $post[$key]['name'] = $category['ten_loai_bai_viet'];
        }
        $userModel = new UserModel();
        foreach ($post as $key => $posts) {
            $user = $userModel->find($posts['ma_nguoi_dung']);
            $post[$key]['username'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
        }
        return $post;
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
