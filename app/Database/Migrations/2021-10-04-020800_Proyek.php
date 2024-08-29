<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Proyek extends Migration
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
			'idunik'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'perusahaan_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'wilayah_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'divisi_id'		=> [
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
			'paket'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'atasnama'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'lokasi'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'kbli_id'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'propinsi_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'pemilik'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'scope'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'konsultan'		=> [
				'type'           	=> 'TEXT',
			],
			'asuransi'		=> [
				'type'           	=> 'TEXT',
			],
			'keuangan'		=> [
				'type'           	=> 'TEXT',
			],
			'pelaksanaan'	=> [
				'type'           	=> 'TEXT',
			],
			'tipe_id'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'carabayar'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'tgl_kontrak'	=> [
				'type'           	=> 'DATE',
			],
			'tgl_pho'		=> [
				'type'           	=> 'DATE',
			],
			'tgl_fho'		=> [
				'type'           	=> 'DATE',
			],
			'ppn'			=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [10, 2],
				'default'        	=> '0',
			],
			'pph'			=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [10, 2],
				'default'        	=> '0',
			],
			'ni_kontrak'	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_tambah'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
			],
			'ni_lain'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
			],
			'ni_bruto'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_ppn'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_pph'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_netto'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'periode1'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 4,
				'default'        	=> '2000',
			],
			'periode2'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 4,
				'default'        	=> '2000',
			],
			'modeyear'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'catatan'		=> [
				'type'           	=> 'TEXT',
			],
			'is_pajak'    	=> [
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
			'activated_by'		=> [
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
		$this->forge->createTable('m_proyek');
	}

	public function down()
	{
		$this->forge->dropTable('m_proyek');
	}
}
