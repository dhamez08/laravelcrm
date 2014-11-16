var clientFileSearch = function(){
	var filesearch = function(baseURL){
		jQuery("#filekeysearch").keyup(function (e) {
            e.preventDefault();
            filesearchload(baseURL);
        });
	};
	
	var filesearchload = function(baseURL){
            var input = jQuery("#filekeysearch").val();
            var client = jQuery("#filekeysearchclient").val();
            jQuery.ajax({
            	url: baseURL+'/file/search/'+client,
            	data: { 'file_search_value': input},
            	type: "GET",
            	dataType: "json",
            	success: function(data){
            		var list = '';
            		if(data.length > 0){
            			jQuery.each(data,function(key,item){
		            		list += '	<li>';
							list += '		<div class="col1">';
							list += '			<div class="cont">';
							list += '				<div class="cont-col1">';
							list += '					<div class="label label-sm label-info">';
							list += '						<i class="fa fa-file-o"></i>';
							list += '					</div>';
							list += '				</div>';
							list += '				<div class="cont-col2">';
							list += '					<div class="desc">';
							list += '						<a download href="'+baseURL+'/public/documents/'+item.filename+'" title="Open File">'+item.filename+'</a>';
							list += '					</div>';
							list += '				</div>';
							list += '			</div>';
							list += '		</div>';
							list += '		<div class="col2">';
							list += '			<a href="'+baseURL+'/file/delete-file-summary/'+item.id+'/'+item.customer_id+'" class="pull-right" title="Delete File"><i class="icon-trash"></i> </a>';
							list += '		</div>';
							list += '	</li>';
            			});
            		} else {
            			list += '	<li>';
						list += '		<div class="col1">';
						list += '			<div class="cont">';
						list += '				<div class="cont-col1">';
						list += '					<div class="label label-sm label-info">';
						list += '						<i class="fa fa-info-circle"></i>';
						list += '					</div>';
						list += '				</div>';
						list += '				<div class="cont-col2">';
						list += '					<div class="desc">';
						list += '						No File Found!';
						list += '					</div>';
						list += '				</div>';
						list += '			</div>';
						list += '		</div>';
						list += '		<div class="col2">';
						list += '		</div>';
						list += '	</li>';
            		}
            		
            		jQuery("#filesearchfeed").html(list);
            	} 
            });
	};
	return {
		init: function(baseURL){
			filesearchload(baseURL);
			filesearch(baseURL);
		},
	};
}();
