/**
Custom module for you to write your own javascript functions
**/
var Summary = function () {

    // private functions & variables

    var listeners = function() {

        CKEDITOR.replace('email_body');
        CKEDITOR.config.toolbarGroups = [           
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            { name: 'links' },
            { name: 'insert' },
        ];

        $("button.sendemail").on("click", function() {
            $("#send-email-modal").modal("show");
        });
    }

    var toggler = function(){
        // Remove default collapse trigger
        $('.page-sidebar, .page-header .sidebar-toggler').unbind('click');

        var body = $('body');
        if ($.cookie && $.cookie('sidebar_closed') === '1' && Metronic.getViewPort().width >= 992) {
            $('body').addClass('page-sidebar-closed');
            $('.client-sidebar-menu').addClass('page-sidebar-menu-closed');
        }

        $('.page-sidebar, .page-header').on('click', '.sidebar-toggler', function (e) {
            var sidebar = $('.client-sidebar');
            var sidebarMenu = $('.client-sidebar-menu');
            $(".sidebar-search", sidebar).removeClass("open");

            if (body.hasClass("page-sidebar-closed")) {
                body.removeClass("page-sidebar-closed");
                sidebarMenu.removeClass("page-sidebar-menu-closed");
                if ($.cookie) {
                    $.cookie('sidebar_closed', '0' ,{ path: '/' });
                }
            } else {
                body.addClass("page-sidebar-closed");
                sidebarMenu.addClass("page-sidebar-menu-closed");
                if (body.hasClass("page-sidebar-fixed")) {
                    sidebarMenu.trigger("mouseleave");
                }
                if ($.cookie) {
                    $.cookie('sidebar_closed', '1' ,{ path: '/' });
                }
            }

            $(window).trigger('resize');
        });

        // Trigger toggler when screen is resized
        $(window).resize(function(){
            if(Metronic.getViewPort().width < 992){

            }
        })

        jQuery('.bulk-delete-toolbar').find('input[type="checkbox"]').on('change', function() {
            var target_table = jQuery(this).attr('table-target');
            if(jQuery(this).is(':checked')) {
                jQuery(target_table).find('input[type="checkbox"]').prop('checked', true);
                jQuery(target_table).find('input[type="checkbox"]').uniform({checkedClass: 'checked'});
            } else {
                jQuery(target_table).find('input[type="checkbox"]').prop('checked', false);
                jQuery(target_table).find('input[type="checkbox"]').uniform({checkedClass: ''});
            }
        });

        jQuery('.bulk-delete-toolbar').closest('form').submit(function(e) {
            var c = confirm("Click OK to confirm bulk delete.");
            return c; 
        });

    }

    // public functions
    return {

        //main function
        init: function () {
            listeners();           
        },
        init_toggler: function(){
            toggler();
        }

    };

}();

$(document).on('change', '#sms_template', function(e) {
    e.preventDefault();
    var val = $(this).val();
    var form = $(this).closest('form');
    if(val == 0) {
        form.find('textarea[name="note"]').val('');
        $('#message').val('').trigger('keyup');
    } else {
        $.get(baseURL + '/settings/sms/template/' + val, null, function(data) {
            form.find('textarea[name="note"]').val(data.body);
            $('#message').val(data.body).trigger('keyup');
        });
    }           
});

$(document).on('keyup', 'textarea[name="note"]', function() {
    $('#message').val($(this).val());
    $('#message').trigger('keyup');
});

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();