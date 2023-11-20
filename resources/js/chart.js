import Chart from "chart.js/auto";

const ctx = document.getElementById("myChart").getContext("2d");
const myChart = new Chart(ctx, {
    type: "bubble",
    data: {
        datasets: [
            {
                label: "data 1",
                data: [
                    { x: 52.27194787, y: 98.76457476, r: 10.503086419753085 },
                    { x: 53.04955418, y: 61.78497942, r: 11.320001714677641 },
                    { x: 87.05761317, y: 3.71484911, r: 9.449159807956104 },
                    { x: 92.56772977, y: 70.23319616, r: 8.748585390946502 },
                    { x: 70.81447188, y: 14.42644033, r: 12.705932784636488 },
                    { x: 63.77314815, y: 41.23285322, r: 9.994041495198903 },
                    { x: 98.6042524, y: 18.55366941, r: 6.6931584362139915 },
                ],
                borderColor: "rgb(75, 192, 192)",
                backgroundColor: "rgba(75, 192, 192, 0.5)",
            },
            
        ],
    },
});