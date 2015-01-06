var FormFileUpload = function () {
    return {
        //main function to initiate the module
        init: function () {
			$('.fileupload').each(function () {
				 // Initialize the jQuery File Upload widget:
				$(this).fileupload({
					dropZone: $(this),
					disableImageResize: true,
					autoUpload: false,
					disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
					maxFileSize: 30000000,
					//limitMultiFileUploads: 10,
					acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf|doc|docx|zip|rar|mpg|mp4|avi|xlsx|xls)$/i
					// Uncomment the following to send cross-domain cookies:
					//xhrFields: {withCredentials: true},
				//}).bind('fileuploaddone', function (e, data) {
				}).bind('fileuploadcompleted', function (e, data) {	
					console.log('DONE');
					//$('#msg').html('');
					if(data.result.success == true) {
						setTimeout(function() {
							window.location.replace(data.result.redirect);
						}, 2000);						
						/*$.get( data.result.listurl + "/" + data.result.websiteid , function(html) {
							$('#slideritems').html(html);
						});*/
					} else {
						var strMsg = "<div class='alert alert-danger'>";
							strMsg += "<strong>Error! </strong>";
							strMsg += data.result.msg;
							strMsg += "</div>";
						//$('#msg').html(strMsg);
					}
				});

				// Upload server status check for browsers with CORS support:
				if ($.support.cors) {
					$.ajax({
						type: 'HEAD'
					}).fail(function () {
						$('<div class="alert alert-danger"/>')
							.text('Upload server currently unavailable - ' +
									new Date())
							.appendTo('#fileupload');
					});
				}

				// Load & display existing files:
				//$(this).addClass('fileupload-processing');
				$.ajaxSetup({
					headers: {
						'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					// Uncomment the following to send cross-domain cookies:
					//xhrFields: {withCredentials: true},
					url: $(this).fileupload('option', 'url'),
					dataType: 'json',
					context: $(this)[0]
				}).always(function () {
					$(this).removeClass('fileupload-processing');
				}).done(function (result) {
					$(this).fileupload('option', 'done')
					.call(this, $.Event('done'), {result: result});
				});
			});


        }

    };

}();

var deleteFiles = function() {
	return {
		init:function(){
			jQuery('.deleteFile').click(function(e){
				e.preventDefault();
				var _link = jQuery(this);
				bootbox.confirm("Are you Sure want to delete this File?", function (confirmation) {
					confirmation && document.location.assign(_link.attr('href'));
				});
			});
		}
	};
}();
