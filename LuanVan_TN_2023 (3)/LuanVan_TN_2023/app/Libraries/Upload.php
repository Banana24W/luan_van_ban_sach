<?php

namespace App\Libraries;

use CodeIgniter\Config\Services;

/**
 * Upload file class
 */
class Upload
{

    /**
     * Validate file upload
     * 
     * @param string $inputName name of input file
     * @return bool true if valid, false if not
     */
    public function validationImage(string $inputName)
    {
        $validationRule = [
            $inputName => [
                'label' => 'Image File',
                'rules' => 'uploaded[' . $inputName . ']'
                    . '|is_image[' . $inputName . ']'
                    . '|mime_in[' . $inputName . ', image/jpg, image/jpeg, image/gif, image/png, image/webp]'
                    . '|max_size[' . $inputName . ', 10000]' // 5MB
            ],
        ];
        $validate = Services::validation();
        if (!$validate->setRules($validationRule)) {
            return false;
        }
        return true;
    }

    /**
     * Used to upload multiple images to server
     *
     * @param mixed $images Images to upload
     * @param string $path path to upload folder
     * @return array|bool a string name of uploaded images or FALSE on failure
     */
    function singleImages($image, $path = UPLOAD_PATH)
    {
        if (!$image) {
            return false;
        }

        if (!$image->isValid() || $image->hasMoved()) {
            return false;
        }
        $newName = $image->getRandomName();
        $fileName = $newName;
        $image->move($path, $newName);

        return $fileName;
    }

    /**
     * Used to upload multiple images to server
     *
     * @param mixed $images Images to upload
     * @param string $inputName Name of input field
     * @return array|bool a string name of uploaded images or FALSE on failure
     */
    function multipleImages($images, $path = UPLOAD_PATH, $inputName = 'images')
    {
        if (!$images) {
            return false;
        }
        foreach ($images[$inputName] as $img) {
            if (!$img->isValid() || $img->hasMoved()) {
                return false;
            }
            $newName = $img->getRandomName();
            $fileNames[] = $newName;
            $img->move($path, $newName);
        }
        return $fileNames;
    }

    function cleanImages($images)
    {
        foreach ($images as $image) {
            $file = PRODUCT_IMAGE_PATH . $image['image'];
            if (!file_exists($file)) {
                return false;
            }
            unlink($file);;
        }
        return true;
    }

   function singleImage($image, $uploadPath) {
        // Kiểm tra xem file ảnh có hợp lệ không
        if ($image->isValid() && $image->getSize() > 0) {
            // Tạo tên mới cho file ảnh để tránh trùng lặp
            $newName = $image->getRandomName();
    
            // Di chuyển file ảnh vào thư mục lưu trữ
            if ($image->move($uploadPath, $newName)) {
                // Trả về tên file ảnh mới đã được lưu
                return $newName;
            }
        }
    
        // Trả về false nếu xảy ra lỗi trong quá trình xử lý
        return false;
    }
}
