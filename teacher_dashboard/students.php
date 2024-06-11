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
  <title>Teacher Dashboard - (Students)</title>
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
            <h3 class=" text-center text-light">All Students</h3>
          </div>
        </div>
        <div class="card my-border-primary-1 my-border-bottom-1">
          <div class="card-body table-body">
            <div class="row mt-2">
              <div class="col-md-12 d-flex align-items-center">
                <label class="w-25">Quick Search</label>

                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
              </div>
            </div>
            <div class="table-responsive main-table mt-4">
              <table id="myTable" class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
                <thead class="bg-primary text-white">
                  <th>Sno</th>
                  <th>Student Name</th>
                  <th>Father Name</th>
                  <th>Student Contact</th>
                  <th>Batch Name</th>
                  <th>Batch Code</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Education</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Actions</th>
                </thead>
                <?php
                $displayed_students = array(); // Array to track displayed students

                $slot_get = isset($_GET['slot']) ? $_GET['slot'] : '';

                if ($slot_get == 'tts') {
                  $batch_slot = 'TTS';
                } elseif ($slot_get == 'mwf') {
                  $batch_slot = 'MWF';
                } else {
                  $batch_slot = '';
                }

                if ($batch_slot != '') {
                  $batch_ids_result = mysqli_query($con, "SELECT `batch_id` FROM `batch` WHERE `batch_slot`='$batch_slot' AND `batch_id`='$teacher_batch_id'");
                } else {
                  $batch_ids_result = get_table_data2('batch', $con, 'teacher', $teacher_sno);
                }

                while ($batch_row = mysqli_fetch_assoc($batch_ids_result)) {
                  $new_batch_ids[] = $batch_row['batch_id'];
                }

                $show_batches = get_table_data('students', $con);
                while ($row = mysqli_fetch_assoc($show_batches)) {
                  $students_batch_ids = explode(',', $row['batch']);

                  // Check if the student's batch IDs intersect with teacher's batch IDs
                  $matching_batches = array_intersect($students_batch_ids, $new_batch_ids);

                  // If there are matching batches and the student hasn't been displayed, show the name
                  if (!empty($matching_batches) && !in_array($row['sno'], $displayed_students)) {
                    $displayed_students[] = $row['sno'];
                ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row['student_name'] ?></td>
                      <td><?php echo $row['father_name'] ?></td>
                      <td><?php echo $row['student_contact'] ?></td>
                      <td><?php
                          foreach ($matching_batches as $batch_id) {
                            $batch_name_result = mysqli_query($con, "SELECT * FROM `batch` WHERE `batch_id`='$batch_id'");
                            $batch_name_row = mysqli_fetch_assoc($batch_name_result);
                            echo $batch_name_row['batch_name'] . "<br>";
                          }
                          ?></td>
                      <td>
                        <?php
                        foreach ($matching_batches as $batch_id) {
                          $batch_name_result = mysqli_query($con, "SELECT * FROM `batch` WHERE `batch_id`='$batch_id'");
                          $batch_name_row = mysqli_fetch_assoc($batch_name_result);
                          echo $batch_name_row['batch_code'] . "<br>";
                        }
                        ?>
                      </td>
                      <td><?php echo $row['date_of_birth'] ?></td>
                      <td><?php echo $row['gender'] ?></td>
                      <td><?php echo $row['qualification'] ?></td>
                      <td><?php echo $row['email'] ?></td>
                      <td><?php echo $row['address'] ?></td>
                      <td><img src="../images/<?php echo $row['student_image'] ?>" class="img img-fluid"></td>
                      <td>

                        <a href="student_attendance.php?student_sno=<?php echo $row['sno']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>

                      </td>
                    </tr>
                <?php
                  }
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