<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\BannerModel;

class Banner extends BaseController
{
    public function index()
    {
        $bannerModel = new BannerModel();
        $banner = $bannerModel->paginate(10);
        // Lặp qua các bài viết và lấy tên người dùng từ mã người dùng
        
        $data = [
            'banner' =>  $banner,
            'pager'    => $bannerModel->pager,  
        ];
      
        return view('Admin/Banner/index', $data);
    }
    public function detail()
    {
        $bannerID = $this->request->getUri()->getSegment(5);
        if (!$bannerID) {
            $data['title']            = 'Thêm mới sản phẩm';
            return view('Admin/Banner/detail', $data);
        }
        $bannerModel = new BannerModel();
        $banner = $bannerModel->select('banner.*')  
        ->where('banner.ma_banner', $bannerID)
        ->first();
        if (!$bannerID) {
            return redirect()->to('dashboard/banner/manage');
        }
        $data['banner']            = $banner;   
        $data['title']              = 'Chỉnh sửa sản phẩm';
  
        return view('Admin/Banner/detail', $data);
    }
    function save()
    {
        //get product data
        $BannerID   = $this->request->getPost('banner_id');
        $status      = $this->request->getPost('status');
        $anhdaidien = $this->request->getFile('anhdaidien');
      
        $bannerModel = new BannerModel();
        $bannerModel->db->transStart();
        $bannerModel->db->transComplete();
      
        //after save product, we need to save product attribute values, image
        //get product inserted id for insert attribute values
        
        //prepare data
        $data = [
            'ma_banner'      =>$BannerID,
            'status'   => $status,
        ];
        $upload = new Upload();
        $images_dd = $upload->singleImage($anhdaidien, BANNER_IMAGE_PATH);
        if ($images_dd) {
            $data['hinh_anh']  = $images_dd;
        }
        $bannerModel->save($data);
        $bannerModel->db->transComplete();
        return redirect()->to('dashboard/banner/manage');
    }
}
