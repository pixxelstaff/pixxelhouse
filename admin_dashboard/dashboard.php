<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <?php include('include/links.php'); ?>
</head>

<body>
  <!-- <div class="container-fluid noti-bar bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-12 p-2  text-white">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae dolorem facilis, dolore ullam vel 
        </div>
      </div>
    </div>
  </div> -->
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include('include/sidebar.php'); ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <?php include('include/navbar.php'); ?>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row mt-3">
          <div class="col-md-3">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='teachers.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-teacher dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Total Teachers</p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php
                    $total_records = getTotalRecords('teacher');
                    echo "$total_records"; ?>
                  </p>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='students.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-students dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Total Students </p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php
                    $total_records = getTotalRecords('students');
                    echo "$total_records"; ?>
                  </p>

                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='batches.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-class dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Total Batches </p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php
                    $total_records = getTotalRecords('batch');
                    echo "$total_records"; ?>
                  </p>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='pending_student.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-approve_student dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Pending Students </p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php
                    $total_records = getTotalRecords('pending_students');
                    echo "$total_records"; ?>
                  </p>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12">
                <h3>Complain and Review Chart</h3>
              </div>
            </div>
            <div id="chart"></div>
          </div>
          <div class="col-md-5">
            <div id='calendar'></div>
          </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth'
            });
            calendar.render();
          });
        </script>
        <?php include('include/footer.php'); ?>
      </div>
    </div>
  </div>


  <?php include('include/javascript.php'); ?>
  <?php
  $query = "SELECT DISTINCT `date` FROM `complain`"; // Replace with your actual table and column names
  $result = mysqli_query($con, $query);

  // Initialize an array to store fetched dates
  $fetchedDates = array();

  // Fetch and add dates to the array
  while ($row = mysqli_fetch_assoc($result)) {
    $fetchedDates[] = $row['date'];
  }

  // Calculate total complaints and reviews for each date
  $totalComplaints = array();
  $totalReviews = array();

  foreach ($fetchedDates as $date) {
    $queryComplaints = "SELECT COUNT(*) AS total_complaints FROM `complain` WHERE `date`='$date' AND `complain_status`='Complain'";
    $queryReviews = "SELECT COUNT(*) AS total_reviews FROM `complain` WHERE `date`='$date' AND `complain_status`='Review'";

    $resultComplaints = mysqli_query($con, $queryComplaints);
    $resultReviews = mysqli_query($con, $queryReviews);

    $rowComplaints = mysqli_fetch_assoc($resultComplaints);
    $rowReviews = mysqli_fetch_assoc($resultReviews);

    $totalComplaints[] = $rowComplaints['total_complaints'];
    $totalReviews[] = $rowReviews['total_reviews'];
  }

  // Convert the PHP arrays to JSON arrays
  $fetchedDatesJSON = json_encode($fetchedDates);
  $totalComplaintsJSON = json_encode($totalComplaints);
  $totalReviewsJSON = json_encode($totalReviews);
  ?>

  <script>
    var chart = {
      series: [{
          name: "Complaint this Months:",
          data: <?php print_r($totalComplaintsJSON); ?>
        },
        {
          name: "Review this Month:",
          data: <?php print_r($totalReviewsJSON); ?>
        },
      ],

      chart: {
        type: "bar",
        height: 345,
        offsetX: -15,
        toolbar: {
          show: true
        },
        foreColor: "#1176bc",
        fontFamily: 'inherit',
        sparkline: {
          enabled: false
        },
      },


      colors: ["#ff0202", "#1176bc"],


      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "30%",
          borderRadius: [2],
          borderRadiusApplication: 'end',
          borderRadiusWhenStacked: 'all'
        },
      },
      markers: {
        size: 0
      },

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
        categories: <?php print_r($fetchedDatesJSON); ?>,
        labels: {
          style: {
            cssClass: "fc-day-today"
          },
        },
      },


      yaxis: {
        show: true,
        min: 0,
        max: 50,
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


      tooltip: {
        theme: "light"
      },

      responsive: [{
        breakpoint: 600,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 3,
            }
          },
        }
      }]


    };

    var chart = new ApexCharts(document.querySelector("#chart"), chart);
    chart.render();
  </script>
  <script>

  </script>
</body>

</html>