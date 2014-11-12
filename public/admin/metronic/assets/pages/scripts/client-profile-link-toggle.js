/**
Custom module to toggle client profile navigation bar
**/
var profileLink = function () {

    // public functions
    return {

        //main function
        init: function () {
        	jQuery("div.profilemenu a.client_menu").click(function(e){ //on add input button click
				e.preventDefault();
				var link = jQuery(this).attr('href');
				jQuery(link).toggleClass('hide');
			});
        },
    };

}();