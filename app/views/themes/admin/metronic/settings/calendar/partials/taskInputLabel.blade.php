<div class="form-group">
	<div class="col-xs-2">
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
<div class="form-group">
	<div class="col-xs-12">
	<label class="control-label">Action Icons</label>
		<div class="icons-list">
			<ul class="nav nav-pills list-unstyled list-unstyled icons-list-wrapper">
			@foreach($icons as $icon )
				<li>
					{{
						Form::radio(
							'icons',
							$icon,
							false,
							array(
								'class'=>'form-control'
							)
						);
					}}
					<i class="fa {{$icon}} fa-2x"></i>
				</li>
			@endforeach
			</ul>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-xs-12">
	<label class="control-label">Color Icons</label>
		<div class="color-label-list">
			<ul class="nav nav-pills list-unstyled list-unstyled color-label-wrapper">
			@foreach($color_label as $color )
				<li>
					{{
						Form::radio(
							'color',
							$color,
							false,
							array(
								'class'=>'form-control'
							)
						);
					}}
					<span class="swatch" style="height: 40px;width:50px;display:block;background-color: {{$color}}"></span>
				</li>
			@endforeach
			</ul>
		</div>
	</div>
</div>
