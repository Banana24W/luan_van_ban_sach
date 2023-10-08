<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserAdmin extends BaseController
{
    public function index()
    {
        $userModel= new UserModel();
        $user =$userModel->paginate(100);
        $data['user']=$user;
        return view('Admin/User/index',$data);
    }
    public function detail()
    {   
        $UserID = $this->request->getUri()->getSegment(4);
        $data['role'] = $this->getSubRole();
        $UserModel = new UserModel();
        $user = $UserModel->select('user.*, role.role_id, role.role_name')
            ->join('role', 'role.role_id = user.role')
            ->where('user.id', $UserID)
            ->first();

        if (!$user) {
            return redirect()->to('dashboard/user');
        }
        $data['user']            = $user;
        $data['title']              = 'Chỉnh sửa tài khoản';
        return view('Admin/User/detail', $data);
    }
    public function save(){
        $status      = $this->request->getPost('status');
        $UserID      = $this->request->getPost('id');
       
        $userModel = new UserModel();
        $data = [
            'status'   => $status,
        ];
        $userModel->update($UserID,$data);
        return redirect()->to('dashboard/user');
    }
}
