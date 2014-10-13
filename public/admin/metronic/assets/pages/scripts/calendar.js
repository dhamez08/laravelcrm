var TaskCalendar = function () {


    return {
        //main function to initiate the module
        init: function ($url) {
            var objCalendar = jQuery('#taskcalendar');
            objCalendar.fullCalendar({
                timeFormat: 'H:mm',
                editable:true,
                selectable: true,
                defaultView: 'month',
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
                select: function(start, end, jsEvent, view) {
                    console.log(view);
                    if(view.name !== 'month') {
                        endtime = $.fullCalendar.formatDate(end,'yyyy-MM-dd H:mm:ss');
                        starttime = $.fullCalendar.formatDate(start,'yyyy-MM-dd H:mm:ss');
                        /* 
                        formstartdate = start.format('DD/MM/YYYY');
                        formstarthour = start.format('hh');
                        formstartmin = start.format('mm');

                        formenddate = end.format('DD/MM/YYYY');
                        formendhour = end.format('hh');
                        formendmin = end.format('mm');
                        var mywhen = starttime + ' - ' + endtime;
                        var myend = formendhour + ' - ' + formendmin;*/
                        console.log(endtime);
                        console.log(starttime);
                        objCalendar.fullCalendar('gotoDate', start);
                        objCalendar.fullCalendar('changeView', 'agendaDay');
                    }
                },
                dayClick: function(date, jsEvent, view) {
                    //console.log(view);
                    //if (view.name === "month") {
                        objCalendar.fullCalendar('gotoDate', date);
                        objCalendar.fullCalendar('changeView', 'agendaDay');
                    //}
                    //alert('asd');
                },
            })
        },
    }
} ();