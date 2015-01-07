/**
 * Created by dhamez on 1/6/15.
 */
var Reminder = (function(){
    var getReminderCount = function(){
        setTimeout(function(){
            var request = $.ajax({
                url: baseURL+"/tasks/count",
                type: "GET",
                dataType: "json"
            });

            request.done(function(msg){
                if(msg.result){
                    var header = jQuery('#header_task_bar');

                    if(msg.count == 0){
                        header.find('.badge').remove();
                        header.find('ul.dropdown-menu > li:first').find('p').text('You dont have a pending tasks.');
                        header.find('ul.dropdown-menu').find('.slimScrollDiv > ul').html('');
                    } else {
                        var badge = jQuery('<span>').addClass('badge badge-default').text(msg.count);

                        header.find('.badge').remove();
                        header.find('.icon-calendar').after(badge);
                        header.find('ul.dropdown-menu').find('.slimScrollDiv > ul').html(msg.tasks);
                        header.find('ul.dropdown-menu > li:first').find('p').text('You have '+msg.count+' tasks reminder.');

                        if(msg.reminder){
                            //Pop up reminder with sound.
                        }
                    }
                    getReminderCount();
                }
            })
        }, 30000);
    }

    return {
        init: function(){
            getReminderCount()
        }
    }
})();