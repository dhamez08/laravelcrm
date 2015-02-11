/**
 * Created by dhamez on 2/3/15.
 */
$(function(){

    var selected_element = null;

    $('#colorpicker').farbtastic(function(color){
        if(selected_element){
            selected_element.css('color', color);
            console.log(color);
        }
    });



    $('.section-element img').draggable({
        revert: true,
        revertDuration: 0,
        appendTo: 'body'
    });

    $('.section-container').sortable();

    $('#template-canvas').droppable({
        accept: '.section-element img',
        drop: function(event, ui){
            var section = ui.draggable.data('section');
            if(section == 'header'){
                generate_html_header($(this));
            } else if(section == 'content-1'){
                generate_html_content_1($(this));
            } else if(section == 'content-2'){
                generate_html_content_2($(this));
            }
        }
    })

    $('body').on('mouseover','.section-container',function(){
        $(this).find('.close-button-container').fadeIn();

        $(this).closest('.section-container').on('mouseleave',function(){
            $('.close-button-container').fadeOut();
        })
    });

    $('body').on('click','.remove-section',function(){
        $(this).closest('.section-container').remove();
    });

    $('body').on('click','.editable',function(event){
        event.stopPropagation();

        selected_element = $(this);

        $('#sections').collapse('hide');
        $('#tool-box').collapse('show');

        if(selected_element.hasClass('editable-text')){
            var text_size = selected_element.css('font-size').split('px').join('');
            var text_color = selected_element.css('color');

            $('#font-size-slider').val(text_size);

        } else if(selected_element.hasClass('editable-photo')){
            var options = new Object();
            var body = $('body');

            var visibility_icon = $('<i>').addClass('fa popover-icon hide-image');
            parseInt(selected_element.css('opacity')) ? visibility_icon.addClass('fa-eye-slash') : visibility_icon.addClass('fa-eye');

            var url_input = $('<div>').addClass('url-input')
                .append($('<input>')
                    .addClass('url')
                    .attr('type','text')
                    .attr('placeholder','Your url')
                );

            var tooltip = $('<div>').addClass('image-options')
                .append('Change photo ')
                .append($('<i>')
                    .addClass('fa fa-chain change-url popover-icon'))
                .append(visibility_icon);

            options.html = true;
            options.placement = 'bottom';
            options.container = 'body';
            options.content = $('<div>')
                .append(tooltip)
                .append(url_input);

            selected_element.popover(options);
            selected_element.popover('show');

            body.on('click','.hide-image.fa-eye-slash',function(){
                selected_element.css('opacity',0);
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            });

            body.on('click','.hide-image.fa-eye',function(){
                selected_element.css('opacity',1);
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            });

            body.on('click','.change-url.fa-chain',function(){
                $('.url-input').show();
                $('.image-options').hide();
            });
        }
    });

    $('#font-size-slider').on('change',function(){
        if(selected_element){
            var font_size = $(this).val();
            selected_element.css('font-size',font_size+'px');
        }
    });

    $('body').on('click', function (e) {
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) {
            if(selected_element && selected_element.popover()){
                selected_element.popover('destroy');
            }
        }
    });

    $('#template-canvas').sortable({cancel:'.editable'});


    function generate_html_header(container){
        header_html = '<table align="center" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-bottom:2px solid #bdc3c7;" class="last-table">' +
            '<tbody>' +
                '<tr>' +
                    '<td align="center" bgcolor="#66809b" background="http://www.stampready.net/dashboard/zip_uploads/o9H4JQxK1etzXm3iCunfvVq7/Koble_container/images/header-bg.jpg" valign="top" style="background-size:cover; background-position:bottom;" data-bg="Header">' +
                        '<table align="center" cellspacing="0" cellpadding="0" border="0" background="http://www.stampready.net/dashboard/zip_uploads/o9H4JQxK1etzXm3iCunfvVq7/Koble_container/images/header-fade.png" width="600" style=" background-repeat:repeat;" class="table600 last-table">' +
                           ' <tbody>' +
                                '<tr>' +
                                    '<td align="center">' +
                                        '<table align="center" cellspacing="0" cellpadding="0" border="0" width="550" class="table-inner last-table">' +
                                            '<tbody>' +
                                                '<tr>' +
                                                    '<td height="90"></td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td align="center" style="font-family: \'Open Sans\', Arial, sans-serif; font-size:16px; color:#FFFFFF; letter-spacing:4px;" data-max="25" data-min="13" data-size="Header Title" data-color="Header Title" mc:edit="header title" data-link-color="Slogan Link" data-link-style="text-decoration:none; color:#ff646a;">THE</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td height="20"></td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td align="center" style="line-height: 0px;">' +
                                                        '<img width="260" height="44" alt="logo" src="http://www.stampready.net/dashboard/zip_uploads/o9H4JQxK1etzXm3iCunfvVq7/Koble_container/images/logo.png" style="display:block; line-height:0px; font-size:0px; border:0px;" mc:edit="header logo" class="editable editable-photo">' +
                                                        '</td>' +
                                                    '</tr>' +
                                                    '<tr>' +
                                                        '<td height="30"></td>' +
                                                    '</tr>' +
                                                    '<tr>' +
                                                        '<td align="center">' +
                                                            '<table align="center" cellspacing="0" cellpadding="0" border="0" width="30" class="last-table">' +
                                                                '<tbody><tr>' +
                                                                    '<td bgcolor="#ff646a" height="2" style="line-height:0px; font-size:0px;" data-bgcolor="Main Color"></td>' +
                                                                '</tr>' +
                                                                '</tbody>' +
                                                            '</table>' +
                                                        '</td>' +
                                                    '</tr>' +
                                                    '<tr>' +
                                                        '<td height="20"></td>' +
                                                    '</tr>' +
                                                    '<tr>' +
                                                        '<td contenteditable class="editable editable-text" align="center" style="font-family: \'Open Sans\', Arial, sans-serif; font-size:14px; color:#ffffff; line-height:26px; text-transform:uppercase; letter-spacing:4px;" data-max="25" data-min="13" data-size="Header Content" data-color="Header Content" mc:edit="header content" data-link-color="Slogan Link" data-link-style="text-decoration:none; color:#ff646a;">Powered by a Community of Millions.</td>' +
                                                    '</tr>' +
                                                    '<tr>' +
                                                        '<td height="75"></td>' +
                                                    '</tr>' +
                                                '</tbody>' +
                                            '</table>' +
                                        '</td>' +
                                    '</tr>' +
                                '</tbody>' +
                            '</table>' +
                        '</td>' +

                '</tbody>' +
            '</table>';

        var section = $('<div>').addClass('section-container');
        var close_button = $('<div>').addClass('close-button-container').append($('<i>').addClass('fa fa-times remove-section'));
        close_button.hide();
        section.append(header_html).append(close_button);
        section.hide().appendTo(container).fadeIn();


    }

    function generate_html_content_1(container){
        contenet_1_html = '<table align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#f2f3f4" width="100%" data-bgcolor="Main Background" data-module="1/1 feature" mc:variant="1/1 Feature" mc:hideable="" mc:repeatable="layout" data-thumb="http://www.stampready.net/dashboard/zip_uploads/o9H4JQxK1etzXm3iCunfvVq7/Koble_container/thumbnails/1-1 feature.jpg" class="">' +
            '<tbody>' +
               ' <tr>' +
                    '<td align="center">' +
                        '<table align="center" cellspacing="0" cellpadding="0" border="0" width="100%" class="last-table">' +
                            '<tbody>' +
                                '<tr>' +
                                   ' <td align="center">' +
                                        '<table align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="600" class="table600 last-table">' +
                                            '<tbody>' +
                                                '<tr>' +
                                                    '<td height="50"></td>' +
                                                '</tr>' +
                                            '</tbody>' +
                                        '</table>' +
                                    '</td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td bgcolor="#ff646a" data-bgcolor="Main Color">' +
                                        '<table align="center" cellspacing="0" cellpadding="0" border="0" width="600" class="table600 last-table">' +
                                            '<tbody><tr>' +
                                                '<td height="50"></td>' +
                                            '</tr>' +
                                                '<tr>' +
                                                    '<td style="font-family: \'Open Sans\', Arial, sans-serif; font-size:24px; color:#ffffff; line-height:26px; font-weight: bold;" data-max="30" data-min="12" data-size="CTA Title" data-color="CTA Title" mc:edit="1/1 feature title" data-link-color="Feature Link" data-link-style="text-decoration:none; color:#ffdbdc;" contenteditable class="editable editable-text">Article title</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td height="15"></td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td style="font-family: \'Open Sans\', Arial, sans-serif; font-size:13px; color:#ffffff; line-height:26px;" data-max="30" data-min="12" data-size="CTA Content" data-color="CTA Content" mc:edit="1/1 feature content" data-link-color="Feature Link" data-link-style="text-decoration:none; color:#ffdbdc;" contenteditable class="editable editable-text">									Envato is an ecosystem of sites to help you get creative. From our world-leading digital marketplaces where you can buy images, templates, project files.									</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td height="20"></td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td>' +
                                                        '<table align="left" cellspacing="0" cellpadding="0" border="0" style="border:2px solid #ffffff;" data-max="30" data-min="12" data-size="CTA Link" data-color="CTA Link" data-border-color="Button Border" class="last-table">' +
                                                           ' <tbody>' +
                                                                '<tr>' +
                                                                    '<td align="center" height="35" style="font-family: \'Open Sans\', Arial, sans-serif; font-size:13px; color:#ffffff; line-height:26px;padding-left: 20px;padding-right: 20px;" data-max="25" data-min="12" data-size="Feature Content" data-color="Feature Content" mc:edit="1/1 feature button">' +
                                                                        '<a data-color="Button Link" style="color:#FFFFFF;text-decoration:none;" href="#">Create your free account now!</a>' +
                                                                    '</td>' +
                                                                '</tr>' +
                                                            '</tbody>' +
                                                       ' </table>' +
                                                    '</td>' +
                                                '</tr>' +
                                                '<tr>' +
                                                    '<td height="50"></td>' +
                                                '</tr>' +
                                            '</tbody>' +
                                       ' </table>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                        '</table>' +
                    '</td>' +
               ' </tr>' +
            '</tbody>' +
       ' </table>';

        var section = $('<div>').addClass('section-container');
        var close_button = $('<div>').addClass('close-button-container').append($('<i>').addClass('fa fa-times remove-section'));
        close_button.hide();
        section.append(contenet_1_html).append(close_button);
        section.hide().appendTo(container).fadeIn();
    }

    function generate_html_content_2(container){
        var content_2_html = '<table align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#f2f3f4" width="100%" data-bgcolor="Main Background" data-module="1/1 content box" mc:variant="1/1 Content Box" mc:hideable="" mc:repeatable="layout" data-thumb="http://www.stampready.net/dashboard/zip_uploads/o9H4JQxK1etzXm3iCunfvVq7/Koble_container/thumbnails/1-1 content box.jpg" class="currentTable">' +
            '<tbody>' +
                '<tr>' +
                    '<td align="center">' +
                        '<table align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF" width="600" style="margin-left:20px; margin-right:20px;" class="table600 last-table">' +
                            '<tbody>' +
                                '<tr>' +
                                    '<td height="50"></td>' +
                                '</tr>' +
                                '<tr>' +
                                    '<td align="center">' +
                                        '<table align="center" cellspacing="0" cellpadding="0" border="0" width="550" class="table-inner last-table" style="border:1px solid #e2e2e2;" data-border-color="Box Border">' +
                                            '<tbody>' +
                                                '<tr align="center">' +
                                                   ' <td>' +
                                                        '<table align="center" cellspacing="0" cellpadding="0" border="0" width="500" class="table-inner last-table">' +
                                                            '<tbody>' +
                                                                '<tr>' +
                                                                    '<td height="25"></td>' +
                                                                '</tr>' +
                                                                '<tr>' +
                                                                    '<td align="left">' +
                                                                        '<table align="left" cellspacing="0" cellpadding="0" border="0" width="30" class="last-table">' +
                                                                            '<tbody>' +
                                                                                '<tr>' +
                                                                                    '<td bgcolor="#ff646a" height="3" style="line-height:0px; font-size:0px;" data-bgcolor="Main Color"></td>' +
                                                                                '</tr>' +
                                                                            '</tbody>' +
                                                                        '</table>' +
                                                                   ' </td>' +
                                                                '</tr>' +
                                                                '<tr>' +
                                                                    '<td height="15"></td>' +
                                                                '</tr>' +
                                                                '<tr align="left">' +
                                                                    '<td style="font-family: \'Open Sans\', Arial, sans-serif; font-size:18px; color:#3b3b3b; line-height:30px; font-weight: bold;" data-max="25" data-min="12" data-size="Title" data-color="Title" mc:edit="1/1 content box title" data-link-color="Content Link" data-link-style="text-decoration:none; color:#ff646a;" contenteditable class="editable editable-text">Article title</td>' +
                                                                '</tr>' +
                                                                '<tr>'+
                                                                    '<td height="10"></td>' +
                                                                '</tr>' +
                                                                '<tr>' +
                                                                    '<td style="font-family: \'Open Sans\', Arial, sans-serif; font-size:13px; color:#7f8c8d; line-height:26px;" data-max="25" data-min="12" data-size="Main Text" data-color="Main Text" mc:edit="1/1 content box content" data-link-color="Content Link" data-link-style="text-decoration:none; color:#ff646a;" contenteditable class="editable editable-text">													Designers, developers and creatives from all over the globe are responsible for the work you see across Envato’s ecosystem.												</td>' +
                                                                '</tr>' +
                                                                '<tr>' +
                                                                    '<td height="25"></td>' +
                                                                '</tr>' +
                                                            '</tbody>' +
                                                        '</table>' +
                                                   ' </td>' +
                                                '</tr>' +
                                            '</tbody>' +
                                        '</table>' +
                                    '</td>' +
                                '</tr>' +
                            '</tbody>' +
                        '</table>' +
                    '</td>' +
                '</tr>' +
            '</tbody>' +
        '</table>';


        var section = $('<div>').addClass('section-container');
        var close_button = $('<div>').addClass('close-button-container').append($('<i>').addClass('fa fa-times remove-section'));
        close_button.hide();
        section.append(content_2_html).append(close_button);
        section.hide().appendTo(container).fadeIn();
    }
});