/**
Custom module for you to write your own javascript functions
**/
var Index = function () {

    // public functions
    return {

        //main function
        init: function () {
            jQuery('.scroller').slimScroll({
				height: '300px'
			});
        },

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();
