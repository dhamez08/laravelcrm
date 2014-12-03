var TwitterFeeds = function () {

  var feeds = function(base_url,name){
    jQuery.get(base_url + '/twitter/feeds',{ 'screen_name': name },function(response){
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
    init: function (base_url,name) {
      feeds(base_url,name);
    }
  };
}();
