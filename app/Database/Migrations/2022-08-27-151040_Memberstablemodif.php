<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Memberstablemodif extends Migration
{
	public function up()
	{
		$this->forge->addColumn('members', [
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => false,
				// 'unique' => true,
			],
		]);
	}

	public function down()
	{
	}
}
