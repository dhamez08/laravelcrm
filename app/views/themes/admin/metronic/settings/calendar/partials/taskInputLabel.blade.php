<div class="col-md-12">
	<div class="row" style="margin-top:20px;">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Action Name</label>
				{{
					Form::text(
						'action_name',
						null,
						array(
							'class'=>'form-control'
						)
					);
				}}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Action Icons</label>
				<select name="icons" class="bs-select form-control" data-show-subtext="true" data-live-search="true">
				@foreach($icons as $icon )
					<option value="{{$icon}}" data-icon="{{$icon}}">{{$icon}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Action Icons</label>
				<select name="color" class="bs-select form-control" data-show-subtext="true" data-live-search="true">
				@foreach($color_label as $color )
					<option value="{{$color}}" data-content='<span class="swatch" style="height: 20px;width:50px;display:block;float:left;margin-right:10px;background-color: {{$color}}"></span> {{$color}}'>{{$color}}</option>
				@endforeach
				</select>
			</div>
		</div>
	</div>
</div>
