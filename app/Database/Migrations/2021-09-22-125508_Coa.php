<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Coa extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'			=> [
				'type'				=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'idunik'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'kode'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'noakun'        => [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'nama'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'level'			=> [
				'type'           	=> 'INT',
				'constraint'     	=> 1,
			],
			'kategori'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'induk_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'posisi'      	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> true,
			],
			'is_confirm' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 1,
				'default'        	=> '0',
			],
			'is_aktif'      => [
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
			'updated_at'	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'deleted_at'  	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_akun');
	}

	public function down()
	{
		$this->forge->dropTable('m_akun');
	}
}
