var ClientEmail = function () {

    var content = $('.inbox-content');
    var loading = $('.inbox-loading');
    var listListing = '';

    var loadInbox = function (el, name) {
        var url = 'inbox_inbox.html';
        var title = $('.inbox-nav > li.' + name + ' a').attr('data-title');
        listListing = name;

        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-nav > li.' + name).addClass('active');
                $('.inbox-header > h1').text(title);

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });

        // handle group checkbox:
        jQuery('body').on('change', '.mail-group-checkbox', function () {
            var set = jQuery('.mail-checkbox');
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                $(this).attr("checked", checked);
            });
            jQuery.uniform.update(set);
        });
    }

    var loadMessage = function (el, name, resetMenu) {
        var url = 'inbox_view.html';

        loading.show();
        content.html('');
        toggleButton(el);

        var message_id = el.parent('tr').attr("data-messageid");  
        
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            data: {'message_id': message_id},
            success: function(res) 
            {
                toggleButton(el);

                if (resetMenu) {
                    $('.inbox-nav > li.active').removeClass('active');
                }
                $('.inbox-header > h1').text('View Message');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var initWysihtml5 = function () {
        $('.inbox-wysihtml5').wysihtml5({
            "stylesheets": [ASSET_PATH+"/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
        });
    }

    var initFileupload = function () {

        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: BASE_URL+'/email/upload-handler',
            autoUpload: true
        });

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: BASE_URL+'/email/upload-handler',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                    new Date())
                    .appendTo('#fileupload');
            });
        }
    }

    var loadCompose = function (el) {
        var url = 'inbox_compose.html';

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Compose');

                loading.hide();
                content.html(res);

                initFileupload();
                initWysihtml5();

                $('.inbox-wysihtml5').focus();
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadReply = function (el) {
        var url = 'inbox_reply.html';

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Reply');

                loading.hide();
                content.html(res);
                $('[name="message"]').val($('#reply_email_content_body').html());

                handleCCInput(); // init "CC" input field

                initFileupload();
                initWysihtml5();
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadSearchResults = function (el) {
        var url = 'inbox_search_result.html';

        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Search');

                loading.hide();
                content.html(res);
                Layout.fixContentHeight();
                Metronic.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var handleCCInput = function () {
        var the = $('.inbox-compose .mail-to .inbox-cc');
        var input = $('.inbox-compose .input-cc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var handleBCCInput = function () {

        var the = $('.inbox-compose .mail-to .inbox-bcc');
        var input = $('.inbox-compose .input-bcc');
        the.hide();
        input.show();
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var toggleButton = function(el) {
        if (typeof el == 'undefined') {
            return;
        }
        if (el.attr("disabled")) {
            el.attr("disabled", false);
        } else {
            el.attr("disabled", true);
        }
    }

    return {
        //main function to initiate the module
        init: function () {

            // handle compose btn click
            $('.inbox').on('click', '.compose-btn a', function () {
                loadCompose($(this));
            });

            // handle discard btn
            $('.inbox').on('click', '.inbox-discard-btn', function(e) {
                e.preventDefault();
                loadInbox($(this), listListing);
            });

            // handle reply and forward button click
            $('.inbox').on('click', '.reply-btn', function () {
                loadReply($(this));
            });

            // handle view message
            $('.inbox-content').on('click', '.view-message', function () {
                loadMessage($(this));
            });

            // handle inbox listing
            $('.inbox-nav > li.inbox > a').click(function () {
                loadInbox($(this), 'inbox');
            });

            // handle sent listing
            $('.inbox-nav > li.sent > a').click(function () {
                loadInbox($(this), 'sent');
            });

            // handle draft listing
            $('.inbox-nav > li.draft > a').click(function () {
                loadInbox($(this), 'draft');
            });

            // handle trash listing
            $('.inbox-nav > li.trash > a').click(function () {
                loadInbox($(this), 'trash');
            });

            //handle compose/reply cc input toggle
            $('.inbox-cc-bcc').on('click', '.inbox-cc', function () {
                handleCCInput();
            });

            //handle compose/reply bcc input toggle
            $('.inbox-cc-bcc').on('click', '.inbox-bcc', function () {
                handleBCCInput();
            });

            $('.cancel-btn').on('click', function(e) {
                e.preventDefault();
                history.back(-1);
            });

            //handle loading content based on URL parameter
            if (Metronic.getURLParameter("a") === "view") {
                loadMessage();
            } else if (Metronic.getURLParameter("a") === "compose") {
                loadCompose();
            } else {
               $('.inbox-nav > li.inbox > a').click();
            }

            initWysihtml5();
            initFileupload();

            /*
            $("select#email_template").live("change", function() {
                $this = $(this);
                $.get(BASE_URL+'/settings/email/template/'+$this.val(), function(response) {
                    //$(".inbox-wysihtml5").data('wysihtml5').editor.setValue(response.body);
                    $("#message").code(response.body);
                    $("input#email_subject").val(response.subject);
                });
            });
            */

            var previousTemplateSelected;
            var noTemplateBodyContent = '';
            $("select#email_template").focus(function() {
                console.log($(this).val());
                previousTemplateSelected = $(this).val();
                noTemplateBodyContent = $('#message').code();
            }).change(function() {
                var template_type = $(this).find(':selected').data('template-type');
                var template_id = $(this).val();
                $('input[name=template_type]').val(template_type);

                if(template_type == 'text'){
                    $('#text-view').removeClass('hide');
                    $('#template-view').addClass('hide');
                    if($(this).val() == '')
                        $('#message').code(noTemplateBodyContent);

                    $this = $(this);
                    $.get(BASE_URL+'/settings/email/template/'+$this.val(), function(response) {
                        //$(".inbox-wysihtml5").data('wysihtml5').editor.setValue(response.body);
                        $("#message").code(response.body);
                        $("input#email_subject").val(response.subject);
                    });
                } else {
                    $('#template-view').removeClass('hide');
                    $('#text-view').addClass('hide');
                    $('input[name=template_id]').val(template_id);

                    var data = new Object();
                    data.template_id = $(this).find(':selected').val();

                    $.ajax({
                        type: "GET",
                        url: baseURL+'/marketing/ajax-edit-template',
                        data: data,
                        success: function(response)
                        {
                            var body = $('#template-view').contents().find('body');
                            body.html('');
                            body.append('<style>'+response.style+'</style>');
                            body.append(response.source_code);
                        },
                        dataType: 'json'
                    });
                }
            });

            $("select#custom_form").live("change", function() {
                $this = $(this);
                $("#fields_container table tbody").html('');
                //show loading
                Metronic.blockUI({
                    target: '#fields_container',
                    boxed: true,
                    message: 'Processing...'
                });

                var row='';
                $.get(BASE_URL+'/settings/custom-forms/fields/'+$this.val(), function(response) {
                    var form_name = response.form.name;
                    $.each(response.build, function(i, item) {
                        //row+='<tr><td><input type="text" value="['+form_name+':'+item.field_name+']" class="form-control" style="border:0px" /></td></tr>';
                        if($this.val()=='customer')
                            row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+item.field_name+'}</a></td></tr>';
                        else if($this.val()=='custom_fields')
                            row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+form_name+':'+item.field_name+'}</a></td></tr>';
                        else
                            row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">['+form_name+':'+item.field_name+']</a></td></tr>';
                    });

                    $("#fields_container table tbody").append(row);

                    Metronic.unblockUI('#fields_container');
                }).error(function() {
                    Metronic.unblockUI('#fields_container');
                });
            });

            var isValid = 0;

            $("#message").next().children('.note-editable').live("click", function() {
                isValid = 1;
            });

            $(document).click(function(event) { 
                if(!$(event.target).closest('.note-editor').length && event.target!="javascript:void(0)") {
                    isValid = 0;
                }        
            });

            $("a.custom_form_link").live("click", function() {
                if(isValid==1) {
                    var selection = document.getSelection();
                    var cursorPos = selection.anchorOffset;
                    var oldContent = selection.anchorNode.nodeValue;
                    var toInsert = $(this).html();
                    if(oldContent!=null) {
                        var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
                        selection.anchorNode.nodeValue = newContent;
                    } else {
                        $("#message").code($("#message").code()+''+toInsert+'');
                    }
                } else {
                    $("#template_body").setCursorToTextEnd();
                    //alert('please click/focus on the editor to insert the dynamic field!');
                }
            });
        }

    };

}();