var UpdateModal = function () {
    // private functions & variables

    // public functions
    return {

        //main function
        init: function () {
            $('.editOpportunity').on("click", function() {
            	alert($(this).attr('opportunity-id'));
            });
        },
    };

}();