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
	    	var _postUrl 			= jQuery(this).attr('action');
	    	var _formInput 			= jQuery(this).serialize();
			var _button_file_upload = 	jQuery('.file-attach');
			var _msg_status 		= 	jQuery('.ajax-container-msg-file-attach');
			var _msg_success_status	= 	jQuery('.success-file-attach');
			var _msg_success_msg	= 	jQuery('.success-msg');

			_button_file_upload.button('loading');
			_button_file_upload.attr('disabled','disabled');
			_msg_success_msg.html('');

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
					_msg_status.switchClass('hide','show');
					_button_file_upload.button('reset');
					_button_file_upload.attr('disabled','disabled');
				}else{
					jQuery('.ajax-error-msg li').remove();
					_msg_status.switchClass('show','hide');
					// open file tab
					jQuery('#sms-file-upload')[0].reset();
					_button_file_upload.button('reset');
					_button_file_upload.attr('disabled','disabled');
					_msg_success_msg.html(msg.message);
					_msg_success_status.switchClass('hide','show');
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

