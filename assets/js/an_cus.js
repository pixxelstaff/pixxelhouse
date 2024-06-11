var ctx = document.getElementById("chart-area");

var myChart = new Chart(ctx, {
    type: "bar",
    data: {

        labels: ["Present","assigment-done", "asbent", "leave",],
        datasets: [
            {
                label: "attendance",
                data: [30, 24, 8, 2,],

                backgroundColor: [
                    "rgba(255, 99, 132, 0.5)",
                    '#10FFA3',
                    "rgba(54, 162, 235, 0.5)",
                    "rgba(255, 206, 86, 0.5)",
                    //   "rgba(75, 192, 192, 0.5)",
                    //   "rgba(153, 102, 255, 0.5)",
                    //   "rgba(255, 159, 64, 0.5)"
                ],

                borderColor: [
                    //   "rgba(255, 99, 132, 1)",
                    //   "rgba(54, 162, 235, 1)",
                    //   "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    '#10FFA3',
                    "rgba(255, 159, 64, 1)"
                ],

                borderWidth: 1
            },
            {
                type: "line",
                label: "active boost",
                data: [2, 8, 24, 30],
                borderColor: "rgba(255, 99, 132, 1)",
                backgroundColor: "rgba(255, 255, 255, 1)"
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true, // Start the y-axis at zero
                max: 40, // Set the maximum value of the y-axis
            }
        }
    }
});


const ctx1 = document.getElementById('myChart');

var mychart2 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['present','assignment-done', 'absent', 'leave'],
        datasets: [{
            label: 'no of days',
            data: [30,24, 8, 2],
            backgroundColor: [
                '#1176BC',
                '#10FFA3',
                '#000',
                '#FFA500',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true, // Start the y-axis at zero
                max: 40, // Set the maximum value of the y-axis
            }
        }
    }

});


