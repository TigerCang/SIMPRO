<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sesilog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kode'          => [
                'type'               => 'VARCHAR',
                'constraint'         => 255,
            ],
            'nosesi'        => [
                'type'               => 'VARCHAR',
                'constraint'         => 255,
            ],
            'ip_address'    => [
                'type'               => 'VARCHAR',
                'constraint'         => 255,
            ],
            'created_at'    => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at'    => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true); //primary key
        $this->forge->createTable('log_sesi');
    }

    public function down()
    {
        $this->forge->dropTable('log_sesi');
    }
}
