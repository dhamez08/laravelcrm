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
				if( jQuery("#clone-phone .phone-wrapper").length > 0  ){
					x = jQuery("#clone-phone .phone-wrapper").length;
				}
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
				if( jQuery("#clone-email .email-wrapper").length > 0  ){
					x = jQuery("#clone-email .email-wrapper").length;
				}
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					var content = '<div class="row email-wrapper">'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+'<input type="text" name="emails['+x+'][mail]" class="form-control input-sm"/>'
							+'</div>'
						+'</div>'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+ '<select name="emails['+x+'][for]" class="form-control input-sm"/>'
								+ '</select>'
							+'</div>'
						+'</div>'
						+'<a href="#" class="remove_field">Remove</a>'
					+'</div>';

					jQuery(wrapper).append(content); //add input box
					// append dropdown phone type / for
					jQuery("#baseEmail > option").each(function () {
						jQuery('select[name="emails['+x+'][for]"]').append(jQuery("<option />").val(this.value).text(this.value));
					});
				}
			});

            jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
        },
    };

}();
var addWebsite = function () {
    // private functions & variables

    // public functions
    return {

        //main function
        init: function () {
            var max_fields      = 10; //maximum input boxes allowed
			var wrapper         = jQuery("#clone-website"); //Fields wrapper
			var add_button      = jQuery(".add-website"); //Add button ID
			var x = 1; //initlal text box count

			jQuery(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if( jQuery("#clone-website .website-wrapper").length > 0  ){
					x = jQuery("#clone-website .website-wrapper").length;
				}
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					var content = '<div class="row website-wrapper">'
						+'<div class="col-xs-4">'
							+'<div class="form-group">'
								+'<input type="text" name="urls['+x+'][url]" class="form-control input-sm"/>'
							+'</div>'
						+'</div>'
						+'<div class="col-xs-2">'
							+'<div class="form-group">'
								+ '<select name="urls['+x+'][for]" class="form-control input-sm"/>'
								+ '</select>'
							+'</div>'
						+'</div>'
						+'<div class="col-xs-2">'
							+'<div class="form-group">'
								+ '<select name="urls['+x+'][is]" class="form-control input-sm"/>'
								+ '</select>'
							+'</div>'
						+'</div>'
						+'<a href="#" class="remove_field">Remove</a>'
					+'</div>';

					jQuery(wrapper).append(content); //add input box
					// append dropdown phone type / for
					jQuery("#baseFor > option").each(function () {
						jQuery('select[name="urls['+x+'][for]"]').append(jQuery("<option />").val(this.value).text(this.value));
					});
					jQuery("#baseIs > option").each(function () {
						jQuery('select[name="urls['+x+'][is]"]').append(jQuery("<option />").val(this.value).text(this.value));
					});
				}
			});

            jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
        },
    };

}();
var addPartner = function () {

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.
            var partner_status = jQuery('#marital_status');
            var partner_details = jQuery('#partner_details');

            partner_status.change(function(){
				if( jQuery(this).val() == 'Married' ){
					partner_details.switchClass('hide','show');
				}else{
					clearInput.init('#partner_details');
					partner_details.switchClass('show','hide');
				}
			});
			if( partner_status.val() == 'Married' ){
				partner_details.switchClass('hide','show');
			}else{
				clearInput.init('#partner_details');
				partner_details.switchClass('show','hide');
			}
        }
    };

}();

var addChildren = function () {

	var content = function(incrementId) {
        return '<div class="row children-wrapper">'
			+'<div class="col-xs-3">'
				+'<div class="form-group">'
				+'<label class="control-label">First Name</label>'
				+'<input type="text" name="children['+incrementId+'][firstname]" class="form-control input-sm">'
				+'</div>'
			+'</div>'
			+'<div class="col-xs-3">'
				+'<div class="form-group">'
				+'<label class="control-label">Last Name</label>'
				+'<input type="text" name="children['+incrementId+'][lastname]" class="form-control input-sm">'
				+'</div>'
			+'</div>'
			+'<div class="col-xs-2">'
				+'<div class="form-group">'
				+'<label class="control-label">Date of Birth</label>'
				+'<input type="text" name="children['+incrementId+'][dob]" data-date-format="yyyy-mm-dd" data-provide="datepicker" class="form-control input-sm">'
				+'</div>'
			+'</div>'
			+'<div class="col-xs-2">'
				+'<div class="form-group">'
				+'<label class="control-label">Relation To Client</label>'
				+'<select name="children['+incrementId+'][relation_to_client]" class="form-control input-sm">'
				+'</select>'
				+'</div>'
			+'</div>'
		+'</div>';
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.
            var children_list = jQuery('#noc');
            var children_details = jQuery('#children_details');
            var children_wrapper = jQuery('#clone-children');

            children_list.change(function(){
				var number_children = jQuery(this).val();
				jQuery(children_wrapper).empty();

				if( number_children == 1 ){
					children_details.switchClass('hide','show');
				}else if( number_children > 1 ){
					children_details.switchClass('hide','show');
					var i = 1;
					for(i; i < number_children; i++){
						jQuery(children_wrapper).append(content(i));
						jQuery("#baseRelationToClient > option").each(function () {
							jQuery('#clone-children .children-wrapper select[name="children['+i+'][relation_to_client]"]').append(jQuery("<option />").val(this.value).text(this.text));
						});
					}
				}else{
					children_details.switchClass('show','hide');
				}

			});
        }
    };

}();

var addRowChildren = function () {

	var content = function(incrementId) {
        return '<div class="row children-wrapper">'
			+'<div class="col-xs-3">'
				+'<div class="form-group">'
				+'<label class="control-label">First Name</label>'
				+'<input type="text" name="children['+incrementId+'][firstname]" class="form-control input-sm">'
				+'</div>'
			+'</div>'
			+'<div class="col-xs-3">'
				+'<div class="form-group">'
				+'<label class="control-label">Last Name</label>'
				+'<input type="text" name="children['+incrementId+'][lastname]" class="form-control input-sm">'
				+'</div>'
			+'</div>'
			+'<div class="col-xs-2">'
				+'<div class="form-group">'
				+'<label class="control-label">Date of Birth</label>'
				+'<input type="text" name="children['+incrementId+'][dob]" data-date-format="yyyy-mm-dd" data-provide="datepicker" class="form-control input-sm">'
				+'</div>'
			+'</div>'
			+'<div class="col-xs-2">'
				+'<div class="form-group">'
				+'<label class="control-label">Relation To Client</label>'
				+'<select name="children['+incrementId+'][relation_to_client]" class="form-control input-sm">'
				+'</select>'
				+'</div>'
			+'</div>'
			+'<a href="#" class="remove_field">Remove</a>'
		+'</div>';
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.
            var max_fields      = 15; //maximum input boxes allowed
            var children_details = jQuery('#children_details');
            var children_wrapper = jQuery('#clone-children');
			var add_row_button = jQuery('.add-row-children');
			var x = 1;

            jQuery(add_row_button).click(function(e){
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					jQuery(children_wrapper).append(content(x)); //add input box
					// append dropdown phone type / for
					jQuery(".relation_to_client > option").each(function () {
						jQuery('#clone-children .children-wrapper select[name="children['+x+'][relation_to_client]"]').append(jQuery("<option />").val(this.value).text(this.text));
					});
				}
			});
			jQuery(children_wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
        }
    };

}();

var clearInput = function () {

    // public functions
    return {

        //main function
        init: function (selector) {
		  jQuery(selector).find(':input').each(function() {
			switch(this.type) {
				case 'password':
				case 'text':
				case 'textarea':
				case 'file':
				case 'select-one':
				case 'select-multiple':
					jQuery(this).val('');
					break;
				case 'checkbox':
				case 'radio':
					this.checked = false;
			}
		  });
        }
    };

}();

var searchCompany = function () {
	return {
		init:function(ajaxUrl){
			var searchCompany = jQuery('#searchCompanyInfo');
			searchCompany.click(function() {
				var company_info = [];
				var company = jQuery("#company").val();
				jQuery.ajax({
					dataType: 'json',
					data: 'company='+company,
					url: ajaxUrl,
					success: function(data) {
						var line;
						jQuery("#company_lookup_results").html('<select id="company_lookup_results_list" multiple="multiple" style="width:500px;"></select>');
						for(var i in data) {
							company_info[i] = data[i];
							line = data[i].name;
							jQuery("#company_lookup_results_list").append('<option value="'+data[i].number+'">'+line+'</option>')
						}
						jQuery("#company_lookup_results_list").click(function() {
							var company_number = (this.value);
								jQuery.ajax({
									dataType: 'json',
									data: 'company_number='+company_number,
									url: '<?php echo base_url(); ?>clients/get_company_details',
									success: function(company_data) {
										var att = jQuery.parseJSON(company_data);
										jQuery("#duedil_company").text(company_data);
										jQuery("#company").val(att.name_formatted);
										jQuery("#companyreg").val(att.company_number);
										jQuery("#find_address_1").val(att.registered_address['full_address'][0]);
										jQuery("#find_address_2").val(att.registered_address['postcode']);
										jQuery("#address").val(att.registered_address['full_address'][0]);
										jQuery("#postcode").val(att.registered_address['postcode']);
									},
									cache: false
								});
						});
					},
					cache: false
				});
			});
		}
	};
}();

var addressLookup = function() {
	// public functions
    return {
        //main function
        init: function (selector) {
		  $(".address-lookup").on("click", function() {
		  		if($.trim($("#postcode").val())!='') {
			      var geocoder = new google.maps.Geocoder();
			      var address = $("#postcode").val() + ', UK';

			      var error = 0;
			      geocoder.geocode( { 'address': address}, function(results, status) {

			        if (status == google.maps.GeocoderStatus.OK) {

			            if(results.length==0) {
			              error = 1;
			            } else {
			              var latitude = results[0].geometry.location.lat();
			              var longitude = results[0].geometry.location.lng();

			              var latlng = new google.maps.LatLng(latitude, longitude);

			              geocoder.geocode( { 'location': latlng}, function(results1, status1) {

			                var street_no='';
			                var route='';
			                var locality='';
			                var county='';

			                if (status1 == google.maps.GeocoderStatus.OK) {

			                  if(results1.length==0) {
			                    error = 1;
			                  } else {

			                    arrAddress = results1[0].address_components;

			                    formatted_address_result = results1[0].formatted_address;

			                    $.each(arrAddress, function(i, address_component) {

			                      if(address_component.types[0]=='street_number') {
			                        street_no = address_component.long_name;
			                      }

			                      if(address_component.types[0]=='route') {
			                        route = address_component.long_name;
			                      }

			                      if(address_component.types[0]=='locality') {
			                        locality = address_component.long_name;
			                      }

			                      if(address_component.types[0]=='administrative_area_level_2') {
			                        county = address_component.long_name;
			                      }

			                      if(locality=='') {
			                        if(address_component.types[0]=='postal_town') {
			                          locality = address_component.long_name;
			                        }
			                      }

			                    });

			                    $("#address1").val($.trim(route));
			                    $("#town").val($.trim(locality));
			                    $("#county").val($.trim(county));

			                    $("#postcode_final").val($("#postcode").val());

			                  }

			                }
			              });
			            }
			        }

			      });
			    }
		  });
        }
    };
}();
