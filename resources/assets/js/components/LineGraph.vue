<template>
    <canvas :id="this.name" width="400" height="200"></canvas>
</template>

<script>
    import Chart from 'chart.js';
    export default {

        props: ['data', 'title', 'name'],

        data() {
            return {
                enquiries: JSON.parse(this.data),
            }
        },

        mounted() {

            console.log(this.enquiries);

            new Chart(document.getElementById(this.name), {
                type: 'line',
                data: {
                    labels: Object.keys(this.enquiries),
                    datasets: [{
                        label: 'Value',
                        borderColor: "#3e95cd",
                        data: Object.values(this.enquiries),
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: this.title
                    },
                }
            });
        }


    }
</script>