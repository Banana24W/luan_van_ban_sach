<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\DetailCartModel;
use App\Models\DiachiModel;
use App\Models\GiohangModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;

class OrderContrroller extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $customerID = session()->get('id');
        $cartModel = new CartModel();
        $cart = $cartModel->where('ma_khach_hang', $customerID)
            ->where('tong_tien IS NOT NULL')
            ->where('payment_method IS NOT NULL')
            ->findAll();
        $data = [
            'order' =>  $cart,
        ];
        $cartData = $this->cart();
        $data['cart'] = $cartData['cart'];
        $data['bookCount'] = $cartData['bookCount'];
        return view('User/Checkout/index', $data);
    }
    public function huyDonHang()
    {
        $ID = $this->request->getUri()->getSegment(4);
        $cartModel = new CartModel();
        $order = $cartModel->where('ma_don_hang', $ID)->first();

        if ($order['trang_thai_don_hang'] == 1 || $order['trang_thai_don_hang'] == 2 || $order['trang_thai_don_hang'] == 3) {
            
             // Xuất mã JavaScript để hiển thị hộp thoại thông báo hủy đơn hàng thành công và reload lại trang
             echo '<script type="text/javascript">';
             echo 'alert("Không thể hủy đơn hàng vì đang ở trạng thái xác nhận hoặc đang vận chuyển.");';
             echo 'window.location.href = "/giao-dich/lich-su-mua";'; // Reload lại trang
             echo '</script>';
        } else {
            // Nếu trạng thái đơn hàng không phải là 1, 2 hoặc 3, thực hiện hủy đơn hàng
            $isupdate = $cartModel->update(['ma_don_hang' => $ID], ['trang_thai_don_hang' => 4]);

            // Xuất mã JavaScript để hiển thị hộp thoại thông báo hủy đơn hàng thành công và reload lại trang
            echo '<script type="text/javascript">';
            echo 'alert("Đã hủy đơn hàng thành công.");';
            echo 'window.location.href = "/giao-dich/lich-su-mua";'; // Reload lại trang
            echo '</script>';
        }
    }
    public function detail()
    {
        $ID = $this->request->getUri()->getSegment(4);
        $customerID = session()->get('id');
        $cartModel = new CartModel();
        $cartItems = $cartModel
            ->where('ma_don_hang', $ID)
            ->where('tong_tien IS NOT NULL')
            ->where('payment_method IS NOT NULL')
            ->where('ma_khach_hang', $customerID)
            ->findAll();
        if ($cartItems) {
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
                            'dia_chi' => $item['shipping_to'],
                            'ngay_dat' => $item['created_at'],
                            'phuong_thuc' => $item['payment_method'],
                        ];
                        $cart[] = $cartItem; // Thêm sản phẩm vào mảng

                    }
                }
            }

            $data['order'] = $cart;
            $cartData = $this->cart();
            $data['cart'] = $cartData['cart'];
            $data['bookCount'] = $cartData['bookCount'];
            return view('User/Checkout/detail', $data);
        } else {
            echo '<script>';
            echo 'alert("Bạn không có quyền truy cập.");';
            echo 'window.location.href = "/giao-dich/lich-su-mua";'; // Thay thế "lich_su_don_hang.php" bằng URL của trang lịch sử đơn hàng
            echo '</script>';
            exit;
        }
    }
    public function checkout()
    {
        $cartdetailModel = new DetailCartModel();
        $userModel = new UserModel();
        $cartModel = new CartModel();
        $productModel = new BookModel();
        $addressModel = new DiachiModel();

        $cart = []; // Mảng lưu trữ các sản phẩm
        $checkoutTotal = [
            'price' => 0,
            'discount' => 0,
            'total' => 0,
            'discount_voucher' => 0
        ];

        $customerID = session()->get('id');


        $customer = $userModel->where('id', $customerID)->first();
        $addresses = $addressModel->where('ma_nguoi_dung', $customerID)->findAll(); // Lấy danh sách địa chỉ

        $cart_id = session()->get('cart_id');
        $carts_id = session()->get('carts_id');
        $carts = $cartModel->where('ma_khach_hang', $customerID)
            ->where('ma_don_hang', $carts_id)->first();
        $cartModel = new CartModel();
        $cartItems = $cartModel
            ->where('ma_don_hang', $carts_id)
            ->where('ma_khach_hang', $customerID)
            ->findAll();
        if (!$cartItems) {
            return redirect()->to('gio-hang');
        }

        foreach ($cartItems as $key => $item) {
            // Get product
            $cartdetais = $cartdetailModel->where('ma_don_hang', $cart_id)->findAll();
            if ($cart_id !== null) {
                $cartdetais = $cartdetailModel->where('ma_don_hang', $carts_id)->findAll();
            }
            if (isset($cart_id)) {
                $cartdetais = $cartdetailModel->where('ma_don_hang', $cart_id)->findAll();
            } else {
                $cartdetais = $cartdetailModel->where('ma_don_hang', $carts['ma_don_hang'])->findAll();
            }
            foreach ($cartdetais as $cartdetail) {
                $product = $productModel->where('ma_sach', $cartdetail['ma_sach'])->first();
                $price = $product['gia'];
                $discount =  $product['gia'] * ($product['khuyen_mai'] / 100);

                $cartItem = [
                    'id' => $cart_id,
                    'productID' => $cartdetail['ma_sach'],
                    'ma_ct_don_hang' => $cartdetail['ma_chi_tiet_don_hang'],
                    'productName' => $product['ten_sach'],
                    'don_gia' => $product['gia'],
                    'discount' => $product['khuyen_mai'],
                    'quantity' => $cartdetail['so_luong'],
                    'productPrice' =>  number_format($price),
                    'productDiscount' =>  number_format($discount),
                ];
                $cart[] = $cartItem; // Thêm sản phẩm vào mảng


                // Get cart product option


                // Calculate checkout total
                $checkoutTotal['price'] += $price * $cartdetail['so_luong'];
                $checkoutTotal['discount'] += $discount * $cartdetail['so_luong'];
                $tong = $checkoutTotal['price'] - $checkoutTotal['discount'] + 25000;
                $tong_item = intval(preg_replace('/[^0-9]/', '', $item['tong_tien']));
                $giam_gia = $tong - $tong_item;
                $checkoutTotal['total'] = intval(preg_replace('/[^0-9]/', '', $item['tong_tien']));
            }
        }

        $checkoutTotal['total'] = number_format($checkoutTotal['total']);
        $checkoutTotal['price'] = number_format($checkoutTotal['price']);
        $checkoutTotal['discount'] = number_format($checkoutTotal['discount']);
        $checkoutTotal['discount_voucher'] = number_format($giam_gia);
        $data['carts'] = $carts;
        $data['customer'] = $customer;
        $data['cartTotal'] = $this->cartTotal;
        $data['cartProducts'] = $cart;
        $data['checkoutTotal'] = $checkoutTotal;
        $data['addresses'] = $addresses; // Thêm danh sách địa chỉ vào dữ liệu gửi tới view
        $cartData = $this->cart();
        $data['cart'] = $cartData['cart'];
        $data['bookCount'] = $cartData['bookCount'];
        return view('User/Checkout/checkout', $data);
    }

    public function processCheckouts()
    {
        $cart_id = session()->get('cart_id');
        $carts_id = session()->get('cartss_id');
        $cartID = $this->request->getPost('carts_id');
        $customerID = $this->request->getPost('customer_id');
        $firstname  = $this->request->getPost('firstname');
        $lastname   = $this->request->getPost('lastname');
        $name       = $firstname . ' ' . $lastname;
        $email      = $this->request->getPost('email');
        $telephone  = $this->request->getPost('telephone');
        $address1   = $this->request->getPost('address1');
        $payment    = $this->request->getPost('payment');
        $shippingTo = "<b>Tên khách hàng:</b> $name<br><b>Email:</b> $email <br><b>Số điện thoại:</b> $telephone<br><b>Địa chỉ giao hàng:</b> $address1<br><b>Địa chỉ phụ:</b> ";

        $data = [

            'payment_method' => $payment,
            'shipping_to'    => $shippingTo,
            'trang_thai_don_hang'         => 0,
            'Ten_nguoi_nhan'  => $name,
        ];

        $odersModel = new CartModel();
        if ($cart_id) {
            $isInserted = $odersModel->update(['ma_don_hang' => $cart_id], $data);
        }
        if ($cartID) {
            $isInserted = $odersModel->update(['ma_don_hang' => $cartID], $data);
        }
        if (!$isInserted) {
            return redirect()->to('giao-dich/thanh-toan');
        }
        // Kiểm tra nếu payment_method là 0 (Ví MoMo)
        if ($payment === '0') {
            $odersModel = new CartModel();
            if (isset($cart_id)) {
                $order = $odersModel->where('ma_don_hang', $cart_id)->first();
                $tong_tien = $order['tong_tien'];
                $sessionData = [
                    'tong' => $tong_tien,
                    'ma' => $cart_id
                ];
                session()->set($sessionData);
            } else {
                $order = $odersModel->where('ma_don_hang', $cartID)->first();
                $tong_tien = $order['tong_tien'];
                $sessionData = [
                    'tong' => $tong_tien,
                    'ma' => $cartID
                ];
                session()->set($sessionData);
            }
            return redirect()->to('giao-dich/checkout');
        }
        // Tạo giỏ hàng mới
        $newCartID = $odersModel->createNewCart($customerID);
        // Gán giỏ hàng hiện tại bằng giỏ hàng mới
        $sessionData = ['cart_id' => $newCartID];
        session()->set($sessionData);

        unset($data);
        return redirect()->to('gio-hang');
        // return redirect()->to(base_url('gio-hang/tao-gh').'/'. $newCartID);
    }

    public function updateOrderStatus()
    {
        // Lấy giá trị order_id từ request POST
        $order_id = $this->request->getPost('order_id');
        $status = '1';
        $orderModel = new CartModel();
        $orderModel->update(['ma_don_hang' => 5], ['trang_thai_don_hang' => $status]);
        // Hiển thị giá trị của biến $order_id


        // Kiểm tra và xử lý dữ liệu
        if (!empty($order_id)) {

            return $this->response->setJSON(['success' => true, 'message' => 'Cập nhật trạng thái đơn hàng thành công']);
        } else {
            // Gửi phản hồi lỗi
            return $this->response->setJSON(['success' => false, 'message' => 'Lỗi khi cập nhật trạng thái đơn hàng']);
        }
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
    public function updateAddressStatus()
    {
        $addressId = $this->request->getPost('address_id');
        $customerID = session()->get('id');
        $addressModel = new DiachiModel();
        $addressModel->where('ma_nguoi_dung', $customerID)->set(['status' => '0'])->update();
        $addressModel->where('ma_nguoi_dung', $customerID)
            ->where('id', $addressId)
            ->set(['status' => '1'])->update();
        // Trả về phản hồi JSON
        return $this->response->setJSON(['success' => true]);
    }
    public function addAddress()
    {
        $city = $this->request->getPost('city');
        $cityName = $this->getCityNameByID($city);
        $district = $this->request->getPost('district');
        $districtName = $this->getDistrictNameByID($district);
        $ward = $this->request->getPost('ward');
        $wardName = $this->getWardNameByID($ward);
        $phone = $this->request->getPost('phone');
        $diachict = $this->request->getPost('address');
        // Combine the city, district, and ward into the address
        $address = $diachict . ', ' . $wardName . ', ' . $districtName . ', ' . $cityName;

        $addressArray = explode(',', $address);

        //get product data
        $UserID   = $this->request->getPost('customer_id');
        // Combine the city, district, and ward into the address
        if (isset($addressArray)) {
            $isSaveAddress = $this->saveAddress($UserID, $address, $phone);
        }
        return redirect()->to('giao-dich/thanh-toan');
    }
    private function getCityNameByID($cityID)
    {
        $url = "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Vô hiệu hóa xác minh SSL
        $data = curl_exec($ch);
        curl_close($ch);

        $cities = json_decode($data, true);

        foreach ($cities as $city) {
            if ($city['Id'] === $cityID) {
                return $city['Name'];
            }
        }

        return null; // Trả về null nếu không tìm thấy thành phố với ID tương ứng
    }
    private function saveAddress($UserID, $address, $phone)
    {
        $diachiModel = new DiachiModel();
        $datas = $this->mergeAddressWithProductID($UserID, $address, $phone);
        foreach ($datas as $data) {
            $isInsert = $diachiModel->insert($data);
            if (!$isInsert) {
                return false;
            }
        }
        return true;
    }


    private function mergeAddressWithProductID($UserID, $address, $phone)
    {

        $data[] = [
            'ma_nguoi_dung' => $UserID,
            'diachi' => $address,
            'phone' => $phone,
            'status' => 0
        ];

        return $data;
    }
    private function getDistrictNameByID($districtID)
    {
        $url = "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Vô hiệu hóa xác minh SSL
        $data = curl_exec($ch);
        curl_close($ch);

        $cities = json_decode($data, true);

        foreach ($cities as $city) {
            if (isset($city['Districts'])) {
                foreach ($city['Districts'] as $district) {
                    if (isset($district['Id']) && $district['Id'] === $districtID) {
                        return $district['Name'];
                    }
                }
            }
        }

        return null; // Trả về null nếu không tìm thấy quận/huyện với ID tương ứng
    }

    private function getWardNameByID($wardID)
    {
        $url = "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Vô hiệu hóa xác minh SSL
        $data = curl_exec($ch);
        curl_close($ch);

        $cities = json_decode($data, true);

        foreach ($cities as $city) {
            if (isset($city['Districts'])) {
                foreach ($city['Districts'] as $district) {
                    if (isset($district['Wards'])) {
                        foreach ($district['Wards'] as $ward) {
                            if (isset($ward['Id']) && $ward['Id'] === $wardID) {
                                return $ward['Name'];
                            }
                        }
                    }
                }
            }
        }

        return null; // Trả về null nếu không tìm thấy phường/xã với ID tương ứng
    }
}
