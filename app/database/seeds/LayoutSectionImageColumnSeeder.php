<?php

class LayoutSectionImageColumnSeeder extends Seeder {

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
                'name'=>'Image Columns',
                'is_generic' => true
            )
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'one_column_small',
                'display_image' => 'images_column/1_column_small.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 620px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/1_column_small.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'one_column_medium',
                'display_image' => 'images_column/1_column_medium.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 620px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/1_column_medium.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'one_column_tall',
                'display_image' => 'images_column/1_column_tall.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 620px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/1_column_tall.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'one_column_xtall',
                'display_image' => 'images_column/1_column_xtall.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 620px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/1_column_xtall.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'two_column_small',
                'display_image' => 'images_column/2_column_small.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/2_column_small.jpg" style="width: 290px; height: auto"/> </div> </div> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/2_column_small.jpg" style="width: 290px; height: auto"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'two_column_medium',
                'display_image' => 'images_column/2_column_medium.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/2_column_medium.jpg" style="width: 290px; height: auto"/> </div> </div> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/2_column_medium.jpg" style="width: 290px; height: auto"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'three_column_small',
                'display_image' => 'images_column/3_column_small.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_small.jpg" style="width: 185px; height: auto"/> </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_small.jpg" style="width: 185px; height: auto"/> </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_small.jpg" style="width: 185px; height: auto"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'three_column_medium',
                'display_image' => 'images_column/3_column_medium.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_medium.jpg" style="width: 185px; height: auto"/> </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_medium.jpg" style="width: 185px; height: auto"/> </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_medium.jpg" style="width: 185px; height: auto"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'three_column_tall',
                'display_image' => 'images_column/3_column_tall.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_tall.jpg" style="width: 185px; height: auto"/> </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_tall.jpg" style="width: 185px; height: auto"/> </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/3_column_tall.jpg" style="width: 185px; height: auto"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'four_column_small',
                'display_image' => 'images_column/4_column_small.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_small.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_small.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_small.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_small.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'four_column_medium',
                'display_image' => 'images_column/4_column_medium.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_medium.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_medium.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_medium.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_medium.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 11,
                'group_id' => 6,
                'name' => 'four_column_tall',
                'display_image' => 'images_column/4_column_tall.png',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_tall.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_tall.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_tall.jpg"/> </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="padding: 0 10px; text-align: justify"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_column/image-holders/4_column_tall.jpg"/> </div> </div> </div> </div> </div>')
            ),
        ));
    }

}