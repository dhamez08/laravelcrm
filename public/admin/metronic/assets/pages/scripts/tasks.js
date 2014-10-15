var Tasks = function () {
    return {

        //main function to initiate the module
        initDashboardWidget: function () {
			$('.task-list input[type="checkbox"]').change(function() {
				if ($(this).is(':checked')) {
					$(this).parents('li').addClass("task-done");
				} else {
					$(this).parents('li').removeClass("task-done");
				}
			});
        }

    };

}();

var GetClient = (function(){

	var GetClient = function($name, $selector, $url, $input_id, $displayKey){

		var getClients = new Bloodhound({
		  datumTokenizer: Bloodhound.tokenizers.obj.whitespace($displayKey),
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  prefetch: {
		  	ttl: 1,
		  	url:$url
		  }
		});

		getClients.clearPrefetchCache();
		getClients.clearRemoteCache();
		getClients.initialize();

		jQuery($selector).typeahead({
		  hint: false,
		  highlight: true,
		  minLength: 1,
		},
		{
		  name: $name,
		  displayKey: $displayKey,
		  source: getClients.ttAdapter()
		});

		jQuery($selector).on('typeahead:selected', function (object, datum) {
			jQuery($input_id).val(datum.id);
			//jQuery($selector).val(datum.Name);
			//console.log(datum);
		});
	};

	return{
		init:function($name, $selector, $url, $input_id, $displayKey){
			GetClient($name, $selector, $url, $input_id, $displayKey);
		}
	};

})();

var CreateTask = (function(){
	var ajaxCreateTask = function() {
	    jQuery('#createTask').on('submit',function(e){
	    	e.preventDefault();
	    	var _postUrl 	= jQuery(this).attr('action');
	    	var _formInput 	= jQuery(this).serialize();

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

	    	var request = $.ajax({
			  url: _postUrl,
			  type: "POST",
			  data: _formInput,
			  dataType: "json"
			});
			request.done(function(msg){
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
			})
	    });
    }
	return{
		init:function($selector, $modalSelector){
            jQuery('body').on('loaded.bs.modal', '.modal', function () {
            	jQuery('#task_date').datepicker({
				    autoclose:true,
				    startDate: '+0d',
				    format: dateClientFormat
				});
			    jQuery(this).removeData('bs.modal');
			    var url = baseURL + '/clients/typeahead-client';

			    var redirectUrl = jQuery(location).attr('href');
			    jQuery(this).find('#redirect').val(redirectUrl);
				//protocol
				//host
			    GetClient.init('get-clients', '.getclient', url, '#customer_id', 'Name');
			    ajaxCreateTask();
			    jQuery('.complete-task, .delete-task').on('click',function(e){
					e.preventDefault();
					var newUrl = jQuery(this).attr('href') + '?redirect=' + jQuery(location).attr('href');
					window.location.href = newUrl;
				});
			});
			jQuery('body').on('hidden.bs.modal', '.ajaxModal', function() {
			    //jQuery(this).removeData('bs.modal');
			});
			jQuery('.complete-task, .delete-task').on('click',function(e){
				e.preventDefault();
				var newUrl = jQuery(this).attr('href') + '?redirect=' + jQuery(location).attr('href');
				window.location.href = newUrl;
			});
		}
	};
})();
