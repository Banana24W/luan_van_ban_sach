<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ma_don_hang' => [
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
            'tong_tien' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => TRUE,
            ],
            'ma_khach_hang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
               
            ],
            'trang_thai_don_hang' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => FALSE,
            ],
            'payment_method' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE,
                'default' => '1'
            ],
            'shipping_to' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'created_at DATETIME NOT NULL DEFAULT current_timestamp',
            'updated_at DATETIME NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp'
           
            
        ]);
        $this->forge->addPrimaryKey('ma_don_hang');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('donhang', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('donhang', TRUE);
    }
}
