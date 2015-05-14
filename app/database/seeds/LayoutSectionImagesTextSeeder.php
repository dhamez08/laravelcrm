<?php

class LayoutSectionImagesTextSeeder extends Seeder {

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
                'name'=>'Images and Text',
                'is_generic' => true
            )
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 9,
                'group_id' => 6,
                'name' => 'text_image_1',
                'display_image' => 'images_text/text_left.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 300px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px" class="editable editable-text" contenteditable="true"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div> </div> <div style="width: 310px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="display: inline-block"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_text/text-images/image-placeholder-wide.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 9,
                'group_id' => 6,
                'name' => 'text_image_2',
                'display_image' => 'images_text/text_right.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 310px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="display: inline-block"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_text/text-images/image-placeholder-wide.jpg"/> </div> </div> <div style="width: 300px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px" class="editable editable-text" contenteditable="true"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 9,
                'group_id' => 6,
                'name' => 'text_image_3',
                'display_image' => 'images_text/text_left_equal.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 300px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris diam nibh, viverra non augue et, congue consequat ante. Nulla vehicula ullamcorper turpis sed sodales. Donec nec tempus arcu. Sed augue risus, scelerisque eu tortor a, sollicitudin tempus orci. Cras sit amet mauris odio. Duis sed orci sodales, faucibus nulla quis, facilisis massa. Mauris tristique, ante quis imperdiet dignissim, est metus gravida leo, in cursus odio elit eu nisl. Donec eget lorem nec arcu lacinia aliquet. Nunc lectus tellus, porta quis mi in, varius tincidunt lectus. Ut tellus tellus, efficitur in mollis ut, imperdiet sed nisl. Praesent eget ipsum id odio euismod tempor vel in dolor. </div> </div> <div style="width: 310px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="display: inline-block"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_text/text-images/image-placeholder-equal.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 9,
                'group_id' => 6,
                'name' => 'text_image_4',
                'display_image' => 'images_text/text_right_equal.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 310px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="display: inline-block"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_text/text-images/image-placeholder-equal.jpg"/> </div> </div> <div style="width: 300px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris diam nibh, viverra non augue et, congue consequat ante. Nulla vehicula ullamcorper turpis sed sodales. Donec nec tempus arcu. Sed augue risus, scelerisque eu tortor a, sollicitudin tempus orci. Cras sit amet mauris odio. Duis sed orci sodales, faucibus nulla quis, facilisis massa. Mauris tristique, ante quis imperdiet dignissim, est metus gravida leo, in cursus odio elit eu nisl. Donec eget lorem nec arcu lacinia aliquet. Nunc lectus tellus, porta quis mi in, varius tincidunt lectus. Ut tellus tellus, efficitur in mollis ut, imperdiet sed nisl. Praesent eget ipsum id odio euismod tempor vel in dolor. </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 9,
                'group_id' => 6,
                'name' => 'text_image_5',
                'display_image' => 'images_text/text_left_tall.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 410px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sollicitudin volutpat libero, vitae mollis nibh sagittis non. Sed non volutpat ex. Nulla facilisi. Maecenas condimentum nisl ante, quis molestie mi convallis at. Aenean eget tincidunt turpis. Aenean sit amet rutrum sapien. Phasellus gravida vitae eros luctus sodales. Praesent euismod lorem quis ligula bibendum viverra. Phasellus elit tortor, tincidunt a pretium vitae, hendrerit sit amet libero. Vivamus lacinia gravida purus quis molestie. Mauris fermentum lectus eu turpis hendrerit mattis fermentum tristique risus. <br/><br/> Suspendisse potenti. Aenean vel accumsan orci. Cras blandit posuere lectus commodo consectetur. In gravida sem auctor risus feugiat semper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque placerat odio et lorem laoreet maximus. Sed vitae viverra neque, eu pellentesque est. Aliquam tempor dapibus lacus vel consequat. </div> </div> <div style="width: 200px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="display: inline-block"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_text/text-images/image-placeholder-tall.jpg"/> </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 9,
                'group_id' => 6,
                'name' => 'text_image_6',
                'display_image' => 'images_text/text_right_tall.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 200px; display: inline-block; margin-left: 5px; vertical-align: top"> <div style="display: inline-block"> <img class="editable editable-photo scaled-image" src="http://zeromyexcess.co.uk/laravelcrm/public/img/template_builder/images_text/text-images/image-placeholder-tall.jpg"/> </div> </div> <div style="width: 410px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sollicitudin volutpat libero, vitae mollis nibh sagittis non. Sed non volutpat ex. Nulla facilisi. Maecenas condimentum nisl ante, quis molestie mi convallis at. Aenean eget tincidunt turpis. Aenean sit amet rutrum sapien. Phasellus gravida vitae eros luctus sodales. Praesent euismod lorem quis ligula bibendum viverra. Phasellus elit tortor, tincidunt a pretium vitae, hendrerit sit amet libero. Vivamus lacinia gravida purus quis molestie. Mauris fermentum lectus eu turpis hendrerit mattis fermentum tristique risus. <br/><br/> Suspendisse potenti. Aenean vel accumsan orci. Cras blandit posuere lectus commodo consectetur. In gravida sem auctor risus feugiat semper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque placerat odio et lorem laoreet maximus. Sed vitae viverra neque, eu pellentesque est. Aliquam tempor dapibus lacus vel consequat. </div> </div> </div> </div> </div>')
            ),
        ));
    }

}