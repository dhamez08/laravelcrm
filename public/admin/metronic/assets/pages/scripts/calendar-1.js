var TaskCalendar = function () {

    var openModal = function($url){
        var modal = jQuery('.ajaxModal');
        modal.modal({
            show: true,
            remote: $url + '/clients/create-client-task'
        });
    }

    return {
        //main function to initiate the module
        init: function ($url) {
            var objCalendar = jQuery('#taskcalendar');
            objCalendar.fullCalendar({
                timeFormat: 'H:mm',
                editable:true,
                selectable: true,
                selectHelper: true,
                defaultView: 'month',
                slotMinutes: 30,
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay',
                },
                events: {
                    url: $url + '/calendar/task-calendar',
                    type: 'GET',
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                },
                eventRender: function(event, element, calEvent) {
                    element.find(".fc-event-time").before($('<span class="fc-event-icons" style="margin-right:5px;"><i class="fa '+ event.icon + ' fa-lg"></i></span>'));
                    if( event.customer_name != null ){
                        element.find(".fc-event-title").after($('<span class="fc-event-client"> - <a style="color:#FFFFFF;text-decoration: underline;" href="' + baseURL + 'clients/view?id=' + event.customer_id + '">' + event.customer_name + '</a></span>'));
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {

                },
                dayClick: function(date, jsEvent, view) {
                    var view = objCalendar.fullCalendar('getView');
                    if (view.name == "month") {
                        objCalendar.fullCalendar('changeView', 'agendaDay');
                    }
                    if(view.name == 'agendaDay'){
                        starttime = $.fullCalendar.formatDate(date,'yyyy-MM-dd H:mm:ss');     
                        endtime = $.fullCalendar.formatDate(date,'yyyy-MM-dd H:mm:ss');
                        //openModal($url);   
                        console.log(endtime);
                        console.log(starttime);
                    }
                }
            })
        },
    }
} ();