<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\DetailCartModel;
use App\Models\GiohangModel;

class Order extends BaseController
{
    public function index()
    {
        $cartModel = new CartModel();
        $cart=$cartModel
        ->where('tong_tien IS NOT NULL')
        ->where('payment_method IS NOT NULL')
        ->findAll();
        $data = [
            'order' =>  $cart,
        ];
        return view('Admin/Order/index', $data);
    }
    public function detail()
    {
        $ID = $this->request->getUri()->getSegment(5);
       
        $cartModel = new CartModel();
        $cartItems = $cartModel
            ->where('ma_don_hang', $ID)
            ->findAll();
        $carts = $cartModel->where('ma_don_hang', $ID)
            ->first();
        $productModel = new BookModel();
        $cartdetailmodel = new DetailCartModel();
        $cart = []; // Mảng lưu trữ các sản phẩm
        $bookCount = 0; // Số lượng các loại sách trong giỏ hàng
        if ($cartItems) {
            $bookIDs = []; // Mảng lưu trữ các mã sách đã có trong giỏ hàng
            foreach ($cartItems as $item) {
                
                    $cartdetais = $cartdetailmodel->where('ma_don_hang', $ID)->findAll();
                
                foreach ($cartdetais as $cartdetail) {
                  
                    $product = $productModel->where('ma_sach', $cartdetail['ma_sach'])->first();
                    $thumbnail = $product['anh_dai_dien'];
                    // Tạo một mảng mới chứa thông tin của sản phẩm
                  
                        $cartItem = [
                            'id' => $ID,
                            'ma_sach' => $cartdetail['ma_sach'],
                            'ma_ct_don_hang' => $cartdetail['ma_chi_tiet_don_hang'],
                            'name' => $product['ten_sach'],
                            'don_gia' => $product['gia'],
                            'discount' => $product['khuyen_mai'],
                            'quantity' => $cartdetail['so_luong'],
                            'anh_dai_dien' => $thumbnail,
                        ];
                        $cart[] = $cartItem; // Thêm sản phẩm vào mảng
                    
                }
            }
        }
        $data['cart'] = $cart;
       
        return view('Admin/Order/detail', $data);
    }
    public function Status()
    {
        $ID = $this->request->getPost('order_id');
        $Status = $this->request->getPost('status');
        $cartModel= new CartModel();
        $cartModel->update(['ma_don_hang'=> $ID],['trang_thai_don_hang'=> $Status]);
        // Trả về phản hồi JSON
        return $this->response->setJSON(['success' => true]);
    }
}
