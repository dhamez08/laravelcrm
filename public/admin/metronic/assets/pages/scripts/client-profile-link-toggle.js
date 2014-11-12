/**
Custom module to toggle client profile navigation bar
**/
var profileLink = function () {
    var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
        jQuery('#tags_1').tagsInput({
            width: 'auto',
            height: 'auto',
            minChars: 3,
            placeholderColor:'#000000',
            inputPadding: 2*2,
            'onAddTag': function () {
                var data = jQuery(this).val();
                var dis = data.replace(new RegExp(',', 'g'), '</span>, <span>');
                jQuery("#client-profile-tags-list").html('<span>'+dis+'</span>');
            },
            'onRemoveTag': function(){
                var data = jQuery(this).val();
                var dis = data.replace(new RegExp(',', 'g'), '</span>, <span>');
                jQuery("#client-profile-tags-list").html('<span>'+dis+'</span>');
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

    var handleEditTags = function(){
        jQuery("#edit-tags-button").click(function(e){
            e.preventDefault();
            if(jQuery(this).text() == "Edit Tags"){
                if(jQuery("#edit-tags-inputs").hasClass("hide")){
                    jQuery("#edit-tags-inputs").toggleClass('hide');
                    jQuery(this).html("Done Editing Tags");
                }
            } else if(jQuery(this).text() == "Done Editing Tags"){
                jQuery("#edit-tags-inputs").toggleClass('hide');
                jQuery(this).html("Edit Tags");
            }
        });
    }
    // public functions
    return {

        //main function
        init: function () {
        	handleTagsInput();
            handleLinksToggle();
            handleEditTags();
        },
    };

}();