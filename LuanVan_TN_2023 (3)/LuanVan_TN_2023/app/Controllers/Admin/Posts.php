<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\UserModel;
use App\Models\CategoryBookModel;
use App\Models\CategoryPostModel;
use App\Models\PostsModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;
use Exception;


class Posts extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $postModel = new PostsModel();
        $posts = $postModel->paginate(10);
        // Lặp qua các bài viết và lấy tên người dùng từ mã người dùng
        $userModel = new UserModel();
        foreach ($posts as $key => $post) {
            $user = $userModel->find($post['ma_nguoi_dung']);
            $posts[$key]['user'] = $user['last_name']; // Thêm thông tin người dùng vào mảng bài viết
        }
        $data = [
            'posts' => $posts,
            'pager'    => $postModel->pager,
            'category' => $this->getSubCategoryPost()
        ];
      
        return view('Admin/Posts/index', $data);
    }
    public function detail()
    {
        $postID = $this->request->getUri()->getSegment(5);
        $categoryModel = new CategoryPostModel();
        $category = $categoryModel->select('ma_loai_bai_viet, ten_loai_bai_viet')->findAll();
        if (!$category) {
            return redirectWithMessage('product-category/detail', 'Bạn cần có danh mục trước mới có thể thêm sản phẩm');
        }
        $data['category'] = $this->getSubCategoryPost();

        


        if (!$postID) {
            $data['title']            = 'Thêm mới sản phẩm';
            return view('Admin/Posts/detail', $data);
        }

        $postmodel = new PostsModel();
        $posts = $postmodel->select('baiviet.*, LoaiBaiViet.ma_loai_bai_viet, LoaiBaiViet.ten_loai_bai_viet')
        ->join('LoaiBaiViet', 'LoaiBaiViet.ma_loai_bai_viet = baiviet.ma_loai_bai_viet')
        ->where('baiviet.ma_bai_viet', $postID)
        ->first();
        if (!$postID) {
            return redirect()->to('dashboard/posts/manage');
        }

       

       
        $data['posts']            = $posts;   
        $data['title']              = 'Chỉnh sửa sản phẩm';
  
        return view('Admin/Posts/detail', $data);
    }
    function save()
    {
        //get product data
        $productID   = $this->request->getPost('posts_id');
        $category    = $this->request->getPost('category');
        $name        = $this->request->getPost('name');
        $status      = $this->request->getPost('status');
        $description = $this->request->getPost('description');
        $anhdaidien  = $this->request->getFile('anhdaidien');
        $userID = session()->get('idadmin');
        $postsModel = new PostsModel();
        $postsModel->db->transStart();
        $postsModel->db->transComplete();
      
        //after save product, we need to save product attribute values, image
        //get product inserted id for insert attribute values
        
        //prepare data
        $data = [
            'ma_bai_viet'      =>$productID,
            'ten_bai_viet'     => $name,
            'ma_loai_bai_viet' => $category,
            'status'   => $status,
            'mo_ta'=>$description,
            'ma_nguoi_dung' => $userID,
        ];
        $upload = new Upload();
        $images_dd = $upload->singleImage($anhdaidien, POST_IMAGE_PATH);
        if ($images_dd) {
            $data['hinh_anh']  = $images_dd;
        }
        $postsModel->save($data);
        $postsModel->db->transComplete();
        return redirect()->to('dashboard/posts/manage');
    }
    public function delete()
    {
        //get product id from post data
        $productID = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$productID) {
            return $this->respond (responseFailed(), Response::HTTP_OK);
        }
        //Delete product
        $product_m = new PostsModel();
        try {
            $isDelete = $product_m->update(['ma_bai_viet'=>$productID],['status'=>0]);
        } catch (DatabaseException $e) {
            return $this->respond(responseFailed('Không xoá được bài viết'),  Response::HTTP_OK);
        }
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được bài viết'),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed('Xóa Thành Công'),  Response::HTTP_OK);
    }





}
