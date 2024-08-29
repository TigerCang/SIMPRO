<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KasBeban1 extends Migration
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
            'idunik'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'user_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'peminta_id'    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'last_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'pilihan'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'tujuan'        => [ //proyek camp alat
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'perusahaan_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'wilayah_id'    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'divisi_id'     => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'nodoc'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'tgl_minta'     => [
                'type'              => 'DATE',
            ],
            'tanggal'       => [
                'type'              => 'DATE',
                'null'              => true,
            ],
            'revisi'        => [
                'type'              => 'INT',
                'constraint'        => 2,
                'default'           => '0',
            ],
            'beban_id'     => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'penerima_id'   => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'kbli_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'asal'          => [
                'type'              => 'VARCHAR', //dari menu kaslangsung dll
                'constraint'        => 100,
            ],
            'jenis'         => [
                'type'              => 'VARCHAR', //ju atau ajp
                'constraint'        => 100,
            ],
            'level'         => [
                'type'              => 'VARCHAR', //lev awal, posisi, next
                'constraint'        => 100, // -1;+2;=3;
            ],
            'acc_1'         => [
                'type'              => 'BOOLEAN',
                'default'           => false,
            ],
            'acc_2'         => [
                'type'              => 'BOOLEAN',
                'default'           => false,
            ],
            'periode'       => [
                'type'              => 'VARCHAR', //periode akun 
                'constraint'        => 100,
            ],
            'is_pajak'       => [
                'type'              => 'BOOLEAN',
                'default'           => false,
            ],
            'is_sama'       => [
                'type'              => 'BOOLEAN',
                'default'           => false,
            ],
            'status'        => [ //new pending proses
                'type'              => 'VARCHAR',
                'constraint'        => 10,
                'default'           => '0',
            ],
            'lampiran'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
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
        $this->forge->createTable('kas_induk');
    }

    public function down()
    {
        $this->forge->dropTable('kas_induk');
    }
}
