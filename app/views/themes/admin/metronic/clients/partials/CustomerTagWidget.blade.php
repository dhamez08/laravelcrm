<div id="client-tags-dis" class="row client-tags hide">
	<div class="col-md-12">
		<i class="icon-tag"></i>
		<span id="client-profile-tags-list">
			@if(count(\CustomerTags\CustomerTags::CustomerTag()->where('customer_id','=',$customer->id)->get()) > 0)
				@foreach(\CustomerTags\CustomerTags::CustomerTag()->where('customer_id','=',$customer->id)->get() as $tag)
					<span class="c_tag_list_item" id="customer_tag_d_{{$tag->id}}">{{$tag->text}},</span>
				@endforeach
			@endif
		</span>
		<a href="#" id="edit-tags-button">{{(count(\CustomerTags\CustomerTags::CustomerTag()->where('customer_id','=',$customer->id)->get()) >= 1) ? 'Edit Tags': 'Add Tags'}}</a>
	</div>
	<div id="edit-tags-inputs" class="col-md-12 hide">
		<input id="tags_1" type="hidden" class="form-control select2" value="
			@if(count(\CustomerTags\CustomerTags::CustomerTag()->where('customer_id','=',$customer->id)->get()))
				@foreach(\CustomerTags\CustomerTags::CustomerTag()->where('customer_id','=',$customer->id)->get() as $tag)
					{{$tag->id}},
				@endforeach
			@endif
		"/>
	</div>
</div>
