<?php

class LayoutSectionSocialMediaSeeder extends Seeder {

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
                'name'=>'Social Media Bar',
                'is_generic' => true
            )
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 5,
                'group_id' => 6,
                'name' => 'social_media_bar',
                'display_image' => 'social_media/social_bar_1.jpg',
                'source_code' => htmlentities('<div class="section-area" style="margin: 0 auto; width: 750px; font-family: \'Arial\'"> <div class="inner-section" style="background-color: #FFFFFF; padding: 15px 30px; text-align: center"> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0000_facebook.png" style="height: 26px; width: auto; margin: 10px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0001_tumbler.png" style="height: 26px; width: auto; margin: 10px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0002_pinterest.png" style="height: 26px; width: auto; margin: 10px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0003_twitter.png" style="height: 21px; width: auto; margin: 10px; margin-top: 13px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0004_youtube.png" style="height: auto; width: 29px; margin: 5px; margin-top: 17px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0005_linkedin.png" style="height: 22px; width: auto; margin: 10px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0006_vimeo.png" style="height: 22px; width: auto; margin: 10px; margin-top: 13px"> </div> <div data-color="social_icon" style="background-color: #000000; border-radius: 50px !important; height: 45px; width: 45px; text-align: center; display: inline-block; overflow: hidden" class="editable-box parent-container"> <img class="editable editable-photo has-container" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/social_media/social_icon_0007_google.png" style="height: 26px; width: auto; margin: 10px"> </div> </div> </div>')
            ),
        ));
    }

}