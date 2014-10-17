/**
Custom module for you to write your own javascript functions
**/
var Notes = function () {

    // private functions & variables

	var createNotes = function() {
		jQuery('#createNote').on('submit',function(e){
	    	e.preventDefault();
	    	var _postUrl 	= jQuery(this).attr('action');
	    	var _formInput 	= jQuery(this).serialize();

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

	    	var request = jQuery.ajax({
			  url: _postUrl,
			  type: "POST",
			  data: new FormData( this ),
			  dataType: "json",
			  cache: false,
			  processData: false,
			  contentType: false
			});
			request.done(function(msg){
				jQuery('.ajax-container-msg').switchClass('hide','show');
				jQuery('.ajax-container-msg').html(msg);
				if( !msg.result ){
					jQuery('.ajax-error-msg li').remove();
					jQuery('.ajax-error-msg').append(msg.message);
					jQuery('.ajax-container-msg').switchClass('hide','show');
				}else{
					jQuery('.ajax-error-msg li').remove();
					jQuery('.ajax-container-msg').switchClass('show','hide');
					if (typeof msg.redirect != 'undefined') {
					    window.location.href = msg.redirect;
					}
				}
			});
	    });
	}

    var modalOnLoaded = function() {
        jQuery('body').on('loaded.bs.modal', '.modal', function () {
			 createNotes();
		});
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.
            //createNotes();
            modalOnLoaded();
        }
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();
