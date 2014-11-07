var SMSFileUpload = function () {
    // private functions & variables

	var ajaxGetFile = function(_url) {
		var request = jQuery.ajax({
		  url: _url,
		  type: "GET",
		  dataType: "html",
		});
		request.done(function(msg){
			jQuery('.file-list').html(msg);
		});
	}

	var ajaxUpload = function(_url) {
		jQuery('#sms-file-upload').on('submit',function(e){
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
				if( !msg.result ){
					jQuery('.ajax-error-msg li').remove();
					jQuery('.ajax-error-msg').append(msg.message);
					jQuery('.ajax-container-msg').switchClass('hide','show');
				}else{
					jQuery('.ajax-error-msg li').remove();
					jQuery('.ajax-container-msg').switchClass('show','hide');
					// open file tab
					jQuery('#sms-file-upload')[0].reset();
					ajaxGetFile(_url);
				}
			});
	    });
	}

    // public functions
    return {

        //main function
        init: function (_url) {
            //initialize here something.
            //reset the form in the add new tab
            ajaxUpload(_url);
        }
    };

}();

