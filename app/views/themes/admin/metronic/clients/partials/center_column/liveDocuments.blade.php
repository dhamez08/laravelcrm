<div class="col-md-12">
@if(!$vmd)
	<div class="row-fluid">
		<div class="col-md-12">
			<div class="alert alert-info">No View My Documents provider account has been setup. Please contact our support department.</div>
		</div>
	</div>		
@else

	@if($account['vmd']=="")
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
						<tr>
							<td width="20%">PIN:</td>
							<td>{{ $account['vmd_pin'] }}</td>
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
					@if($shared)
                    <h5 style="margin-top:0px;">Documents Shared with Client</h5>
						<table class="table">
							@foreach($shared as $shared_file)
							<tr>
								<td width="70%">
									<a href="{{ $shared_file['url'] }}" target="_blank">{{ $shared_file['name'] }}</a>

									@if($shared_file['notes']!="")
									<em> - {{ $shared_file['notes'] }}</em>				
									@endif					
								</td>
								<td width="15%" style="text-align:center;">{{ date("d/m/y H:i", strtotime($shared_file['time'])) }}</td>
								<td align="center" style="text-align:center;">
									<a href="{{ $shared_file['url'] }}" target="_blank">View Document</a>
								</td>
							</tr>
							@endforeach
						</table>
					@endif

                    @if($uploaded)
                    <h5 style="margin-top:0px;">Documents Uploaded by Client</h5>
                    <table class="table">
                        @foreach($uploaded as $uploaded_file)
                        <tr>
                            <td width="70%">
                                <a href="{{ $uploaded_file['url'] }}" target="_blank">{{ $uploaded_file['name'] }}</a>

                                @if($uploaded_file['notes']!="")
                                <em> - {{ $uploaded_file['notes'] }}</em>
                                @endif
                            </td>
                            <td width="15%" style="text-align:center;">{{ date("d/m/y H:i", strtotime($uploaded_file['time'])) }}</td>
                            <td align="center" style="text-align:center;">
                                <a href="{{ $uploaded_file['url'] }}" target="_blank">View Document</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @endif

                    @if(!$uploaded && !$shared))
                        No shared and uploaded files by clients
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
								<a href="{{ $uploaded_file['url'] }}" target="_blank">{{ $uploaded_file['name'] }}</a>
								@if($uploaded_file['notes']!="")
								<em> - {{ $uploaded_file['notes'] }}</em>				
								@endif
							</td>
							<td width="15%" style="text-align:center;">{{ date("d/m/y H:i", strtotime($uploaded_file['time'])) }}</td>
							<td align="center" style="text-align:center;"><a href="{{ $uploaded_file['url'] }}" target="_blank">View Document</a>
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
