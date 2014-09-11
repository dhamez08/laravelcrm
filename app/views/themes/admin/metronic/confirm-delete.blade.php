@extends( $main_view_blade )

@section('body-content')
	@parent
	@section('innerpage-main-content')
	{{
		Form::open(
			array(
				'action' => $confirm_form_action,
				'class' => '',
				'method'=>'DELETE'
			)
		)
	}}
		<div class="alert alert-block alert-{{$confirm_type}}">
			<!--<button data-dismiss="alert" class="close" type="button"></button>-->
			<h2 class="alert-heading">{{$confirm_heading}}</h2>
			<div>
				<h4>{{$confirm_content}}</h4>
			</div>
		</div>

		@foreach($confirm_button as $key=>$val)
			@if( isset($val['type']) && $val['type'] == 'button' )
				<button type="submit" class="btn {{$val['color']}}">{{$key}}</button>
			@elseif( isset($val['type']) && $val['type'] == 'link' )
				<a href="{{$val['url']}}" class="btn blue">{{$key}}</a>
			@endif
		@endforeach
	{{ Form::close() }}
	@stop
@stop
