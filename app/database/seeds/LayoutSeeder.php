<?php

class LayoutSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        DB::table('system_email_layout')->insert(array(
            array('name'=>'Grit'),
            array('name'=>'Gemicon')
        ));
    }

}
