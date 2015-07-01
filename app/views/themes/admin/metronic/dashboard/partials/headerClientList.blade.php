<div class="page-bar">
	<ul class="page-breadcrumb client-list-top">
		@if($clientTopList->count() > 0 )
			@foreach($clientTopList->get() as $client)
				<li>
					<i class="fa fa-user"></i>
					<a href="{{url('clients/client-summary') . '/' . $client->id}}">{{($client->type == 2) ? $client->company_name:$client->first_name ." ". $client->last_name}}</a>
				</li>
			@endforeach
		@endif
	</ul>
	<div style="width:25%" class="page-toolbar" id="clientSearch">
		<div class="pull-right" style="width:100%;">
			<div class="input-group">
				<input type="text" placeholder="Search Client" class="form-control">
				<span class="input-group-btn">
				<button type="button" class="btn blue"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>
	</div>
</div>
@yield('additonal-pagebar')
@if(isset($customer))
	@include($view_path.'.clients.partials.CustomerTagWidget')
@endif

@section('script-footer')
	@parent
		@section('footer-custom-js')
			@parent
			<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client-search.js"></script>
			<script>
				jQuery(document).ready(function() {
					//ClientSearch.init( baseURL );

				$("#clientSearch input").select2({
				    placeholder: "Search Client",
				    minimumInputLength: 3,
				    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
				        url: "{{ url('clients/clientlist') }}",
				        dataType: 'json',
				        quietMillis: 250,
				        data: function (term, page) {
				            return {
				                keyword: term, // search term
				            };
				        },
				        results: function (data, page) { // parse the results into the format expected by Select2.
				            // since we are using custom formatting functions we do not need to alter the remote JSON data
				            //return { results: data };
				            return {
				                results :
				                    data.map(function(item) {
				                        return {
				                            id : item.customer_id,
				                            first_name : item.first_name,
				                            last_name : item.last_name
				                        };
				                    }
				            )};				            
				        },
				        cache: true
				    },
				    /*
				    initSelection: function(element, callback) {
				        // the input tag has a value attribute preloaded that points to a preselected repository's id
				        // this function resolves that id attribute to an object that select2 can render
				        // using its formatResult renderer - that way the repository name is shown preselected
				        var id = $(element).val();
				        if (id !== "") {
				            $.ajax("https://api.github.com/repositories/" + id, {
				                dataType: "json"
				            }).done(function(data) { callback(data); });
				        }
				    },
				    */
				    formatResult: function(data) {
				    	return data.first_name + ' ' + data.last_name;
				    },
				    formatSelection: function(data) {
				    	return data.first_name + ' ' + data.last_name;
				    }
				    //dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
				    //escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
				});

				$("#clientSearch input").on('change', function(e) {
					//console.log(e.val);
					if ( parseInt(e.val) ){
						window.location = "{{ url('clients/client-summary') }}/" + e.val;
					}
				});

				});
			</script>
		@stop
@stop