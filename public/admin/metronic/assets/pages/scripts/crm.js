/**
Custom module for you to write your own javascript functions
**/
var Index = function () {

	var modalEvent = function(){
		jQuery('body').on('show.bs.modal', '.modal', function () {
			//jQuery(this).find('.modal-body').html('');
			jQuery(this).removeData('bs.modal');
		});
		jQuery('body').on('loaded.bs.modal', '.modal', function () {
			jQuery(this).removeData('bs.modal');
		});
		jQuery('body').on('hidden.bs.modal', '.modal', function () {
			jQuery(this).removeData('bs.modal');
		});
	}

	var slimScroll = function(){
		jQuery('.scroller').slimScroll({
			height: '300px'
		});
	}

	var inputDatePicker = function(){
		jQuery('.inputdatepicker').datepicker({
			autoclose:true,
		});
	}

    // public functions
    return {

        //main function
        init: function () {
			modalEvent();
			slimScroll();
			inputDatePicker();
        },

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();

/** Custom jQuery functions **/
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


$(function(){
    $('#header_task_bar').on('show.bs.dropdown', function () {
        var task_ids = new Array();

        $.each($('li.task-item'),function(){
            task_ids.push($(this).data('task-id'));
        });

        var ajax_container = $(this);
        var previous_ajax = ajax_container.data('jqXHR');

        if(task_ids.length !== 0){
            if(previous_ajax){
                previous_ajax.abort(); // Terminate ajax when still typing
            }

            ajax_container.data('jqXHR',$.ajax({
                url: baseURL+'/task/ajax-dismiss-reminder',
                data: {tasks_ids : task_ids},
                type: 'post',
                success: function(response){
                }
            }));
        }

    })

    $('#header_task_bar').on('hide.bs.dropdown', function () {
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
            }
        })
    })
})