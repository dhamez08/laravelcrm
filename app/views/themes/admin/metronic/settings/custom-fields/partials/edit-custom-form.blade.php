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
			min-height: 200px;
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

	</style>


		<script>


	/* Make the control draggable */
	function makeDraggable() {
		$(".selectorField").draggable({ helper: "clone",stack: "div",cursor: "move", cancel: null  });
	}

	var _ctrl_index = 1001;
	function docReady() {
		console.log("document ready");
		compileTemplates();
		
		makeDraggable();
		
		$( ".droppedFields" ).droppable({
			  activeClass: "activeDroppable",
			  hoverClass: "hoverDroppable",
			  accept: ":not(.ui-sortable-helper)",
			  drop: function( event, ui ) {
				//console.log(event, ui);
				var draggable = ui.draggable;				
				draggable = draggable.clone();
				draggable.removeClass("selectorField");
				draggable.addClass("droppedField");
				draggable[0].id = "CTRL-DIV-"+(_ctrl_index++); // Attach an ID to the rendered control
				draggable.appendTo(this);				
				

				/* Once dropped, attach the customization handler to the control */
				draggable.click(function () {
										// The following assumes that dropped fields will have a ctrl-defined. 
										//   If not required, code needs to handle exceptions here. 
										var me = $(this)
										var ctrl = me.find("[class*=ctrl]")[0];
										var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
										customize_ctrl(ctrl_type, this.id);
										//window["customize_"+ctrl_type](this.id);
								});

				makeDraggable();
			}
		});		

		/* Make the droppedFields sortable and connected with other droppedFields containers*/
		$( ".droppedFields" ).sortable({
										cancel: null, // Cancel the default events on the controls
										connectWith: ".droppedFields"
									}).disableSelection();
	}
	

	/*
		Preview the customized form 
			-- Opens a new window and renders html content there.
	*/
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
		
	if(typeof(console)=='undefined' || console==null) { console={}; console.log=function(){}}
	
	/* Delete the control from the form */
	function delete_ctrl() {
		if(window.confirm("Are you sure about this?")) {
			var ctrl_id = $("#theForm").find("[name=forCtrl]").val()
			console.log(ctrl_id);
			$("#"+ctrl_id).remove();
		}
	}
	
	/* Compile the templates for use */
	function compileTemplates() {
		window.templates = {};
		window.templates.common = Handlebars.compile($("#control-customize-template").html());
		
		/* HTML Templates required for specific implementations mentioned below */
		
		// Mostly we donot need so many templates
		
		window.templates.textbox = Handlebars.compile($("#textbox-template").html());
		window.templates.textarea = Handlebars.compile($("#textbox-template").html());
		window.templates.combobox = Handlebars.compile($("#combobox-template").html());
		window.templates.selectmultiplelist = Handlebars.compile($("#combobox-template").html());
		window.templates.radiogroup = Handlebars.compile($("#combobox-template").html());
		window.templates.checkboxgroup = Handlebars.compile($("#combobox-template").html());
		window.templates.rating = Handlebars.compile($("#rating-template").html());
		
	}
	
	// Object containing specific "Save Changes" method
	save_changes = {};
	
	// Object comaining specific "Load Values" method. 
	load_values = {};
	
	
	/* Common method for all controls with Label and Name */
	load_values.common = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#"+ctrl_id);
		
		form.find("[name=label]").val(div_ctrl.find('.control-label').text())
		var specific_load_method = load_values[ctrl_type];
		if(typeof(specific_load_method)!='undefined') {
			specific_load_method(ctrl_type, ctrl_id);		
		}
	}
	
	
	
	/* Specific method to load values from a textbox control to the customization dialog */
	load_values.textbox = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#"+ctrl_id);
		var ctrl = div_ctrl.find("input, textarea")[0];
		form.find("[name=name]").val(ctrl.name)		
		form.find("[name=placeholder]").val(ctrl.placeholder)		
	}
	
	load_values.textarea = load_values.textbox;

	load_values.rating = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#"+ctrl_id);
		var ctrl = div_ctrl.find("input")[0];
		form.find("[name=name]").val(ctrl.name)	
	}

	/* Specific method to load values from a combobox control to the customization dialog  */
	load_values.combobox = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#"+ctrl_id);
		var ctrl = div_ctrl.find("select")[0];
		form.find("[name=name]").val(ctrl.name)
		var options= '';
		$(ctrl).find('option').each(function(i,o) { options+=o.text+'\n'; });
		form.find("[name=options]").val($.trim(options));
	}
	// Multi-select combobox has same customization features
	load_values.selectmultiplelist = load_values.combobox;
	
	
	/* Specific method to load values from a radio group */
	load_values.radiogroup = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#"+ctrl_id);
		var options= '';
		var ctrls = div_ctrl.find("div").find("label");
		var radios = div_ctrl.find("div").find("input");
		
		ctrls.each(function(i,o) { options+=$(o).text()+'\n'; });
		form.find("[name=name]").val(radios[0].name)
		form.find("[name=options]").val($.trim(options));
	}
	
	// Checkbox group  customization behaves same as radio group
	load_values.checkboxgroup = load_values.radiogroup;
	
	/* Specific method to load values from a button */
	load_values.btn = function(ctrl_type, ctrl_id) {
		var form = $("#theForm");
		var div_ctrl = $("#"+ctrl_id);
		var ctrl = div_ctrl.find("button")[0];
		form.find("[name=name]").val(ctrl.name)		
		form.find("[name=label]").val($(ctrl).text().trim())		
	}
	
	/* Common method to save changes to a control  - This also calls the specific methods */
	
	save_changes.common = function(values) {
		var div_ctrl = $("#"+values.forCtrl);
		div_ctrl.find('.control-label').text(values.label);
		var specific_save_method = save_changes[values.type];
		if(typeof(specific_save_method)!='undefined') {
			specific_save_method(values);		
		}
	}
	
	/* Specific method to save changes to a text box */
	save_changes.textbox = function(values) {
		var div_ctrl = $("#"+values.forCtrl);
		var ctrl = div_ctrl.find("input, textarea")[0];
		ctrl.placeholder = values.placeholder;
		ctrl.name = values.name;
		//console.log(values);
	}

	save_changes.rating = function(values) {
		var div_ctrl = $("#"+values.forCtrl);
		var ctrl = div_ctrl.find("input");
		$(ctrl).each(function(i,o) {
			o.name = values.name;
		});
	}

	save_changes.textarea= save_changes.textbox;

	/* Specific method to save changes to a combobox */
	save_changes.combobox = function(values) {
		console.log(values);
		var div_ctrl = $("#"+values.forCtrl);
		var ctrl = div_ctrl.find("select")[0];
		ctrl.name = values.name;
		$(ctrl).empty();
		$(values.options.split('\n')).each(function(i,o) {
			$(ctrl).append("<option>"+$.trim(o)+"</option>");
		});
	}
	
	/* Specific method to save a radiogroup */
	save_changes.radiogroup = function(values) {
		var div_ctrl = $("#"+values.forCtrl);
		
		var label_template = $(".selectorField .ctrl-radiogroup label")[0];
		var radio_template = $(".selectorField .ctrl-radiogroup input")[0];
		
		var ctrl = div_ctrl.find(".ctrl-radiogroup");
		ctrl.empty();
		$(values.options.split('\n')).each(function(i,o) {
			var label = $(label_template).clone().text($.trim(o))
			var radio = $(radio_template).clone();
			radio[0].name = values.name;
			label.append(radio);
			$(ctrl).append(label);
		});
	}
	
	/* Same as radio group, but separated for simplicity */
	save_changes.checkboxgroup = function(values) {
		var div_ctrl = $("#"+values.forCtrl);
		
		var label_template = $(".selectorField .ctrl-checkboxgroup label")[0];
		var checkbox_template = $(".selectorField .ctrl-checkboxgroup input")[0];
		
		var ctrl = div_ctrl.find(".ctrl-checkboxgroup");
		ctrl.empty();
		$(values.options.split('\n')).each(function(i,o) {
			var label = $(label_template).clone().text($.trim(o))
			var checkbox = $(checkbox_template).clone();
			checkbox[0].name = values.name;
			label.append(checkbox);
			$(ctrl).append(label);
		});
	}
	
	// Multi-select customization behaves same as combobox
	save_changes.selectmultiplelist = save_changes.combobox;
	
	/* Specific method for Button */
	save_changes.btn = function(values) {
		var div_ctrl = $("#"+values.forCtrl);
		var ctrl = div_ctrl.find("button")[0];
		$(ctrl).html($(ctrl).html().replace($(ctrl).text()," "+$.trim(values.label)));
		ctrl.name = values.name;
		//console.log(values);
	}

	
	/* Save the changes due to customization 
		- This method collects the values and passes it to the save_changes.methods
	*/
	function save_customize_changes(e, obj) {
		//console.log('save clicked', arguments);
		var formValues = {};
		var val=null;
		$("#theForm").find("input, textarea").each(function(i,o) {
			if(o.type=="checkbox"){
				val = o.checked;
			} else {
				val = o.value;
			}
			formValues[o.name] = val;
		});
		save_changes.common(formValues);
	}
	
	/*
		Opens the customization window for this
	*/
	function customize_ctrl(ctrl_type, ctrl_id) {
		console.log(ctrl_type);
		var ctrl_params = {};

		/* Load the specific templates */
		var specific_template = templates[ctrl_type];
		if(typeof(specific_template)=='undefined') {
			specific_template = function(){return ''; };
		}
		var modal_header = $("#"+ctrl_id).find('.control-label').text();
		
		var template_params = {
			header:modal_header, 
			content: specific_template(ctrl_params), 
			type: ctrl_type,
			forCtrl: ctrl_id
		}
		
		// Pass the parameters - along with the specific template content to the Base template
		var s = templates.common(template_params)+"";
		
		
		$("[name=customization_modal]").remove(); // Making sure that we just have one instance of the modal opened and not leaking
		$('<div id="customization_modal" name="customization_modal" class="modal fade" />').append(s).modal('show');
		
		setTimeout(function() {
			// For some error in the code  modal show event is not firing - applying a manual delay before load
			load_values.common(ctrl_type, ctrl_id);
		},300);
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
						<label class="radio">Option 1<input type="radio" name="radioField" value="option1"></label>
						<label class="radio">Option 2<input type="radio" name="radioField" value="option2"></label>
						<label class="radio">Option 3<input type="radio" name="radioField" value="option3"></label>
					</div>
				</div>
				<div class='selectorField draggableField checkboxgroup' >
					<label class="control-label" style="vertical-align:top">Checkboxes</label>
					<div style="display:inline-block;margin-left:15px" class="ctrl-checkboxgroup">
						<label class="checkbox">Option 1<input type="checkbox" name="checkboxField" value="option1"></label>
						<label class="checkbox">Option 2<input type="checkbox" name="checkboxField" value="option2"></label>
						<label class="checkbox">Option 3<input type="checkbox" name="checkboxField" value="option3"></label>
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
						    <input type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5" style="margin:0px">5</label>
						    <input type="radio" id="rating-4" name="rating" value="4" /><label for="rating-4" style="margin:0px">4</label>
							<input type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3" style="margin:0px">3</label>
							<input type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2" style="margin:0px">2</label>
							<input type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1" style="margin:0px">1</label>
							<input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" /><label for="rating-0" style="margin:0px">0</label>
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
						    <table class="table" style="border:0px;">
						    	<tr>
							    	<td style="width:50%;border:0px;padding:0px">
							    		<div id="selected-column-1" class="droppedFields"></div>
							    	</td>
							    	<td style="width:50%;border:0px;padding:0px">
							    		<div id="selected-column-2" class="droppedFields"></div>
							    	</td>
							    </tr>
							    <tr>
							    	<td colspan="2" style="width:100%;border:0px;padding:0px">
							    		<div id="selected-column-3" class="droppedFields"></div>
							    	</td>
							    </tr>
							</table>
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
				<input type="button" class="btn blue" value="Preview" onclick="preview();">
				<input type="button" class="btn blue" value="Save">
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

	<script src="{{$asset_path}}/global/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
	<script src="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.0-rc.3/handlebars.min.js"></script>

	<script>
		$(document).ready(docReady); 
	</script>
	@stop
@stop
