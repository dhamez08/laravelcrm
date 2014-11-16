/**
Custom module to toggle client profile navigation bar
**/
var profileLink = function () {
    var handleTagsInput = function (clientId,customerId) {
        jQuery.get("http://laravelcrm.dev/settings/tags/clients/client-tag/"+clientId,function(response){
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
            	handleDeleteTags(customerId,removed.id);
            } else if(typeof e.added != "undefined"){
            	handleSaveTags(customerId,added.id);
            }
        });
    };
    
    var handleDisplayTags = function(customerId){
    	jQuery.get("http://laravelcrm.dev/settings/tags/clients/customer-tag/"+customerId,function(response){
    		var list = '';
    		jQuery.each(response,function(i,item){
    			list += '<span id="customer_tag_d_'+item.id+'">';
    			list += item.text;
    			list += '</span>';
    		});
        	jQuery("#client-profile-tags-list").html(list);
        });
    };

    var handleDeleteTags = function(customerId,id){
    	jQuery.get("http://laravelcrm.dev/settings/tags/clients/delete-customer-tags/"+customerId+"/"+id,function(response){
    		if(response.status == 1){
    			jQuery("#client-profile-tags-list #customer_tag_d_"+id).remove();
    		}
        });
    };
    
    var handleSaveTags = function(customerId,id){
    	jQuery.get("http://laravelcrm.dev/settings/tags/clients/save-customer-tags/"+customerId+"/"+id,function(response){
    		var list = '';
    		if(response.status == 1){
    			list += '<span id="customer_tag_d_'+id+'">';
    			list += response.item.text;
    			list += ',</span>';
    		
        		jQuery("#client-profile-tags-list").append(list);
        	}
        });
    };

    var handleLinksToggle = function(){
        jQuery("div.profilemenu a.client_menu").click(function(e){ //on add input button click
                e.preventDefault();
                var link = jQuery(this).attr('href');
                if(jQuery(link).is(':hidden')){
                    jQuery("div.collapse-profile-menu").hide('slow');
                }
                jQuery(link).fadeToggle('slow'); 
            });
    };

    var handleEditTags = function(){
        jQuery("#edit-tags-button").click(function(e){
            e.preventDefault();
            if(jQuery(this).text() == "Edit Tags"){
                if(jQuery("#edit-tags-inputs").is(":hidden")){
                    jQuery("#edit-tags-inputs").fadeToggle('slow');
                    jQuery(this).html("Done Editing Tags");
                }
            } else if(jQuery(this).text() == "Done Editing Tags"){
                jQuery("#edit-tags-inputs").fadeToggle('slow');
                jQuery(this).html("Edit Tags");
            }
        });
    };
    
    var handleClientTags = function(){
    	jQuery("#toggle-client-tags").click(function(e){
    		e.preventDefault();
    		if(jQuery("#client-tags-dis").is(':hidden')){
    			jQuery("#edit-tags-inputs").hide();
    			jQuery("#edit-tags-button").html("Edit Tags");
    		}
    		jQuery("#client-tags-dis").fadeToggle('slow');
    	});	
    };
    
    var hideElementsInPage = function(){
    	jQuery("div.collapse-profile-menu").hide();
        jQuery("#edit-tags-inputs").hide();
        jQuery("#client-tags-dis").hide();
    };
    
    // public functions
    return {

        //main function
        init: function (client,customer) {
        	hideElementsInPage();
        	handleTagsInput(client,customer);
            handleLinksToggle();
            handleEditTags();
            handleClientTags();
        },
    };

}();