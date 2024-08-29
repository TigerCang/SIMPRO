<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SetAnggaran extends Migration
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
            'pilihan'       => [ //pendapatan pengeluaran
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'tujuan'        => [ //bc alat tanah
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'jenis'        => [ //btl bn dll
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'biaya_id'      => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'default'           => '0',
            ],
            'akun_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'default'           => '0',
            ],
            'bulan'         => [
                'type'              => 'DECIMAL',
                'constraint'        => [10, 2],
                'default'           => '0',
            ],
            'jumlah'        => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 4],
                'default'           => '0',
            ],
            'harga'         => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'total'         => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'catatan'       => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'levsatu'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
            ],
            'is_confirm'     => [
                'type'               => 'INT',
                'constraint'         => 1,
                'default'            => '0',
            ],
            'is_aktif'      => [
                'type'               => 'BOOLEAN',
                'default'            => true,
            ],
            'updated_by'    => [
                'type'              => 'INT',
                'constraint'         => 11,
                'unsigned'           => true,
                'default'             => '0',
            ],
            'confirmed_by'    => [
                'type'              => 'INT',
                'constraint'         => 11,
                'unsigned'           => true,
                'default'             => '0',
            ],
            'activated_by'        => [
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
        $this->forge->createTable('m_anggaran');
    }

    public function down()
    {
        $this->forge->dropTable('m_anggaran');
    }
}
