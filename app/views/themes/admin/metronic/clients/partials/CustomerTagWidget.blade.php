<div id="client-tags-dis" class="col-md-12 col-summary client-tags hide">
	<p>
		<i class="icon-tag"></i>
		<span id="client-profile-tags-list">
			@if(count($tags))
				@foreach($tags as $tag)
					<span id="customer_tag_d_{{$tag->id}}">{{$tag->text}},</span>
				@endforeach
			@endif
		</span>
		<a href="#" id="edit-tags-button">Edit Tags</a>
	</p>
	<p id="edit-tags-inputs" class="col-md-12 hide">
		<input id="tags_1" type="hidden" class="form-control select2" value="
			@if(count($tags))
				@foreach($tags as $tag)
					{{$tag->id}},
				@endforeach
			@endif
		"/>
	</p>	
</div>	