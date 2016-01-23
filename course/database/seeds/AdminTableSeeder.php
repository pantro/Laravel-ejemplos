<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder {

	
	public function run()
	{
		\DB::table('users')->insert(array (
			'first_name'=>'Duilio',
			'last_name'	=>'Palacios',
			'email'		=>'i@duilio.me',
			'password'	=> \Hash::make('secret'),
			'type'		=>'admin'
		));
	}

}
