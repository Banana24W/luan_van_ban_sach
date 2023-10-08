<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'role_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE
                
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
        ]);
        $this->forge->addPrimaryKey('role_id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('role', TRUE, $attributes);
    
    }

    public function down()
    {
        $this->forge->dropTable('role', TRUE);
    }
}
