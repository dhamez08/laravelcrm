@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/star-rating/css/star-rating.css" rel="stylesheet" type="text/css"/>
	<style>
		
		div.activeDroppable {
			background-color: #eeffee;
			border: 1px dashed #000;
			min-height: 100px;
		}

		div.hoverDroppable {
			background-color: lightgreen;
		}

		div.draggableField {
			/* float: left; */
			padding-left:5px;
		}
		
		div.draggableField > input,select, button, .checkboxgroup, .selectmultiple, .radiogroup {
			margin-top: 10px;
			
			margin-right: 10px;
			margin-bottom: 10px;
		}

		div.draggableField:hover{
			background-color: #ccffcc;
			cursor: move;
		}

		.radio input[type=radio] {
			position: relative;
			float:left;
		}

		.checkbox input[type=checkbox] {
			position: relative;
			float:left;
		}

		div#selected-content {
			min-height: 300px;
		}
	</style>

	<style id="content-styles">
		/* Styles that are also copied for Preview */
		body {
			margin: 10px 0 0 10px;
		}
		
		.control-label {
			display: inline-block !important;
			padding-top: 5px;
			text-align: right;
			vertical-align: baseline;
			padding-right: 10px;
		}
		
		.droppedField {
			padding-left:5px;
		}

		.droppedField > input,select, button, .checkboxgroup, .selectmultiple, .radiogroup {
			margin-top: 10px;
			
			margin-right: 10px;
			margin-bottom: 10px;
		}

		.action-bar .droppedField {
			float: left;
			padding-left:5px;
		}

		.radio input[type=radio] {
			position: relative;
			float:left;
		}

		.checkbox input[type=checkbox] {
			position: relative;
			float:left;
		}

		
		.col-sm-6 {
			width: 50%;
			float:left;
		}

	</style>


	<script>


	var _ctrl_index = @if(!empty($form->build)) {{ $form->last_field_ctr }} @else 1001 @endif;
	var form_id = {{ $form->id }};
	function preview() {
		console.log('Preview clicked');
		
		// Sample preview - opens in a new window by copying content -- use something better in production code

		
		var selected_content = $("#selected-content").clone();
		selected_content.find("div").each(function(i,o) {
								var obj = $(o)
								obj.removeClass("draggableField ui-draggable well ui-droppable ui-sortable");
							});
		var legend_text = $("#form-title")[0].value;
		
		if(legend_text=="") {
			legend_text="Form builder demo";
		}
		selected_content.find("#form-title-div").remove();
		
		var selected_content_html = selected_content.html();
		
		var dialogContent  ='<html>\n<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>\n';
		dialogContent+= '<link href="{{$asset_path}}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>\n';
		dialogContent+= '<link href="{{$asset_path}}/global/plugins/star-rating/css/star-rating.css" rel="stylesheet" type="text/css"/>\n';
		dialogContent+='<style>\n'+$("#content-styles").html()+'\n</style>\n';
		dialogContent+= '</head>\n<body>';
		dialogContent+= '<legend>'+legend_text+'</legend>';
		dialogContent+= selected_content_html;
		dialogContent+= '\n</body></html>';

		//dialogContent+='<br/><br/><b>Source code: </b><pre>'+$('<div/>').text(dialogContent).html();+'</pre>\n\n';

		dialogContent = dialogContent.replace('\n</body></html>','');
		dialogContent+= '\n</body></html>';
		
		

		//var win = window.open("about:blank");
		//win.document.write(dialogContent);
		$("input#content").val(dialogContent);
		$("#formpreview").submit();
		//return dialogContent;
	}

	</script>

	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			<legend>Form Designer</legend>
		  <div class="tabbable"> 
			<!-- List of controls rendered into Bootstrap Tabs -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#simple" data-toggle="tab">Simple input</a>
				</li>
				<li>
					<a href="#multiple" data-toggle="tab">Radio/Checkbox/List</a>
				</li>
				<li>
					<a href="#rating" data-toggle="tab">Rating</a>
				</li>
				<li>
					<a href="#labels" data-toggle="tab">Labels</a>
				</li>
				<!-- <li>
					<a href="#btns" data-toggle="tab" >Buttons</a>
				</li> -->
			</ul>
			<div class="row-fluid">
			<div id="listOfFields" class="col-md-3 well tab-content">
			  <div class="tab-pane active" id="simple">
				<div class='selectorField draggableField'>
					<label class="control-label">Text Input</label>
					<input type="text" placeholder="Text here..." class="ctrl-textbox form-control"></input>
				</div>
				<div class='selectorField draggableField'>
					<label class="control-label">Multiline Input</label>
					<textarea placeholder="Text here..." class="ctrl-textarea form-control" rows="3"></textarea>
				</div>
				<div class='selectorField draggableField'>
					<label class="control-label">Dropdown</label>
					<select class="ctrl-combobox form-control">
						<option value="option1">Option 1</option>
						<option value="option2">Option 2</option>
						<option value="option3">Option 3</option>
					</select>
				</div>
			  </div>
			  
			  <div class="tab-pane" id="multiple">
				<div class='selectorField draggableField radiogroup'>
					<label class="control-label" style="vertical-align:top">Radio buttons</label>
					<div style="display:inline-block;margin-left:15px" class="ctrl-radiogroup">
						<label class="radio">Option 1<input type="radio" name="" value="option1"></label>
						<label class="radio">Option 2<input type="radio" name="" value="option2"></label>
						<label class="radio">Option 3<input type="radio" name="" value="option3"></label>
					</div>
				</div>
				<div class='selectorField draggableField checkboxgroup' >
					<label class="control-label" style="vertical-align:top">Checkboxes</label>
					<div style="display:inline-block;margin-left:15px" class="ctrl-checkboxgroup">
						<label class="checkbox">Option 1<input type="checkbox" name="" value="option1"></label>
						<label class="checkbox">Option 2<input type="checkbox" name="" value="option2"></label>
						<label class="checkbox">Option 3<input type="checkbox" name="" value="option3"></label>
					</div>
				</div>
				<div class='selectorField draggableField selectmultiple'>
					<label class="control-label">Select multiple</label>
					<div>
						<select multiple="multiple" class="ctrl-selectmultiplelist form-control">
							<option value="option1">Option 1</option>
							<option value="option2">Option 2</option>
							<option value="option3">Option 3</option>
						</select>
					</div>
				</div>
			  </div>
			  <div class="tab-pane" id="rating">
				<div class='selectorField draggableField selectmultiple'>
					<label class="control-label">Rating</label>
					<div>
						<span class="star-cb-group ctrl-rating">
						    <input type="radio" id="rating-5" name="" value="5" /><label for="rating-5" style="margin:0px">5</label>
						    <input type="radio" id="rating-4" name="" value="4" /><label for="rating-4" style="margin:0px">4</label>
							<input type="radio" id="rating-3" name="" value="3" /><label for="rating-3" style="margin:0px">3</label>
							<input type="radio" id="rating-2" name="" value="2" /><label for="rating-2" style="margin:0px">2</label>
							<input type="radio" id="rating-1" name="" value="1" /><label for="rating-1" style="margin:0px">1</label>
							<input type="radio" id="rating-0" name="" value="0" class="star-cb-clear" /><label for="rating-0" style="margin:0px">0</label>
						</span>
					</div>
				</div>
			  </div>
			  <div class="tab-pane" id="labels">
				<div class='selectorField draggableField selectmultiple'>
					<h1 class="control-label ctrl-label">Example Heading</h1>
				</div>
				<div class='selectorField draggableField selectmultiple'>
					<h2 class="control-label ctrl-label">Example Heading</h2>
				</div>
				<div class='selectorField draggableField selectmultiple'>
					<h3 class="control-label ctrl-label">Example Heading</h3>
				</div>
				<div class='selectorField draggableField selectmultiple'>
					<h4 class="control-label ctrl-label">Example Heading</h4>
				</div>
				<div class='selectorField draggableField selectmultiple'>
					<h5 class="control-label ctrl-label">Example Heading</h5>
				</div>
				<div class='selectorField draggableField selectmultiple'>
					<h6 class="control-label ctrl-label">Example Heading</h6>
				</div>
			  </div>
			  <div class="tab-pane" id="btns">
				<div class='selectorField draggableField'>
					<button class="btn ctrl-btn">Simple Button</button>
				</div>
				<div class='selectorField draggableField'>
					<button class="btn btn-primary ctrl-btn">Primary Button</button>
				</div>
				<div class='selectorField draggableField'>
					<button class="btn btn-success ctrl-btn"><i class="icon-ok-sign icon-white"></i> Save Button</button>
				</div>
				<div class='selectorField draggableField'>
					<button class="btn btn-danger ctrl-btn"><i class="icon-trash icon-white"></i> Delete Button</button>
				</div>
			  </div>
		    </div>
			<!-- End of list of controls -->
			
			<!-- 
				Below we have the columns to drop controls
					-- Removed the TABLE based implementations from earlier code
					-- Grid system used for rendering columns 
					-- Columns can be simply added by defining a div with droppedFields class
			-->
			<div class="col-md-9">
				<!--[if lt IE 9]>
				<div class="row-fluid" id="form-title-div">
					<label>Type form title here...</label>
				</div>
				<![endif]-->
			    <div class="row" id="form-title-div" style="margin:15px 0px;margin-top:0px">
				    <input type="text" class="form-control col-md-10" placeholder="Type form Name here" id="form-title" value="{{ $form->name }}">
			    </div>
			  
			    <div class="row-fluid">
				    <div class="portlet box blue tasks-widget">
					    <div class="portlet-title">
						    <div class="caption">
							    Form Canvas <small>(Drag and drop form items here)</small>
						    </div>
					    </div>							
					    <div class="portlet-body" style="padding:15px" id="selected-content">
					    @if(empty($form->build))
						    <div class="row">
					    		<div id="selected-column-1" class="droppedFields col-sm-6"></div>
					    		<div id="selected-column-2" class="droppedFields col-sm-6"></div>
							</div>
							<div class="row">
					    		<div id="selected-column-3" class="droppedFields col-sm-12"></div>
							</div>
							<div class="row">
					    		<div id="selected-column-4" class="droppedFields col-sm-6"></div>
					    		<div id="selected-column-5" class="droppedFields col-sm-6"></div>
							</div>
							<div class="row">
					    		<div id="selected-column-6" class="droppedFields col-sm-12"></div>
							</div>
							<div class="row">
					    		<div id="selected-column-7" class="droppedFields col-sm-6"></div>
					    		<div id="selected-column-8" class="droppedFields col-sm-6"></div>
							</div>
							<div class="row">
					    		<div id="selected-column-9" class="droppedFields col-sm-12"></div>
							</div>
						@else
							{{ $form->build }}
						@endif
						</div>
					</div>
				</div>
			    </div>
			  
			  
			</div>
			<!-- Preview button -->
			<div class="row-fluid">	
				<div class="col-md-12">
				<form action="{{ url('settings/custom-forms/preview') }}" method="post" target="_blank" id="formpreview">
					{{ \Form::token() }}
					<input type="hidden" name="content" id="content">
				</form>

				<form action="{{ url('settings/custom-forms/save-form') }}" method="post" id="formsave">
					{{ \Form::token() }}
					<input type="hidden" name="form_id" value="{{ $form->id }}">
					<input type="hidden" name="form_name" id="form_name" value="{{ $form->id }}">
					<input type="hidden" name="form_id_ctr" id="form_id_ctr" value="">
					<input type="hidden" name="content" id="content_form">
				</form>
				<input type="button" class="btn blue" value="Preview" onclick="preview();">
				<input type="button" class="btn blue" value="Save" onclick="save();">
				</div>
			</div>
		  </div>

		  @include($view_path . '.settings.custom-fields.partials.extras.handlebar-template')

		@stop
	@stop
@stop

@section('body-modals')
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent

	<script src="{{$asset_path}}/pages/scripts/custom-forms-edit.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.0-rc.3/handlebars.min.js"></script>

	<script>
		$(document).ready(docReady); 
	</script>
	@stop
@stop
