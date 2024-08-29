<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tanah extends Migration
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
			],
			'wilayah_id' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'divisi_id'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'kakun_id'   	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'kode'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'nama'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'kbli_id'     	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'lokasi'     	=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
			],
			'kategori'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'null'		     	=> true,
			],
			'surat'     	=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
			],
			'tgl_beli'     	=> [
				'type'           	=> 'DATE',
			],
			'umur'      	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 3,
				'default'        	=> '0',
			],
			'sisa'        	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 3,
				'default'        	=> '0',
			],
			'ni_beli'     	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_residu'   	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_susut'   	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'modsusut'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
			],
			'bukti'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
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
			'nolink'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
				'null'		     	=> true,
			],
			'is_jual'    	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
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
			'activated_by'		=> [
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
			'deleted_at' 	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_tanah');
	}

	public function down()
	{
		$this->forge->dropTable('m_tanah');
	}
}
