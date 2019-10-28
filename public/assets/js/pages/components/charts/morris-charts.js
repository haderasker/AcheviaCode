"use strict";
// Class definition
var KTMorrisChartsDemo = function () {

    // Private functions

    var demo1 = function () {

        // LINE CHART
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'kt_morris_1',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.

            data: [{
                y: '2019-10-1',
                a: 100,
                b: 90,
                c: 70,
                d: 90,
                e: 100,
                f: 70,
                i: 50,
                g: 80
            },
                {
                    y: '2019-10-2',
                    a: 75,
                    b: 65,
                    c: 20,
                    d: 50,
                    e: 80,
                    f: 50,
                    i: 30,
                    g: 50
                },
                {
                    y: '2019-10-3',
                    a: 50,
                    b: 40,
                    c: 40,
                    d: 30,
                    e: 60,
                    f: 40,
                    i: 60,
                    g: 30
                },
                {
                    y: '2019-10-4',
                    a: 75,
                    b: 65,
                    c: 100,
                    d: 90,
                    e: 100,
                    f: 90,
                    i: 100,
                    g: 90
                },
                {
                    y: '2019-10-5',
                    a: 50,
                    b: 40,
                    c: 100,
                    d: 90,
                    e: 100,
                    f: 90,
                    i: 100,
                    g: 90
                },
                {
                    y: '2019-10-6',
                    a: 75,
                    b: 65,
                    c: 100,
                    d: 90,
                    e: 100,
                    f: 90,
                    i: 100,
                    g: 90
                },
                {
                    y: '2019-10-10',
                    a: 100,
                    b: 90,
                    c: 100,
                    d: 90,
                    e: 100,
                    f: 90,
                    i: 10,
                    g: 40
                },
                {
                    y: '2019-10-13',
                    a: 75,
                    b: 65,
                    c: 100,
                    d: 90,
                    e: 100,
                    f: 90,
                    i: 100,
                    g: 90
                },
                {
                    y: '2019-10-15',
                    a: 100,
                    b: 90,
                    c: 100,
                    d: 90,
                    e: 100,
                    f: 90,
                    i: 10,
                    g: 40
                }
            ],
            xLabels:'day',
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a', 'b','c','d','e','f','g','i'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['new', 'following', 'coming visit', 'meeting', 'done deal', 'cancellation', 'not interested', 'pending again'],
            lineColors: ['#6e4ff5', '#f6aa33', '#de1f78', '#2abe81', '#24a5ff', '#fd27eb', '#5867dd', '#990000']
        });
    }

    var demo2 = function () {
        // AREA CHART
        new Morris.Area({

            element: 'kt_morris_2',

            data: [{
                y: '2006',
                a: 100,
                b: 90
            },
                {
                    y: '2007',
                    a: 75,
                    b: 65
                },
                {
                    y: '2008',
                    a: 50,
                    b: 40
                },
                {
                    y: '2009',
                    a: 75,
                    b: 65
                },
                {
                    y: '2010',
                    a: 50,
                    b: 40
                },
                {
                    y: '2011',
                    a: 75,
                    b: 65
                },
                {
                    y: '2012',
                    a: 100,
                    b: 90
                }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            lineColors: ['#de1f78', '#c7d2e7'],
            pointFillColors: ['#fe3995', '#e6e9f0']
        });
    }

    var demo3 = function () {
        // BAR CHART
        new Morris.Bar({
            element: 'kt_morris_3',
            data: [{
                y: '2006',
                a: 100,
                b: 90
            },
                {
                    y: '2007',
                    a: 75,
                    b: 65
                },
                {
                    y: '2008',
                    a: 50,
                    b: 40
                },
                {
                    y: '2009',
                    a: 75,
                    b: 65
                },
                {
                    y: '2010',
                    a: 50,
                    b: 40
                },
                {
                    y: '2011',
                    a: 75,
                    b: 65
                },
                {
                    y: '2012',
                    a: 100,
                    b: 90
                }
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            barColors: ['#2abe81', '#24a5ff']
        });
    }

    var demo4 = function () {
        // PIE CHART
        new Morris.Donut({
            element: 'kt_morris_4',
            data: [{
                label: "Download Sales",
                value: 12
            },
                {
                    label: "In-Store Sales",
                    value: 30
                },
                {
                    label: "Mail-Order Sales",
                    value: 20

                }
            ],
            colors: ['#593ae1', '#6e4ff5', '#9077fb']
        });
    }

    return {
        // public functions
        init: function () {
            demo1();
            demo2();
            demo3();
            demo4();
        }
    };
}();

jQuery(document).ready(function () {
    KTMorrisChartsDemo.init();
});