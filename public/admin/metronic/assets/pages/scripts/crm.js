/**
Custom module for you to write your own javascript functions
**/
var Index = function () {

	var modalEvent = function(){
		jQuery('body').on('loaded.bs.modal', '.modal', function () {
			jQuery(this).removeData('bs.modal');
		});
		jQuery('body').on('hidden.bs.modal', '.modal', function () {
			jQuery(this).removeData('bs.modal');
		});
	}

	var slimScroll = function(){
		jQuery('.scroller').slimScroll({
			height: '300px'
		});
	}

    // public functions
    return {

        //main function
        init: function () {
			modalEvent();
			slimScroll();
        },

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();
