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
                            if(jQuery('body .bootbox.modal').length == 0){
                                var task_table = $('<table>').attr('id','task-reminders').addClass('table table-condensed table-feeds').append('<tbody>');
                                task_table.find('tbody').html(msg.reminder);
                                var audio = new Audio(baseURL+'/public/admin/metronic/assets/global/sounds/reminder.mp3');
                                audio.play();
                                bootbox.dialog({
                                    title: "Task Reminder",
                                    message: task_table,
                                    buttons: {
                                        "Dismiss": {
                                            label: "Dismiss All",
                                            className: "btn-primary",
                                            callback: function() {
                                                var task_ids = new Array();
                                                jQuery('#task-reminders').find('tr').each(function(){
                                                    task_ids.push($(this).data('task-id'));
                                                })
                                                var dismiss = $.ajax({
                                                    url: baseURL+"/tasks/dismiss",
                                                    type: "POST",
                                                    dataType: "json",
                                                    data: {'tasks_ids': task_ids}
                                                });
                                                dismiss.done(function(msg){
                                                    if(msg.result){
                                                        $('button.bootbox-close-button.close').click();
                                                    }
                                                });
                                            }
                                        }
                                    }
                                });
                            }
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