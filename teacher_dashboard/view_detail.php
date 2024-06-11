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
    <title>Teacher Dashboard - (Attendance)</title>
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
                <div class="card bg-primary">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Assignment Detail</h3>
                    </div>
                </div>
                <?php
                $get_assignment = $_GET['assignment'];
                $show_assignment_detail = get_table_data2('attandance', $con, 'attendance_id', $get_assignment);
                while ($show = mysqli_fetch_assoc($show_assignment_detail)) {
                $assignment_name=$show['assigments'];
                $assignment_detail=$show['assigment_detail'];
                }
                ?>
                <div class="row">
                    <div class="col-md-12">
                    <a href="assigment.php">
                                        <input type="button" class="btn btn-primary mt-3 float-start" value="Back">
                                    </a>
                    </div>
                </div>
               <div class="card">
               <div class="card-header text-center">
                        <h1><?php echo $assignment_name ?></h1>
                    </div>
                    <div class="card-body">
                       <div class="row">
                        <div class="col-md-12">
                        <h4 class="text-primary">Assignment Detail</h4>
                        </div>
                       </div>
                       <div class="row mt-3">
                        <div class="col-md-12">
                        <p class="card-text"><?php echo $assignment_detail ?></p>
                        </div>
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