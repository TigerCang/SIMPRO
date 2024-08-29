<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Biaya extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'idunik'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'pilihan'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'induk_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'tipe_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'kode'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'matabayar'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
				'null'		     	=> true,
			],
			'nama'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'satuan'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'level'			=> [
				'type'           	=> 'INT',
				'constraint'     	=> 1,
			],
			'akun_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'is_jumlah'     	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'is_confirm' 	=> [
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
			'updated_at'   	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'deleted_at' 	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_biaya');
	}

	public function down()
	{
		$this->forge->dropTable('m_biaya');
	}
}
