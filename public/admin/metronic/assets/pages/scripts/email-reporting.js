/**
 * Created by dhamez on 5/27/15.
 */
$(function(){
    console.log('test');
    AmCharts.makeChart("email-total-report",
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
            "dataProvider": [
                {
                    "category": "Email Sent",
                    "column-1": 8
                },
                {
                    "category": "Email Read",
                    "column-1": 6
                },
                {
                    "category": "Email Bounced",
                    "column-1": 2
                }
            ]
        }
    );

    AmCharts.makeChart("email-total-sent",
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
            "dataProvider": [
                {
                    "category": "1",
                    "column-1": 8
                },
                {
                    "category": "2",
                    "column-1": 6
                },
                {
                    "category": "3",
                    "column-1": "2"
                },
                {
                    "category": "4",
                    "column-1": 1
                },
                {
                    "category": "5",
                    "column-1": 2
                },
                {
                    "category": "6",
                    "column-1": 3
                },
                {
                    "category": "7",
                    "column-1": 6
                },
                {
                    "category": "8",
                    "column-1": "8"
                },
                {
                    "category": "9",
                    "column-1": "2"
                },
                {
                    "category": "10",
                    "column-1": "9"
                },
                {
                    "category": "11",
                    "column-1": "10"
                },
                {
                    "category": "12",
                    "column-1": "11"
                },
                {
                    "category": "13",
                    "column-1": "11"
                },
                {
                    "category": "14",
                    "column-1": "9"
                },
                {
                    "category": "15",
                    "column-1": "12"
                },
                {
                    "category": "16",
                    "column-1": "11"
                },
                {
                    "category": "17",
                    "column-1": "9"
                },
                {
                    "category": "18",
                    "column-1": "8"
                },
                {
                    "category": "19",
                    "column-1": "11"
                },
                {
                    "category": "20",
                    "column-1": "12"
                },
                {
                    "category": "21",
                    "column-1": "13"
                },
                {
                    "category": "22",
                    "column-1": "15"
                },
                {
                    "category": "23",
                    "column-1": "17"
                },
                {
                    "category": "24",
                    "column-1": "19"
                },
                {
                    "category": "25",
                    "column-1": "11"
                },
                {
                    "category": "26",
                    "column-1": "9"
                },
                {
                    "category": "27",
                    "column-1": "11"
                },
                {
                    "category": "28",
                    "column-1": "12"
                },
                {
                    "category": "29",
                    "column-1": "14"
                },
                {
                    "category": "30",
                    "column-1": "12"
                }
            ]
        }
    );

    AmCharts.makeChart("email-total-read",
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
            "dataProvider": [
                {
                    "category": "1",
                    "column-1": 8
                },
                {
                    "category": "2",
                    "column-1": 6
                },
                {
                    "category": "3",
                    "column-1": "2"
                },
                {
                    "category": "4",
                    "column-1": 1
                },
                {
                    "category": "5",
                    "column-1": 2
                },
                {
                    "category": "6",
                    "column-1": 3
                },
                {
                    "category": "7",
                    "column-1": 6
                },
                {
                    "category": "8",
                    "column-1": "8"
                },
                {
                    "category": "9",
                    "column-1": "2"
                },
                {
                    "category": "10",
                    "column-1": "9"
                },
                {
                    "category": "11",
                    "column-1": "10"
                },
                {
                    "category": "12",
                    "column-1": "11"
                },
                {
                    "category": "13",
                    "column-1": "11"
                },
                {
                    "category": "14",
                    "column-1": "9"
                },
                {
                    "category": "15",
                    "column-1": "12"
                },
                {
                    "category": "16",
                    "column-1": "11"
                },
                {
                    "category": "17",
                    "column-1": "9"
                },
                {
                    "category": "18",
                    "column-1": "8"
                },
                {
                    "category": "19",
                    "column-1": "11"
                },
                {
                    "category": "20",
                    "column-1": "12"
                },
                {
                    "category": "21",
                    "column-1": "13"
                },
                {
                    "category": "22",
                    "column-1": "15"
                },
                {
                    "category": "23",
                    "column-1": "17"
                },
                {
                    "category": "24",
                    "column-1": "19"
                },
                {
                    "category": "25",
                    "column-1": "11"
                },
                {
                    "category": "26",
                    "column-1": "9"
                },
                {
                    "category": "27",
                    "column-1": "11"
                },
                {
                    "category": "28",
                    "column-1": "12"
                },
                {
                    "category": "29",
                    "column-1": "14"
                },
                {
                    "category": "30",
                    "column-1": "12"
                }
            ]
        }
    );

    AmCharts.makeChart("email-total-bounced",
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
            "dataProvider": [
                {
                    "category": "1",
                    "column-1": 1
                },
                {
                    "category": "2",
                    "column-1": 1
                },
                {
                    "category": "3",
                    "column-1": "0"
                },
                {
                    "category": "4",
                    "column-1": 0
                },
                {
                    "category": "5",
                    "column-1": 0
                },
                {
                    "category": "6",
                    "column-1": 0
                },
                {
                    "category": "7",
                    "column-1": 2
                },
                {
                    "category": "8",
                    "column-1": "1"
                },
                {
                    "category": "9",
                    "column-1": "0"
                },
                {
                    "category": "10",
                    "column-1": "1"
                },
                {
                    "category": "11",
                    "column-1": "2"
                },
                {
                    "category": "12",
                    "column-1": "1"
                },
                {
                    "category": "13",
                    "column-1": "1"
                },
                {
                    "category": "14",
                    "column-1": "0"
                },
                {
                    "category": "15",
                    "column-1": "1"
                },
                {
                    "category": "16",
                    "column-1": "2"
                },
                {
                    "category": "17",
                    "column-1": "3"
                },
                {
                    "category": "18",
                    "column-1": "1"
                },
                {
                    "category": "19",
                    "column-1": "1"
                },
                {
                    "category": "20",
                    "column-1": "2"
                },
                {
                    "category": "21",
                    "column-1": "3"
                },
                {
                    "category": "22",
                    "column-1": "4"
                },
                {
                    "category": "23",
                    "column-1": "3"
                },
                {
                    "category": "24",
                    "column-1": "1"
                },
                {
                    "category": "25",
                    "column-1": "1"
                },
                {
                    "category": "26",
                    "column-1": "2"
                },
                {
                    "category": "27",
                    "column-1": "1"
                },
                {
                    "category": "28",
                    "column-1": "2"
                },
                {
                    "category": "29",
                    "column-1": "4"
                },
                {
                    "category": "30",
                    "column-1": "2"
                }
            ]
        }
    );
});