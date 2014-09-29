var UpdateModal = function () {
    // private functions & variables

    // public functions
    return {

        //main function
        init: function () {
            $('.editOpportunity').on("click", function() {
            	var id = $(this).attr('opportunity-id');

            	op_name = $("input#opportunity_edit_name_"+id).val();
            	op_text = $("input#opportunity_edit_desc_"+id).val();
            	op_milestone = $("input#opportunity_edit_milestone_"+id).val();
            	op_probability = $("input#opportunity_edit_probability_"+id).val();
            	op_value = $("input#opportunity_edit_value_"+id).val();
            	op_close_date = $("input#opportunity_edit_close_date_"+id).val();
                op_tags = $("input#opportunity_edit_tags_"+id).val();

                tags_array = op_tags.split(",");

            	var modal_container = $("#add-opportunity-form-modal");
            	modal_container.find(".modal-title").html("Update Opportunity");
            	modal_container.find("#opportunity-id-hidden").val(id);
            	modal_container.find("input[name='opportunity_name']").val(op_name);
            	modal_container.find("textarea[name='opportunity_description']").val(op_text);
            	modal_container.find("input[name='expected_value']").val(op_value);
            	modal_container.find("select[name='milestone']").val(op_milestone);
            	modal_container.find("select[name='probability']").val(op_probability);
            	modal_container.find("input[name='close_date']").val(op_close_date);
                modal_container.find("select[name='tag[]']").val(tags_array);
                //modal_container.find("select[name='tag[]']").multiselect("refresh");

            	modal_container.modal();
            
            });

			$("#addOpportunity").on("click", function() {
				var modal_container = $("#add-opportunity-form-modal");
            	modal_container.find(".modal-title").html("Add new Opportunity");
            	modal_container.find("#opportunity-id-hidden").val('');
            	modal_container.find("input[name='opportunity_name']").val('');
            	modal_container.find("textarea[name='opportunity_description']").val('');
            	modal_container.find("input[name='expected_value']").val('');
            	modal_container.find("select[name='milestone']").val('0');
            	modal_container.find("select[name='probability']").val('0');
            	modal_container.find("input[name='close_date']").val('');
                modal_container.find("select[name='tag[]']").val('');

            	modal_container.modal();
			});
        },
    };

}();