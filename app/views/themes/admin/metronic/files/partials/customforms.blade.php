<div class="portlet portlet-sortable light bordered">
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
	<div class="portlet-body tabbable-line">
		<h4>List Files</h4>
		@foreach($customerFiles->get()	as $files)
			@if($files->type == $id)
				<p>
					<a href="{{asset('public/documents/' . $files->filename)}}" target="_blank">{{$files->filename}}</a>
					-
					{{link_to(
						'#',
						$files->name,
						array(
							'class'=>'clientFiles editable editable-click',
							'data-pk'=>$files->id,
							'data-name'=>'name',
							'data-type'=>'text',
							'data-url'=>url('file/ajax-update-name'),
							'data-title'=>'Update Category',
						)
						);
					}}
					-
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

