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
                    <div class="col-12 text-center">
                        <div class="institute-logo-div">
                            <img src="../assets/images/logo.svg" alt="">
                        </div>

                    </div>
                </div>
                <!-- <div class="row my-2">
                    <div class="col-md-3">
                        <div class="col-12 d-flex flex-column gap-2 form-element-div">
                            <label for="">search**</label>
                            <input type="text" name="" id="" placeholder="search batch">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-12 d-flex flex-column gap-2 form-element-div">
                            <label for="">sort by batch**</label>
                            <select name="" id="">
                                <option value="">select batch</option>
                                <option value="">web 110</option>
                                <option value="">GD 154</option>
                                <option value="">Ui/UX 160</option>
                                <option value="">web 110</option>
                                <option value="">GD 154</option>
                                <option value="">Ui/UX 160</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-12 d-flex flex-column gap-2 form-element-div">
                            <label for="">sort by course**</label>
                            <select name="" id="">
                                <option value="">select batch</option>
                                <option value="">web design</option>
                                <option value="">web developemnt</option>
                                <option value="">Grapic Design</option>
                                <option value="">wordpress</option>
                                <option value="">ui/ux designing</option>
                                <option value="">Video graphics</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-12 d-flex flex-column gap-2 form-element-div">
                            <label for="">sort by Teacher**</label>
                            <select name="" id="">
                                <option value="">Select by Teacher</option>
                                <option value="january">Khizer Habib</option>
                                <option value="feb">Qaiser ghouri</option>
                                <option value="March">Sir kahsif</option>
                                <option value="April">sir zubar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 py-2 d-flex justify-content-end"><a href="" class="btn btn-warning">Save as Pdf</a></div>
                </div> -->
                <?php
                $sno = 0;
                $batch = fetchAllData($con, 'batch');
                while ($showData =  mysqli_fetch_assoc($batch)) {
                    $sno++;
                ?>
                    <div class="row my-1">
                        <div class="col-12 my-2 text-center">
                            <h2 class="col-label"><?php echo $showData['batch_name'] . "-performance"; ?></h2>
                        </div>
                        <div class="col-12 table-responsive py-2">
                            <table id="batch-table<?php echo $sno; ?>" class="display custom-table batch-report-table" style="width:100%">
                                <!-- <table class="custom-table activity-data-table w-100"> -->
                                <thead>
                                    <tr>
                                        <th scope="col">Sno</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Father-Name</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Teacher</th>
                                        <th scope="col">Total Class</th>
                                        <th scope="col">Total Month</th>
                                        <th scope="col">Present-class</th>
                                        <th scope="col">Absent-Class</th>
                                        <th scope="col">Leave-class</th>
                                        <th scope="col">Skip-class</th>
                                        <th scope="col">Assignment</th>
                                        <th scope="col">done</th>
                                        <th scope="col">Undone</th>
                                        <th scope="col">Fees Paid</th>
                                        <th scope="col">Fees unpaid</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //code for course name
                                    $batchId = $showData['batch_id'];
                                    $student_sno = 0;
                                    $tableData = "SELECT * FROM `students` WHERE FIND_IN_SET(`batch`,?)";
                                    $tableDataP = mysqli_prepare($con, $tableData);
                                    mysqli_stmt_bind_param($tableDataP, 's',  $batchId);
                                    mysqli_stmt_execute($tableDataP);
                                    $results = mysqli_stmt_get_result($tableDataP);
                                    //now fetching teacher id and course id
                                    $essential_data = fetchOtherdetails($con, 'batch', 'batch_id',  $batchId);
                                    while ($dis = mysqli_fetch_assoc($essential_data)) {
                                        $teachId = $dis['teacher'];
                                        $courseId = $dis['course_id'];
                                    }

                                    //for getting course_Name 
                                    $course_Name = fetchOtherdetails($con, 'course', 'Id', $courseId);
                                    while ($dis_course_name = mysqli_fetch_assoc($course_Name)) {
                                        $act__name = $dis_course_name['course_name'];
                                    }
                                    // ends here

                                    //for getting teacher_Name 

                                    $teacher_Name = fetchOtherdetails($con, 'teacher', 'teacher_id', $teachId);
                                    while ($dis_course_name = mysqli_fetch_assoc($teacher_Name)) {
                                        $act__t__name = $dis_course_name['teacher_name'];
                                    }

                                    // ends here
                                    // taking total number of class
                                    $attendance_data = fetchOtherdetails($con, 'attandance', 'batch_name',  $batchId);
                                    $total_Class = mysqli_num_rows($attendance_data);
                                    //fetching distinct month count for each batch
                                    $BatchMonth = "SELECT DISTINCT `attendance_month` FROM `attandance` WHERE `batch_name` = '$batchId'";
                                    $BatchMonthQ = mysqli_query($con, $BatchMonth);
                                    $countTotalMonth = mysqli_num_rows($BatchMonthQ);
                                    //printing student data below?ok
                                    while ($students = mysqli_fetch_assoc($results)) {
                                        $student_sno++;
                                    ?>
                                        <tr>
                                            <td><?= $student_sno ?></td>
                                            <td><?= $students['student_name']; ?></td>
                                            <td><?= $students['father_name']; ?></td>
                                            <td><?= $act__name; ?></td>
                                            <td><?= $act__t__name; ?></td>
                                            <td><?= $total_Class; ?></td>
                                            <td><?= $countTotalMonth . " months" ?></td>
                                            <!-- critical attendance data for a $students fetching from attendance -->
                                            <?php
                                            $presentClasses = 0;
                                            $absentClasses = 0;
                                            $leavedClasses = 0;
                                            $skipClasses = 0;
                                            $Tassignment = 0;
                                            $assignmentDone = 0;
                                            $assignmentNotDone = 0;
                                            $measure_attendance_data = fetchOtherdetails($con, 'attandance', 'batch_name', $batchId);
                                            while ($measurement = mysqli_fetch_assoc($measure_attendance_data)) {
                                                // finding index of student data column to get other details
                                                $batch_students_ids = explode(',', $measurement['student_ids']);
                                                $studentIdIndex = array_search($students['sno'], $batch_students_ids);
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
                                                $paidNum = 0;
                                                $unPaidNum = 0;
                                                $paid_q = fetchOtherdetailsCol2($con,'students_fees','std_data',$students['sno'],'batch_data',$batchId); 
                                                while($paidFeeStatus = mysqli_fetch_assoc($paid_q)){
                                                    if($paidFeeStatus['fees_status'] == '1'){
                                                        $paidNum++;
                                                    }
                                                    else{
                                                        $unPaidNum++;
                                                    }
                                                }
                                            }

                                            ?>
                                            <td><?= $presentClasses; ?></td>
                                            <td><?= $absentClasses; ?></td>
                                            <td><?= $leavedClasses; ?></td>
                                            <td><?= $skipClasses; ?></td>
                                            <td><?= $Tassignment ?></td>
                                            <td><?= $assignmentDone ?></td>
                                            <td><?= $assignmentNotDone ?></td>
                                            <td><?= $paidNum ?> months</td>
                                            <td><?= $unPaidNum ?> month</td>
                                            <td><a href="student-report.php?student-id=<?= $students['sno'] ?>" data-id='<?= $students['sno'] ?>' class="view-btn">View</a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                }
                ?>





                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>


    <?php include('include/javascript.php'); ?>
    <!-- <script src="../assets/js/circular.js"></script> -->
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
    <script src="f-assets/dashboard-chart.js"></script>




</body>

</html>