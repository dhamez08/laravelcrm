var MediaFormFileUpload = function () {
    return {
        //main function to initiate the module
        init: function () {

             // Initialize the jQuery File Upload widget:
            $('#media-fileupload').fileupload({
                disableImageResize: false,
                autoUpload: false,
                disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                maxFileSize: 30000000,
					acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf|doc|docx|zip|rar|mpg|mp4|avi|xlsx|xls)$/i
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
            }).bind('fileuploaddone', function (e, data) {
				if(data.result.success == true) {
					//window.location.replace(data.result.redirect);
					/*$.get( data.result.listurl + "/" + data.result.websiteid , function(html) {
						$('#slideritems').html(html);
					});*/
				} else {
					/*var strMsg = "<div class='alert alert-danger'>";
						strMsg += "<strong>Error! </strong>";
						strMsg += data.result.msg;
						strMsg += "</div>";*/
					//$('#msg').html(strMsg);
				}
			});

            // Enable iframe cross-domain access via redirect option:
            $('#media-fileupload').fileupload(
                'option',
                'redirect',
                window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                )
            );

            // Upload server status check for browsers with CORS support:
            if ($.support.cors) {
                $.ajax({
                    type: 'HEAD'
                }).fail(function () {
                    $('<div class="alert alert-danger"/>')
                        .text('Upload server currently unavailable - ' +
                                new Date())
                        .appendTo('#media-fileupload');
                });
            }

            // Load & display existing files:
            $('#media-fileupload').addClass('fileupload-processing');
            $.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
				}
			});
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#media-fileupload').attr("action"),
                dataType: 'json',
                context: $('#media-fileupload')[0]
            }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
            });
        }

    };

}();
