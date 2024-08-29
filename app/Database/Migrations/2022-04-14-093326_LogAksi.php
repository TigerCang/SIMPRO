<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogAksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'idunik'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'user_id'       => [
                'type'              => 'BIGINT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'menu'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'pilihan'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'aksi'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'data'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'level'         => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'st_seru'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
                'default'           => 'off',
            ],
            'catatan'       => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'lama'          => [
                'type'              => 'INT',
                'constraint'        => 10,
            ],
            'ip_address'    => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
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
        $this->forge->createTable('log_aksi');
    }

    public function down()
    {
        $this->forge->dropTable('log_aksi');
    }
}
