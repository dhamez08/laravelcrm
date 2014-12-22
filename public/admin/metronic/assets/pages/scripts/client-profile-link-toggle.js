/**
Custom module to toggle client profile navigation bar
**/
var profileLink = function () {
    var handleTagsInput = function (baseURL,clientId,customerId) {
        jQuery.get(baseURL+"/settings/tags/clients/client-tag/"+clientId,function(response){
        	jQuery("#tags_1").select2({
        		multiple: true,
        		data: response
        	});
        });
        jQuery("#tags_1").on("change",function(e){
        	var data = jQuery(this).val();
            var dis = data.replace(new RegExp(',', 'g'), '</span>, <span>');
            var val = e.val, added = e.added, removed = e.removed;
            if(typeof e.removed != "undefined"){
            	handleDeleteTags(baseURL,customerId,removed.id);
            } else if(typeof e.added != "undefined"){
            	handleSaveTags(baseURL,customerId,added.id);
            }
        });
    };

    var handleDisplayTags = function(baseURL,customerId){
    	jQuery.get(baseURL+"/settings/tags/clients/customer-tag/"+customerId,function(response){
    		var list = '';
    		jQuery.each(response,function(i,item){
    			list += '<span id="customer_tag_d_'+item.id+'">';
    			list += item.text;
    			list += '</span>';
    		});
        	jQuery("#client-profile-tags-list").html(list);
        });
    };

    var handleDeleteTags = function(baseURL,customerId,id){
    	jQuery.get(baseURL+"/settings/tags/clients/delete-customer-tags/"+customerId+"/"+id,function(response){
    		if(response.status == 1){
    			jQuery("#client-profile-tags-list #customer_tag_d_"+id).remove();
    		}
        });
        var countTags = jQuery("span.client-profile-tags-list span.c_tag_list_item").length;
        if(parseInt(countTags) > 0){
          jQuery(this).html("Edit Tags");
        } else {
          jQuery(this).html("Add Tags");
        }
    };

    var handleSaveTags = function(baseURL,customerId,id){
    	jQuery.get(baseURL+"/settings/tags/clients/save-customer-tags/"+customerId+"/"+id,function(response){
    		var list = '';
    		if(response.status == 1){
    			list += '<span id="customer_tag_d_'+id+'">';
    			list += response.item.text;
    			list += ',</span>';

        		jQuery("#client-profile-tags-list").append(list);
        	}
        });
        var countTags = jQuery("span.client-profile-tags-list span.c_tag_list_item").length;
        if(parseInt(countTags) > 0){
          jQuery(this).html("Edit Tags");
        } else {
          jQuery(this).html("Add Tags");
        }
    };

    var handleLinksToggle = function(){
        jQuery("div.profilemenu a.client_menu").click(function(e){ //on add input button click
                e.preventDefault();
                var link = jQuery(this).attr('href');
                if(jQuery(link).is(':hidden')){
                    jQuery("div.collapse-profile-menu").hide('slow');
                }
                jQuery(link).fadeToggle('slow');
                Metronic.scrollTo(jQuery(link));
            });
    };

    var handleEditTags = function(){
        jQuery("#edit-tags-button").click(function(e){
            var countTags = jQuery("span.client-profile-tags-list span.c_tag_list_item").length;
            e.preventDefault();
            if((jQuery(this).text() == "Edit Tags") || (jQuery(this).text() == "Add Tags")){
                if(jQuery("#edit-tags-inputs").is(":hidden")){
                    jQuery("#edit-tags-inputs").fadeToggle('slow');
                    jQuery(this).html("Done Editing Tags");
                }
            } else if(jQuery(this).text() == "Done Editing Tags"){
                jQuery("#edit-tags-inputs").fadeToggle('slow');
                if(parseInt(countTags) > 0){
                  jQuery(this).html("Edit Tags");
                } else {
                  jQuery(this).html("Add Tags");
                }
            }
        });
    };

    var handleClientTags = function(){
    	jQuery("#toggle-client-tags").click(function(e){
        var countTags = jQuery("span.client-profile-tags-list span.c_tag_list_item").length;
        e.preventDefault();
    		if(jQuery("#client-tags-dis").is(':hidden')){
    			jQuery("#edit-tags-inputs").hide();
          if(parseInt(countTags) > 0){
            jQuery("#edit-tags-button").html("Edit Tags");
          } else {
    			  jQuery("#edit-tags-button").html("Add Tags");
          }
    		}
    		jQuery("#client-tags-dis").fadeToggle('slow');
    	});
    };

    var hideElementsInPage = function(){
    	jQuery("div.collapse-profile-menu").hide().removeClass('hide');
        jQuery("#edit-tags-inputs").hide().removeClass('hide');
        jQuery("#client-tags-dis").hide().removeClass('hide');
    };

    // public functions
    return {

        //main function
        init: function (baseURL,client,customer) {
        	hideElementsInPage();
        	handleTagsInput(baseURL,client,customer);
            handleLinksToggle();
            handleEditTags();
            handleClientTags();
        }
    };

}();
