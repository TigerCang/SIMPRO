<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Idunik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'idunik'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
        ]);
        $this->forge->createTable('m_idunik');
    }

    public function down()
    {
        $this->forge->dropTable('m_idunik');
    }
}
