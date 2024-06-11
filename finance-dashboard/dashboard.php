<?php
session_start();
if (!isset($_SESSION['finance_manager_login'])) {
  header("location:index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finance Dashboard</title>
  <?php include('include/links.php'); ?>
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">

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
        <div class="row">
          <div class="col-lg-9 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                <div class="col-12 finance-card" id="f-card1">
                  <span class="card-icon"><i></i></span>
                  <h6>Total Fees</h6>
                  <div id="spark1"></div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                <div class="col-12 finance-card" id="f-card2">
                  <span class="card-icon"><i></i></span>
                  <h6>Fee Paid</h6>
                  <div id="spark2"></div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                <div class="col-12 finance-card" id="f-card3">
                  <span class="card-icon"><i></i></span>
                  <h6>Fee Unpaid</h6>
                  <div id="spark3"></div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-12 my-3 main-graph">
                <div class="main-graph w-100" id="studentStatics"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <h4 class="tab-head">Recent Transitions</h4>
                <div class="col-12 my-3 tab-p">
                  <table id="transition-data-table" class="display custom-table" style="width:100%"> <!-- <table class="transitions-data-table"> -->
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Name</th>
                        <th>Father-Name</th>
                        <th>Batch</th>
                        <th>Fees-Month</th>
                        <th>Fees-status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ind = 0;
                      $fetchAllStudent = fetchAllData($con, 'students');
                      while ($sh = mysqli_fetch_assoc($fetchAllStudent)) {
                        $ind++;

                        $currentMonth = date("F");
                        $studentFeeData = "SELECT * FROM `students_fees` WHERE `month` = ? AND `std_data` = ?  ";
                        $studentFeeDataP = mysqli_prepare($con, $studentFeeData);
                        mysqli_stmt_bind_param($studentFeeDataP, "ss", $currentMonth, $sh['sno']);
                        mysqli_stmt_execute($studentFeeDataP);
                        $fee_result = mysqli_stmt_get_result($studentFeeDataP);
                        
                        if (mysqli_num_rows($fee_result) > 0) {
                          while ($displayFeeData = mysqli_fetch_assoc($fee_result)) {
                         
                      ?>
                            <tr>
                              <td><?php echo $ind; ?></td>
                              <!-- //query to get student name and father name -->

                              <td><?php echo $sh['student_name']; ?></td>
                              <td><?php echo $sh['father_name']; ?></td>

                              <?php
                              $b_id =  $displayFeeData['batch_data'];
                              $batchName = mysqli_query($con, "SELECT * FROM `batch` WHERE `batch_id` = '$b_id'");
                              while ($disName = mysqli_fetch_assoc($batchName)) {
                              ?>
                                <td><?php echo $disName['batch_name']; ?></td>
                              <?php
                              }
                              ?>
                              <td><?php echo $displayFeeData['month'] ?></td>
                              <?php $status_ind =  $displayFeeData['fees_status'] == '1' ? 'paid' : 'unpaid'; ?>
                              <td><a href="javascript:void(0)" class="<?php echo $status_ind ?> act-btn"><?php echo $status_ind ?></a></td>
                              <td>
                                <a href="javascript:void(0)" data-id='1' class="view-btn">Invoice</a>
                                <a href="student-report.php?student-id=<?php echo $displayFeeData['std_data']; ?>&batch-id=<?php echo $b_id; ?>" data-id='1' class="view-btn">Finance Report</a>
                              </td>
                            </tr>
                      <?php
                          }
                        }
                        else{
                          ?>
                            <tr>
                              <td colspan="100">
                                <?= $sh['student_name'] ?> data is not uploaded
                              </td>
                            </tr>
                          <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12">
            <!-- first div of side column -->
            <div class="col-12 cir-div">
              <h2 class="sec-col-h2">Monthly-Analytics</h2>
              <div id="chartDiv" class="d-flex justify-content-center"></div>
              <div class="statics-data w-100 d-flex justify-content-around gap-2">
                <span class="ratio-data " id="paid-number"></span>
                <span class="ratio-data unpaid" id="unpaid-number"></span>
              </div>
            </div>
            <!-- second coulm of joined and left student -->
            <!-- writing query and logic according to this month -->
            <?php
            $curMon = date('m-Y');
            $curMon2 = date('m-y');
            // Create a prepared statement with placeholders
            $selectData = "SELECT * FROM `students` WHERE `date` LIKE CONCAT('%', ?, '%') OR `date` LIKE CONCAT('%', ?, '%')";
            $selectDataP = mysqli_prepare($con, $selectData);
            if ($selectDataP) {
              mysqli_stmt_bind_param($selectDataP, 'ss', $curMon, $curMon2);
              mysqli_stmt_execute($selectDataP);
              $result = mysqli_stmt_get_result($selectDataP);
              $newStudent = mysqli_num_rows($result);
              mysqli_stmt_close($selectDataP);
            } else {
              echo "Error preparing statement: " . mysqli_error($con);
            }

            // checking left student

            $leftStudent = "SELECT * FROM `left_student` WHERE `left_date` LIKE CONCAT('%', ?, '%')";
            $leftStudentp = mysqli_prepare($con, $leftStudent);
            mysqli_stmt_bind_param($leftStudentp, 's', $curMon);
            mysqli_stmt_execute($leftStudentp);
            $l_result = mysqli_stmt_get_result($leftStudentp);
            $left_student = mysqli_num_rows($l_result);
            //total student
            $tStd = fetchAllData($con, 'students');
            $tStdNumber = mysqli_num_rows($tStd);
            $actualTotalNumber = $tStdNumber + $left_student;
            $leftStudentPercentage = $left_student != 0 ? floor(($left_student / $actualTotalNumber) * 100) : 0;
            $newStudentPercentage = $newStudent != 0 ? floor(($newStudent / $actualTotalNumber) * 100) : 0;


            ?>
            <div class="col-12 std_imp_data overflow-hidden my-4">
              <div class="statics-data-col col-12 d-flex my-4">
                <div class="col-6 label-div d-flex flex-column gap-2 justify-content-center align-items-center">
                  <h6>new students</h6>
                  <p class="std_count_p paid"><?= $newStudent; ?>+</p>
                </div>
                <div class="col-6 text-center">
                  <div class="circular-progress">
                    <span class="progress-value" data-end-val="<?= $newStudentPercentage; ?>">0%</span>
                  </div>
                </div>
              </div>
              <div class="statics-data-col col-12 d-flex my-4">
                <div class="col-6 label-div d-flex flex-column gap-2 justify-content-center align-items-center">
                  <h6>Left students</h6>
                  <p class="std_count unpaid">-<?= $left_student; ?></p>
                </div>
                <div class="col-6 text-center">
                  <div class="circular-progress">
                    <span class="progress-value" data-end-val="<?= $leftStudentPercentage ?>">0%</span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <?php include('include/footer.php'); ?>
      </div>
    </div>
  </div>


  <?php include('include/javascript.php'); ?>
  <script src="../assets/js/circular.js"></script>
  <script src="f-assets/dashboard-chart.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
  <script>
    new DataTable('#transition-data-table');
  </script>


</body>

</html>