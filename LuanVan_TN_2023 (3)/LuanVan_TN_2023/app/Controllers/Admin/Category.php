<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\CategoryBookModel;
use App\Models\PostsModel;
use Exception;

class Category extends BaseController
{
    public function index()
    {

        $CategoryBookModel = new CategoryBookModel();
        $category = $CategoryBookModel->paginate(10);
        $datas['category'] = $category;
        return view('Admin/Category/index',$datas);
    }

    public function detail()
    {
        return view('Admin/Category/detail');
    }
    public function save()
    {

        $name=$this->request->getPost('name');
       
        $status=$this->request->getPost('status');
        $datas = [

            'ten_loai_sach' => $name,
            'status'=> $status,
        ];
        $category = new CategoryBookModel();

        $isInsert = $category->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/category');
    }
    public function delete()
    {
        $id = $this->request->getUri()->getSegment(4);
       
    // Kiểm tra xem có cuốn sách nào đang sử dụng loại sách này
    $postsModel = new BookModel();
    $booksCount = $postsModel->where('ma_loai_sach', $id)->countAllResults();

    if ($booksCount > 0) {
        // Nếu có cuốn sách đang sử dụng loại sách này, chuyển hướng về trang danh sách loại sách với thông báo lỗi
        return redirect()->to('dashboard/category')->with('error', 'Không thể xóa loại sách. Có cuốn sách liên quan đến nó.');
    }

    // Nếu không có cuốn sách nào đang sử dụng loại sách này, tiến hành xóa
    $CategoryBookModel = new CategoryBookModel();
    $CategoryBookModel->update(['ma_loai_sach'=>$id],['status'=>0]);
    

    return redirect()->to('dashboard/category');
    }
    public function edit()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $CategoryBookModel = new CategoryBookModel();
        $category = $CategoryBookModel->find($id);
        $datas['category'] = $category;

        return view('Admin/Category/edit',$datas);
    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $CategoryBookModel = new CategoryBookModel();
        $CategoryBookModel->find($id);


        $name=$this->request->getPost('name');
        $status=$this->request->getPost('status');
        $datas = [

            'ten_loai_sach' => $name,
            'status'=>$status,
        ];
        $CategoryBookModel->update($id, $datas);
        return redirect()->to('dashboard/category');
    }
}
