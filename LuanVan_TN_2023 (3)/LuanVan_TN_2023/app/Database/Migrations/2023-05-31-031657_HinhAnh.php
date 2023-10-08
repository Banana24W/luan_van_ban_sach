<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HinhAnh extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'ma_sach' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => FALSE,
                
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
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
        $this->forge->createTable('HinhAnh', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('HinhAnh', TRUE);
    }
}
