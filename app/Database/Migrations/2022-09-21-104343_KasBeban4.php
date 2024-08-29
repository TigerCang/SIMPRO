<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KasBeban4 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kasanak_id'    => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
            ],
            'nomor'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'masapajak'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'objekpajak_id'   => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'nilai_dpp'     => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'tarif'         => [
                'type'               => 'DECIMAL',
                'constraint'         => [10, 2],
                'default'            => '0',
            ],
            'nilai_potong'  => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'dokref_id'     => [
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
            'deleted_at'    => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true); //primary key
        $this->forge->createTable('kas_pajak');
    }

    public function down()
    {
        $this->forge->dropTable('kas_pajak');
    }
}
