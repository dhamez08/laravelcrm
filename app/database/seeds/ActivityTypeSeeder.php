<?php

class ActivityTypeSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('activity_type')->insert(array(
			array('activity_group_id'=>1, 'name'=>'New User', 'log_text'=>'XXX added user YYY'),
			array('activity_group_id'=>1, 'name'=>'Remove User', 'log_text'=>'XXX removed user YYY'),
			array('activity_group_id'=>1, 'name'=>'Update User', 'log_text'=>'XXX updated user YYY'),
			array('activity_group_id'=>1, 'name'=>'Update Profile', 'log_text'=>'XXX updated profile'),
			array('activity_group_id'=>2, 'name'=>'New Client', 'log_text'=>'XXX added client YYY'),
			array('activity_group_id'=>2, 'name'=>'Remove Client', 'log_text'=>'XXX removed client YYY'),
			array('activity_group_id'=>2, 'name'=>'Update Client', 'log_text'=>'XXX updated client YYY'),
			array('activity_group_id'=>3, 'name'=>'New Note', 'log_text'=>'XXX added note for YYY'),
			array('activity_group_id'=>3, 'name'=>'Remove Note', 'log_text'=>'XXX removed note for YYY'),
			array('activity_group_id'=>3, 'name'=>'Update Note', 'log_text'=>'XXX updated note for YYY'),
			array('activity_group_id'=>4, 'name'=>'New Task', 'log_text'=>'XXX added task for YYY'),
			array('activity_group_id'=>4, 'name'=>'Remove Task', 'log_text'=>'XXX removed task for YYY'),
			array('activity_group_id'=>4, 'name'=>'Update Task', 'log_text'=>'XXX updated task for YYY'),
			array('activity_group_id'=>4, 'name'=>'Complete Task', 'log_text'=>'XXX completed task for YYY'),			
		));
	}

}
