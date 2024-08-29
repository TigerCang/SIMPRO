<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KasBeban3 extends Migration
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
            'kasinduk_id'   => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
            ],
            'kasanak_id'    => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
            ],
            'biaya_id'      => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'akun_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'debit'         => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'kredit'        => [
                'type'           => 'DECIMAL',
                'constraint'     => [20, 2],
                'default'        => '0',
            ],
            'sisa'        => [
                'type'           => 'DECIMAL',
                'constraint'     => [20, 2],
                'default'        => '0',
            ],
            'catatan'        => [
                'type'           => 'TEXT',
                'null'             => true,
            ],
            'created_at'  => [
                'type'           => 'DATETIME',
                'null'             => true,
            ],
            'updated_at'  => [
                'type'           => 'DATETIME',
                'null'             => true,
            ],
            'deleted_at'  => [
                'type'           => 'DATETIME',
                'null'             => true,
            ],
        ]);
        $this->forge->addKey('id', true); //primary key
        $this->forge->createTable('kas_detil');
    }

    public function down()
    {
        $this->forge->dropTable('kas_detil');
    }
}
