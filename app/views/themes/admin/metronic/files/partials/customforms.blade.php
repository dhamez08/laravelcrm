<div class="portlet portlet-sortable light bordered" style="height:500px;">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-pin font-yellow-lemon"></i>
			<span class="caption-subject bold font-yellow-lemon uppercase">
			{{$title}} </span>
		</div>
		<ul class="nav nav-tabs">
			<li  class="active">
				<a href="#" data-toggle="tab">
				Files </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line" style="max-height:500px;">
		<div class="list_files_widget">
			@foreach($customerFiles->get()	as $files)
				@if($files->type == $id)
					<p>
						<a href="{{asset('public/documents/' . $files->filename)}}" target="_blank">{{$files->filename}}</a>
						<a 	class="btn red btn-sm deleteFile"
							href="{{
								action(
									'File\ClientFileController@getDeleteFile',
									array(
										'id'=>$files->id,
										'customerid'=>$files->customer_id
									)
								)
							}}"
						>
							<i class="fa fa-trash-o fa-5x"></i>
						</a>
					</p>
				@endif
			@endforeach
		</div>
	</div>
</div>
