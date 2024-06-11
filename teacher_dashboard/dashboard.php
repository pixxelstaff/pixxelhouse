<?php
session_start();
if(isset($_SESSION['teacher_id'])){
include('../connect.php');
include('../functions/function.php');
$teacher_session = $_SESSION['portal_email'];
$teacher_sno = $_SESSION['teacher_id'];
$teacher_details = get_table_data2('teacher', $con, 'portal_email', $teacher_session);
while ($teacher = mysqli_fetch_assoc($teacher_details)) {
  $teacher_name_get_session = $teacher['teacher_name'];
  $teacher_image = $teacher['teacher_image'];
}
$teacher_batch_details = get_table_data2('batch', $con, 'teacher', $teacher_sno);
while ($teacher2 = mysqli_fetch_assoc($teacher_batch_details)) {
  $teacher_batch_id = $teacher2['batch_id'];
}
}else{
    header("location:index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher Dashboard</title>
  <?php include('include/links.php'); ?>
</head>

<body>
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
        <div class="row mt-3 p-2 text-center bg-danger">
          <div class="col-md-12 p-0 m-0">
            <marquee behavior="" direction="">
              <h4 class="text-bg-danger p-0 m-0">Note:Please ensure regular attendance and consistent assignment marking.</h4>
            </marquee>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='students.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-students dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Total Students </p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php

                    $total_records = getTotalStudentsForTeacher($con, 'batch', 'teacher', $teacher_sno);
                    echo "$total_records"; ?>
                  </p>

                </div>
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='batches.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-class dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Total Batches </p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php
                    $total_records1 = getTotalRecords_with($con, 'batch', 'teacher', $teacher_sno);
                    echo "$total_records1"; ?>
                  </p>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center dashboard-card my-border-primary-1 card-shadow-ph">
              <a onclick="window.location='pending_student.php'">
                <div class="card-body">
                  <p class="p-0 m-0 text-primary card-label"><i class="icon-approve_student dashboard-icon"></i></p>
                  <p class="p-0 m-0 text-primary card-label">Students Questions</p>
                  <p class="p-0 m-0 text-primary card-label">
                    <?php
                    $total_records2 = getTotalRecords_with($con, 'query', 'message_status', 'Teacher');
                    echo "$total_records2"; ?>
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
                <h3>Batch Names</h3>
              </div>
              <div class="col-md-12 mb-2 table-responsive" style="height:350px">
                <div class="card mt-3 pt-1">
                  <div class="card-body p-0 m-0">
                    <table class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
                      <thead class="text-bg-primary">
                        <th>Sno</th>
                        <th>Batch Name</th>
                        <th>Course Duration</th>
                        <th>Image</th>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $show_batches = get_table_data2('batch', $con, 'teacher', $teacher_sno);
                          while ($row = mysqli_fetch_assoc($show_batches)) {
                            $teacher = $row['teacher'];
                            $batch_name = $row['batch_name'];
                            $course_id = $row['course_id'];

                            $get_course_name = get_table_data2('course', $con, 'Id', $course_id);
                            while ($row = mysqli_fetch_assoc($get_course_name)) {
                              $show_course_name = $row['course_name'];
                              $show_course_image = $row['course_thumbnail'];
                              $show_course_duration = $row['course_duration'];
                            };

                            $get_teacher_name = get_table_data2('teacher', $con, 'teacher_id', $teacher);
                            $show_teacher_name = mysqli_fetch_assoc($get_teacher_name)['teacher_name'];
                          ?>
                            <td class="vertical-align-middle"></td>
                            <td class="vertical-align-middle"><?php echo $batch_name; ?></td>
                            <td class="vertical-align-middle"><?php echo $show_course_duration . " Months"; ?></td>
                            <td style="width:150px" class="vertical-align-middle"><img src='../batch_image/<?php echo $show_course_image; ?>' height="100px" width="100px"></td>
                        </tr>
                      <?php
                          }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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

</body>

</html>