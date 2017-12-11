<template>
    <canvas id="enquiriesChart" width="400" height="200"></canvas>
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
