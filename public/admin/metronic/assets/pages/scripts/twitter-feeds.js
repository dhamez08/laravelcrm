var TwitterFeeds = function () {

  var feeds = function(name){
    jQuery.get('/twitter/feeds',{ 'screen_name': name },function(response){
      var html = '';
      jQuery.each(response,function(key,val){
        html += '<li>';
        html += val['html'];
        html += '</li>';
      });

      jQuery("#twitter ul.feeds").html(html);
    });
  };

  // public functions
  return {

    //main function
    init: function (name) {
      feeds(name);
    }
  };
}();
