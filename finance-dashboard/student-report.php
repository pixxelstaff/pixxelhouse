<?php
session_start();
if(!isset($_SESSION['finance_manager_login'])){
  header("location:index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>student-report || Finance Dashboard</title>
  <?php include('include/links.php'); ?>
</head>

<body>

  <?php
  if (isset($_GET['student-id'])) {
    $id = $_GET['student-id'];
    $studentData = fetchOtherdetails($con, 'students', 'sno', $id);
    while ($students = mysqli_fetch_assoc($studentData)) {
      $stdId = $students['sno'];
      $name = $students['student_name'];
      $fathername = $students['father_name'];
      $email = $students['email'];
      $studentNum = $students['student_contact'];
      $fatherEmail = $students['father_email'];
      $fatherNum = $students['home_contact'];
      $studentImage = $students['student_image'];
      $studentFees = $students['fees'];
      //taking name of batch using ids
      $explodeBatchIds = explode(',', $students['batch']);
      $conacteBatchName = '';
      $concateCourseName = '';
      foreach ($explodeBatchIds as  $value) {
        $batch = fetchOtherdetails($con, 'batch', 'batch_id', $value);
        while ($bName = mysqli_fetch_assoc($batch)) {
          $conacteBatchName .= $bName['batch_name'] . ",";
          $courseId = $bName['course_id'];
        }
        $course_Name = fetchOtherdetails($con, 'course', 'Id', $courseId);
        while ($dis_course_name = mysqli_fetch_assoc($course_Name)) {
          $concateCourseName = $dis_course_name['course_name'] . ",";
        }
      }
    }
  } else {
  ?>
    <script>
      window.location.href = 'students.php'
    </script>
  <?php
  }
  ?>

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

        <div class="row">
          <div class="col-12 text-center">
            <div class="institute-logo-div">
              <img src="../assets/images/logo.svg" alt="">
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
            <h2 class="student-name"><?= $name ?></h2>
            <ul class="student-data my-4 w-100 d-flex flex-column">
              <li><span class="label-span"><i>Father-Name</i></span> <?= $fathername ?></li>
              <li><span class="label-span"><i>Course</i></span><?= trim($concateCourseName, ',') ?></li>
              <li><span class="label-span"><i>Batch</i></span><?= trim($conacteBatchName, ',') ?></li>
              <li><span class="label-span"><i>Conatct-no</i></span><?= $studentNum ?></li>
              <li><span class="label-span"><i>email</i></span><?= $email ?></li>
              <li><span class="label-span"><i>F-conatct-no:</i></span><?= $fatherNum ?></li>
              <li><span class="label-span"><i>F-email</i></span><?= $fatherEmail ?></li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
            <img src="../images/<?= $studentImage ?>" class="profile-img " alt="">
          </div>
        </div>

        <div class="row">
          <?php

          foreach ($explodeBatchIds  as $expValue) {
            $stdClassCount = '';
            $expBdetails = fetchOtherdetails($con, 'batch', 'batch_id', $expValue);
            $measure_attendance_data = fetchOtherdetails($con, 'attandance', 'batch_name', $expValue);
            $stdClassCount = mysqli_num_rows($measure_attendance_data);
            //counting total assignment given
            while ($dis = mysqli_fetch_assoc($expBdetails)) {
          ?>
              <div class="col-12">
                <h2 class="col-label"><?= $dis['batch_name'] ?>-performance</h2>
              </div>
              <div class="col-12 table-responsive py-2">
                <table class="custom-table activity-data-table w-100">
                  <thead>
                    <tr>
                      <?php
                      $head = ['Total-class', 'Present-class', 'Absent-Class', 'Leave-class', 'Skip-class', 'Assignment', 'done', 'Undone'];
                      foreach ($head as $head_value) {
                      ?>
                        <th><?= $head_value ?></th>
                      <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $presentClasses = 0;
                    $absentClasses = 0;
                    $leavedClasses = 0;
                    $skipClasses = 0;
                    $assignmentDone = 0;
                    $assignmentNotDone = 0;
                    $Tassignment = 0;
                    while ($measurement = mysqli_fetch_assoc($measure_attendance_data)) {
                      // finding index of student data column to get other details
                      $batch_students_ids = explode(',', $measurement['student_ids']);
                      $studentIdIndex = array_search($stdId, $batch_students_ids);
                      // calculating present - absent - leave -skip ones
                      $explodeAttendanceData = explode(',', $measurement['attendance_status']);
                      if ($explodeAttendanceData[$studentIdIndex] == 'P') {
                        $presentClasses++;
                      } elseif ($explodeAttendanceData[$studentIdIndex] == 'A') {
                        $absentClasses++;
                      } elseif ($explodeAttendanceData[$studentIdIndex] == 'L') {
                        $leavedClasses++;
                      } else {
                        $skipClasses++;
                      }
                      if ($measurement['assigments'] != '') {
                        $Tassignment++;
                      }
                      $explodeAssignmentData = explode(',', $measurement['assigments_done']);
                      if ($explodeAssignmentData[$studentIdIndex] == '1') {
                        $assignmentDone++;
                      } elseif ($explodeAssignmentData[$studentIdIndex] == '0') {
                        $assignmentNotDone++;
                      }
                      //checking upaid and paid data of student
                      //checking upaid and paid data of student
                      $paidNum = 0;
                      $unPaidNum = 0;
                      $paid_q = fetchOtherdetailsCol2($con, 'students_fees', 'std_data', $stdId, 'batch_data', $expValue);
                      $totalFeeMonth = mysqli_num_rows($paid_q);
                      while ($paidFeeStatus = mysqli_fetch_assoc($paid_q)) {
                        if ($paidFeeStatus['fees_status'] == '1') {
                          $paidNum++;
                        } else {
                          $unPaidNum++;
                        }
                      }
                    }
                    //calculating the percentage data

                    $presentPercentage = ($stdClassCount != 0 && $presentClasses != 0) ? floor(($presentClasses / $stdClassCount)*100) : 0;
                    $absentPercentage =($stdClassCount != 0  && $absentClasses != 0) ?  floor(($absentClasses / $stdClassCount)*100) : 0;
                    $assignmentPercentage = ($stdClassCount != 0  && $assignmentDone != 0) ?  floor(($assignmentDone / $Tassignment)*100) : 0;
                    $feePaidPercentage = ($stdClassCount != 0   && $paidNum != 0) ?  floor(($paidNum / $totalFeeMonth)*100) : 0;

                    // $presentPercentage = 67;
                    // $absentPercentage =87;
                    // $assignmentPercentage = 43;
                    // $feePaidPercentage = 45;
                    ?>
                    <tr>
                      <td><?= $stdClassCount ?></td>
                      <td><?= $presentClasses ?></td>
                      <td><?= $absentClasses ?></td>
                      <td><?= $leavedClasses ?></td>
                      <td><?= $skipClasses ?></td>
                      <td><?= $Tassignment ?></td>
                      <td><?= $assignmentDone ?></td>
                      <td><?= $assignmentNotDone ?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <div class="col-12 row my-4">
            <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
              <h2 class="cir-lab">Attended Class</h2>
              <div class="circular-progress">
                <span class="progress-value" data-end-val="<?= $presentPercentage ?>">0%</span>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
              <h2 class="cir-lab">Absent Class</h2>

              <div class="circular-progress">
                <span class="progress-value" data-end-val="<?= $absentPercentage ?>">0%</span>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
              <h2 class="cir-lab">Assignment done</h2>

              <div class="circular-progress">
                <span class="progress-value" data-end-val="<?= $assignmentPercentage ?>">0%</span>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
              <h2 class="cir-lab">Fees paid</h2>
              <div class="circular-progress">
                <span class="progress-value" data-end-val="<?= $feePaidPercentage ?>">0%</span>
              </div>
            </div>
          </div>
          <?php
            }
          }
          ?>

          <div class="col-12">
            <h2 class="col-label">Fees Submission data</h2>
          </div>
          <div class="col-12 table-responsive my-3">
            <table class="custom-table activity-data-table w-100">
              <thead>
                <tr>
                  <?php
                  $head = ['Sno', 'Name', 'Father-Name', 'Course', 'Batch', 'Month', 'Fee', 'Amount', 'Action'];
                  foreach ($head as $head_value) {
                  ?>
                    <th><?= $head_value ?></th>
                  <?php
                  }

                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $selectFeeData = fetchOtherdetails($con, 'students_fees', 'std_data', $stdId);
                $serialNo = 0;
                while ($data = mysqli_fetch_assoc($selectFeeData)) {
                  $serialNo++;
                ?>
                  <td><?= $serialNo ?></td>
                  <td><?= $name ?></td>
                  <td><?= $fathername ?></td>
                  <?php

                  $batchNameThroughId = fetchOtherdetails($con, 'batch', 'batch_id', $data['batch_data']);
                  while ($nm = mysqli_fetch_assoc($batchNameThroughId)) {
                    $b__name = $nm['batch_name'];
                    $c__id = $nm['course_id'];
                  }
                  $std_cname = fetchOtherdetails($con, 'course', 'Id', $c__id);
                  while ($cnm = mysqli_fetch_assoc($std_cname)) {
                    $c__name = $cnm['course_name'];
                  }
                  ?>
                  <td><?= $c__name ?></td>
                  <td><?= $b__name ?></td>

                  <td><?= $data['month'] ?></td>
                  <td><?= $studentFees ?></td>
                  <td>
                    <?php
                    if ($data['fees_status'] == '1') {
                    ?>
                      <span href="javascript:void(0)" class="paid act-btn">paid</span>
                    <?php
                    } else {
                    ?>
                      <span href="javascript:void(0)" class="unpaid act-btn">unpaid</span>
                    <?php
                    }
                    ?>
                  </td>
                  <td><a href="javascript:void(0)" data-id='1' class="view-btn">Invoice</a></td>
                <?php
                }
                ?>

        



              </tbody>
            </table>
          </div>

        </div>


        <?php include('include/footer.php'); ?>
      </div>
    </div>
  </div>


  <?php include('include/javascript.php'); ?>
  <script src="../assets/js/circular.js"></script>
  <script src="f-assets/dashboard-chart.js"></script>


</body>

</html>