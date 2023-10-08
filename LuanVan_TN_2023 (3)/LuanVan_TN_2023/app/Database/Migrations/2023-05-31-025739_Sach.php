<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sach extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ma_sach' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'ten_sach' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'ma_loai_sach' => [
                'type' => 'INT',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'mo_ta_sach' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'gia' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
            ],
            'so_luong' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
            ],
            'nam_xuat_ban' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => FALSE,
                
            ],
            'ma_nha_xuat_ban'=>[
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
               
            ],
            'tac_gia' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'khuyen_mai' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
            'lan_tai_ban'=>[
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
            ],
            'so_trang' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => FALSE,
            ],
            'danh_gia' => [
                'type' => 'FLOAT',
                'constraint' => 1,
                'null' => FALSE,
            ],
            'anh_dai_dien'=>[
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
        ]);
        $this->forge->addPrimaryKey('ma_sach');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('Book', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('Book', TRUE);
    }
}
