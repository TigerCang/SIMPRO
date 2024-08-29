<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penerima extends Migration
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
			'kode'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'nip'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
				'null'		     	=> true,
			],
			'nama'        	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'perusahaan_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'wilayah_id' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'divisi_id'    	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'null'		     	=> true,
			],
			'cabang_id'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'lokasi'   		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'kategori'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'rating'     	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 3,
				'default'        	=> '0',
			],
			'jenkel'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
			],
			'goldarah'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 10,
				'null'     		 	=> true,
			],
			't4lahir'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'tgl_lahir'  	=> [
				'type'           	=> 'DATE',
			],
			'alamat'     	=> [
				'type'           	=> 'TEXT',
				'null'     		 	=> true,
			],
			'user_id'   	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'kontak'     	=> [
				'type'           	=> 'TEXT',
				'null'     		 	=> true,
			],
			'email'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'golongan_id'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'jabatan_id'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'atasan_id' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'ijasah'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
			],
			'jurusan'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
				'null'     		 	=> true,
			],
			'tgl_ijasah'  	=> [
				'type'           	=> 'DATE',
			],
			'st_ijasah'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'asuransi'    	=> [
				'type'           	=> 'TEXT',
				'null'     		 	=> true,
			],
			'nosim'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'jns_sim'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
			],
			'tgl_sim'    	=> [
				'type'           	=> 'DATE',
			],
			'st_ptkp'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'tgl_join'     	=> [
				'type'           	=> 'DATE',
			],
			'st_pegawai'   	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'tgl_kontrakawal' => [
				'type'           	=> 'DATE',
			],
			'tgl_kontrakakhir' => [
				'type'           	=> 'DATE',
			],
			'mode_keluar' 	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'tgl_keluar'	=> [
				'type'           	=> 'DATE',
			],
			'alasan_keluar'	=> [
				'type'           	=> 'TEXT',
				'null'     		 	=> true,
			],
			'st_pel'    	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'kakun_pel' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'st_sup'    	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'kakun_sup'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'st_lain'    	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'kakun_lain' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'st_peg'    	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'kakun_peg'  	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'osm'    		=> [ //operator supir mekanik
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'catatan'    	=> [
				'type'           	=> 'TEXT',
				'null'     		 	=> true,
			],
			'gambar'      	=> [
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
		$this->forge->createTable('m_penerima');
	}

	public function down()
	{
		$this->forge->dropTable('m_penerima');
	}
}
