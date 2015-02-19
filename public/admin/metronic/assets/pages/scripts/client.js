/**
Custom module for you to write your own javascript functions
**/
var addAddress = function () {
    // private functions & variables

    // public functions
    return {
        //main function
        init: function () {
        	jQuery('.address-checkbox').click(function(e) {
        		//e.preventDefault();
        		jQuery('#well-' + $(this).val()).toggle();
        	});
        	jQuery('.address-checkbox').each(function(ndx, val) {
        		if($(this).is(':checked')) {
        			jQuery('#well-' + $(this).val()).show();
        		}
        	});
        },
    };

}();

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
					var content = '<div class="phone-wrapper">'
						+'<div class="well">'
								+'<div class="form-group">'
									+'<label class="control-label col-md-3">Number</label>'
									+'<div class="col-md-8">'
										+'<input type="text" name="telephone['+x+'][number]" class="form-control input-sm"/>'
									+'</div>'
								+'</div>'
								+'<div class="form-group">'
									+'<label class="control-label col-md-3">Type</label>'
									+'<div class="col-md-4">'
										+ '<select name="telephone['+x+'][for]" class="form-control input-sm"/>'
										+ '</select>'
									+'</div>'
								+'</div>'
							+'<a href="#" class="btn btn-danger btn-xs remove_field pull-right" style="bottom:6px;margin-bottom: 10px;position:relative;right:9%;">Remove</a>'
						+'</div>';
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
					var content = '<div class="email-wrapper">'
						+'<div class="well">'
								+'<div class="form-group">'
									+'<label class="control-label col-md-3">Email</label>'
									+'<div class="col-md-8">'
										+'<input type="text" name="emails['+x+'][mail]" class="form-control input-sm"/>'
									+'</div>'
								+'</div>'
								+'<div class="form-group">'
									+'<label class="control-label col-md-3">Type</label>'
									+'<div class="col-md-8">'
										+ '<select name="emails['+x+'][for]" class="form-control input-sm"/>'
										+ '</select>'
									+'</div>'
								+'</div>'
							+'<a href="#" class="btn btn-danger btn-xs remove_field pull-right" style="bottom:6px;margin-bottom: 10px;position:relative;right:9%;">Remove</a>'
						+'</div>';
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
					var content = '<div class="website-wrapper">'
						+'<div class="well">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">URL</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="urls['+x+'][url]" class="form-control input-sm"/>'
								+'</div>'
							+'</div>'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">Reference</label>'
								+'<div class="col-md-9">'
									+ '<select name="urls['+x+'][for]" class="form-control input-sm"/>'
									+ '</select>'
								+'</div>'
							+'</div>'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">Type</label>'
								+'<div class="col-md-9">'
								+ '<select name="urls['+x+'][is]" class="form-control input-sm"/>'
								+ '</select>'
							+'</div>'
							+'</div>'
						+'<a href="#" class="remove_field">Remove</a>'
						+'</div>'
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
        return '<div class="well">'
					+ '<div class="row children-wrapper">'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">First Name</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="children['+incrementId+'][firstname]" class="form-control input-sm">'
								+'</div>'
							+'</div>'
						+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">Last Name</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="children['+incrementId+'][lastname]" class="form-control input-sm">'
								+'</div>'
							+'</div>'
						+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">Date of Birth</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="children['+incrementId+'][dob]" data-date-format="dd/mm/yyyy" data-provide="datepicker" placeholder="dd/mm/yyyy" class="form-control input-sm inputdatepicker">'
								+'</div>'
							+'</div>'
						+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
							+'<label class="control-label col-md-3">Relation To Client</label>'
								+'<div class="col-md-9">'
									+'<select name="children['+incrementId+'][relation_to_client]" class="form-control input-sm">'
									+'</select>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>';
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
				jQuery('.inputdatepicker').datepicker({
					autoclose:true,
				});
			});
        }
    };

}();

var addRowChildren = function () {

	var content = function(incrementId) {
        return '<div class="well">'
					+ '<div class="row children-wrapper">'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">First Name</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="children['+incrementId+'][firstname]" class="form-control input-sm">'
								+'</div>'
							+'</div>'
						+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">Last Name</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="children['+incrementId+'][lastname]" class="form-control input-sm">'
								+'</div>'
							+'</div>'
						+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
								+'<label class="control-label col-md-3">Date of Birth</label>'
								+'<div class="col-md-9">'
									+'<input type="text" name="children['+incrementId+'][dob]" data-date-format="dd/mm/yyyy" data-provide="datepicker" placeholder="dd/mm/yyyy" class="form-control input-sm inputdatepicker">'
								+'</div>'
							+'</div>'
						+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
							+'<label class="control-label col-md-3">Relation To Client</label>'
								+'<div class="col-md-9">'
									+'<select name="children['+incrementId+'][relation_to_client]" class="form-control input-sm">'
									+'</select>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>';
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
					jQuery("#baseRelationToClient > option").each(function () {
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
		init:function(ajaxCompanySearchUrl,ajaxCompanySearchUrlInfo){
			var searchCompany = jQuery('#searchCompanyInfo');
			searchCompany.click(function() {
				var company_info = [];
				var company = jQuery("#company").val();
				jQuery.ajax({
					dataType: 'json',
					data: 'company='+company,
					url: ajaxCompanySearchUrl,
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
								url: ajaxCompanySearchUrlInfo,
								success: function(company_data) {
									//var address = jQuery.parseJSON(company_data.registered_address);
									var att = company_data;
									var arr = $.map(att, function(el) { return el; })
									console.log(att);
									console.log(JSON.stringify(company_data));
									jQuery("#duedil_company").val(JSON.stringify(company_data));
									jQuery("#company").val(att.name_formatted);
									jQuery("#companyreg").val(att.company_number);
									jQuery("#address_line_2").val(att.registered_address['full_address'][0]);
									jQuery("#postcode").val(att.registered_address['postcode']);
									jQuery("#address1").val(att.registered_address['full_address'][0] + ', ' + att.registered_address['full_address'][1]);
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

var deletePhone = function() {
	return {
		init:function(){
			jQuery('.deletePhone').click(function(e){
				e.preventDefault();
				var _link = jQuery(this);
				bootbox.confirm("Are you Sure want to delete this phone number?", function (confirmation) {
					confirmation && document.location.assign(_link.attr('href'));
				});
			});
		}
	};
}();
var deleteURL = function() {
	return {
		init:function(){
			jQuery('.deleteURL').click(function(e){
				e.preventDefault();
				var _link = jQuery(this);
				bootbox.confirm("Are you Sure want to delete this website?", function (confirmation) {
					confirmation && document.location.assign(_link.attr('href'));
				});
			});
		}
	};
}();
var deleteEmail = function() {
	return {
		init:function(){
			jQuery('.deleteMail').click(function(e){
				e.preventDefault();
				var _link = jQuery(this);
				bootbox.confirm("Are you Sure want to delete this Email?", function (confirmation) {
					confirmation && document.location.assign(_link.attr('href'));
				});
			});
		}
	};
}();
var deletePerson = function() {
	return {
		init:function(){
			jQuery('.deletePerson').click(function(e){
				e.preventDefault();
				var _link = jQuery(this);
				bootbox.confirm("Are you Sure want to delete this Person?", function (confirmation) {
					confirmation && document.location.assign(_link.attr('href'));
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

var SendIndividualSMS = function () {
    // private functions & variables
	var sendSMS = function() {
		jQuery('#sendIndividualSMS').on('submit',function(e){
	    	e.preventDefault();
	    	var _postUrl 	= jQuery(this).attr('action');
	    	var _formInput 		= jQuery(this).serialize();
			var _button_send 	= 	jQuery('.send-individual-sms');
			var _msg_status 	= 	jQuery('.ajax-container-msg');

			_button_send.button('loading');
			_button_send.attr('disabled','disabled');

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
					if (typeof msg.redirect != 'undefined') {
					    window.location.href = msg.redirect;
					}
				}
			});
	    });
	}

    var modalOnLoaded = function() {
        jQuery('body').on('loaded.bs.modal', '.modal', function () {
			 var redirectUrl = jQuery(location).attr('href');
			 jQuery(this).find('#redirect').val(redirectUrl);
			 jQuery(this).removeData('bs.modal');
			 sendSMS();
		});
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.
            //createNotes();
            modalOnLoaded();
            sendSMS();
        }
    };

}();

