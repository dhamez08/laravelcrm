var FormFileUpload = function () {
    return {
        //main function to initiate the module
        init: function () {
			$('.fileupload').each(function () {
				 // Initialize the jQuery File Upload widget:
				$(this).fileupload({
					dropZone: $(this),
					disableImageResize: false,
					autoUpload: false,
					disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
					maxFileSize: 500000,
					maxNumberOfFiles: 5,
					acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
					// Uncomment the following to send cross-domain cookies:
					//xhrFields: {withCredentials: true},
				}).bind('fileuploaddone', function (e, data) {
					//$('#msg').html('');
					if(data.result.success == true) {
						//window.location.replace(data.result.url + '/dashboard/website/show/' + data.result.websiteid + '/#' + 'slider');
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
					context: $('#fileupload')[0]
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
