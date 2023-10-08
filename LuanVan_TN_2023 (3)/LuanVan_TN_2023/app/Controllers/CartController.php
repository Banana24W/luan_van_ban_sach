<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\DetailCartModel;
use App\Models\VoucherModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;
use TheSeer\Tokenizer\Exception;

class CartController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $cart_id = session()->get('cart_id');
        $carts_id = session()->get('carts_id');
        $customerID = session()->get('id');
        $cartModel = new CartModel();
        $cartItems = $cartModel
            ->where('ma_don_hang', $carts_id)
            ->where('ma_khach_hang', $customerID)
            ->findAll();
        $carts = $cartModel->where('ma_khach_hang', $customerID)
            ->where('ma_don_hang', $carts_id)
            ->first();
        $cartss = $cartModel->where('ma_don_hang', $cart_id)->first();
        $productModel = new BookModel();
        $cartdetailmodel = new DetailCartModel();
        $cart = []; // Mảng lưu trữ các sản phẩm
        $bookCount = 0; // Số lượng các loại sách trong giỏ hàng
        if ($cartItems) {
            $bookIDs = []; // Mảng lưu trữ các mã sách đã có trong giỏ hàng
            foreach ($cartItems as $item) {
                if ($cart_id !== null) {
                    $cartdetais = $cartdetailmodel->where('ma_don_hang', $carts_id)->findAll();
                }
                if (isset($cart_id)) {
                    $cartdetais = $cartdetailmodel->where('ma_don_hang', $cart_id)->findAll();
                } else {
                    $cartdetais = $cartdetailmodel->where('ma_don_hang', $carts['ma_don_hang'])->findAll();
                }
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
                        $cart[] = $cartItem; // Thêm sản phẩm vào mảng
                    } else {
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
                        $cart[] = $cartItem; // Thêm sản phẩm vào mảng
                    }
                }
            }
        }
        $data['cart'] = $cart;
        $data['carts'] = $carts;
        $data['cartss'] = $cartss;
        $data['cartTotal'] = $this->cartTotal;
        $data['bookCount'] = $bookCount; // Thêm biến bookCount vào mảng $data
        return view('User/Cart/index', $data);
    }
    public function addProductToCart()
    {
        $customerID = session()->get('id');
        $cart_id = session()->get('cart_id');
        $productID = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        $price = $this->request->getPost('don_gia');
        $cartModel = new CartModel();
        $detailCartModel = new DetailCartModel();
        $bookModel= new BookModel();
        $book=$bookModel->where('ma_sach', $productID)->first();
        if (!$customerID) {
            $errorMessage = 'Bạn cần đăng nhập để mua hàng.';
            echo "<script>alert('$errorMessage'); window.location.href = 'http://localhost:8080/User/Login';</script>"; // Hiển thị hộp thoại thông báo và chuyển hướng
        }

        // Kiểm tra xem giỏ hàng đã tồn tại cho khách hàng hiện tại chưa
        $cartIDs = $cartModel->getInsertID();

        $carts = $cartModel->where('tong_tien', null)
            ->where('ma_khach_hang', $customerID)
            ->orderBy('ma_don_hang', 'desc')
            ->first();
        $cart = $cartModel->where('ma_khach_hang', $customerID)->first();

        if (!$cart) {
            session()->remove('cart_id');
            // Tạo giỏ hàng mới cho khách hàng nếu chưa tồn tại
            $data = [
                'ma_khach_hang' => $customerID,
            ];
            $cartModel->insert($data);
            $cartID = $cartModel->getInsertID();
        } else {
            $cartID = $cart['ma_don_hang'];
        }
        if ($carts) {
            $cartID = $carts['ma_don_hang'];
        }

        if (isset($cart_id)) {
            $cartID = $cart_id;
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $isExist = $detailCartModel->where(['ma_sach' => $productID, 'ma_don_hang' => $cartID])->first();
        if ($isExist) {
            //
            return redirect()->to('gio-hang');
        }
        if (!$cart) {
            $ID = $cartModel->getInsertID();
            $data = [
                'ma_don_hang' => $ID,
                'ma_sach' => $productID,
                'so_luong' => $quantity ?? 1,
                'don_gia' => $price,
            ];
        } else {
            $data = [
                'ma_don_hang' => $cartID,
                'ma_sach' => $productID,
                'so_luong' => $quantity ?? 1,
                'don_gia' => $price,
            ];
        }
        $isDetailSave = $detailCartModel->insert($data);
        $bookModel->update(['ma_sach'=>$productID],['so_luong'=>$book['so_luong']-$quantity]);
        if (!$isDetailSave) {
            // Không thể lưu chi tiết giỏ hàng, xử lý theo yêu cầu
            return redirect()->to('gio-hang');
        }
        $sessionData = ['carts_id' => $cartID];
        session()->set($sessionData);
        return redirect()->to('gio-hang');
    }
    public function addProductToCarts()
    {
        $id = $this->request->getUri()->getSegment(3);

        $data = [
            'ma_don_hang' => $id,
        ];

        return view('User/Cart/index', $data);
    }

    public function updateProductCart()
    {
        $cartID = $this->request->getPost('ma_ct_don_hang');
        $productID = $this->request->getPost('ma_sach');
        $quantity = $this->request->getPost("quantity{$cartID}");
        $cartModel = new DetailCartModel();
        $isUpdated = $cartModel->update(['ma_ct_don_hang' => $cartID, 'ma_sach' => $productID], ['so_luong' => $quantity]);

        if (!$isUpdated) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE), Response::HTTP_OK);
        }

        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }
    public function delete()
    {
        $cartID = $this->request->getPost('ma_ct_don_hang');
        $productID = $this->request->getPost('ma_sach');
        if (!$cartID) {
            return $this->respond(responseFailed('Không có sản phẩm này trong giỏ hàng'),  Response::HTTP_OK);
        }
        $cartModel = new DetailCartModel();
        $isDeleted = $cartModel->delete(['ma_ct_don_hang' => $cartID, 'ma_sach' => $productID]);
        if (!$isDeleted) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }

    public function applyDiscount()
    {
        // Lấy mã giảm giá từ request POST
        $discountCode = $this->request->getPost('discount_code');
        $tong = $this->request->getPost('tong_tien');
        $vchuyen = $this->request->getPost('van_chuyen');
        $giam_gia = $this->request->getPost('giam_gia');
        // Gọi model để kiểm tra mã giảm giá và tính toán giảm giá
        $model = new VoucherModel();
        // Truy vấn thông tin giảm giá từ mã giảm giá
        $discount = $model->where('ma_voucher', $discountCode)->first();

        if ($discount) {
            // Mã giảm giá hợp lệ, tiến hành tính toán giảm giá

            // Lấy thông tin giá trị giảm giá từ model
            $discountType  = $model->getPromotion($discountCode);
            $discountAmount = $model->getPhanTramKM($discountCode);

            // Xử lý giảm giá dựa trên loại mã giảm giá
            if ($discountType == 0) {
                $vchuyen = floatval(str_replace(',', '', $vchuyen));
                $discountAmount = floatval($discountAmount);
                $cartDiscount = number_format(($vchuyen - ($vchuyen * ($discountAmount / 100))));
            } elseif ($discountType == 1) {
                $tong = floatval(str_replace(',', '', $tong));
                $discountAmount = floatval($discountAmount);
                $cartDiscount = number_format(($tong - ($tong * ($discountAmount / 100))));
            } else {
                // Loại giảm giá không hợp lệ
                return $this->response->setJSON(['success' => false, 'error' => 'Loại giảm giá không hợp lệ']);
            }

            // Trả về số tiền giảm giá

            return $this->response->setJSON(['success' => true, 'discounted_amount' => $cartDiscount]);
        } else {
            // Mã giảm giá không tồn tại
            return $this->response->setJSON(['success' => false, 'error' => 'Mã giảm giá không tồn tại']);
        }
    }
    public function luuDonHang()
    {
        $cartModel = new CartModel();
        $customerID = session()->get('id');
        $tongTien = $this->request->getPost('tong_tien');
        // Loại bỏ tất cả các ký tự không phải số từ chuỗi
        $tongTien = preg_replace('/[^0-9]/', '', $tongTien);

        // Chuyển đổi chuỗi thành số nguyên
        $tongTien = (int)$tongTien;
        $ma = $this->request->getPost('ma_don_hang');
        $cart_id = session()->get('cart_id');
        if (isset($cart_id)) {
            $cartModel->update(['ma_don_hang' => $cart_id, 'ma_khach_hang' => $customerID], ['tong_tien' => $tongTien]);
        } else {
            $cartModel->update(['ma_don_hang' => $ma, 'ma_khach_hang' => $customerID], ['tong_tien' => $tongTien]);
        }
        $cartID = $cartModel->getInsertID();
        $sessionData = ['cartss_id' => $cartID];
        session()->set($sessionData);
        // Trả về phản hồi JSON
        return $this->response->setJSON(['success' => true]);
    }
}
