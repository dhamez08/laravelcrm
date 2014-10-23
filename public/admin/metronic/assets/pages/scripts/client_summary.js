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

    // public functions
    return {

        //main function
        init: function () {
            listeners();           
        }

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();