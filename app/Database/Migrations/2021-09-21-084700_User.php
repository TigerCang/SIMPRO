<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'			=> [
				'type'      		=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'idunik'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'kode'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'null' 				=> false,
				'character set' 	=> 'utf8',
				'collate' 			=> 'utf8_bin',
			],
			'peminta'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'password'		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'role_id'       => [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
			],
			'atasan_id'	=> [
				'type'           	=> 'TEXT',
			],
			'acc_setuju'	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 3,
				'unsigned'       	=> true,
				'default'        	=> '0',
			],
			'batasacc'		=> [
				'type'           	=> 'DECIMAL',
				'constraint'     	=> [20, 2],
				'default'        	=> '0',
			],
			'act_create'	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'act_edit'		=> [
				'type'      		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'act_confirm'	=> [
				'type'      		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'act_delete'	=> [
				'type'      		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'act_aktif'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'act_perusahaan' => [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'perusahaan'	=> [
				'type'           	=> 'TEXT',
			],
			'act_wilayah'	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'wilayah'		=> [
				'type'           	=> 'TEXT',
			],
			'act_divisi'	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'divisi'		=> [
				'type'           	=> 'TEXT',
			],
			'act_gaji'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'gaji'			=> [
				'type'				=> 'TEXT',
			],
			'act_camp'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'camp'			=> [
				'type'           	=> 'TEXT',
			],
			'act_proyek'	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'proyek'		=> [
				'type'           	=> 'TEXT',
			],
			'act_alat'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'alat'   		=> [
				'type'           	=> 'TEXT',
			],
			'act_tanah'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'tanah'   		=> [
				'type'           	=> 'TEXT',
			],
			'jenis_kas'   	=> [
				'type'           	=> 'TEXT',
			],
			'act_super'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'act_saring' 	=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'iz_pass'		=> [
				'type'       		=> 'BOOLEAN',
				'default'    		=> false,
			],
			'bgimg'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
				'default'        	=> '01.jpg',
			],
			'is_confirm' 	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 1,
				'default'        	=> '0',
			],
			'is_aktif' 		=> [
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
			'created_at'	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'updated_at'	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'deleted_at'	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('m_user');
	}

	public function down()
	{
		$this->forge->dropTable('m_user');
	}
}
