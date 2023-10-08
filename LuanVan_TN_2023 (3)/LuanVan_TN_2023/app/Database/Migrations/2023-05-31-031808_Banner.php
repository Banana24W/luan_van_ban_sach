<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Banner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ma_banner' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'hinh_anh' => [
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
        $this->forge->addPrimaryKey('ma_banner');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('Banner', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('Banner', TRUE);
    }
}
