<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alat extends Migration
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
			'pilihan'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'penerima_id'	=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 15,
				'unsigned'       	=> true,
				'null'		     	=> true,
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
			'divisi_id'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'perusahaanin_id' => [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'kakun_id'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'kode'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
				'null'		     	=> true,
			],
			'nomor'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
			],
			'nama'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'kbli_id'		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'merk'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'null'		     	=> true,
			],
			'bentuk'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'kategori_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'jenis'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'null'		     	=> true,
			],
			'surat'      	=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
			],
			'mesin'     	=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
			],
			'transmisi'		=> [
				'type'           	=> 'TEXT',
				'null'		     	=> true,
			],
			'tgl_beli'		=> [
				'type'           	=> 'DATE',
				'null'		     	=> true,
			],
			'tgl_produksi'	=> [
				'type'           	=> 'DATE',
				'null'		     	=> true,
			],
			'tgl_stnk'		=> [
				'type'           	=> 'DATE',
				'null'		     	=> true,
			],
			'tgl_keur'		=> [
				'type'           	=> 'DATE',
				'null'		     	=> true,
			],
			'umur'     		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 10,
				'default'        	=> '0',
			],
			'sisa'     		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 10,
				'default'        	=> '0',
			],
			'ni_beli'     	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_residu'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_target'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_sewa'   	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'ni_susut'  	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'modsusut'   	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
				'null'		     	=> true,
			],
			'berat'    		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [12, 2],
				'default'        	=> '1',
			],
			'ibbm'      	=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [12, 2],
				'default'        	=> '1',
			],
			'bukti'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
				'null'		     	=> true,
			],
			'supir_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'biaya_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'gambar'   		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'default'        	=> 'default.png',
			],
			'catatan'		=> [
				'type'           	=> 'TEXT',
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
		$this->forge->createTable('m_alat');
	}

	public function down()
	{
		$this->forge->dropTable('m_alat');
	}
}
