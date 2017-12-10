<template>
    <div class="pt-4">
        <canvas id="enquiriesChart" width="400" height="200"></canvas>
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

            let dates = Object.keys(this.enq);
            let sends = [];

            for (let key in this.enq) {
                sends.push(this.enq[key].length);
            }


            var ctx = document.getElementById("enquiriesChart").getContext('2d');
            var enquiriesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: '# of Votes',
                        data: sends,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
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
