<?php

class ActivityGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('activity_group')->insert(array(
			array('name'=>'User', 'description'=>'Main user or sub user', 'date_added'=>date('Y-m-d H:i:s')),
			array('name'=>'Client', 'description'=>'Person or company', 'date_added'=>date('Y-m-d H:i:s')),
			array('name'=>'Note', 'description'=>'', 'date_added'=>date('Y-m-d H:i:s')),
			array('name'=>'Task', 'description'=>'', 'date_added'=>date('Y-m-d H:i:s')),
		));
	}

}
