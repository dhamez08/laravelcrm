/**
 * Created by dhamez on 2/3/15.
 */
$(function(){


    var color_element = null;
    var selected_element = null;
    var selected_text = null;
    var jcrop_api = null;
    var is_modal_active = false;
    var image_width = 0;
    var image_height = 0;
    var apply_all = false;

    $("#apply-all").bootstrapSwitch();

    $("#apply-all").on('switchChange.bootstrapSwitch', function(event, state) {
        apply_all = state;
    });

    $('body').on('click','.popover-icon',function(){
        var selected_icon = $(this);

        if(selected_icon.hasClass('fa-align-left')){
            selected_element.css('text-align','left');
        } else if(selected_icon.hasClass('fa-align-right')){
            selected_element.css('text-align','right');
        } else if(selected_icon.hasClass('fa-align-center')){
            selected_element.css('text-align','center')
        } else if(selected_icon.hasClass('fa-align-justify')){
            selected_element.css('text-align','justify')
        } else if(selected_icon.hasClass('fa-bold')){
            rangy.restoreSelection(selected_text);
            document.execCommand('bold');
            selected_text = rangy.saveSelection();
        } else if(selected_icon.hasClass('fa-italic')){
            rangy.restoreSelection(selected_text);
            document.execCommand('italic');
            selected_text = rangy.saveSelection();
        } else if(selected_icon.hasClass('fa-link')){
            rangy.restoreSelection(selected_text);
            selected_text = rangy.saveSelection();
            $('.url-input').show();
            $('.image-options').hide();

            $('body').on('keypress','#image-url',function(e){
                if(e.keyCode == 13){
                    rangy.restoreSelection(selected_text);
                    document.execCommand('createLink',false, $(this).val());
                    selected_text = rangy.saveSelection();
                    $(this).val('');
                    $('.url-input').hide();
                    $('.image-options').show();
                }
            });


        }
    });

    $('body').on('mouseup','.editable-text',function(){
        selected_text = rangy.saveSelection();

        setTimeout(function(){
            if(rangy.getSelection().toString()){
                var options = new Object();
                var body = $('body');

                var text_tooltip = $('<div>')
                    .addClass('image-options')
                    .append($('<i>')
                        .addClass('fa fa-bold popover-icon'))
                    .append($('<i>')
                        .addClass('fa fa-italic popover-icon'))
                    .append($('<i>')
                        .addClass('fa fa-align-left popover-icon'))
                    .append($('<i>')
                        .addClass('fa fa-align-center popover-icon'))
                    .append($('<i>')
                        .addClass('fa fa-align-right popover-icon'))
                    .append($('<i>')
                        .addClass('fa fa-align-justify popover-icon'))
                    .append($('<i>')
                        .addClass('fa fa-link popover-icon'));

                var url_input = $('<div>')
                    .addClass('url-input')
                    .append($('<input>')
                        .attr('id','image-url')
                        .addClass('url')
                        .attr('type','text')
                        .attr('placeholder','Your url'))
                    .append($('<i>')
                        .addClass('fa fa-times popover-icon close-url'));

                options.html = true;
                options.placement = 'bottom';
                options.container = 'body';
                options.content = $('<div>')
                    .append(url_input)
                    .append(text_tooltip);

                selected_element.popover(options);
                selected_element.popover('show');

            }
        },300);
    });

    $('#colorpicker').farbtastic(function(color){
        if(selected_element && color_element){

            if(color_element == 'color'){
                $('#font-color').val(color);
            } else if(color_element == 'background-color'){
                $('#background-color').val(color);
            }

            if(apply_all){
                var section_group = selected_element.data('color');
                $('[data-color="'+section_group+'"]').css(color_element, color);
            } else {
                selected_element.css(color_element, color);
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
        $(this).find('.close-button-container').show('slide',{direction:'right'},200);

        $(this).closest('.section-container').on('mouseleave',function(){
            $('.close-button-container').hide('slide',{direction:'right'},200);
        })
    });

    $('body').on('click','.remove-section',function(){
        $(this).closest('.section-container').remove();
    });

    $('body').on('focus','#font-color, #background-color',function(){
        $('.colorpicker-container').removeClass('hide');
        var id = $(this).attr('id');
        var color = $(this).val();
        if(id == 'font-color'){
            color_element = 'color';

            if(apply_all){
                var section_group = selected_element.data('color');
                $('[data-color="'+section_group+'"]').css('color', $(this).val());
            } else {
                selected_element.css('color', $(this).val());
            }
        } else if(id == 'background-color'){
            color_element = 'background-color';
            selected_element.css('background-color', $(this).val());
        }
    });


    $('body').on('change','#font-color, #background-color',function(){
        var id = $(this).attr('id');
        if(id == 'font-color'){
            if(apply_all){
                var section_group = selected_element.data('color');
                $('[data-color="'+section_group+'"]').css('color', $(this).val());
            } else {
                selected_element.css('color', $(this).val());
            }
        } else if(id == 'background-color'){
            if(apply_all){
                var section_group = selected_element.data('color');
                $('[data-color="'+section_group+'"]').css('background-color', $(this).val());
            } else {
                selected_element.css('background-color', $(this).val());
            }
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

            $('.box-control').hide();
            $('.text-control').show();

//            var text_size = selected_element.css('font-size').split('px').join('');
//            var text_color = selected_element.css('color');
//            var background_color = selected_element.css('background-color');
//
//            if(background_color != "transparent")
//                background_color = rgb2hex(background_color);
//
//            if(text_color != "transparent")
//                text_color = rgb2hex(text_color);
//
//
//            $('#font-color').val(text_color);
//            $('#background-color').val(background_color);
//
//            $('#font-size-slider').val(text_size);

        }
        else if(selected_element.hasClass('editable-photo')){
            var options = new Object();
            var body = $('body');

            image_width = parseInt(selected_element.css('width').split('px').join(''));
            image_height = parseInt(selected_element.css('height').split('px').join(''));

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
                .append($('<span>').addClass('image-dimension').text(image_width+" x "+image_height))
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

            body.one('click','.hide-image.fa-eye-slash',function(){
                selected_element.css('display','none');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            });

            body.one('click','.hide-image.fa-eye',function(){
                selected_element.css('display','visible');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            });

            body.one('click','.change-url.fa-chain',function(){
                $('.url-input').show();
                $('.image-options').hide();
            });

            body.on('click','.close-url',function(){
                $('#image-url').val('');
                $('.url-input').hide();
                $('.image-options').show();
            });

            body.one('keypress','#image-url',function(e){
                if(e.keyCode == 13){
                    var hyperlink = $('<a>')
                        .attr('href',$(this).val())
                        .attr('target','_blank');

                    selected_element.wrap(hyperlink);
                    selected_element.popover('destroy');
                }
            });

            body.one('click','.change-photo',function(){
                $('#upload-photo').click();
            })

            body.one('change','#upload-photo',function(){
                readURL($(this));
                $('#image-cropper').modal('show');
                is_modal_active = true;
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

                var preview = $('#image-cropper-preview');

                formData.append('x_coord',preview.data('x-coord'));
                formData.append('y_coord',preview.data('y-coord'));
                formData.append('width',preview.data('width'));
                formData.append('height',preview.data('height'));
                formData.append('image_width',image_width);
                formData.append('image_height',image_height);

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
                            $('#cropper-loader').addClass('hide');
                            $('#close-cropper').click();
                            is_modal_active = false;
                        } else {
                            $('#cropper-loader').addClass('hide');
                            $('#close-cropper').click();
                            is_modal_active = false;
                            alert('File dimension or file size is too large. Please resize image.')
                        }
                    },
                    complete: function()
                    {
                        $(form).data('loading', false);
                    },
                    dataType: 'json'
                });
            }

            function readURL(input) {
                if (input[0].files && input[0].files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var true_width;
                        var true_height;

                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function(){
                            true_width = this.width;
                            true_height = this.height;

                            if(jcrop_api){
                                jcrop_api.destroy();
                                $('#image-cropper-preview').removeAttr('style');
                            }

                            var boundary_w = true_width < image_width ? true_width : image_width;
                            var boundary_h = true_height < image_height ? true_height : image_height;

                            $('#image-cropper-preview').Jcrop({
                                onSelect: setSelection,
                                onChange: setSelection,
                                boxWidth: 565,
                                keySupport: false,
                                trueSize: [true_width,true_height],
                                setSelect: [0,0,boundary_w,boundary_h],
                                aspectRatio: boundary_w / boundary_h
                            },function(){
                                jcrop_api = this;
                            });
                        }

                        var preview = $('#image-cropper-preview');
                        preview.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input[0].files[0]);
                }
            }

            function setSelection(coords){
                var preview = $('#image-cropper-preview');
                preview.data('x-coord', coords.x);
                preview.data('y-coord', coords.y);
                preview.data('x2-coord', coords.x2);
                preview.data('y2-coord', coords.y2);
                preview.data('height', coords.h);
                preview.data('width', coords.w);
            }

            $('#crop-image').one('click',function(){
                var preview = $('#image-cropper-preview');
                $('#upload-form').submit();
                    if(jcrop_api){
                        jcrop_api.destroy();
                        $('#cropper-loader').removeClass('hide');
                        preview.removeAttr('style');
                    }

                is_modal_active = false;
            });

            body.on('change','#upload-photo', handleFileSelect);
            body.on('submit','#upload-form', handleFormSubmit);
        }
        else if(selected_element.hasClass('editable-url')){
            var options = new Object();
            var body = $('body');


            var url_input = $('<div>')
                .addClass('url-input')
                .append($('<input>')
                    .attr('id','image-url')
                    .addClass('url')
                    .attr('type','text')
                    .attr('placeholder','Your url'))
                .append($('<i>')
                    .addClass('fa fa-times popover-icon close-url'));

            url_input.show();

            options.html = true;
            options.placement = 'bottom';
            options.container = 'body';
            options.content = $('<div>')
                .append(url_input);

            selected_element.popover(options);
            selected_element.popover('show');

            body.on('click','.change-url.fa-chain',function(){
                $('.url-input').show();
                $('.image-options').hide();
            });

            body.on('click','.close-url',function(){
                $('#image-url').val('');
                selected_element.popover('destroy');
            });

            body.on('keypress','#image-url',function(e){
                if(e.keyCode == 13){
                    selected_element.attr('href',$(this).val()).attr('target','_blank');
                    selected_element.popover('destroy');
                }
            });
        }
    });

    $('body').on('click','.editable-box',function(){
        selected_element = $(this);

        $('.text-control').hide();
        $('.box-control').show();

        $('#layouts').collapse('hide');
        $('#tool-box').collapse('show');

//        var background_color = selected_element.css('background-color');
//
//        if(background_color != "transparent")
//            background_color = rgb2hex(background_color);
//
//        $('#background-color').val(background_color);
    });

    $('#font-size-slider').on('change',function(){
        if(selected_element){
            var font_size = $(this).val();

            if(apply_all){
                var section_group = selected_element.data('color');
                $('[data-color="'+section_group+'"]').css('font-size',font_size+'px');
            } else {
                selected_element.css('font-size',font_size+'px');
            }

        }
    });

    $('body').on('mouseup', function (e) {
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('.popover.in').length === 0) {
            if(selected_element && selected_element.popover() && !is_modal_active){
                selected_element.popover('destroy');
            }
        }
    });

    $('#template-canvas').sortable({cancel:'.editable'});

    $('.layout-name').on('click',function(){
        var layout_id = $(this).data('layout-id');

        if($('#layout-'+layout_id+'-section-list').html() == ""){
            $.ajax({
                url: 'ajax-layout-section-list/'+layout_id,
                type: 'get',
                dataType: 'json',
                success: function(data, status){

                        $.each(data, function(index, value){
                            var div = $('<div>')
                                .addClass('col-md-12 section-element section-display-image')
                                .append($('<img>')
                                    .attr('src',value.display_image)
                                    .addClass('img-responsive')
                                    .data('html',value.source_code));
                            $('#layout-'+layout_id+'-section-list').append(div);
                        });

                    $('.section-element img').draggable({
                        revert: true,
                        revertDuration: 0,
                        appendTo: 'body'
                    });
                }
            });
        }
    });

    $('#image-cropper').on('hidden.bs.modal', function (e) {
        is_modal_active = false;
        if(jcrop_api){
            jcrop_api.destroy();
            $('#image-cropper-preview').removeAttr('style');
        }

        if(selected_element && selected_element.popover() && !is_modal_active){
            selected_element.popover('destroy');
        }
    });

    var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

    function rgb2hex(rgb) {
        rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }

    function hex(x) {
        return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
    }

});