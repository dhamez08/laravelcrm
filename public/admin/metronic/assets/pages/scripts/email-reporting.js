/**
 * Created by dhamez on 5/27/15.
 */
$(function(){
    // Fetch initial list for default filter
    var page_index = 0;
    var filter = 'sent'

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth();
    var yyyy = today.getFullYear();
    var month = new Array();
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";

    var date_label = "for the month of "+month[mm];

    mm += 1;
    if(dd<10)
        dd='0'+dd

    if(mm<10)
        mm='0'+mm

    var end_date = yyyy+'-'+mm+'-'+dd;
    var start_date = yyyy+'-'+mm+'-'+'01';

    $('#start-date').val(start_date);
    $('#end-date').val(end_date);

    rebuild_chart(start_date, end_date);

    var chart_one_data = [
        {
            "category": "Email Sent",
            "column-1": 0
        },
        {
            "category": "Email Read",
            "column-1": 0
        },
        {
            "category": "Email Bounced",
            "column-1": 0
        }
    ]
    var chart_two_data = new Array({
        "category": 0,
        "column-1": 0
    });
    var chart_three_data = new Array({
        "category": 0,
        "column-1": 0
    });
    var chart_four_data = new Array({
        "category": 0,
        "column-1": 0
    });

    $('#date-range-button').on('click',function(){
        var start = $('#start-date').val();
        var end = $('#end-date').val();
        date_label = "from "+start+" to "+end;
        rebuild_chart(start, end);
    })

    $('#email-list-more').on('click',function(){
        page_index++;
        fetch_list();
    });

    $('#list-view-tab').on('click',function(){
        page_index = 0;
        if(!($('#email-list-table tbody').html())){
            fetch_list();
        }
    });

    $('#email-status-filter').on('change',function(){
        page_index = 0;
        filter = $(this).val();
        $('#email-list-table tbody').html('')
        fetch_list();
    });

    function rebuild_chart(start_date, end_date){
        var data = new Object();
        data.start_date = start_date;
        data.end_date = end_date;

        $.ajax({
            url: 'ajax-email-report-data',
            data: data,
            type: 'get',
            dataType: 'json',
            success: function(response){
                console.log(response);


                $.each(response.count, function(index, row){
                    if(row.receipt == '0'){
                        chart_one_data[0]['column-1'] = row.message_count;
                    } else if(row.receipt == '1'){
                        chart_one_data[1]['column-1'] = row.message_count;
                    } else if(row.receipt == '-1'){
                        chart_one_data[2]['column-1'] = row.message_count
                    }
                })

                // Add sent and read
                chart_one_data[0]['column-1'] += chart_one_data[1]['column-1'];

                summary_chart.dataProvider = chart_one_data;
                summary_chart.validateData();

                sent_chart.dataProvider = generate_data(response.sent);
                sent_chart.validateData();

                read_chart.dataProvider = generate_data(response.read);
                read_chart.validateData();

                bounced_chart.dataProvider = generate_data(response.bounced);
                bounced_chart.validateData();

                $('.date-label').text(date_label);
            }
        });
    }

    function generate_data(array_of_data){
        var dates = new Array();
        $.each(array_of_data, function(date, count){
            dates.push({'category':date, 'column-1':count});
        })

        return dates;
    }

    function fetch_list(){
        setTimeout(function(){
            Metronic.blockUI({
                target: '#email-list-container',
                boxed: true
            });

            $.ajax({
                url: 'ajax-list-email-report/'+filter+'/'+page_index,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(response.success){
                        $.each(response.messages, function(index, message){
                            $('#email-list-table tbody').append(
                                $('<tr>')
                                    .append($('<td>').text(message.sender))
                                    .append($('<td>').text(message.to))
                                    .append($('<td>').text(message.subject))
                                    .append($('<td>').text(message.added_date))
                            );
                        });
                    }

                    Metronic.unblockUI('#email-list-container');
                }
            })
        },100);
    }

    var summary_chart = AmCharts.makeChart("email-total-report",
        {
            "type": "serial",
            "path": "https://www.amcharts.com/lib/3/",
            "categoryField": "category",
            "rotate": true,
            "angle": 20,
            "depth3D": 8,
            "plotAreaBorderAlpha": 0.1,
            "plotAreaBorderColor": "#847F7F",
            "startDuration": 1,
            "backgroundAlpha": 0.59,
            "borderColor": "#DADADA",
            "color": "#7F7A7A",
            "theme": "default",
            "categoryAxis": {
                "gridPosition": "start"
            },
            "trendLines": [],
            "graphs": [
                {
                    "balloonText": "[[title]] of [[category]]:[[value]]",
                    "fillAlphas": 1,
                    "fontSize": -6,
                    "id": "AmGraph-1",
                    "labelText": "",
                    "legendAlpha": 0,
                    "legendColor": "#FFFFFF",
                    "title": "Number",
                    "type": "column",
                    "valueField": "column-1"
                },
                {
                    "balloonText": "[[title]] of [[category]]:[[value]]",
                    "bullet": "round",
                    "id": "AmGraph-2",
                    "labelText": "",
                    "lineThickness": 2,
                    "title": "graph 2",
                    "valueField": "column-2"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "title": ""
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": [],
            "dataProvider": chart_one_data
        }
    );

    var sent_chart = AmCharts.makeChart("email-total-sent",
        {
            "type": "serial",
            "path": "http://www.amcharts.com/lib/3/",
            "categoryField": "category",
            "plotAreaBorderColor": "#A9A9A9",
            "startDuration": 1,
            "startEffect": "easeOutSine",
            "color": "#4F4F4F",
            "fontSize": 12,
            "handDrawScatter": 5,
            "categoryAxis": {
                "gridPosition": "start"
            },
            "trendLines": [],
            "graphs": [
                {
                    "balloonText": "[[title]] of [[category]]:[[value]]",
                    "bullet": "round",
                    "id": "AmGraph-1",
                    "title": "Emails",
                    "valueField": "column-1"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "axisColor": "#7F7A7A",
                    "axisThickness": 0,
                    "gridColor": "#4E4E4E",
                    "labelFrequency": 3,
                    "labelOffset": -1,
                    "minVerticalGap": 42,
                    "tickLength": 2,
                    "title": "Number of Emails"
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": [],
            "dataProvider": chart_two_data
        }
    );

    var read_chart = AmCharts.makeChart("email-total-read",
        {
            "type": "serial",
            "path": "http://www.amcharts.com/lib/3/",
            "categoryField": "category",
            "plotAreaBorderColor": "#A9A9A9",
            "startDuration": 1,
            "startEffect": "easeOutSine",
            "color": "#4F4F4F",
            "fontSize": 12,
            "handDrawScatter": 5,
            "categoryAxis": {
                "gridPosition": "start"
            },
            "trendLines": [],
            "graphs": [
                {
                    "balloonText": "[[title]] of [[category]]:[[value]]",
                    "bullet": "round",
                    "id": "AmGraph-1",
                    "title": "Emails",
                    "valueField": "column-1"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "axisColor": "#7F7A7A",
                    "axisThickness": 0,
                    "gridColor": "#4E4E4E",
                    "labelFrequency": 3,
                    "labelOffset": -1,
                    "minVerticalGap": 42,
                    "tickLength": 2,
                    "title": "Number of Emails"
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": [],
            "dataProvider": chart_three_data
        }
    );

    var bounced_chart = AmCharts.makeChart("email-total-bounced",
        {
            "type": "serial",
            "path": "http://www.amcharts.com/lib/3/",
            "categoryField": "category",
            "plotAreaBorderColor": "#A9A9A9",
            "startDuration": 1,
            "startEffect": "easeOutSine",
            "color": "#4F4F4F",
            "fontSize": 12,
            "handDrawScatter": 5,
            "categoryAxis": {
                "gridPosition": "start"
            },
            "trendLines": [],
            "graphs": [
                {
                    "balloonText": "[[title]] of [[category]]:[[value]]",
                    "bullet": "round",
                    "id": "AmGraph-1",
                    "title": "Emails",
                    "valueField": "column-1"
                }
            ],
            "guides": [],
            "valueAxes": [
                {
                    "id": "ValueAxis-1",
                    "axisColor": "#7F7A7A",
                    "axisThickness": 0,
                    "gridColor": "#4E4E4E",
                    "labelFrequency": 3,
                    "labelOffset": -1,
                    "minVerticalGap": 42,
                    "tickLength": 2,
                    "title": "Number of Emails"
                }
            ],
            "allLabels": [],
            "balloon": {},
            "titles": [],
            "dataProvider": chart_four_data
        }
    );
});