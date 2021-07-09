<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MembersMigration extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nom'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'date_naissance' => [
				'type' => 'date',
				// 'null' => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('members');
	}

	public function down()
	{
		$this->forge->dropTable('members');
	}
}
