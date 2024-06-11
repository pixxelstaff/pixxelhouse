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
    <title>Finance Dashboard - generate challan</title>
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
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="sel-std">Generate challan</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive col-12 mt-4">
                            <table id="mine-example" class="display custom-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sno = 0;
                                    $studentsData = fetchAllData($con, 'students');
                                    while ($students =  mysqli_fetch_assoc($studentsData)) {
                                        $sno++;
                                        $explodedBatchId = explode(',', $students['batch']);
                                        foreach ($explodedBatchId as  $BatchIdVal) {
                                            $batchDetails = fetchOtherdetails($con, 'batch', 'batch_id', $BatchIdVal);
                                            while ($displayBatchDetails = mysqli_fetch_assoc($batchDetails)) {
                                                $batchName = $displayBatchDetails['batch_name'];
                                                $courseId = $displayBatchDetails['course_id'];
                                            }
                                            $course_Name = fetchOtherdetails($con, 'course', 'Id', $courseId);
                                            while ($dis_course_name = mysqli_fetch_assoc($course_Name)) {
                                                $act__name = $dis_course_name['course_name'];
                                            }
                                    ?>
                                                                  <tr>
                                            <td><?= $sno; ?></td>
                                            <td><?=$students['student_name'] ?></td>
                                            <td><?=$students['father_name'] ?></td>
                                            <td><?= $act__name ?></td>
                                            <td><?= $batchName ?></td>
                                            <td><img src="../images/<?= $students['student_image']  ?>" class="teach-img" alt=""></td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="student-report.php?student-id=<?= $students['sno']?>" class="btn btn-primary">Report</a>
                                                    <a href="pdf.php?id=<?=$students['sno']?>&&batch-id=<?= $BatchIdVal ?>" target="_blank" class="btn btn-danger d-flex gap-1"><span><i class="fa-regular fa-eye"></i></span>challan</a>
                                                    <a href="downloadPdf.php?id=<?=$students['sno']?>&&batch-id=<?= $BatchIdVal ?>" class="btn btn-success d-flex gap-1"><span><i class="fa-solid fa-download"></i></span> challan</a>
                                                </div>
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
        </div>
    </div>


    <?php include('include/javascript.php'); ?>
    <script src="../assets/js/circular.js"></script>
    <script src="f-assets/dashboard-chart.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
    <script>
        new DataTable('#mine-example');
    </script>

</body>

</html>