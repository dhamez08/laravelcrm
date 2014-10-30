var Messages = function () {

    var content = $('.inbox-content');
    var loading = $('.inbox-loading');
    var listListing = '';

    var loadInbox = function (el, name) {
        if(name=='inbox')
            var url = BASE_URL+'/messages/inbox';
        else if(name=='sent')
            var url = BASE_URL+'/messages/sent';
        else if(name=='draft')
            var url = BASE_URL+'/messages/draft';
        else if(name=='trash')
            var url = BASE_URL+'/messages/trash';
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
        var url = BASE_URL+'/messages/view';

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
        var url = BASE_URL+'/messages/compose';

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
        var url = BASE_URL+'/messages/reply';

        var message_id = el.attr("data-messageid");  

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            data: {'message_id': message_id},
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Reply');

                loading.hide();
                content.html(res);
                $('[name="message"]').val($('#reply_email_content_body').html());

                //handleCCInput(); // init "CC" input field

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

            // handle view message
            $('.inbox-content').on('click', '.view-message', function () {
                var message_id = $(this).parent('tr').attr("data-messageid");
                location.href=BASE_URL+'/messages/view?message_id='+message_id;
            });

            //handle compose/reply cc input toggle
            $('.inbox-content').on('click', '.mail-to .inbox-cc', function () {
                handleCCInput();
            });

            //handle compose/reply bcc input toggle
            $('.inbox-content').on('click', '.mail-to .inbox-bcc', function () {
                handleBCCInput();
            });

            $('.cancel-btn').on('click', function(e) {
                e.preventDefault();
                history.back(-1);
            });

            $("select#email_template").live("change", function() {
                $this = $(this);
                $.get(BASE_URL+'/settings/email/template/'+$this.val(), function(response) {
                    // $(".inbox-wysihtml5").data('wysihtml5').editor.setValue(response.body);
                    $("#message").code(response.body);
                    $("input#email_subject").val(response.subject);
                });
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
                        row+='<tr><td>['+form_name+':'+item.field_name+']</td></tr>';
                    });

                    $("#fields_container table tbody").append(row);

                    Metronic.unblockUI('#fields_container');
                });
            });

            initFileupload();
            initWysihtml5();

            jQuery('body').on('change', '.mail-group-checkbox', function () {
                var set = jQuery('.mail-checkbox');
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    $(this).attr("checked", checked);
                });
                jQuery.uniform.update(set);
            });


            jQuery("a#message_read").on("click", function(e) {
                e.preventDefault();
                jQuery("form#inboxForm input#action_type").val("message_read");
                jQuery("form#inboxForm").submit();
            });
            jQuery("a#message_unread").on("click", function(e) {
                e.preventDefault();
                jQuery("form#inboxForm input#action_type").val("message_unread");
                jQuery("form#inboxForm").submit();
            });
            jQuery("a#message_delete").on("click", function(e) {
                e.preventDefault();
                jQuery("form#inboxForm input#action_type").val("message_delete");
                jQuery("form#inboxForm").submit();
            });

            jQuery("a#message_restore").on("click", function(e) {
                e.preventDefault();
                jQuery("form#inboxForm input#action_type").val("message_restore");
                jQuery("form#inboxForm").submit();
            });
            jQuery("a#message_force_delete").on("click", function(e) {
                e.preventDefault();
                jQuery("form#inboxForm input#action_type").val("message_force_delete");
                jQuery("form#inboxForm").submit();
            });
            jQuery("a#forwardEmailLink").on("click", function(e) {
                e.preventDefault();
                jQuery("div#forwardEmailContainer").show();
            });
            jQuery("button#forwardEmailCancel").on("click", function(e) {
                e.preventDefault();
                jQuery("div#forwardEmailContainer").hide();
            });

        }

    };

}();