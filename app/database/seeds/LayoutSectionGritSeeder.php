<?php

class LayoutSectionGritSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('system_email_layout')->insert(array(
            array('name'=>'Grit')
        ));
        DB::table('system_layout_section')->insert(array(
            array(
                'layout_id' => 1,
                'group_id' => 1,
                'name' => 'navigation',
                'display_image' => 'grit/navigation.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/navigation.jpg" data-module="navigation" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF" data-bgcolor="Header"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td height="48"></td></tr><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="285" class="scale"><tbody><tr><td class="scale-center-bottom"><img border="0" class="reset editable editable-photo" style="display: block;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/logo.jpg"></td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="285" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #2f2f36; font-weight: bold; text-align: right; line-height: 24px;"><tbody><tr><td contenteditable="true" class="scale-center-both" data-max="24" data-size="Menu Links" data-color="Menu Links"><a style="text-decoration: none; color: #2f2f36;" href="" class="editable editable-url">Awards</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="text-decoration: none; color: #2f2f36;" href="" class="editable editable-url">Press</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="text-decoration: none; color: #2f2f36;" href="" class="editable editable-url">Media</a></td></tr></tbody></table></td></tr><tr><td height="48"></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 2,
                'name' => 'header',
                'display_image' => 'grit/header.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/header.jpg" data-module="header" class=""><tbody><tr><td bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td class="editable-box" data-bg="Header repeat" style="background-repeat: repeat no-repeat;"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td height="30"></td></tr><tr><td class="scale-center"><img border="0" class="editable editable-photo reset2" style="display: block;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/header.jpg"></td></tr></tbody></table><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td align="center" contenteditable class="editable editable-text scale-center-both" data-max="32" data-min="18" data-size="Headlines Big" data-color="Headlines Big" style="padding: 60px 0px 18px 0px; font-size: 20px; line-height: 24px; font-weight: bold; color: #2f2f36;">We think with &nbsp;<img border="0" class="reset editable editable-photo" style="display: block-inline; background-color: #f17366;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/cloud_icon.png">&nbsp; in mind.</td></tr><tr><td contenteditable align="center" class="editable editable-text scale-center-both" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Integer posuere erat a ante venenatis dapibus.</td></tr></tbody></table></td></tr><tr><td class="editable-box" height="60"></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/2columns.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/2columns.jpg" data-module="2 columns" class=""><tbody><tr><td bgcolor="#FFFFFF" contenteditable="false" class="editable-box"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="285" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td class="scale-center-both"><img border="0" class="reset editable editable-photo" style="display: block;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/image_1.jpg"></td></tr><tr><td contenteditable="true" class="scale-center-both editable editable-text" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 30px 0px 12px 0px; font-size: 16px; line-height: 24px; font-weight: bold; color: #2f2f36;">Grid Column One.</td></tr><tr><td contenteditable="true" class="scale-center-both-bottom editable editable-text" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 10px 0px 0px; line-height: 24px;">Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. <a data-max="24" data-size="Links" data-color="Links" style="text-decoration: none; color: rgb(137, 22, 16); font-weight: bold;" href="" class="editable editable-url">Pellentesque</a> ornare sem lacinia quam venenatis vestibulum.</td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="285" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td align="right" class="scale-center-both-top"><img border="0" class="editable editable-photo reset image_target" style="display: block;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/image_2.jpg"></td></tr><tr><td contenteditable="true" class="scale-center-both editable editable-text" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 30px 0px 12px 10px; font-size: 16px; line-height: 24px; font-weight: bold; color: #2f2f36;">Grid Column Two.</td></tr><tr><td contenteditable="true" class="scale-center-both editable editable-text" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 10px; line-height: 24px;">Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. <a data-max="24" data-size="Links" data-color="Links" style="text-decoration: none; color: rgb(137, 22, 16); font-weight: bold;" href="" class="editable editable-url">Pellentesque</a> ornare sem lacinia quam venenatis vestibulum.</td></tr><tr><td height="60"><br type="_moz"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/3columns.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/3columns.jpg" data-module="3 columns" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="171" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td class="scale-center-both"><img border="0" class="editable editable-photo reset" style="display: block; border-radius: 3px;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/small_image_1.jpg"></td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 30px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Your Tasks Managed.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;"><a style="text-decoration: none; color: #f17366; font-weight: bold;" href="" class="editable editable-url">Pellentesque</a> ornare sem lacinia quam venenatis vestibulum.</td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="386" class="scale"><tbody><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="171" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td class="scale-center-both-top"><img border="0" class="editable editable-photo reset" style="display: block; border-radius: 3px;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/small_image_2.jpg"></td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 30px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Swipe To Delete.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Donec ullamcorper <a style="text-decoration: none; color: #f17366; font-weight: bold;" href="" class="editable editable-url">nulla</a> non metus auctor fringilla.</td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="171" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td class="scale-center-both-top"><img border="0" class="editable editable-photo reset" style="display: block; border-radius: 3px;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/small_image_3.jpg"></td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 30px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Swipe Down To Add.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Pellentesque ornare sem lacinia quam <a style="text-decoration: none; color: #f17366; font-weight: bold;" href="" class="editable editable-url">venenatis</a> vestibulum.</td></tr></tbody></table></td></tr><tr><td height="60"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/text_right.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/text_right.jpg" data-module="image left big" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="285" class="scale"><tbody><tr><td class="scale-center-both"><img border="0" class="editable editable-photo reset" style="display: block;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/image_3.jpg"></td></tr><tr><td height="60" class="h30"></td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="285" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 0px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Grid Column One.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom60" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Nulla vitae elit libero, a pharetra augue. Nullam quis justo sit amet urna mollis ornare vel eu leo. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/text_left.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/text_left.jpg" data-module="image right big" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td><table align="right" cellspacing="0" cellpadding="0" border="0" width="285" class="scale"><tbody><tr><td class="scale-center-both"><img border="0" class="editable editable-photo reset" style="display: block; border-radius: 3px;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/image_4.jpg"></td></tr><tr><td height="60" class="h30"></td></tr></tbody></table><table align="left" cellspacing="0" cellpadding="0" border="0" width="285" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 0px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Grid Column Two.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom60" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam <a class="colorResult editable editable-url" style="text-decoration: none; color: #f17366; font-weight: bold;" href="">venenatis</a> vestibulum.</td></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/image_left.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/image_left.jpg" data-module="image left" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="175" class="scale"><tbody><tr><td class="scale-center-both"><img border="0" class="editable editable-photo reset" style="display: block;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/small_image_4.jpg"></td></tr><tr><td height="60" class="h30"></td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="395" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 0px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Grid Column Three.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom60" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. Pellentesque ornare sem lacinia quam <a style="text-decoration: none; color: #f17366; font-weight: bold;" href="" class="editable editable-url">venenatis</a> vestibulum.</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/image_right.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/image_right.jpg" data-module="image right" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td><table align="right" cellspacing="0" cellpadding="0" border="0" width="175" class="scale"><tbody><tr><td class="scale-center-both"><img border="0" class="editable editable-photo reset" style="display: block; border-radius: 3px;" src="http://www.stampready.net/dashboard/zip_uploads/sQWOxqMG7vSNgCd6jXA8ePcy/grit/images/small_image_5.jpg"></td></tr><tr><td height="60" class="h30"></td></tr></tbody></table><table align="left" cellspacing="0" cellpadding="0" border="0" width="395" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-min="14" data-size="Headlines" data-color="Headlines" style="padding: 0px 0px 12px; font-size: 19px; line-height: 34.2px; font-weight: bold; color: rgb(47, 47, 54);">Grid Column Four.</td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom60" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Donec ullamcorper nulla non metus auctor fringilla. Aenean eu leo quam. <a style="text-decoration: none; color: #f17366; font-weight: bold;" href="" class="editable editable-url">Pellentesque</a> ornare sem lacinia quam venenatis vestibulum.</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/last_words.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/last_words.jpg" data-module="last words" class=""><tbody><tr><td class="editable-box" bgcolor="#FFFFFF"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td style="border-top: 1px solid #aab0bd;"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #696a78;"><tbody><tr><td height="60"></td></tr><tr><td align="center" contenteditable="true" class="editable editable-text scale-center-both" style="padding: 0px 0px 42px 0px; font-weight: bold;"><a data-max="24" data-size="Button" data-color="Button" data-bgcolor="Button" style="font-size: 24px; line-height: 24px; text-decoration: none; color: #FFFFFF; padding: 13px 19px 11px 19px; border-radius: 3px; background-color: #2b2e3b;" href="" class="editable editable-url">05</a></td></tr><tr><td align="center" contenteditable="true" class="editable editable-text scale-center-both" data-max="32" data-min="18" data-size="Headlines Big" data-color="Headlines Big" style="padding: 0px 0px 12px 0px; font-size: 20px; line-height: 24px; font-weight: bold; color: #2f2f36;">Grid Column Five.</td></tr><tr><td align="center" contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-size="Paragraphs" data-color="Paragraphs" style="padding: 0px 0px 0px 0px; line-height: 24px;">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</td></tr><tr><td height="60"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>')
            ),
            array(
                'layout_id' => 1,
                'group_id' => 3,
                'name' => 'content',
                'display_image' => 'grit/footer.jpg',
                'source_code' => htmlentities('<table align="center" cellspacing="0" cellpadding="0" border="0" width="750" data-thumb="http://www.stampready.net/dashboard/templates/grit/thumbnails/footer.jpg" data-module="footer" class=""><tbody><tr><td class="editable-box" bgcolor="#333741"><table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="scale"><tbody><tr><td height="60"></td></tr><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="386" class="scale"><tbody><tr><td><table align="left" cellspacing="0" cellpadding="0" border="0" width="171" class="scale" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #9b9b9b;"><tbody><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-size="Headlines Footer" data-color="Headlines Footer" style="padding: 4px 0px 6px 0px;"><a style="font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #FFFFFF; line-height: 24px; font-size: 16px;" href="" class="editable editable-url">Account Info</a></td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-bottom" data-max="24" data-size="Footer Links" data-color="Footer Links" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">Login</a><br><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">Register</a><br><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">sr_unsubscribe</a></td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="171" class="scale" style="font-family:\'Proxima N W15 Thin Reg\', Helvetica, Arial, sans-serif; font-size: 12px; color: #9b9b9b;"><tbody><tr><td contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-size="Headlines Footer" data-color="Headlines Footer" style="padding: 4px 0px 6px 0px;"><a style="font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #FFFFFF; line-height: 24px; font-size: 16px;" href="" class="editable editable-url">Our Products</a></td></tr><tr><td contenteditable="true" class="editable editable-text scale-center-both-bottom" data-max="24" data-size="Footer Links" data-color="Footer Links" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">StampReady</a><br><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">ThemeForest</a></td></tr></tbody></table></td></tr></tbody></table><table align="right" cellspacing="0" cellpadding="0" border="0" width="171" class="scale"><tbody><tr><td align="left" contenteditable="true" class="editable editable-text scale-center-both-top" style="padding: 0px 0px 6px 0px;"><a style="font-family: Helvetica, Arial, sans-serif; text-decoration: none; color: #FFFFFF; line-height: 24px; font-size: 16px;" href="" class="editable editable-url">Social Corner</a></td></tr><tr><td align="left" contenteditable="true" class="editable editable-text scale-center-both" data-max="24" data-size="Footer Links" data-color="Footer Links" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">Twitter</a><br><a style="text-decoration: none; color: #a4a3a3; line-height: 24px;" href="" class="editable editable-url">Facebook</a></td></tr></tbody></table></td></tr><tr><td height="60"></td></tr></tbody></table></td>	</tr></tbody></table>')
            ),
        ));
    }

}
