<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datalog extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'			=> [
				'type'				=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'menu'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'aksi'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'idunik'      	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'data'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'ip_address'	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
			],
			'is_show'    	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 5,
			],
			'created_by'	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 50,
				'null'		     	=> true,
			],
			'created_at'	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
			'updated_at'	=> [
				'type'           	=> 'DATETIME',
				'null'		     	=> true,
			],
		]);
		$this->forge->addKey('id', true); //primary key
		$this->forge->createTable('log_data');
	}

	public function down()
	{
		$this->forge->dropTable('log_data');
	}
}
