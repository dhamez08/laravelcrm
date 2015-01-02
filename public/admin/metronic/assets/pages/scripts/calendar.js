var TaskCalendar = function () {

    var openModal = function($url, $startDate, $endDate){
        var modal = jQuery('.ajaxModal');
        modal.modal({
            show: true,
            remote: $url
        });
    }

    return {
        //main function to initiate the module
        init: function ($url, $gcal_url) {
            var objCalendar = jQuery('#taskcalendar');
            objCalendar.fullCalendar({
                timeFormat: 'h:mm T',
                editable:true,
                selectable: true,
                selectHelper: true,
                defaultView: 'month',
                slotMinutes: 30,
                eventLimit: true,
                height: 550,
                header: {
                        left: 'title',
                        center: '',
                        right: 'prev,next,today,month,agendaWeek,agendaDay',
                },
                googleCalendarApiKey: 'AIzaSyCV47iUXlYHHWUn2TSC5ZU0sxLhjE0pdLE',
                eventSources:[
					{
						url: $url + '/calendar/task-calendar',
							error: function() {
								//alert('there was an error while fetching events!');
							}
                    },
                    {
						//url:$gcal_url,
                        googleCalendarId: $gcal_url,
						className: 'gcal-event'
					}
                ],
                eventRender: function(event, element, calEvent) {
                    element.find(".fc-time").before($('<span class="fc-icons" style="margin-right:5px;"><i class="fa '+ event.icon + ' fa-lg"></i></span>'));
                    if( event.customer_name != null ){
                        element.find(".fc-title").after($('<span class="fc-client"> - <a style="color:#FFFFFF;text-decoration: underline;" href="' + $url + '/clients/client-summary/' + event.customer_id + '">' + event.customer_name + '</a></span>'));
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if( calEvent.source.dataType == 'gcal' ){
						window.open(calEvent.url, 'gcalevent', 'width=700,height=600');
						return false;
					}else{
						var $remoteurl = $url + '/calendar/edit-task' + '/' + calEvent.id + '/' + calEvent.customerId + '/calendar';
						openModal($remoteurl);
					}
					return false;
                },
                dayClick: function(date, jsEvent, view) {
                    var view = objCalendar.fullCalendar('getView');
                    if (view.name == "month") {
                        objCalendar.fullCalendar('gotoDate', date);
                        objCalendar.fullCalendar('changeView', 'agendaDay');
                    }
                    if(view.name == 'agendaDay'){
                        var $startTime   = date.format('X');
                        var $endTime     = date.format('X');
                        var $remoteurl = $url + '/clients/create-client-task?start=' + $startTime + '&end=' + $endTime + '&redirect=calendar';
                        openModal($remoteurl);
                    }
                },
                eventDrop: function(event, delta, revertFunc) {

                    //alert(event.title + " was dropped on " + event.start.format());
                    //if (!confirm("Are you sure about this change?")) {
                        //revertFunc();
                   // }else{
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: $url + "/calendar/ajax-update-task",
                            data: { task_id: event.id, new_task_date: event.start.format('YYYY-MM-DD HH:mm:ss'), end_time: event.end.format('YYYY-MM-DD HH:mm:ss')},
                            success: function() {
                                //location.reload(true);
                                //alert(taskref+'----'+taskdate);
                            },
                            error: function() {
                            }
                        });
                   // }
                },
                eventResize: function(event, delta, revertFunc) {
                    if (!confirm("Are you sure about this change?")) {
                        revertFunc();
                    }else{
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: $url + "/calendar/ajax-update-task",
                            data: { task_id: event.id, new_task_date: event.start.format('YYYY-MM-DD HH:mm:ss'), end_time: event.end.format('YYYY-MM-DD HH:mm:ss')},
                            success: function() {
                                //location.reload(true);
                                //alert(taskref+'----'+taskdate);
                            },
                            error: function() {
                            }
                        });
                    }
                },
            })
        },
    }
} ();
