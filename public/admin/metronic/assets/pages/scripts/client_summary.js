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

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();