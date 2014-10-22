/* Make the control draggable */
	function makeDraggable() {
		$(".selectorField").draggable({ helper: "clone",stack: "div",cursor: "move", cancel: null  });
	}

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


				makeDraggable();
			}
		});		

		/* Make the droppedFields sortable and connected with other droppedFields containers*/
		$( ".droppedFields" ).sortable({
			cancel: null, // Cancel the default events on the controls
			connectWith: ".droppedFields",
		}).disableSelection();

		$(".droppedField").live("click", function() {
			var me = $(this)
			var ctrl = me.find("[class*=ctrl]")[0];
			var ctrl_type = $.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
			var ctrl_name = '';
			if(ctrl.name!==undefined) {
				ctrl_name = ctrl.name;
			} else {
				//get the name for radio button or checkboxes because they're nested
				var item = $("input");
				me.find(item).each(function() {
					ctrl_name = $(this).attr("name");
				});
			}

			customize_ctrl(ctrl_type, this.id, ctrl_name);

			console.log(ctrl_type);
			console.log(this.id);
			console.log(ctrl_name);
		});
	}
	

	/*
		Preview the customized form 
			-- Opens a new window and renders html content there.
	*/

	function save() {
		var selected_content = $("#selected-content").clone();
		var selected_content_html = selected_content.html();
		$("input#form_name").val($("input#form-title").val());
		$("input#form_id_ctr").val(_ctrl_index);
		$("input#content_form").val(selected_content_html);

		var no_name = 0;
		$("#selected-content :input").each(	function() {
			if($(this).attr('name')=='' || !$(this).attr('name')) {
				no_name++;
			}
		});

		if(no_name>0) {
			alert('The form cannot be saved, Please make sure you provide name in each field.');
		} else {
			$("#formsave").submit();
		}
	}
		
	if(typeof(console)=='undefined' || console==null) { console={}; console.log=function(){}}
	
	/* Delete the control from the form */
	function delete_ctrl() {
		if(window.confirm("Are you sure about this?")) {
			var ctrl_id = $("#theForm").find("[name=forCtrl]").val()
			console.log(ctrl_id);
			$("#"+ctrl_id).detach();
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
			o.id = form_id+"-"+values.name+"-"+i;
			$(this).next().attr("for",form_id+"-"+values.name+"-"+i);
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
			radio[0].value = $.trim(o);
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
			checkbox[0].name = values.name+'[]';
			checkbox[0].value = $.trim(o);
			label.append(checkbox);
			$(ctrl).append(label);
		});
	}
	
	save_changes.selectmultiplelist = function(values) {
		console.log(values);
		var div_ctrl = $("#"+values.forCtrl);
		var ctrl = div_ctrl.find("select")[0];
		ctrl.name = values.name+'[]';
		$(ctrl).empty();
		$(values.options.split('\n')).each(function(i,o) {
			$(ctrl).append("<option>"+$.trim(o)+"</option>");
		});
	}
	
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
		var regex = /^[0-9a-zA-Z _]+$/;
		var val=null;
		var new_field_name="";
		var old_field_name="";
		$("#theForm").find("input, textarea").each(function(i,o) {
			if(o.type=="checkbox"){
				val = o.checked;
			} else {
				val = o.value;
			}
			formValues[o.name] = val;
			if(o.name=="name") {
				new_field_name = val;
			}
			if(o.name=="forLastFieldName") {
				old_field_name = val;
			}
			
		});

		var exists = 0;

		if(new_field_name!==old_field_name) {
			
			$("#selected-content :input").each(	function() {
				if($(this).attr('name')===new_field_name && $(this).attr('name')!==old_field_name) {
					exists++;
				}
			});
		}
		if(!new_field_name.match(regex) && new_field_name!='') {
			alert('Field name must only contains letters, numbers, spaces and underscores.');
		} else if(exists>0) {
			alert('Field name already exists. Please choose another!');
		} else {
			save_changes.common(formValues);
			$("#customization_modal").modal("hide");
		}
	}
	
	/*
		Opens the customization window for this
	*/
	function customize_ctrl(ctrl_type, ctrl_id, field_name) {
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
			forCtrl: ctrl_id,
			forLastFieldName: field_name
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