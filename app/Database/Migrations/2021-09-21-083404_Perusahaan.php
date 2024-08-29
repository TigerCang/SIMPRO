<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perusahaan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'			=> [
				'type'				=> 'INT',
				'constraint' 		=> 11,
				'unsigned' 			=> true, //nilai positif saja
				'auto_increment' 	=> true,
			],
			'idunik'		=> [
				'type' 				=> 'VARCHAR',
				'constraint' 		=> 100,
			],
			'kode'			=> [
				'type'				=> 'VARCHAR',
				'constraint' 		=> 100,
			],
			'kui'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 10,
			],
			'nama'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'alamat'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'telp'			=> [
				'type'				=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'kota'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'direktur'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'penerima_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'logo'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'default'        	=> 'default.png',
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
			'created_at' 	=> [
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
		$this->forge->createTable('m_perusahaan');
	}

	public function down()
	{
	}
}
