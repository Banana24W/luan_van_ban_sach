<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CartDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ma_chi_tiet_don_hang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'ma_sach' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
               
            ],
            'ma_don_hang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
               
            ],
            'so_luong' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
               
            ],
            'don_gia' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => FALSE,
            ],
            
           
            
        ]);
        $this->forge->addPrimaryKey('ma_chi_tiet_don_hang');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('chitietdonhang', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('chitietdonhang', TRUE);
    }
}
