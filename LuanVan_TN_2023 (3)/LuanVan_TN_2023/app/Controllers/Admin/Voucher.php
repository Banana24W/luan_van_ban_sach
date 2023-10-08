<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\VoucherModel;

class Voucher extends BaseController
{
    public function index()
    {
        $voucherModel= new VoucherModel();
        $voucher=$voucherModel->paginate(10);
        $datas=[
            'voucher'=>$voucher,
            'pager'=>$voucherModel->pager,
        ];
        return view('Admin/Voucher/index', $datas);

    }
    public function detail(){
        $vocherID = $this->request->getUri()->getSegment(5);
        if (!$vocherID) {
            $data['title']            = 'Thêm mới voucher';
            return view('Admin/Voucher/detail', $data);
        }

        $vocherModel = new VoucherModel();
        $voucher = $vocherModel->select('voucher.*')
        
        ->where('voucher.id', $vocherID)
        ->first();
        if (!$vocherID) {
            return redirect()->to('dashboard/voucher/manage');
        }
        $data['voucher']            = $voucher;   
        $data['title']              = 'Chỉnh sửa voucher';
  
        return view('Admin/Voucher/detail', $data);
    }
    function save()
    {
        //get product data
        $voucherID   = $this->request->getPost('posts_id');
        $ma_voucher   = $this->request->getPost('ma_voucher');
        $voucher_category = $this->request->getPost('voucher_category');
        $date_s        = $this->request->getPost('date_start');
        $date_e      = $this->request->getPost('date_end');
        $status = $this->request->getPost('status');
        $soluong= $this->request->getPost('soluong');
        $phan_tram=$this->request->getPost('phanttram');
        $voucherModel = new voucherModel();
        $voucherModel->db->transStart();
        $voucherModel->db->transComplete();
      
        //after save product, we need to save product attribute values, image
        //get product inserted id for insert attribute values
        
        //prepare data
        $data = [
            'id'    => $voucherID,
            'ma_voucher'      =>$ma_voucher,
            'loai_khuyen_mai'     => $voucher_category,
            'ngay_bat_dau'  =>$date_s,
            'ngay_ket_thuc' => $date_e,    
            'status'   => $status,
            'so_luong' => $soluong,
            'phan_tram_giam	'=> $phan_tram,
        ];
       
        $voucherModel->save($data);
        $voucherModel->db->transComplete();
        return redirect()->to('dashboard/voucher/manage');
    
    }
}
