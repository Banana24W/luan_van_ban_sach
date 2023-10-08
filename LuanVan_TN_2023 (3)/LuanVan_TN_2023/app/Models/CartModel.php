<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'donhang';
    protected $primaryKey       = 'ma_don_hang';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createNewCart($customerID)
    {
        // Tạo một bản ghi giỏ hàng mới trong cơ sở dữ liệu
        $cartData = [
            'ma_khach_hang' => $customerID,
            // Các trường khác của giỏ hàng (nếu có)
        ];
        $cartModel = new CartModel();
        $cartModel->insert($cartData);

        // Lấy ID của giỏ hàng mới
        $newCartID = $cartModel->getInsertID();
        // Trả về ID của giỏ hàng mới
        return $newCartID;
    }
    public function getOrdersData()
    {
        $orderModel = new CartModel();
        $data = $orderModel->select('MONTH(created_at) AS month, COUNT(*) AS count')
            ->where('tong_tien IS NOT NULL')
            ->where('payment_method IS NOT NULL')
            ->groupBy('MONTH(created_at)')
            ->findAll();

        return $data;
    }
    // Phương thức lấy thông tin đơn hàng dựa trên mã đơn hàng (order_id)
    public function getOrderByOrderId($order_id)
    {
        return $this->where('ma_don_hang', $order_id)->first();
    }
}
