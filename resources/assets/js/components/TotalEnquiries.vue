<template>
    <div style="height: 600px; width: 1200px;">
        <canvas id="enquiriesChart" width="1200" height="600"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {
        props: ['enquiries'],
        data() {
            return {
                enq: JSON.parse(this.enquiries),
            }
        },
        mounted() {

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

//            document.write(Object.keys(this.enq));

            var ctx = document.getElementById("enquiriesChart").getContext('2d');
            var enquiriesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(this.enq),
                    datasets: [{
                        label: '# of Enquiries',
                        data: Object.values(this.enq),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                maxTicksLimit: 3
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                autoSkip: false,
                                maxTicksLimit: 2,
                            }
                        }],
                    }
                }
            });
        }
    }
</script>
