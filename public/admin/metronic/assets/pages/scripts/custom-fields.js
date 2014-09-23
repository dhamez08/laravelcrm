$(function(){

	var CustomField = function () {

		var init = function() {
			setupListeners();
		}

		var setupListeners = function() {
			$("#addForm").on("click", function() {
				addForm();
			});

			$("select.itemType").live("change", function() {
				updateForm($(this));
			});
		}

		var addForm = function() {
			row = '<div class="panel panel-default">';
				row+= '<div class="panel-body formBody">';
					row+= '<div>';
						row+= '<div class="form-group">';
							row+= '<label>Item Type</label>';
							row+= selectoption;
						row+= '</div>';
					row+= '</div>';
					row+= '<div>';
						row+= '<div class="form-group">';
							row+= '<label>Item Name</label>';
							row+= '<input type="text" class="form-control" name="item_name[]" placeholder="Enter name for this item">';
						row+= '</div>';
					row+= '</div>';
					row+= '<div>';
						row+= '<div class="form-group hasPlaceholder">';
							row+= '<label>Item Placeholder</label>';
							row+= '<input type="text" class="form-control" name="item_placeholder[]" placeholder="Enter placeholder text">';
						row+= '</div>';
						row+= '<div class="form-group dropdownOption" style="display:none">';
							row+= '<label>Item Values (separate values with semicolon):</label>';
							row+= '<input type="text" class="form-control" name="item_values[]" placeholder="Enter dropdown values">';
						row+= '</div>';
					row+= '</div>';
				row+= '</div>';
			row+= '</div>';

			$(".formContainer").append(row);
		}

		var updateForm = function(form) {
			if(form.val()==1 || form.val()==4 || form.val()==5) {
				form.parents(".formBody").children().children(".hasPlaceholder").show();
				form.parents(".formBody").children().children(".dropdownOption").hide();
			} else if(form.val()==2) {
				form.parents(".formBody").children().children(".hasPlaceholder").hide();
				form.parents(".formBody").children().children(".dropdownOption").show();
			} else if(form.val()==3 || form.val()==6) {
				form.parents(".formBody").children().children(".hasPlaceholder").hide();
				form.parents(".formBody").children().children(".dropdownOption").hide();
			}
		}

	    return {
	        init: init
	    };

	}();

	CustomField.init();

});