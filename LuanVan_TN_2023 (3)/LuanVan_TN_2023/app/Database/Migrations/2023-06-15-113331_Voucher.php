<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Voucher extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'ngay_bat_dau' => [
                'type' => 'DATETIME',
                'null' => FALSE,
            ],
            'ngay_ket_thuc' => [
                'type' => 'DATETIME',
                'null' => FALSE,
            ],
            'ma_voucher' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => FALSE,
               
            ],
            'ma_khach_hang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ],
            'loai_khuyen_mai' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
            'so_luong' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => FALSE,
            ],
            'ma_don_hang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
            ],
            'phan_tram_giam' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
            
        ]);
        $this->forge->addPrimaryKey('id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('Voucher', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('Voucher', TRUE);
    }
}
