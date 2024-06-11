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
                <div class="row">
                    <div class="col-12">
                        <h2 class="col-label">Teacher - report</h2>
                    </div>
                    <div class="row my-1">
                        <div class="col-12 table-responsive py-2">
                            <table class="custom-table activity-data-table w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Sno</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Total batches</th>
                                        <th scope="col">Total Student</th>
                                        <th scope="col">Current Student</th>
                                        <th scope="col">Left Student</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">Teacher Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $teacherData = fetchAllData($con, 'teacher');
                                    $TTeacherCount = mysqli_num_rows($teacherData);
                                    $serialNo = 0;
                                    while ($show = mysqli_fetch_assoc($teacherData)) {
                                        $serialNo++;
                                        $batchData = fetchOtherdetails($con, 'batch', 'teacher', $show['teacher_id']);
                                        $batch_arr = [];
                                        while ($dis = mysqli_fetch_assoc($batchData)) {
                                            $batch_arr[] = $dis['batch_id'];
                                        }
                                        $CurrentbatchStdCount = 0;
                                        $leftBatchStdCount = 0;
                                        foreach ($batch_arr as $bCount) {
                                            $count = fetchOtherdetails($con, 'students', 'batch', $bCount);
                                            $CurrentbatchStdCount += mysqli_num_rows($count);
                                            $leftCount = fetchOtherdetails($con, 'left_student', 'batch', $bCount);
                                            $leftBatchStdCount += mysqli_num_rows($leftCount);
                                        }
                                        $totalStudent = $CurrentbatchStdCount + $leftBatchStdCount;
                                        $currentMonth = date('F');

                                    ?>
                                        <tr>
                                            <td><?= $serialNo ?></td>
                                            <td><?= $show['teacher_name'] ?></td>
                                            <td><?= count($batch_arr) ?></td>
                                            <td><?= $totalStudent ?></td>
                                            <td><?= $CurrentbatchStdCount ?></td>
                                            <td><?= $leftBatchStdCount ?></td>
                                            <td><?= $currentMonth ?></td>
                                            <td class="text-center"><img src="../images/<?= $show['teacher_image'] ?>" class="teach-img" alt=""></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="col-label">PixxelHouse Monthly - report</h2>
                    </div>
                    <div class="row my-1">
                        <div class="col-12 table-responsive py-2">
                            <table class="custom-table activity-data-table w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Sno</th>
                                        <th scope="col">Total batches</th>
                                        <th scope="col">New Batches</th>
                                        <th scope="col">Total Course</th>
                                        <th scope="col">Total Teacher</th>
                                        <th scope="col">Total Student</th>
                                        <th scope="col">New Student</th>
                                        <th scope="col">Left Student</th>
                                        <th scope="col">Month</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // function based on date
                                    function dateBase($connection, $tablename, $column, $date1, $date2)
                                    {
                                        $currentMonthBatch = "SELECT * FROM `$tablename` WHERE `$column` LIKE '%$date1%' OR `$column` LIKE '%$date2%'";
                                        $date_qry = mysqli_query($connection, $currentMonthBatch);

                                        return $date_qry;
                                    }
                                    $currentMonthDate = date('m-Y');
                                    $revCurrentMonthDate = date('Y-m');
                                    $secondDateFormat = date('m-y');
                                    // $currentMonthDate ='1-2024';
                                    // $revCurrentMonthDate = '2024-1';
                                    // $secondDateFormat = '1-24';
                                    $fetchBatch = fetchAllData($con, 'batch');
                                    $totalBatches = mysqli_num_rows($fetchBatch);
                                    $currentMonthBatch = "SELECT * FROM `batch` WHERE `date_of_start` LIKE '%$currentMonthDate%' OR `date_of_start` LIKE '%$revCurrentMonthDate%'";
                                    $qry = mysqli_query($con, $currentMonthBatch);
                                    $thisMonthBatch = mysqli_num_rows($qry);
                                    //counting total course
                                    $course = fetchAllData($con, 'course');
                                    $TotalCourseCount = mysqli_num_rows($course);
                                    //counting total students
                                    $overall_std = fetchAllData($con, 'students');
                                    $students_t_num = mysqli_num_rows($overall_std);
                                    // calculating current students that have joined;
                                    $dateStudentq = dateBase($con, 'students', 'date', $currentMonthDate, $secondDateFormat);
                                    $current__std = mysqli_num_rows($dateStudentq);
                                    //calculating the number of students that has left today
                                    $dateQleftStd = dateBase($con, 'left_student', 'left_date', $currentMonthDate, $revCurrentMonthDate);
                                    $countLeftStds = mysqli_num_rows($dateQleftStd);
                                    ?>
                                    <tr>
                                        <td>1</td>
                                        <td><?= $totalBatches ?></td>
                                        <td><?= $thisMonthBatch ?></td>
                                        <td><?= $TotalCourseCount ?></td>
                                        <td><?= $TTeacherCount ?></td>
                                        <td><?= $students_t_num ?></td>
                                        <td><?= $current__std ?></td>
                                        <td><?= $countLeftStds ?></td>
                                        <td><?= $currentMonth ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="col-label">Revenue - report</h2>
                    </div>
                    <div class="row my-1">
                        <div class="col-12 table-responsive py-2">
                            <table class="custom-table activity-data-table w-100">
                                <thead>
                                    <tr>
                                        <th scope="col">Sno</th>
                                        <th scope="col">Total Revenue</th>
                                        <th scope="col">Paid Revenue</th>
                                        <th scope="col">unpaid Revenue</th>
                                        <th scope="col">Month </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $feeDetail = "SELECT 
                                 (SELECT SUM(`feeAmount`) FROM `students_fees` WHERE `month` = '$currentMonth') AS 'TotalRevenue',
                                 (SELECT SUM(`feeAmount`) FROM `students_fees` WHERE `fees_status` = '1' AND `month` = '$currentMonth') AS 'paidRevenue',
                                 (SELECT SUM(`feeAmount`) FROM `students_fees` WHERE `fees_status` = '0' AND `month` = '$currentMonth') AS 'unPaidRevenue'";

                                    $feeDetailQ = mysqli_query($con, $feeDetail);

                                    while ($feeNumbers = mysqli_fetch_assoc($feeDetailQ)) {
                                    ?>
                                        <tr>
                                            <td>1</td>
                                            <td><?= $feeNumbers['TotalRevenue'] ?></td>
                                            <td><?= $feeNumbers['paidRevenue']  ?></td>
                                            <td><?= $feeNumbers['unPaidRevenue']  ?></td>
                                            <td><?= $currentMonth ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 py-2">
                        <h2 class="col-label m-0">Institute - report</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 row my-4">
                        <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
                            <h2 class="cir-lab">Fees Paid</h2>
                            <div class="circular-progress">
                                <span class="progress-value" data-end-val="88">0%</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
                            <h2 class="cir-lab">Fees Unpaid</h2>

                            <div class="circular-progress">
                                <span class="progress-value" data-end-val="12">0%</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
                            <h2 class="cir-lab">Students Increase</h2>

                            <div class="circular-progress">
                                <span class="progress-value" data-end-val="90">0%</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 cir-parent">
                            <h2 class="cir-lab">Revenue Increase</h2>
                            <div class="circular-progress">
                                <span class="progress-value" data-end-val="33">0%</span>
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


</body>

</html>