// $(document).ready(function(){

// })

$(document).ready(function () {


  // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      { name: "Earnings this month:", data: [355, 390, 300, 350, 390, 180, 355, 390] },
      { name: "Expense this month:", data: [280, 250, 325, 215, 250, 310, 280, 250] },
    ],

    chart: {
      type: "bar",
      height: 345,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },


    colors: ["#5D87FF", "#49BEFF"],


    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "35%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },


    legend: {
      show: false,
    },


    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },


    yaxis: {
      show: true,
      min: 0,
      max: 400,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },


    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]


  };

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();


  // =====================================
  // Breakup
  // =====================================
  var breakup = {
    color: "#adb5bd",
    series: [38, 40, 25],
    labels: ["2022", "2021", "2020"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();



  // =====================================
  // Earning
  // =====================================
  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Earnings",
        color: "#49BEFF",
        data: [25, 66, 20, 40, 12, 58, 20],
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();


  // =====================================
  // mine chart
  // =====================================


  var activity = {
    series: [
      { name: "present  this month:", data: [9] },
      { name: "absent  this month:", data: [2] },
      { name: "leave  this month:", data: [1] },
    ],

    chart: {
      type: "bar",
      height: 220,
      offsetX: -15,
      toolbar: { show: true },
      foreColor: "#adb0bb",
      fontFamily: 'inherit',
      sparkline: { enabled: false },
    },


    colors: ["#5D87FF", "#49BEFF", "#f7971e"],


    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "90%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    markers: { size: 0 },

    dataLabels: {
      enabled: false,
    },


    legend: {
      show: false,
    },


    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },

    xaxis: {
      type: "category",
      categories: ["january",],
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },


    yaxis: {
      show: true,
      min: 0,
      max: 12,
      tickAmount: 4,
      labels: {
        style: {
          cssClass: "grey--text lighten-2--text fill-color",
        },
      },
    },
    stroke: {
      show: true,
      width: 3,
      lineCap: "butt",
      colors: ["transparent"],
    },


    tooltip: { theme: "light" },

    responsive: [
      {
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }
    ]


  };

  new ApexCharts(document.querySelector("#mine_chart"), activity).render();

  var ajax_array = [];

  let main_div = document.getElementsByClassName('main_academic_div');

  Array.from(main_div).forEach((item, i_index) => {
    let cir_chart = document.querySelector(`#mine_circular_chart${i_index + 1}`)
    var p_data = parseInt(cir_chart.getAttribute('data-present'))
    var a_data = parseInt(cir_chart.getAttribute('data-absent'))
    var l_data = parseInt(cir_chart.getAttribute('data-leave'))
    var skip_data = parseInt(cir_chart.getAttribute('data-skip'))

    // =====================================
    // mine_circular_chart
    // =====================================
    var m_cir_i_index = {
      color: "#adb5bd",
      series: [p_data, a_data, l_data, skip_data],
      labels: ["present", "absent", "leave", "skip"],
      chart: {
        width: 280,
        type: "donut",
        fontFamily: "Plus Jakarta Sans', sans-serif",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          startAngle: 0,
          endAngle: 360,
          donut: {
            size: '75%',
          },
        },
      },
      stroke: {
        show: false,
      },

      dataLabels: {
        enabled: true,
      },

      legend: {
        show: false,
      },
      colors: ["#1176BC", "#ededed", "#F9F9FD", "#acacac"],

      responsive: [
        {
          breakpoint: 990,
          options: {
            chart: {
              width: 250,
            },
          },
        },
      ],
      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };


    new ApexCharts(cir_chart, m_cir_i_index).render();

  })

  

  $.ajax({
    url: 'api.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      
      console.log(data)
      
      // academic page graph code

      Array.from(main_div).forEach((item2, i_index2) => {

        var total_class_data = parseInt(data[i_index2].total_class);
        var p_bar_data = parseInt(data[i_index2].total_present_class);
        var a_bar_data = parseInt(data[i_index2].total_absent_class);
        var l_bar_data = parseInt(data[i_index2].total_leave_class);
        var s_bar_data = parseInt(data[i_index2].total_skip_class);
        var assign_bar_data = parseInt(data[i_index2].assignment_done);

        let ac_chart_i_index2 = {
          series: [
            { data: [p_bar_data, a_bar_data, l_bar_data, s_bar_data, assign_bar_data] }
          ],

          chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: { show: true },
            foreColor: "#adb0bb",
            fontFamily: 'inherit',
            sparkline: { enabled: false },
          },


          colors: ["#5D87FF", "#49BEFF"],


          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: "20%",
              borderRadius: [4],
              borderRadiusApplication: 'end',
              borderRadiusWhenStacked: 'all'
            },
          },
          markers: { size: 0 },

          dataLabels: {
            enabled: false,
          },


          legend: {
            show: false,
          },


          grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
              lines: {
                show: false,
              },
            },
          },

          xaxis: {
            type: "category",
            categories: ["Present", "Absent", "Leave", "Skip", "Assignment"],
            labels: {
              style: { cssClass: "grey--text lighten-2--text fill-color" },
            },
          },


          yaxis: {
            show: true,
            min: 0,
            max: total_class_data,
            tickAmount: 4,
            labels: {
              style: {
                cssClass: "grey--text lighten-2--text fill-color",
              },
            },
          },
          stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
          },


          tooltip: { theme: "light" },

          responsive: [
            {
              breakpoint: 600,
              options: {
                plotOptions: {
                  bar: {
                    borderRadius: 3,
                  }
                },
              }
            }
          ]


        }

        new ApexCharts(document.querySelector(`#chart${i_index2 + 1}`), ac_chart_i_index2).render();

      })

    }
  })




})

alert('working')








