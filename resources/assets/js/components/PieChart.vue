<template>
    <canvas :id="this.name" width="1200" height="1200"></canvas>
</template>

<script>
    import Chart from 'chart.js';

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

    export default {

        props: ['data', 'title', 'name'],

        data() {
            return {
                enquiries: JSON.parse(this.data),
            }
        },

        mounted() {

//            console.log(this.enquiries);

            new Chart(document.getElementById(this.name), {
                type: 'pie',
                data: {
                    labels: Object.keys(this.enquiries),
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e879b3", "#c45850", "#4d52e8", "#8dc468", "#88e5e8", "#c46d3b", "#c4bf60"],
                        data: Object.values(this.enquiries),
                    }]
                },
                options: {
                    responsive: true,
                    animations: true,
                    responsiveAnimationDuration: 0,
                    animation: { duration: 0 },
                    title: {
                        display: true,
                        text: this.title
                    }
                }
            });
        }


    }
</script>