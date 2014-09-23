/**
Custom module for you to write your own javascript functions
**/
var addPhone = function () {
    // private functions & variables

    // public functions
    return {

        //main function
        init: function () {
            var max_fields      = 10; //maximum input boxes allowed
			var wrapper         = jQuery("#clone-phone"); //Fields wrapper
			var add_button      = jQuery(".add-phone"); //Add button ID
			var x = 1; //initlal text box count

			jQuery(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					var content = '<div class="row phone-wrapper">'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+'<input type="text" name="telephone['+x+'][number]" class="form-control input-sm"/>'
							+'</div>'
						+'</div>'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+ '<select name="telephone['+x+'][for]" class="form-control input-sm"/>'
								+ '</select>'
							+'</div>'
						+'</div>'
						+'<a href="#" class="remove_field">Remove</a>'
					+'</div>';

					jQuery(wrapper).append(content); //add input box
					// append dropdown phone type / for
					jQuery("#basePhone > option").each(function () {
						jQuery('select[name="telephone['+x+'][for]"]').append(jQuery("<option />").val(this.value).text(this.value));
					});
				}
			});

            jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
        },
    };

}();
var addEmail = function () {
    // private functions & variables

    // public functions
    return {

        //main function
        init: function () {
            var max_fields      = 10; //maximum input boxes allowed
			var wrapper         = jQuery("#clone-email"); //Fields wrapper
			var add_button      = jQuery(".add-email"); //Add button ID
			var x = 1; //initlal text box count

			jQuery(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					var content = '<div class="row email-wrapper">'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+'<input type="text" name="email['+x+'][mail]" class="form-control input-sm"/>'
							+'</div>'
						+'</div>'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+ '<select name="email['+x+'][for]" class="form-control input-sm"/>'
								+ '</select>'
							+'</div>'
						+'</div>'
						+'<a href="#" class="remove_field">Remove</a>'
					+'</div>';

					jQuery(wrapper).append(content); //add input box
					// append dropdown phone type / for
					jQuery("#baseEmail > option").each(function () {
						jQuery('select[name="email['+x+'][for]"]').append(jQuery("<option />").val(this.value).text(this.value));
					});
				}
			});

            jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
        },
    };

}();
