<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;
class Admin extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $admminModel = new UserModel();
        $user = $admminModel->paginate(100);
        $datas['user'] = $user;
        return view('Admin/Admin/index',$datas);
    }

    public function detail()
    {   
        $UserID = $this->request->getUri()->getSegment(5);
        $data['role'] = $this->getSubRole();
        

        $UserModel = new UserModel();
        $user = $UserModel->select('user.*, role.role_id, role.role_name')
            ->join('role', 'role.role_id = user.role')
            ->where('user.id', $UserID)
            ->first();

        if (!$user) {
            return redirect()->to('dashboard/admin/manage');
        }
        $data['user']            = $user;
        $data['title']              = 'Chỉnh sửa tài khoản';
        return view('Admin/Admin/detail', $data);
    }
    public function delete()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');
        //if account id is empty, return error response
        if (!$id) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        //cannot delete exclusive admin account, of course
        if ($id == 1) {
            return $this->respond(responseFailed('Bạn không thể xoá tài khoản này!'), Response::HTTP_OK);
        }

        $adminModel = new UserModel();
        if (!$adminModel->delete($id)) {
            return $this->respond(responseFailed(), Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(), Response::HTTP_OK);
    }
    public function save()
    {

    }
    
}
