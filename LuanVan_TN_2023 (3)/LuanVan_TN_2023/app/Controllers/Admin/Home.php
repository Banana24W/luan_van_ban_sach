<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CartModel;

class Home extends BaseController
{
    public function index()
    {
        $cartModel = new CartModel();
        $cart = $cartModel->where('trang_thai_don_hang', 3)->countAllResults();
        $carts = $cartModel->where('trang_thai_don_hang', 2)->countAllResults();
        $cartss = $cartModel->where('trang_thai_don_hang', 4)->countAllResults();
        $cartsss = $cartModel->where('tong_tien IS NOT NULL')
            ->where('payment_method IS NOT NULL')
            ->countAllResults();

        $data['orderCount1'] = $cart;
        $data['orderCount2'] = $carts;
        $data['orderCount3'] = $cartss;
        $data['orderCount4'] = $cartsss;
        return view('Admin/Home/index', $data);
    }

    public function getOrdersData()
    {
        $orderModel = new CartModel();
        $data = $orderModel->select('MONTH(created_at) AS month, COUNT(*) AS count')
            ->where('tong_tien IS NOT NULL')
            ->where('payment_method IS NOT NULL')
            ->groupBy('MONTH(created_at)')
            ->findAll();


        return json_encode($data);
    }
    public function displayChart()
    {
        return view('chart');
    }
    public function getChartData()
    {
        $orderModel = new CartModel();
        // Truy vấn bảng đơn hàng để lấy tổng tiền và ngày
        $query = $orderModel->select('DATE_FORMAT(created_at, "%Y-%m-%d") AS month, COUNT(*) AS count ,SUM(tong_tien) AS total')
            ->where('tong_tien IS NOT NULL')
            ->where('payment_method IS NOT NULL')
            ->groupBy('month')
            ->get();

        $data = $query->getResultArray();

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

}
