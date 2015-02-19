/**
 * Created by dhamez on 2/3/15.
 */
$(function(){


    var color_element = null;
    var selected_element = null;

    $('#colorpicker').farbtastic(function(color){
        if(selected_element && color_element){
            selected_element.css(color_element, color);
            if(color_element == 'color'){
                $('#font-color').val(color.toUpperCase());
            } else if(color_element == 'background-color'){
                $('#background-color').val(color.toUpperCase());
            }
        }
    });

    $('.section-container').sortable();

    $('#template-canvas').droppable({
        accept: '.section-element img',
        drop: function(event, ui){
            var section = ui.draggable.data('section');

            var html = ui.draggable.data('html');

            var section = $('<div>').addClass('section-container');
            var close_button = $('<div>').addClass('close-button-container').append($('<i>').addClass('fa fa-times remove-section'));
            close_button.hide();
            section.append(html).append(close_button);
            section.hide().appendTo($(this)).fadeIn();
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

    $('body').on('focus','#font-color, #background-color',function(){
        $('.colorpicker-container').removeClass('hide');
        var id = $(this).attr('id');
        if(id == 'font-color'){
            color_element = 'color';
        } else if(id == 'background-color'){
            color_element = 'background-color';
        }
    });


    $('body').on('change','#font-color, #background-color',function(){
        var id = $(this).attr('id');
        if(id == 'font-color'){
            selected_element.css('color', $(this).val());
        } else if(id == 'background-color'){
            selected_element.css('background-color', $(this).val());
        }
    });

    $('body').on('blur','#font-color, #background-color',function(){
        $('.colorpicker-container').addClass('hide');
    });

    $('body').on('click','.editable',function(event){
        event.stopPropagation();

        selected_element = $(this);

        if(selected_element.hasClass('editable-text')){

            $('#layouts').collapse('hide');
            $('#tool-box').collapse('show');

            var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

            function rgb2hex(rgb) {
                rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
                return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
            }

            function hex(x) {
                return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
            }

            var text_size = selected_element.css('font-size').split('px').join('');
            var text_color = selected_element.css('color');
            var background_color = selected_element.css('background-color');

            if(background_color != "transparent")
                background_color = rgb2hex(background_color);

            if(text_color != "transparent")
                text_color = rgb2hex(text_color);


            $('#font-color').val(text_color.toUpperCase());
            $('#background-color').val(background_color.toUpperCase());

            $('#font-size-slider').val(text_size);

        } else if(selected_element.hasClass('editable-photo')){
            var options = new Object();
            var body = $('body');

            var visibility_icon = $('<i>').addClass('fa popover-icon hide-image');
            parseInt(selected_element.css('opacity')) ? visibility_icon.addClass('fa-eye-slash') : visibility_icon.addClass('fa-eye');

            var url_input = $('<div>')
                .addClass('url-input')
                .append($('<input>')
                    .attr('id','image-url')
                    .addClass('url')
                    .attr('type','text')
                    .attr('placeholder','Your url'))
                .append($('<i>')
                    .addClass('fa fa-times popover-icon close-url'));

            var tooltip = $('<div>')
                .addClass('image-options')
                .append($('<span>')
                    .addClass('change-photo').text('Change photo '))
                .append($('<form>').attr('method','post').attr('id','upload-form').css('display','none').append($('<input>')
                    .attr('name','upload-photo').attr('type','file').attr('id','upload-photo').css('display','none')))
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
//                selected_element.css('opacity',0);
                selected_element.css('display','none');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            });

            body.on('click','.hide-image.fa-eye',function(){
//                selected_element.css('opacity',1);
                selected_element.css('display','visible');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            });

            body.on('click','.change-url.fa-chain',function(){
                $('.url-input').show();
                $('.image-options').hide();
            });

            body.on('click','.close-url',function(){
                $('#image-url').val('');
                $('.url-input').hide();
                $('.image-options').show();
            });

            body.on('keypress','#image-url',function(e){
                if(e.keyCode == 13){
                    var hyperlink = $('<a>')
                        .attr('href',$(this).val())
                        .attr('target','_blank');

                    selected_element.wrap(hyperlink);
                    selected_element.popover('destroy');
                }
            });

            body.on('click','.change-photo',function(){
                $('#upload-photo').click();
            })

            body.on('change','#upload-photo',function(){
                $('#upload-form').submit();
            })

            var filesToUpload = null;

            function handleFileSelect(event)
            {
                var files = event.target.files || event.originalEvent.dataTransfer.files;
                files = new Array();
                _.each(files, function(file) {
                    filesToUpload.push(file);
                });
            }

            function handleFormSubmit(event)
            {
                event.preventDefault();

                var form = this,
                    formData = new FormData(form);

                if ($(form).data('loading') === true) {
                    return;
                }
                $(form).data('loading', true);

                if (filesToUpload) {
                    _.each(filesToUpload, function(file){
                        formData.append('cover[]', file);
                    });
                }

                $.ajax({
                    type: "POST",
                    url: 'file-upload',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response)
                    {
                        if(response.success){
                            selected_element.attr('src',response.filePath);
                        }
                    },
                    complete: function()
                    {
                        $(form).data('loading', false);
                    },
                    dataType: 'json'
                });
            }

            $('#upload-photo').on('change', handleFileSelect);
            $('#upload-form').on('submit', handleFormSubmit);
        } else if(selected_element.hasClass('editable-box')){
//            alert('box');
        } else if(selected_element.hasClass('editable-url')){
//            alert('url');
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

    $('.layout-name').on('click',function(){
        var layout_id = $(this).data('layout-id');
        $.ajax({
            url: 'ajax-layout-section-list/'+layout_id,
            type: 'get',
            dataType: 'json',
            success: function(data, status){

//                if($('#layout-'+layout_id+'-section-list').html() == ""){
                    $.each(data, function(index, value){
                        var div = $('<div>')
                            .addClass('col-md-12 section-element section-display-image')
                            .append($('<img>')
                                .attr('src',value.display_image)
                                .addClass('img-responsive')
                                .data('html',value.source_code));
                        $('#layout-'+layout_id+'-section-list').append(div);
                    });
//                }

                $('.section-element img').draggable({
                    revert: true,
                    revertDuration: 0,
                    appendTo: 'body'
                });
            }
        });
    });

});