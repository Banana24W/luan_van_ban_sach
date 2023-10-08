<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoaiBaiViet extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ma_loai_bai_viet' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'ten_loai_bai_viet' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
            
        ]);
        $this->forge->addPrimaryKey('ma_loai_bai_viet');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('LoaiBaiViet', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('LoaiBaiViet', TRUE);
    }
}
