<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SerialBarang extends Migration
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
			'barang_id'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'noseri'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'harga'        	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'alat_id'     	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'reparasi'   	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 2,
				'default'        	=> '0',
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
		$this->forge->createTable('m_serial');
	}

	public function down()
	{
		$this->forge->dropTable('m_serial');
	}
}
