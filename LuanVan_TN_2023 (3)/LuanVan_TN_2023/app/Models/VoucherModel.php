<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'Voucher';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getPromotion($ma_khuyen_mai)
    {
        $query = $this->select('loai_khuyen_mai')
                      ->where('ma_voucher', $ma_khuyen_mai)
                      ->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->loai_khuyen_mai;
        } else {
            return null;
        }
    }
    public function getPhanTramKM($ma_khuyen_mai)
    {
        $query = $this->select('phan_tram_giam')
                      ->where('ma_voucher', $ma_khuyen_mai)
                      ->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            return $row->phan_tram_giam;
        } else {
            return null;
        }
    }
}
