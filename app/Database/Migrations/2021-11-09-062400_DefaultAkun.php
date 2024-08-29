<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Defaultakun extends Migration
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
			'perusahaan_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'wilayah_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'divisi_id'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'menu'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'submenu'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'kelompok'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'nama'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'nilai'        	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'akun1_id'   	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'akun2_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'akun3_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'akun4_id'     	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'akun5_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'catatan'    	=> [
				'type'           	=> 'TEXT',
			],
			'setdef'      	=> [
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
		$this->forge->createTable('def_akun');
	}

	public function down()
	{
		$this->forge->dropTable('def_akun');
	}
}

//101.Akumulasi penyusutan -- 102.Persediaan Alat -- 601.Biaya Penyusutan
