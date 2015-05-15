<?php

class LayoutSectionLogoHeaderSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('system_email_layout')->insert(array(
            array(
                'name'=>'Logo Headers',
                'is_generic' => true
            )
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 12,
                'group_id' => 6,
                'name' => 'small_square',
                'display_image' => 'headers/small_square.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="margin: 0 auto; width: 750px; font-family: Helvetica; font-weight: bold"> <div class="inner-section" style="padding: 15px; padding-bottom: 30px"> <div style="width: 200px; display: inline-block; padding-top: 10px; font-size: 15px; text-align: center"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/headers/logo-headers/logo_small.jpg"> </div> <div style="width: 500px; display: inline-block; padding-top: 10px; vertical-align: top; font-size: 14px; padding-top: 20px; vertical-align: bottom; color: #677B7C; text-align: right"> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Home Page</a> </div> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Contact Us</a> </div> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Inquire</a> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 12,
                'group_id' => 6,
                'name' => 'big_square',
                'display_image' => 'headers/big_square.png',
                'source_code' => htmlentities('<div class="section-area" style="background: #FFFFFF; margin: 0 auto; width: 750px; font-family: Helvetica; font-weight: bold"> <div class="inner-section" style="padding: 15px; padding-bottom: 30px; position: relative"> <div class="overlay-position" style="width: 200px; display: inline-block; font-size: 15px; text-align: center; position: absolute; left: 20px; top: 5px"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/headers/logo-headers/logo_medium.jpg"> </div> <div class="editable-box" style="background-color: #ACACAC; width: 700px; display: inline-block; vertical-align: top; font-size: 14px; padding-top: 10px; color: rgb(103, 123, 124); text-align: right; padding-bottom: 10px; margin-top: 20px;"> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Home Page</a> </div> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Contact Us</a> </div> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Inquire</a> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 12,
                'group_id' => 6,
                'name' => 'big_circle',
                'display_image' => 'headers/big_circle.png',
                'source_code' => htmlentities('<div class="section-area" style="background: #FFFFFF; margin: 0 auto; width: 750px; font-family: Helvetica; font-weight: bold"> <div class="inner-section" style="padding: 15px; padding-bottom: 30px; position: relative"> <div class="overlay-position" style="width: 200px; display: inline-block; font-size: 15px; text-align: center; position: absolute; left: 20px; top: 5px"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/headers/logo-headers/logo_medium.jpg" style="border-radius: 70px !important"> </div> <div class="editable-box" style="background-color: #ACACAC; width: 700px; display: inline-block; vertical-align: top; font-size: 14px; padding-top: 10px; color: rgb(103, 123, 124); text-align: right; padding-bottom: 10px; margin-top: 20px;"> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Home Page</a> </div> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Contact Us</a> </div> <div style="padding: 20px; display: inline-block"> <a class="editable editable-url" data-color="HeaderLogoLink" target="_blank" contenteditable="true">Inquire</a> </div> </div> </div> </div>')
            ),
        ));
    }

}