/**
Media Library
**/

var DropBoxIntegrationFile = function() {

	var ajaxInsertDB = function(_url, dropbox_file, file_type, customer_id){
		jQuery('#ajax-loading-bar').toggleClass('hidden');
		var request = $.ajax({
		  url: _url + '/file/ajax-add-file-integration',
		  type: "POST",
		  data: {
			  file_type : file_type,
			  filename : dropbox_file,
			  customer_id : customer_id,
			  integrate	: 'dropbox'
		  },
		  dataType: "json"
		});

		request.done(function( msg ) {
			console.log(msg.success);
			if (msg.success) {
				jQuery('#ajax-loading-bar').toggleClass('hidden');
				window.location.href = msg.redirect;
			}
		});
	}

	return {
		init:function(url){
			//var button = Dropbox.createChooseButton(options);
			//document.getElementById("dropbox-container-" + file_type).appendChild(button);
			jQuery('.dropbox_file').on('click',function(e){
				e.preventDefault();
				var file_type = jQuery(this).data('file-type');
				var customer_id = jQuery(this).data('customer-id');

				var options = {

					// Required. Called when a user selects an item in the Chooser.
					success: function(files) {
						if( files.length > 0 ){
							for (i = 0; i < files.length; i++) {
								//alert("Here's the file link: " + files[i].link + 'file type ' + file_type + 'customer id ' + customer_id)
								ajaxInsertDB(url, files[i].link, file_type, customer_id);
							}
						}
					},

					// Optional. Called when the user closes the dialog without selecting a file
					// and does not include any parameters.
					cancel: function() {

					},

					// Optional. "preview" (default) is a preview link to the document for sharing,
					// "direct" is an expiring link to download the contents of the file. For more
					// information about link types, see Link types below.
					linkType: "direct", // or "direct"

					// Optional. A value of false (default) limits selection to a single file, while
					// true enables multiple file selection.
					multiselect: true, // or true

					// Optional. This is a list of file extensions. If specified, the user will
					// only be able to select files with these extensions. You may also specify
					// file types, such as "video" or "images" in the list. For more information,
					// see File types below. By default, all extensions are allowed.
					extensions: [],
				};
				Dropbox.choose(options);
			});
		}
	};
}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();
