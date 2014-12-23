var ClientSearch = function(){
    var baseURL = '';

    var setBaseURL = function( url ){
        this.baseURL = url;
    };

    var getBaseURL = function(){
      return this.baseURL;
    };

    var Listeners = function(){
        $(document).on("input","#clientSearch input[type='text']",function(e){
            var input = $(this).val();

            if ( e.which == 13 ) {
                e.preventDefault();
                getClients( input );
            } else {
                getClients( input );
            }
        });
    };

    var getClients = function( keyword ){
        $("#clientSearch button").html('<i class="fa fa-spinner fa-spin"></i>');
        $.get( getBaseURL()+"/clients/clientlist",{ keyword: keyword }, function( response ){

            var layout = '';
            if( response.length > 0) {
                $.each(response, function (i, s) {
                    layout += '<li>';
                    layout += '<i class="fa fa-user"></i>';
                    layout += '<a href="' + getBaseURL() + '/clients/client-summary/' + s.id + '">';
                    if (s.type == 2) {
                        layout += s.company_name;
                    } else {
                        layout += s.first_name + ' ' + s.last_name;
                    }
                    layout += '</a>';
                    layout += '</li>';
                });
            } else {
                layout += '<li>No Record Found!</li>';
            }

            $(".client-list-top").html(layout);
            $("#clientSearch button").html('<i class="fa fa-search"></i>');
        });
    };

    return {
        init: function ( url ) {
            setBaseURL( url );
            Listeners();
        }
    };
}();