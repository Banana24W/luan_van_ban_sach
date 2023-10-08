<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BaiViet extends Migration
{
  
        public function up()
        {
            $this->forge->addField([
                'ma_bai_viet' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                ],
                'ten_bai_viet' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => FALSE,
                ],
                'mo_ta' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => FALSE,
                ],
                'hinh_anh' => [
                    'type' => 'INT',
                    'constraint' => 50,
                    'null' => FALSE,
                ],
               
                'ma_nguoi_dung' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => FALSE,
                ],
                'ma_loai_bai_viet'=>[
                    'type' => 'INT',
                    'constraint' => 10,
                    'null' => FALSE,
                 
                ],
                'status' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'null' => FALSE,
                ],
                'created_at DATETIME NOT NULL DEFAULT current_timestamp',
                'updated_at DATETIME NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp'
            ]);
            $this->forge->addPrimaryKey('ma_bai_viet');
            $attributes = [
                'ENGINE' => 'InnoDB',
                'CHARACTER SET' => 'utf8',
                'COLLATE' => 'utf8_general_ci'
            ];
            $this->forge->createTable('BaiViet', TRUE, $attributes);
        }
    
        public function down()
        {
            $this->forge->dropTable('BaiViet', TRUE);
        }
    }
    

