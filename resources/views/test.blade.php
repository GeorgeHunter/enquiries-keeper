@extends('layouts.report')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <div class="container">

        <h1>Chart</h1>
        <div style="width: 1200px; height: 600px;">
            <canvas id="bar-chart" width="1200" height="600"></canvas>
        </div>


    </div>

    <script>

        Object.values = Object.values ? Object.values : function(obj) {
            var allowedTypes = ["[object String]", "[object Object]", "[object Array]", "[object Function]"];
            var objType = Object.prototype.toString.call(obj);

            if(obj === null || typeof obj === "undefined") {
                throw new TypeError("Cannot convert undefined or null to object");
            } else if(!~allowedTypes.indexOf(objType)) {
                return [];
            } else {
                // if ES6 is supported
                if (Object.keys) {
                    return Object.keys(obj).map(function (key) {
                        return obj[key];
                    });
                }

                var result = [];
                for (var prop in obj) {
                    if (obj.hasOwnProperty(prop)) {
                        result.push(obj[prop]);
                    }
                }

                return result;
            }
        };

        if (typeof module !== 'undefined' && module.exports) {
            module.exports = Object.values;
        }

        var obj  = {!! $enquiries !!};

        var keys = Object.keys(obj);
        var values = Object.values(obj);

        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: keys,
                datasets: [{
                    label: '# of Enquiries',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                },
                responsive: false,
                responsiveAnimationDuration: 0,
                animation: {
                    duration: 0
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }

            }
        });
    </script>

@stop