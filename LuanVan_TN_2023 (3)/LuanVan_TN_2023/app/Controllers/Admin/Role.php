<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleAdmmin;
use Exception;
class Role extends BaseController
{
    public function index()
    {
        $roleModel=new RoleAdmmin();
        $role=$roleModel->paginate(10);
        $data['role']=$role;
        return view('Admin/Role/index',$data);
    }
    public function detail()
    {
        return view('Admin/Role/detail');
    }
    public function save()
    {

        $name=$this->request->getPost('name');
       
        $status=$this->request->getPost('status');
        $datas = [

            'role_name' => $name,
            'status'=> $status,
        ];
        $role = new RoleAdmmin();

        $isInsert = $role->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/role/detail');
    }
    public function delete()
    {
        $id = $this->request->getUri()->getSegment(4);
        $roleModel=new RoleAdmmin();
        $roleModel->delete($id);

         return redirect()->to('dashboard/role');
    }
    public function edit()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $roleModel = new RoleAdmmin();
        $role = $roleModel->find($id);
        $datas['role'] = $role;

        return view('Admin/role/edit',$datas);
    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $roleModel = new RoleAdmmin();
        $roleModel->find($id);


        $name=$this->request->getPost('name');
        $status=$this->request->getPost('status');
        $datas = [

            'role_name' => $name,
            'status'=>$status,
        ];
        $roleModel->update($id, $datas);
        return redirect()->to('dashboard/role');
    }
}
