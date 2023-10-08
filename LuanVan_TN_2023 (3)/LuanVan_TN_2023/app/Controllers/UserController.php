<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CartModel;
use App\Models\DetailCartModel;
use App\Models\DiachiModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use Exception;

class UserController extends BaseController
{

	public function login()
	{
		$cartData = $this->cart();
		$datas['cart'] = $cartData['cart'];
		$datas['bookCount'] = $cartData['bookCount'];
		return view('User/User/Login', $datas);
	}
	public function register()
	{
		$cartData = $this->cart();
		$datas['cart'] = $cartData['cart'];
		$datas['bookCount'] = $cartData['bookCount'];
		return view('User/User/Register', $datas);
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
	public function xemthongtin()
	{
		$addressModel = new DiachiModel();
		$customerModel = new UserModel();
		$customerID = session()->get('id');
		$customer = $customerModel->find($customerID);
		$addresses = $addressModel->where('ma_nguoi_dung', $customerID)->findAll(); // Lấy danh sách địa chỉ
		$data['addresses'] = $addresses; // Thêm danh sách địa chỉ vào dữ liệu gửi tới view

		$cartData = $this->cart();
		$data['cart'] = $cartData['cart'];
		$data['bookCount'] = $cartData['bookCount'];
		$data['customer'] = $customer;
		return view('User/User/Xemthongtin', $data);
	}
	public function capnhatthongtin()
	{
		$customerID = session()->get('id');
		$firstname  = $this->request->getPost('firstname');
		$lastname   = $this->request->getPost('lastname');
		$password   = $this->request->getPost('password');
		$address1   = $this->request->getPost('address1');
		$telephone  = $this->request->getPost('telephone');
		$addressModel = new DiachiModel();
		$customerModel = new UserModel();
		$inputs = [
			'firstname' => $firstname,
			'lastname'  => $lastname,
			'telephone' => $telephone,
			'address1'  => $address1
		];
		$validation = service('validation');
		$validation->setRules(
			[
				'firstname' => 'required',
				'lastname'  => 'required',
				'telephone' => 'required|min_length[9]|max_length[10]',
				'address1'  => 'required'
			],
			//Custom error message
			customValidationErrorMessage()
		);

		//if something wrong, redirect to login page and show error message
		if (!$validation->run($inputs)) {
			$error_msg = $validation->getErrors();
			return redirectWithMessage(base_url('User/Xemthongtin'), $error_msg);
		}
		$datas = [
			'first_name' => $firstname,
			'last_name'  => $lastname,
		];

		$data = [
			'diachi' => $address1,
			'phone' => $telephone,
		];
		if (!empty($password)) {

			$datas['password'] = $password;
		}
		$isSave = $customerModel->update(['id' => $customerID], $datas);


		$isSaves = $addressModel->where('ma_nguoi_dung', $customerID)
			->where('status', '1')
			->set($data)
			->update();
		if (!$isSave) {
			return redirectWithMessage(base_url('User/Xemthongtin'), UNEXPECTED_ERROR_MESSAGE);
		}
		if (!$isSaves) {
			return redirectWithMessage(base_url('User/Xemthongtin'), UNEXPECTED_ERROR_MESSAGE);
		}
		return redirect()->to('User/Xemthongtin');
	}
	public function userLogin()
	{
		helper('Common_helper');
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$inputs = array(
			'username' => $username,
			'password' => $password
		);

		//check empty
		$validation = service('validation');
		$validation->setRules(
			[
				'username' => 'required',
				'password' => 'required|min_length[3]'
			],
			//Custom error message
			customValidationErrorMessage()
		);

		//if something wrong, redirect to login page and show error message
		if (!$validation->run($inputs)) {
			$error_msg = $validation->getErrors();
			return redirectWithMessage(site_url('User/Login'), $error_msg);
		}

		//kiem tra ten dang nhap
		$userModel = new UserModel;
		$user = $userModel->where('username', $username)->first();
		if (!$user) {
			return redirectWithMessage(site_url('User/Login'), WRONG_LOGIN_INFO_MESSAGE);
		}

		// kiểm tra mật khẩu
		$pass = $user['password'];
		$authPassword = md5((string)$password) === $pass;
		if (!$authPassword) {
			return redirectWithMessage(site_url('User/Login'), WRONG_LOGIN_INFO_MESSAGE);
		}

		$sessionData = [
			'id' 	     => $user['id'],
			'username'   => $user['username'],
			'email'		 => $user['email'],
			'first_name' => $user['first_name'],
			'last_name'	 => $user['last_name'],
			'isLogin' => true
		];


		//create new session and start to work
		session()->set($sessionData);
		return redirect()->to('');
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('');
	}
	public function save()
	{
		helper('Common_helper');
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$email = $this->request->getPost('email');
		$firstname = $this->request->getPost('first_name');
		$lastname = $this->request->getPost('last_name');
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
		$UserID   = $this->request->getPost('id');
		// Combine the city, district, and ward into the address

		$datas = [
			'id' => $UserID,
			'username'       =>  $username,
			'password'    => md5((string) $password),
			'email'    =>  $email,
			'first_name' => $firstname,
			'last_name'        =>  $lastname,
			'role' => 3,
			'status' => 3,
		];
		// Khởi tạo model
		$userModel = new UserModel;


		// Kiểm tra email đã tồn tại
		$emailExists = $userModel->where('email', $email)->first();
		$usernameExists=$userModel->where('username',$username)->first();
		if ($emailExists) {
			// Thông báo cho người dùng biết rằng email đã tồn tại và không cho phép đăng ký
			return redirectWithMessage(site_url('User/Register'), EMAIL_NOT_EXIST);
		}
		if ($usernameExists) {
			// Thông báo cho người dùng biết rằng email đã tồn tại và không cho phép đăng ký
			return redirectWithMessage(site_url('User/Register'), USERNAME_NOT_EXIST);
		}
		try {
			$userModel->insert($datas);
			$insertID = $userModel->getInsertID();
			if ($UserID) {
				$insertID = $UserID;
			}
			if (isset($addressArray)) {
				$isSaveImage = $this->saveAddress($insertID, $address, $phone);
				if (!$isSaveImage) {
					redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
				}
			}
			// Nếu thêm dữ liệu thành công, chuyển hướng đến trang thông báo đăng ký thành công
			// Lưu thông báo vào session
			session()->setFlashdata('success', 'Đăng ký thành công.');

			// Hiển thị thông báo và yêu cầu người dùng ấn OK để chuyển hướng trang
			echo '<script>alert("Đăng ký thành công."); window.location.href="' . base_url('User/Login') . '";</script>';
		} catch (Exception $e) {
			// Nếu có lỗi xảy ra, hiển thị thông báo lỗi cho người dùng
			echo $e->getMessage();
		}
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
			'status'=>1,
		];

		return $data;
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
