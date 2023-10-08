<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookImageModel;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\CategoryBookModel;
use App\Models\CategoryPostModel;
use App\Models\CommentModel;
use App\Models\DetailCartModel;
use App\Models\NXBModel;
use App\Models\PostsModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;

class ShopController extends BaseController
{
    use ResponseTrait;
    public function index()

    {
        $productModel = new BookModel();
        $categoryBookModel = new CategoryBookModel();
        $category = $categoryBookModel->findAll();
        $bookCounts = [];

        foreach ($category as $cat) {
            $bookCount = $productModel->where('ma_loai_sach', $cat['ma_loai_sach'])->countAllResults();
            $bookCounts[$cat['ma_loai_sach']] = $bookCount;
        }
        $datas['bookCounts'] = $bookCounts;
        $datas['title'] = 'Home';
        $datas['category'] = $this->getSubCategory();
        $datas['product'] = $this->product();
        $datas['cartTotal'] = $this->cartTotal;
        $cartData = $this->cart();
        $datas['post'] = $this->post();
        $datas['cart'] = $cartData['cart'];
        $datas['bookCount'] = $cartData['bookCount'];
        return view('User/Shop/index', $datas);
    }
    public function product()
    {
        $productModel = new BookModel();
        $product = $productModel->where('status >= 1')->findAll();
        $categoryBookModel = new CategoryBookModel();
        foreach ($product as $key => $post) {
            $category = $categoryBookModel->find($post['ma_loai_sach']);
            $product[$key]['name'] = $category['ten_loai_sach'];
        }
        return $product;
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
                $cartdetais = $cartdetailmodel->where('ma_don_hang', $cart_id)->findAll();
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
    public function detail()
    {
        $id = $this->request->getUri()->getSegment(3);
        $productModel = new BookModel();
        $producImagetModel = new BookImageModel();
        $categoryBookModel = new CategoryBookModel();
        $product = $productModel->where('ma_sach', $id)->first();
        $category = $categoryBookModel->findAll();
        $commentModel = new CommentModel();
        $comment = $commentModel->where('ma_sach', $product['ma_sach'])->findAll();
        $comments = $commentModel->where('ma_sach', $product['ma_sach'])
            ->where('status', 1)->findAll();
        $commentCount = count($comments);


        $userModel = new UserModel();
        foreach ($comment as $key => $comments) {
            $user = $userModel->find($comments['ma_khach_hang']);
            $comment[$key]['user'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
            $product = $productModel->find($comments['ma_sach']);
            $comment[$key]['ten_sach'] = $product['ten_sach']; // Thêm thông tin người dùng vào mảng bài viết
        }
        $data = [
            'comment' => $comment,
            'commentCount'    => $commentCount,
        ];

        $userModel = new UserModel();

        // foreach ($comment as $key => $comments) {
        //     $product = $productModel->find($comments['ma_sach']);
        //     $comment[$key]['ten_sach'] = $product['ten_sach']; // Thêm thông tin người dùng vào mảng bài viết

        //     $user = $userModel->find($comments['ma_nguoi_dung']);
        //     $comment[$key]['username'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
        // }



        $cartModel = new CartModel();
        $cartdetailModel = new DetailCartModel();

        $customerID = session()->get('id');
        // $carts = $cartModel->where('ma_khach_hang', $customerID)
        //     ->where('trang_thai_don_hang', 3)
        //     ->findAll();

        // if ($carts) {
        //     foreach ($carts as $cart) {
        //         $cartDetail = $cartdetailModel->where('ma_sach', $id)
        //             ->where('ma_khach_hang', $customerID)
        //             ->findAll();

        //         if ($cartDetail) {
        //             // Người dùng đã mua cuốn sách cần đánh giá trong một đơn hàng
        //             // Thực hiện các hành động tương ứng
        //             break; // Thoát khỏi vòng lặp sau khi tìm thấy cuốn sách
        //         }
        //     }
        // }
        if (!$product) {
            return redirect()->to('cua-hang');
        }
        $productImage = $producImagetModel->where('ma_sach', $product['ma_sach'])->find();
        $bookCounts = [];

        foreach ($category as $cat) {
            $bookCount = $productModel->where('ma_loai_sach', $cat['ma_loai_sach'])->countAllResults();
            $bookCounts[$cat['ma_loai_sach']] = $bookCount;
        }

        $user = $categoryBookModel->find($product['ma_loai_sach']);
        $product['name'] = $user['ten_loai_sach'];
        $nxbModel = new NXBModel();
        $nxb = $nxbModel->find($product['ma_nha_xuat_ban']);
        $product['name_nxb'] = $nxb['ten_nha_xuat_ban'];
        $data['category'] = $category;
        $data['product'] = $product;
        $data['productImage'] = $productImage;
        $data['cartTotal'] = $this->cartTotal;
        $data['bookCounts'] = $bookCounts;
        $data['post'] = $this->post();
        // $data['cartDetail'] = $cartDetail;
        $cartData = $this->cart();
        $data['cart'] = $cartData['cart'];
        $data['bookCount'] = $cartData['bookCount'];
        return view('User/Shop/detail', $data);
    }
    public function addcomment()
    {
        $customerID = session()->get('id');
        $id = $this->request->getPost('product_id');
        $rating = $this->request->getPost('rating');
        $comment = $this->request->getPost('comment');
        $commentModel = new CommentModel();
        if (!$customerID) {
            $errorMessage = 'Bạn cần đăng nhập để mua hàng.';
            echo "<script>alert('$errorMessage'); window.location.href = 'http://localhost:8080/User/Login';</script>"; // Hiển thị hộp thoại thông báo và chuyển hướng
        }
        $data = [
            'ma_sach' => $id,
            'ma_khach_hang' => $customerID,
            'binh_luan' => $comment,
            'danh_gia' => $rating,
            'status' => 0,
        ];
        $commentModel->insert($data);

        // Cập nhật đánh giá trung bình của sách
        $bookModel = new BookModel();
        $avgRating = $commentModel->where('ma_sach', $id)->selectAvg('danh_gia')->get()->getRow()->danh_gia;
        $avgRating = round($avgRating, 2); // Làm tròn đến 2 chữ số thập phân
        $bookModel->update($id, ['danh_gia' => $avgRating]);
        // Redirect lại trang hiện tại
        return redirect()->to(base_url('cua-hang'));
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
    public function search()
    {
        $productModel = new BookModel();
        $categoryBookModel = new CategoryBookModel();
        $category = $categoryBookModel->findAll();
        $bookCounts = [];

        foreach ($category as $cat) {
            $bookCount = $productModel->where('ma_loai_sach', $cat['ma_loai_sach'])->countAllResults();
            $bookCounts[$cat['ma_loai_sach']] = $bookCount;
        }
        $tukhoa = $this->request->getPost('tukhoa');
        if (!empty($tukhoa)) {
            $result = $productModel->like('ten_sach', $tukhoa)->findAll();
            $categoryBookModel = new CategoryBookModel();
            foreach ($result as $key => $post) {
                $category = $categoryBookModel->find($post['ma_loai_sach']);
                $result[$key]['name'] = $category['ten_loai_sach'];
            }
            if (!empty($result)) {
                $datas['search'] = $result;
            } else {
                $datas['message'] = 'Không có kết quả tìm kiếm';
            }
        } else {
            $datas['message'] = 'Vui lòng nhập từ khóa';
        }

        $datas['bookCounts'] = $bookCounts;
        $datas['title'] = 'Home';
        $datas['category'] = $this->getSubCategory();
        $datas['product'] = $this->product();
        $datas['cartTotal'] = $this->cartTotal;
        $cartData = $this->cart();
        $datas['post'] = $this->post();
        $datas['cart'] = $cartData['cart'];
        $datas['bookCount'] = $cartData['bookCount'];



        return view('User/Shop/search', $datas);
    }
    // Xử lý kết quả tìm kiếm
    public function timkiemsach()
    {
    }


    public function searchBooks()
    {
    }
}
