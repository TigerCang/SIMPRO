<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KasBeban2 extends Migration
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
            'kasdetil_id'   => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
            ],
            'ruas_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'anggaran_id'   => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
            ],
            'biaya_id'      => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'akun_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'sumberdaya_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'osm_id'        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'item_id'       => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'jumlah'        => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 4],
            ],
            'harga'         => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'debit'         => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'kredit'        => [
                'type'              => 'DECIMAL',
                'constraint'        => [20, 2],
                'default'           => '0',
            ],
            'catatan'       => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'anak_id'   => [
                'type'              => 'BIGINT',
                'constraint'        => 15,
                'unsigned'          => true,
            ],
            'mode'        => [
                'type'              => 'VARCHAR', //a inputan b1 ubah jumlah, b2 ubah harga c pph
                'constraint'        => 10,
            ],
            'asal'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
                'null'              => true,
            ],
            'in_pph'     => [
                'type'              => 'BOOLEAN',
                'default'           => false,
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
        $this->forge->createTable('kas_anak');
    }

    public function down()
    {
        $this->forge->dropTable('kas_anak');
    }
}
