<div class="col-md-12">
@if(!$vmd)
	<div class="row-fluid">
		<div class="col-md-12">
            <div class="alert alert-info">
                @if($customer_details['postcode']!="")
                <span>No 'View my Documents' account setup for this client. To enable this service, simply <a href="{{ url('clients/view-my-documents-activate?id='.$clientId.'&enable=yes') }}">click here to activate</a>.</span>
                @else
                <span>No 'View my Documents' account setup for this client. Before you can enable this service, please ensure you have entered the full address including postcode.</span>
                @endif
            </div>
		</div>
	</div>		
@else
	@if($vmd)

	<div class="row-fluid">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<h5 style="margin-top:0px;">Client Account Settings</h5>
					<table width="100%" border="0" cellspacing="0" cellpadding="5">
						<tr>
							<td width="20%">Status:</td>
							<td>Active <small>(<a href="{{ url('clients/view-my-documents-unlink?id='.$clientId.'&enable=no') }}">unlink client</a>)</small></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>         
            
	<div class="row-fluid">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body" style="max-height:400px;overflow:scroll; ">
                    <h5 style="margin-top:0px;">Documents Shared with Client</h5>
					@if($shared)
						<table class="table">
							@foreach($shared as $shared_file)
							<tr>
								<td width="70%">
									<a href="{{ $shared_file->url }}" target="_blank">{{ $shared_file->filename }}</a>

									@if($shared_file->note != "")
									<em> - {{ $shared_file->note }}</em>
									@endif					
								</td>
								<td width="15%" style="text-align:center;">{{ date("d/m/y H:i", strtotime($shared_file->time)) }}</td>
								<td align="center" style="text-align:center;">
									<a href="{{ $shared_file->url }}" target="_blank">View Document</a>
								</td>
							</tr>
							@endforeach
						</table>
					@else
                    The client has not shared any files/documents.
                    @endif
				</div>
			</div>
		</div>
	</div>      
        

	<div class="row-fluid">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<h5 style="margin-top:0px;">Documents Uploaded by Client</h5>
					@if($uploaded)
					<table class="table">
						@foreach($uploaded as $uploaded_file)
						<tr>
							<td width="70%">
								<a href="{{ $uploaded_file->url }}" target="_blank">{{ $uploaded_file->filename }}</a>
								@if($uploaded_file->notes !="")
								<em> - {{ $uploaded_file->notes }}</em>
								@endif
							</td>
							<td width="15%" style="text-align:center;">{{ date("d/m/y H:i", strtotime($uploaded_file->time)) }}</td>
							<td align="center" style="text-align:center;"><a href="{{ $uploaded_file->url }}" target="_blank">View Document</a>
							</td>
						</tr>
						@endforeach
					</table>
					@else		  	
					The client has not uploaded any files/documents.
					@endif
				</div>
			</div>
		</div>
	</div>

	@endif
@endif
</div>

@section('script-footer')
	@parent
		@section('footer-custom-js')
			@parent
		@stop
@stop
