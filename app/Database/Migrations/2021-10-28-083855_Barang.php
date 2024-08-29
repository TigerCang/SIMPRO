<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          	=> [
				'type'      		=> 'BIGINT',
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
			'kakun_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'kode'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'partnumber'   	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
				'null'		     	=> true,
			],
			'nama'     		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'kategori' 		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'null'		     	=> true,
			],
			'merk'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'null'		     	=> true,
			],
			'satuan'   		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
				'null'		     	=> true,
			],
			'stokmin'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'default'        	=> '0',
			],
			'harga'    		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'biaya_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'use_serial'  	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'gambar'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'default'        	=> 'default.png',
			],
			'catatan'    	=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
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
			'deleted_at' 	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_barang');
	}

	public function down()
	{
		$this->forge->dropTable('m_barang');
	}
}
