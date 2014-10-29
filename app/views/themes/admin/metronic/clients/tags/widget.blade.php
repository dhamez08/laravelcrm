@if($client_tag->count() > 0)
	<ul class="list-unstyled">
		@foreach($client_tag->get() as $val_client_tag)
			<li>
				{{$val_client_tag->tags->tag}}
				<a 	class="btn btn-xs deleteClientTag"
					href="{{
						action(
							'ClientTags\ClientTagsController@getConfirmClientTagDelete',
							array(
								'id'=>$val_client_tag->id,
								'client_id'=>$val_client_tag->customer_id,
							)
						)
					}}"
				>
					<i class="fa fa-trash-o fa-5x"></i>
				</a>
			</li>
		@endforeach
	</ul>
@endif
@if( $tags )
	{{ Form::open(
		array(
				'action' => array(
					'ClientTags\ClientTagsController@postAddTagToClient',
					$client_id
				),
				'method' => 'POST',
				'class' => 'form-horizontal',
				'role'=>'form',
			)
		)
	}}
	<select name="tag_id">
		<option name="0">-Select Tag-</option>
		@foreach($tags as $val_tag)
			<option value="{{$val_tag->id}}">{{$val_tag->tag}}</option>
		@endforeach
	</select>
	{{Form::submit('Add Tag',array('class'=>"btn blue btn-sm"))}}
	{{Form::close()}}
@endif
