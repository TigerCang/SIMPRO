<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lampiran extends Migration
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
			'idunik'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'pilihan'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'judul'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 2550,
			],
			'deskripsi'   	=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
			],
			'tanggal'    	=> [
				'type'           	=> 'DATE',
				'default'        	=> '1980-12-02',
			],
			'lampiran'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'updated_by'	=> [
				'type'      		=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'default' 			=> '0',
			],
			'created_at'  	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'updated_at'  	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'deleted_at'  	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_lampiran');
	}

	public function down()
	{
		$this->forge->dropTable('m_lampiran');
	}
}
