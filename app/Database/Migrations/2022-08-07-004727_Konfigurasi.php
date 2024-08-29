<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konfigurasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'idunik'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'mode'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
            ],
            'parameter'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'subparam'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'nilai'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'updated_by'    => [
                'type'              => 'INT',
                'constraint'         => 11,
                'unsigned'           => true,
                'default'             => '0',
            ],
            'created_at'    => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at'    => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at'    => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true); //primary key
        $this->forge->createTable('m_konfigurasi');
    }

    public function down()
    {
        $this->forge->dropTable('m_konfigurasi');
    }
}
