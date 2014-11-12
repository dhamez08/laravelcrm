/**
Custom module to toggle client profile navigation bar
**/
var profileLink = function () {
    var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
        $('#tags_1').tagsInput({
            width: 'auto',
            'onAddTag': function () {
                alert(jQuery(this).val());
            },
        });
    }

    var handleLinksToggle = function(){
        jQuery("div.profilemenu a.client_menu").click(function(e){ //on add input button click
                e.preventDefault();
                var link = jQuery(this).attr('href');
                if(jQuery(link).hasClass('hide')){
                    jQuery("div.collapse-profile-menu").addClass('hide');
                }
                jQuery(link).toggleClass('hide'); 
            });
    }
    // public functions
    return {

        //main function
        init: function () {
        	handleTagsInput();
            handleLinksToggle();
        },
    };

}();