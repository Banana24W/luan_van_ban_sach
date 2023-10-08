<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;
use App\Models\UserModel;

class Comment extends BaseController
{
    public function index()
    {
        $commentModel = new CommentModel();
        $comment=$commentModel->findAll();
        $userModel = new UserModel();
        foreach ($comment as $key => $comments) {
            $user = $userModel->find($comments['ma_khach_hang']);
            $comment[$key]['user'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
        }
        $data = [
            'comment' =>  $comment,
        ];
        return view('Admin/Comment/index', $data);
    }
    public function Status()
    {
        $ID = $this->request->getPost('order_id');
        $Status = $this->request->getPost('status');
        $cartModel= new CommentModel();
        $cartModel->update(['id'=> $ID],['status'=> $Status]);
        // Trả về phản hồi JSON
        return $this->response->setJSON(['success' => true]);
    }
}
