<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdduserMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false,
				'unique' => true,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false,
				'unique' => true,
			],
			'created_at datetime default current_timestamp'
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('user');
	}
	
	public function down()
	{
		$this->forge->dropTable('user');
		//
	}
}
