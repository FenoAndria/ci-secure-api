<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MembersSeeder extends Seeder
{
	public function run()
	{
		$model = model('MembersModel');

                $model->insert([
                        'nom'      => static::faker()->email,
                        'date_naissance' => static::faker()->date,
                ]);
	}
}
