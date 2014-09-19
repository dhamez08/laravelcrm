<?php

class TaskLabelSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		DB::table('task_label')->insert(array(
			array('user_id'=>0,'action_name'=>'Call','icons'=>'fa-phone','color'=>'#9f3879'),
			array('user_id'=>0,'action_name'=>'Email','icons'=>'fa-envelope','color'=>'#b0322b'),
			array('user_id'=>0,'action_name'=>'Follow Up','icons'=>'fa-hand-o-up','color'=>'#d05d17'),
			array('user_id'=>0,'action_name'=>'Meeting','icons'=>'fa-calendar','color'=>'#d0dad1'),
			array('user_id'=>0,'action_name'=>'Milestone','icons'=>'fa-spinner','color'=>'#c1dde4'),
			array('user_id'=>0,'action_name'=>'Send','icons'=>'fa-send-o','color'=>'#f3c098'),
		));
	}

}
