
$(document).ready(() => {
  let fee__data = '';
  $.ajax({
    url: 'ajax/feeDataAjax.php',
    method: 'POST',
    // dataType:'json',
    success: function (response) {
      console.log(response)
      fee__data = response;
      console.log(fee__data)
      $('#paid-number').html(`paid - ${fee__data[0].paidStudent}`)
      $('#unpaid-number').html(`unpaid - ${fee__data[0].unPaidStudent}`)
      var spark1 = {
        chart: {
          id: 'sparkline1',
          type: 'line',
          height: 140,
          sparkline: {
            enabled: true
          },
          group: 'sparklines'
        },
        series: [{
          name: 'Monthly Revenue',
          data: [123000, 105000, 135000, 120000, 155000, 110000, 120000, 121650, 125400, 185000]
        }],
        stroke: {
          curve: 'smooth'
        },
        markers: {
          size: 0
        },
        tooltip: {
          fixed: {
            enabled: true,
            position: 'right'
          },
          x: {
            show: false
          }
        },
        title: {
          text: `${fee__data[0].TotalAmount}`,
          style: {
            fontSize: '16px',
            color: '#fff'
          }
        },
        colors: ['#fff']
      }
      var spark2 = {
        chart: {
          id: 'sparkline2',
          type: 'line',
          height: 140,
          sparkline: {
            enabled: true
          },
          group: 'sparklines'
        },
        series: [{
          name: 'Fees Collected',
          data: [54000, 105000, 135000, 120000, 155000, 110000, 120000, 121650, 125400, 185000]
        }],
        stroke: {
          curve: 'smooth'
        },
        markers: {
          size: 0
        },
        tooltip: {
          fixed: {
            enabled: true,
            position: 'right'
          },
          x: {
            show: false
          }
        },
        title: {
          text: `${fee__data[0].paidAmount}`,
          style: {
            fontSize: '16px',
            color: '#fff'
          }
        },
        colors: ['#fff']
      }
      var spark3 = {
        chart: {
          id: 'sparkline3',
          type: 'line',
          height: 140,
          sparkline: {
            enabled: true
          },
          group: 'sparklines'
        },
        series: [{
          name: 'Unpaid Fees',
          data: [54000, 105000, 135000, 120000, 155000, 110000, 120000, 121650, 125400, 185000]
        }],
        stroke: {
          curve: 'smooth'
        },
        markers: {
          size: 0
        },
        tooltip: {
          fixed: {
            enabled: true,
            position: 'right'
          },
          x: {
            show: false
          }
        },
        title: {
          text: `${fee__data[0].unPaidAmount}`,
          style: {
            fontSize: '16px',
            color: '#fff',
          }
        },
        colors: ['#fff']
      }

      new ApexCharts(document.querySelector("#spark1"), spark1).render();
      new ApexCharts(document.querySelector("#spark2"), spark2).render();
      new ApexCharts(document.querySelector("#spark3"), spark3).render();
      //circular chart here
      var circularBar = {
        series: [fee__data[0].paidStudent, fee__data[0].unPaidStudent],
        chart: {
          type: 'donut',
          width: 280
        },
        dataLabels: {
          enabled: true
        },
        labels: ['Fees paid', 'Fees Unpaid'], // Add labels to your series values
        legend: {
          show: false
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            }
          }
        }],
        colors: ['#1176BC', '#EE0606'] // Set custom colors for your series
      };

      var circularChart = new ApexCharts(document.querySelector("#chartDiv"), circularBar);
      circularChart.render();
    },
    error: function (error) {
      console.log(error)
    }
  })


})



// js charting code starts here 



// student statics

var std_statics = {
  series: [{
    name: 'student-joined',
    data: [31, 40, 28, 51, 42, 109, 100],
    color: '#3aff3a',
  }, {
    name: 'student-left',
    data: [11, 32, 45, 32, 34, 52, 41],
    color: '#ee0606' // Set the color for the series
  }],
  chart: {
    height: 450,
    type: 'area',
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    colors: ['#2c67f2', '#62cff4'],
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.3,
        stops: [0, 100]
      },
      colors: ['#FF5733', '#62cff4'] // Set the fill area colors for each series
    },
    markers: {
      size: 6,
      colors: ['#FF5733']
    }
  },
  xaxis: {
    type: 'category',
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"]
  },
  yaxis: {
    labels: {
      show: true  // Hide y-axis labels
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    },
  }
};

var statics = new ApexCharts(document.querySelector("#studentStatics"), std_statics);
statics.render();

// new one

let batchDiv = document.getElementsByClassName('batch-report-table');
Array.from(batchDiv).forEach((item) => {
  new DataTable(`#${item.id}`)
})

