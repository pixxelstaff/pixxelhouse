<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard -(Batches)</title>
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
        <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
          <div class="card-body">
            <h3 class=" text-center text-light">All Batches</h3>
          </div>
        </div>
        <div class="card my-border-primary-1 my-border-bottom-1">
          <div class="card-body table-body">
            <div class="row mt-2">
              <div class="col-md-9 d-flex align-items-center">
                <label class="w-25">Quick Search</label>

                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
              </div>
              <div class="col-md-3">
                <a href="batches.php"><button type="reset" class="btn btn-dark">Reset</button></a>
                <a href="?slot=<?php echo 'mwf' ?>"><button type="reset" class="btn btn-primary">MWF</button></a>
                <a href="?slot=<?php echo 'tts' ?>"><button type="reset" class="btn btn-primary">TTS</button></a>
              </div>
            </div>
            <div class="table-responsive main-table mt-4 table-height-lg">
              <table id="myTable" class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
                <thead class="bg-primary text-white">
                  <th>Sno</th>
                  <th>Batch Name</th>
                  <th>Batch Code</th>
                  <th>Batch Slot</th>
                  <th>Course Name</th>
                  <th>Teacher</th>
                  <th>Batch Time</th>
                  <th>Lab Number</th>
                  <th>Batch Duration</th>
                  <th>Date of Start</th>
                  <th>Date of End</th>
                  <th>Actions</th>
                </thead>
                <?php
                if (isset($_GET['slot'])) {
                  $slot_get = $_GET['slot'];
                  if ($slot_get == 'tts') {
                    $show_batches = get_table_data2('batch', $con, 'batch_slot', 'TTS');
                  } elseif ($slot_get == 'mwf') {
                    $show_batches = get_table_data2('batch', $con, 'batch_slot', 'MWF');
                  }
                } else {
                  $show_batches = get_table_data('batch', $con);
                }
                while ($row = mysqli_fetch_assoc($show_batches)) {
                  $check_sno = $row['batch_id'];
                  $teacher = $row['teacher'];
                  $course_id = $row['course_id'];

                  // Get teacher name
                  $get_teacher_name = mysqli_fetch_assoc(get_table_data2('teacher', $con, 'teacher_id', $teacher));
                  $show_teacher_name = $get_teacher_name['teacher_name'];

                  // Get course name
                  $get_course_name = mysqli_fetch_assoc(get_table_data2('course', $con, 'Id', $course_id));
                  $show_course_name = $get_course_name['course_name'];

                ?>
                  <tr>
                    <td></td>
                    <td><?php echo $row['batch_name'] ?></td>
                    <td><?php echo $row['batch_code'] ?></td>
                    <td><?php echo $row['batch_slot'] ?></td>
                    <td><?php

                        echo $show_course_name;
                        ?></td>
                    <td><?php echo $show_teacher_name ?></td>
                    <td><?php echo $row['time'] ?></td>
                    <td><?php echo $row['lab_number'] ?></td>
                    <td><?php echo $row['course_duration'] . " " . "Months" ?></td>
                    <td><?php echo $row['date_of_start'] ?></td>
                    <td><?php echo $row['date_of_end'] ?></td>
                    <td>

                      <a href="view_batch.php?batch_sno=<?php echo $row['batch_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
                      <a href="edit_batch.php?batch_sno=<?php echo $row['batch_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Edit</button></a>
                      <a href="delete.php?batch_sno=<?php echo $row['batch_id']; ?>"><button class="btn btn-primary" style="margin-right:5px">Delete</button></a>

                    </td>
                  </tr>
                <?php
                }

                ?>
              </table>
            </div>
          </div>
        </div>

        <?php include('include/footer.php'); ?>
      </div>
    </div>
  </div>
  <?php include('include/javascript.php'); ?>

</body>

</html>