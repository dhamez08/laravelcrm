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
		  prefetch: $url
		});

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
