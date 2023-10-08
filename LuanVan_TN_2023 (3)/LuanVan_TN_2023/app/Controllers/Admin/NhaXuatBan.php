<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\NXBModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;
use Exception;

class NhaXuatBan extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $NhaxuatbanModel = new NXBModel();
        $NXB = $NhaxuatbanModel->paginate(10);
        $data['NXB'] = $NXB;
        return view('Admin/NXB/index', $data);
    }
    public function detail()
    {
        return view('Admin/NXB/detail');
    }
    public function save()
    {

        $name = $this->request->getPost('name');

        $status = $this->request->getPost('status');
        $datas = [

            'ten_nha_xuat_ban' => $name,
            'status' => $status,
        ];
        $nxb = new NXBModel();

        $isInsert = $nxb->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/nxb/detail');
    }
    public function delete()
    {
        $id = $this->request->getUri()->getSegment(4);
        $NhaxuatbanModel = new NXBModel();
        $bookModel = new BookModel();
        $book = $bookModel->where('ma_nha_xuat_ban', $id)->first();
        if ($book) {
            // Xuất hộp thoại cảnh báo nếu có sách đang sử dụng nhà xuất bản
            echo '<script>';
            echo 'alert("Không thể xóa nhà xuất bản do có sách đang sử dụng");';
            echo 'window.location.href = "dashboard/nxb";';
            echo '</script>';
            exit;
        }
        $NhaxuatbanModel->delete($id);

        return redirect()->to('dashboard/nxb');
    }
    public function edit()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $NhaxuatbanModel = new NXBModel();
        $nxb = $NhaxuatbanModel->find($id);
        $datas['NXB'] = $nxb;

        return view('Admin/NXB/edit', $datas);
    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $NhaxuatbanModel = new NXBModel();
        $NhaxuatbanModel->find($id);


        $name = $this->request->getPost('name');
        $status = $this->request->getPost('status');
        $datas = [

            'ten_nha_xuat_ban' => $name,
            'status' => $status,
        ];
        $NhaxuatbanModel->update($id, $datas);
        return redirect()->to('dashboard/nxb');
    }
}
