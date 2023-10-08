<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NhaXuatBan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ma_nha_xuat_ban' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'ten_nha_xuat_ban' => [
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
        $this->forge->addPrimaryKey('ma_nha_xuat_ban');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('NhaXuatBan', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('NhaXuatBan', TRUE);
    }
}
