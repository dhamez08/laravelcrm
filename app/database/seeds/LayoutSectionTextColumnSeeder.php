<?php

class LayoutSectionTextColumnSeeder extends Seeder {

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
                'name'=>'Text Columns',
                'is_generic' => true
            )
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 10,
                'group_id' => 6,
                'name' => 'one_column',
                'display_image' => 'text_columns/one_column.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 620px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 10,
                'group_id' => 6,
                'name' => 'two_column',
                'display_image' => 'text_columns/two_column.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div> </div> <div style="width: 310px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 10,
                'group_id' => 6,
                'name' => 'three_column',
                'display_image' => 'text_columns/three_column.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> <div style="width: 205px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> </div> </div> </div>')
            ),
            array(
                'layout_id' => 10,
                'group_id' => 6,
                'name' => 'four_column',
                'display_image' => 'text_columns/four_column.png',
                'source_code' => htmlentities('<div class="section-area editable-box" style="background-color: #FFFFFF; margin: 0 auto; width: 750px; font-family: Arial"> <div class="inner-section" style="padding: 15px 60px"> <div style="margin: 0 auto; width: 635px"> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> <div style="width: 152px; display: inline-block; vertical-align: top"> <div style="font-size: 12px; padding: 0 10px; text-align: justify" data-color="TextColumn" class="editable editable-text" contenteditable="true"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lectus in odio tincidunt pellentesque. Etiam massa risus, placerat non luctus sit amet, efficitur ac nisi. Cras hendrerit sem consequat. </div> </div> </div> </div> </div>')
            ),
        ));
    }

}