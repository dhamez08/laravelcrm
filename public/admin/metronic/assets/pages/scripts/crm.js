/**
Custom module for you to write your own javascript functions
**/
var Index = function () {

	var modalEvent = function(){
		jQuery('body').on('show.bs.modal', '.modal', function () {
			//jQuery(this).find('.modal-body').html('');
			jQuery(this).removeData('bs.modal');
		});
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

	var inputDatePicker = function(){
		jQuery('.inputdatepicker').datepicker({
			autoclose:true,
		});
	}

    // public functions
    return {

        //main function
        init: function () {
			modalEvent();
			slimScroll();
			inputDatePicker();
        },

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();

/** Custom jQuery functions **/
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
