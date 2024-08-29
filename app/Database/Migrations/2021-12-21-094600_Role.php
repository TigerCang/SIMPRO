<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          	=> [
				'type'     			=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'idunik'     	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'nama'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'menu_1'     	=> [
				'type'           	=> 'TEXT',
			],
			'menu_2'       	=> [
				'type'           	=> 'TEXT',
			],
			'menu_3'      	=> [
				'type'           	=> 'TEXT',
			],
			'menu_4'      	=> [
				'type'           	=> 'TEXT',
			],
			'menu_5'      	=> [
				'type'           	=> 'TEXT',
			],
			'menu_6'     	=> [
				'type'           	=> 'TEXT',
			],
			'menu_7'     	=> [
				'type'           	=> 'TEXT',
			],
			'menu_8'      	=> [
				'type'           	=> 'TEXT',
			],
			'menu_9'      	=> [
				'type'           	=> 'TEXT',
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
		$this->forge->createTable('m_role');
	}

	public function down()
	{
		$this->forge->dropTable('m_role');
	}
}
