<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-pin font-yellow-lemon"></i>
			<span class="caption-subject bold font-yellow-lemon uppercase">
			{{$title}} </span>
		</div>
		<ul class="nav nav-tabs">
			<li  class="active">
				<a href=".list_files{{$id}}" data-toggle="tab">
				Files </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line">
		<div class="tab-content">
			<div class="tab-pane active list_files{{$id}}" id="">
				<h4>List Files</h4>
				<div>
					{{\MediaLibrary\MediaLibraryController::get_instance()->getDisplay($customer->id, $id);}}
				</div>
				@foreach($customerFiles->get()	as $files)
					@if($files->type == $id)
						<p>
							<a href="{{asset('public/documents/' . $files->filename)}}" target="_blank">{{$files->filename}}</a>
							<a 	class="btn red btn-xs deleteFile"
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
</div>

