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
                type: 'pie',
                data: {
                    labels: Object.keys(this.enquiries),
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: Object.values(this.enquiries),
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: this.title
                    }
                }
            });
        }


    }
</script>