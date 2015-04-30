<?php

class LayoutSectionFocusSeeder extends Seeder {

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
                'name'=>'Focus'
            )
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 7,
                'group_id' => 1,
                'name' => 'focus_navigation',
                'display_image' => 'focus/focus_navigation.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px"> <div style="width: 240px; display: inline-block; font-size: 15px; text-align: center"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/focus_header.png"> </div> <div style="width: 440px; display: inline-block; vertical-align: top; font-size: 12px; padding: 0 15px"> <div style="padding: 10px"> <span class="editable editable-text" contenteditable="true" style="color: #222222; font-size: 15px; font-weight: 600"> LIFESTYLE ACCESSORIES WITH A DOWN TO EARTH </span> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 7,
                'group_id' => 2,
                'name' => 'focus_banner',
                'display_image' => 'focus/focus_banner.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px; text-align: center"> <div style="display: inline-block; vertical-align: top; font-size: 12px; padding: 0 15px"> <span class="editable editable-text" contenteditable="true" style="color: #222222; font-size: 20px; font-weight: 600"> ONE BAG, 2PACK, THREE WAYS </span> </div> </div> <div class="inner-section" style="background-color: #FFFFFF; padding: 0; text-align: center"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/bag_top.jpg" style="width: 750px; height: auto"> </div> </div>')
            ),
            array(
                'layout_id' => 7,
                'group_id' => 2,
                'name' => 'focus_top_one',
                'display_image' => 'focus/focus_top_1.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="margin: 10px 0"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/top_2_left.png"> </div> <p class="editable editable-text" contenteditable="true" style="color: #222222">Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.</p> <a class="editable editable-url" contenteditable="true" style="text-align: center; font-weight: bold; background-color: #dadad2; width: 150px; padding: 8px 15px; border-radius: 5px; margin: 0 auto"> Iphone now <img src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/focus_header_0000_right.png" style="margin-left: 15px"> </a> </div> <div style="width: 310px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="margin: 10px 0"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/top_2_right.png"> </div> <p class="editable editable-text" contenteditable="true" style="color: #222222">Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.</p> <a class="editable editable-url" contenteditable="true" style="text-align: center; font-weight: bold; background-color: #dadad2; width: 150px; padding: 8px 15px; border-radius: 5px; margin: 0 auto"> Iphone now <img src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/focus_header_0000_right.png" style="margin-left: 15px"> </a> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 7,
                'group_id' => 2,
                'name' => 'focus_top_two',
                'display_image' => 'focus/focus_top_2.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 0; text-align: center"> <img class="editable editable-photo" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/bottom.png" style="width: 750px; height: auto"> </div> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px; text-align: left"> <div style="display: inline-block; vertical-align: top; font-size: 12px; padding: 0 15px"> <span class="editable editable-text" contenteditable="true" style="color: #222222; font-size: 13px; font-weight: 600"> There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage. </span><br/><br/> <a class="editable editable-url" contenteditable="true" target="_blank" style="color: #222222; font-size: 13px; font-weight: 600; padding: 15px 0">Read More</a> </div> </div> </div>')
            ),
            array(
                'layout_id' => 7,
                'group_id' => 2,
                'name' => 'focus_bottom_1',
                'display_image' => 'focus/focus_bottom_1.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 200px; display: inline-block; vertical-align: top"> <div style="margin: 10px 0"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/3_1.png"> </div> <span class="editable editable-text" contenteditable="true" style="color: #222222; font-size: 14px; font-weight: bold">SPORT IPHONE 5 CASE</span><br/> <span class="editable editable-text" contenteditable="true" style="color: #c0c0c0; font-size: 14px">HERITAGE</span> </div> <div style="width: 200px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="margin: 10px 0"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/3_2.png"> </div> <span class="editable editable-text" contenteditable="true" style="color: #222222; font-size: 14px; font-weight: bold">IPHONE FOLD WALLET</span><br/> <span class="editable editable-text" contenteditable="true" style="color: #c0c0c0; font-size: 14px">SMOKE</span> </div> <div style="width: 200px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="margin: 10px 0"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/3_3.png"> </div> <span class="editable editable-text" contenteditable="true" style="color: #222222; font-size: 14px; font-weight: bold">DRAW IPHONE CASE</span><br/> <span class="editable editable-text" contenteditable="true" style="color: #c0c0c0; font-size: 14px">STAND / HERITAGE</span> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 7,
                'group_id' => 2,
                'name' => 'focus_button',
                'display_image' => 'focus/focus_button.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 18px; text-align: center"> <a class="editable editable-url" contenteditable="true" style="text-align: center; font-weight: bold; background-color: #dadad2; width: 150px; padding: 8px 15px; border-radius: 5px; margin: 0 auto"> Iphone now <img src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/focus/focus_header_0000_right.png" style="margin-left: 15px"> </a> </div> </div>')
            ),

            array(
                'layout_id' => 7,
                'group_id' => 2,
                'name' => 'focus_footer',
                'display_image' => 'focus/focus_footer.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: Helvetica"> <div class="inner-section" style="background-color: #FFFFFF; padding: 18px"> <div style="line-height: 5px; text-align: center; font-weight: bold"> <a target="_blank" class="editable editable-url" contenteditable="true" style="color: #222222; font-size: 15px">Terms</a> | <a target="_blank" class="editable editable-url" contenteditable="true" style="color: #222222; font-size: 15px">Privacy</a> | <a target="_blank" class="editable editable-url" contenteditable="true" style="color: #222222; font-size: 15px">Unsubscribe</a> </div> </div> </div>')
            ),
        ));
    }

}