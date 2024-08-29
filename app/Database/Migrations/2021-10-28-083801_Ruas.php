<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ruas extends Migration
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
			'pilihan'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'proyek_id'   	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'ruas_id'    	=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 15,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'camp_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'kode'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'nama'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'jarak'        	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'default'        	=> '0',
			],
			'catatan'    	=> [
				'type'           	=> 'TEXT',
			],
			'is_confirm'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 1,
				'default'        	=> '0',
			],
			'is_aktif'     	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> true,
			],
			'updated_by'	=> [
				'type'      		=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'default' 			=> '0',
			],
			'confirmed_by'	=> [
				'type'      		=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'default' 			=> '0',
			],
			'activated_by'	=> [
				'type'      		=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'default' 			=> '0',
			],
			'created_at'  	=> [
				'type'           	=> 'DATETIME',
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
		$this->forge->createTable('m_ruas');
	}

	public function down()
	{
		$this->forge->dropTable('m_ruas');
	}
}
