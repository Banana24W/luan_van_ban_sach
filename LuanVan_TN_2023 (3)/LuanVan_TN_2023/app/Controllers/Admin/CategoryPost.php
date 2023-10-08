<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryPostModel;
use App\Models\PostsModel;
use TheSeer\Tokenizer\Exception;

class CategoryPost extends BaseController
{
    public function index()
    {

        $CategoryPostModel = new CategoryPostModel();
        $categorypost = $CategoryPostModel->findAll();
        $datas = [
            'categorypost' =>  $categorypost,
            'pager'    => $CategoryPostModel->pager,  
        ];
     
        
        return view('Admin/Categorypost/index',$datas);
    }

    public function detail()
    {
        return view('Admin/Categorypost/detail');
    }
    public function save()
    {

        $name=$this->request->getPost('name');
       
        $status=$this->request->getPost('status');
        $datas = [

            'ten_loai_bai_viet' => $name,
            'status'=> $status,
        ];
        $categorypost = new CategoryPostModel();

        $isInsert = $categorypost->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/categorypost/detail');
    }
    public function delete()
    {
         $id = $this->request->getUri()->getSegment(4);
        // //xóa bảng posts chứa khóa ngoai
        $postsModel = new PostsModel();
        $booksCount = $postsModel->where('ma_loai_bai_viet', $id)->countAllResults();
        if ($booksCount > 0) {
            // Nếu có cuốn sách đang sử dụng loại sách này, chuyển hướng về trang danh sách loại sách với thông báo lỗi
            return redirect()->to('dashboard/categorypost')->with('error', 'Không thể xóa loại bài viết. Có bài viết liên quan đến.');
        }


        $CategoryPostModel=new CategoryPostModel();
        $CategoryPostModel->delete($id);

         return redirect()->to('dashboard/categorypost');
    }
    public function edit()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $CategoryPostModel = new CategoryPostModel();
        $categorypost = $CategoryPostModel->find($id);
        $datas['categorypost'] = $categorypost;

        return view('Admin/Categorypost/edit',$datas);
    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $CategoryPostModel = new CategoryPostModel();
        $CategoryPostModel->find($id);


        $name=$this->request->getPost('name');
        $status=$this->request->getPost('status');
        $datas = [

            'ten_loai_bai_viet' => $name,
            'status'=>$status,
        ];
        $CategoryPostModel->update($id, $datas);
        return redirect()->to('dashboard/categorypost');
    }
}
