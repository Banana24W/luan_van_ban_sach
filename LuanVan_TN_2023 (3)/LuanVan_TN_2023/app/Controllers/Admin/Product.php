<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use App\Models\BookImageModel;
use App\Models\BookModel;
use App\Models\CategoryBookModel;
use App\Models\NXBModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Response;
use CodeIgniter\API\ResponseTrait;
class Product extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $productModel = new BookModel();


        $data = [
            'products' => $productModel->findAll(),
            'pager'    => $productModel->pager,
            'category' => $this->getSubCategory()
        ];
        return view('Admin/Product/index', $data);
    }
    public function detail()
    {
        $productID = $this->request->getUri()->getSegment(5);
        $categoryModel = new CategoryBookModel();
        $category = $categoryModel->select('ma_loai_sach, ten_loai_sach')->findAll();
      
        $data['category'] = $this->getSubCategory();

        $nxbmodel = new NXBModel();
        $nxb = $nxbmodel->select('ma_nha_xuat_ban, ten_nha_xuat_ban')->findAll();
       
        $data['NXB'] = $this->getSubCategoryNXB();


        if (!$productID) {
            $data['title']            = 'Thêm mới sản phẩm';
            return view('Admin/Product/detail', $data);
        }

        $productModel = new BookModel();
        $product = $productModel->select('book.*, LoaiSach.ma_loai_sach, LoaiSach.ten_loai_sach')
            ->join('LoaiSach', 'LoaiSach.ma_loai_sach = book.ma_loai_sach')
            ->where('book.ma_sach', $productID)
            ->first();
        if (!$product) {
            return redirect()->to('dashboard/product/manage');
        }

        $productImageModel = new BookImageModel();
        $images = $productImageModel->where('ma_sach', $productID)->orderBy('id', 'ASC')->find();


        $data['product']            = $product;
        $data['images']             = $images;
        $data['title']              = 'Chỉnh sửa sản phẩm';

        return view('Admin/Product/detail', $data);
    }
    function save()
    {
        //get product data
        $productID   = $this->request->getPost('product_id');
        $category    = $this->request->getPost('category');
        $name        = $this->request->getPost('name');
        $price       = $this->request->getPost('price');
        $discount    = $this->request->getPost('discount');
        $quantity    = $this->request->getPost('quantity');
        $status      = $this->request->getPost('status');
        $description = $this->request->getPost('description');
        $namxuatban   = $this->request->getPost('namxuatban');
        $nxb = $this->request->getPost('nxb');
        $sotrang = $this->request->getPost('sotrang');
        $lantaiban = $this->request->getPost('lantaiban');
        $tacgia = $this->request->getPost('author');
        $anhdaidien = $this->request->getFile('anhdaidien');
        $fileError = $this->request->getFiles()['images'][0]->getError();
        if ($fileError != 4) {
            $upload = new Upload();
            $images = $upload->multipleImages($this->request->getFiles(), PRODUCT_IMAGE_PATH);
            if (!$images) {
                return redirectWithMessage('dashboard/product/manage/detail/' . $productID, 'Hình ảnh lỗi ');
            }
        }
        $productModel = new BookModel();
        $productModel->db->transStart();
        $productModel->db->transComplete();
        //prepare data
        $data = [
            'ma_sach'      => $productID,
            'ten_sach'     => $name,
            'ma_loai_sach' => $category,
            'ma_nha_xuat_ban' => $nxb,
            'gia'    => intval(str_replace(',', '', $price)),
            'khuyen_mai' => $discount,
            'so_luong' => $quantity,
            'status'   => $status,
            'mo_ta_sach' => $description,
            'nam_xuat_ban'  => $namxuatban,
            'so_trang' => $sotrang,
            'lan_tai_ban' => $lantaiban,
            'tac_gia' => $tacgia,
        ];
        $upload = new Upload();
        $images_dd = $upload->singleImage($anhdaidien, PRODUCT_IMAGE_PATH);
        if ($images_dd) {
            $data['anh_dai_dien']  = $images_dd;
        }
        $productModel->save($data);
        if (isset($images)) {
            $data['images']  = $images[0];
        }
        $insertID = $productModel->getInsertID();
        if ($productID) {
            $insertID = $productID;
        }
        if (isset($images)) {
            $isSaveImage = $this->saveImage($insertID, $images);
            if (!$isSaveImage) {
                redirectWithMessage('dashboard/product/manage/detail/', UNEXPECTED_ERROR_MESSAGE);
            }
        }
        $productModel->db->transComplete();
        return redirect()->to('dashboard/product/manage');
    }

    private function saveImage($productID, $images)
    {
        $productImageModel = new BookImageModel();
        $datas = $this->mergeImageWithProductID($productID, $images);
        foreach ($datas as $data) {
            $isInsert = $productImageModel->insert($data);
            if (!$isInsert) {
                return false;
            }
        }
        return true;
    }


    private function mergeImageWithProductID($productID, $images)
    {
        foreach ($images as $image) {
            $data[] = [
                'ma_sach' => $productID,
                'image' => $image
            ];
        }
        return $data;
    }
    public function delete()
    {
        //get product id from post data
        $productID = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$productID) {
            return $this->respond (responseFailed(), Response::HTTP_OK);
        }

       

        //Delete image
        $productImageModel = new BookImageModel();
        $images = $productImageModel->select('image')->where('ma_sach', $productID)->find();
        $upload = new Upload();
        $upload->cleanImages($images);
        $isDelete = $productImageModel->where('ma_sach', $productID)->delete();
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được hình ảnh'),  Response::HTTP_OK);
        }

        //Delete product
        $product_m = new BookModel();
        try {
            $isDelete = $product_m->update(['ma_sach'=>$productID],['status'=>0]);
        } catch (DatabaseException $e) {
            return $this->respond(responseFailed('Không xoá được sản phẩm'),  Response::HTTP_OK);
        }
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được sản phẩm'),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }

    public function deleteImage($id = null)
    {
        if ($this->request->getPost('id')) {
            $id = $this->request->getPost('id');
        }
        if (!$id) {
            return $this->respond(responseFailed(UNEXPECTED_ERROR_MESSAGE),  Response::HTTP_OK);
        }
        //Delete image
        $productImageModel = new BookImageModel();
        $image = $productImageModel->select('image')->first($id);
        if (!$image) {
            return $this->respond(responseFailed('Không có hình ảnh này'),  Response::HTTP_OK);
        }
        $file = PRODUCT_IMAGE_PATH . $image['image'];
        if (!file_exists($file)) {
            return $this->respond(responseFailed('Hình ảnh không tồn tại'),  Response::HTTP_OK);
        }

        @unlink($file);

        $isDelete = $productImageModel->delete($id);
        if (!$isDelete) {
            return $this->respond(responseFailed('Không xoá được sản phẩm'),  Response::HTTP_OK);
        }
        return $this->respond(responseSuccessed(),  Response::HTTP_OK);
    }
}
