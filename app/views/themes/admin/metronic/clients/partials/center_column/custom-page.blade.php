<div class="col-md-12">
	<!--section 1-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					@if($customtab->section1)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> {{ $customtab->section1_name }}</span>
						</div>
					@endif
					<div class="actions">
						@if($customtab->section1)
							@if($customtab->section1==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section1notes-modal">
							@elseif($customtab->section1==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section1files-modal">
							@elseif($customtab->section1==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section1form-modal">
							@endif
							<i class="fa fa-plus"></i> Add </a>
						@else
							<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-pencil"></i> Configure this section </a>
						@endif
						
					</div>
				</div>
				<div class="portlet-body">
					<div class="" style="position: relative; overflow-y: auto; width: auto; height: 200px;">
					@if($customtab->section1)
						No data has been added.
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@include($view_path.'.clients.partials.modals.customtabs.section1-modals')

	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					@if($customtab->section2)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> {{ $customtab->section2_name }}</span>
						</div>
					@endif
					<div class="actions">
						@if($customtab->section2)
							@if($customtab->section2==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section2notes-modal">
							@elseif($customtab->section2==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section2files-modal">
							@elseif($customtab->section2==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section2form-modal">
							@endif
							<i class="fa fa-plus"></i> Add </a>
						@else
							<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-pencil"></i> Configure this section </a>
						@endif
					</div>
				</div>
				<div class="portlet-body">
					<div class="" style="position: relative; overflow-y: auto; width: auto; height: 200px;">
					@if($customtab->section2)
						No data has been added.
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@include($view_path.'.clients.partials.modals.customtabs.section2-modals')

	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					@if($customtab->section3)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> {{ $customtab->section3_name }}</span>
						</div>
					@endif
					<div class="actions">
						@if($customtab->section3)
							@if($customtab->section3==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section3notes-modal">
							@elseif($customtab->section3==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section3files-modal">
							@elseif($customtab->section3==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section3form-modal">
							@endif
							<i class="fa fa-plus"></i> Add </a>
						@else
							<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-pencil"></i> Configure this section </a>
						@endif
					</div>
				</div>
				<div class="portlet-body">
					<div class="" style="position: relative; overflow-y: auto; width: auto; height: 200px;">
					@if($customtab->section3)
						No data has been added.
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@include($view_path.'.clients.partials.modals.customtabs.section3-modals')

	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					@if($customtab->section4)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> {{ $customtab->section4_name }}</span>
						</div>
					@endif
					<div class="actions">
						@if($customtab->section4)
							@if($customtab->section4==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section4notes-modal">
							@elseif($customtab->section4==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section4files-modal">
							@elseif($customtab->section4==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section4form-modal">
							@endif
							<i class="fa fa-plus"></i> Add </a>
						@else
							<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-pencil"></i> Configure this section </a>
						@endif
					</div>
				</div>
				<div class="portlet-body">
					<div class="" style="position: relative; overflow-y: auto; width: auto; height: 200px;">
					@if($customtab->section4)
						No data has been added.
					@endif	
					</div>
				</div>
			</div>
		</div>
	</div>

@include($view_path.'.clients.partials.modals.customtabs.section4-modals')

</div>