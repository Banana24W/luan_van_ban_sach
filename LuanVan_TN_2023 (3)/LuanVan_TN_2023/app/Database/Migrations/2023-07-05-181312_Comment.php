<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
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
            'ma_khach_hang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
               
            ],
            'binh_luan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
               
            ],
            'danh_gia' => [
                'type' => 'INT',
                'constraint' => 4,
                'null' => FALSE,
            ],
            'created_at DATETIME NOT NULL DEFAULT current_timestamp',
            'updated_at DATETIME NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp'
           
            
        ]);
        $this->forge->addPrimaryKey('id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('binhluan', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('binhluan', TRUE);
    }
}
