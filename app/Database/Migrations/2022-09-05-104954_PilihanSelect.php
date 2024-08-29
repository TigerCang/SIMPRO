<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PilihanSelect extends Migration
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
            'nomor'         => [
                'type'              => 'INT',
                'constraint'        => 5,
            ],
            'param'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'kelompok'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'nama'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
        ]);
        $this->forge->addKey('id', true); //primary key
        $this->forge->createTable('m_select');
    }

    public function down()
    {
        $this->forge->dropTable('m_select');
    }
}
