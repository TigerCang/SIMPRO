<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kalender extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          	=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 15,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'tanggal'    	=> [
				'type'           	=> 'DATE',
			],
			'nama'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'potong_cuti'	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 10,
			],
			'updated_by'    => [
				'type'              => 'INT',
				'constraint'         => 11,
				'unsigned'           => true,
				'default'             => '0',
			],
			'created_at' 	=> [
				'type'          	=> 'DATETIME',
				'null'		     	=> true,
			],
			'updated_at' 	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'deleted_at'  	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_kalender');
	}

	public function down()
	{
		$this->forge->dropTable('m_kalender');
	}
}
