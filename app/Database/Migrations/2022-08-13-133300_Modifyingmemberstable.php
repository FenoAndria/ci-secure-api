<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Modifyingmemberstable extends Migration
{
	public function up()
	{
		$this->forge->addColumn('members','created_at datetime default current_timestamp');
	}

	public function down()
	{
		//
	}
}
