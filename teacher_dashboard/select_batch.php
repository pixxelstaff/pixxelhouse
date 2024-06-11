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
    <title>Teacher Dashboard - (Select Batch)</title>
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
                <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
                    <div class="card-body">
                        <?php
                        if (isset($_GET['page_assignment'])) {
                            $get_page = $_GET['page_assignment'];
                        }
                        if (isset($get_page) && $get_page == 1) {
                        ?>
                            <h3 class=" text-center text-light">Select To Add Assignment</h3>
                        <?php
                        } elseif (isset($get_page) && $get_page == 2) {
                        ?>
                            <h3 class=" text-center text-light">Select To Mark Assignment</h3>
                        <?php
                        } elseif (isset($get_page) && $get_page == 3) {
                        ?>
                            <h3 class=" text-center text-light">Select To Edit Attendance</h3>
                        <?php
                        } elseif (isset($get_page) && $get_page == 4) {
                        ?>
                            <h3 class=" text-center text-light">Select To Edit Assignment</h3>
                        <?php
                        } else {
                        ?>
                            <h3 class=" text-center text-light">Select To Add Attendance</h3>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body">
                        <div class="row mt-4">
                            <?php
                            $show_batches = get_table_data2('batch', $con, 'teacher', $teacher_sno);
                            while ($row = mysqli_fetch_assoc($show_batches)) {
                                $check_sno = $row['batch_id'];
                                $teacher = $row['teacher'];
                                $course_id = $row['course_id'];
                                // $batch_image = $row['image'];
                                $show_course = get_table_data2('course', $con, 'Id', $course_id);
                                while ($row2 = mysqli_fetch_assoc($show_course)) {
                                    $course_name = $row2['course_name'];
                                    $course_image = $row2['course_thumbnail'];
                                }
                            ?>
                                <div class="col-md-4">
                                    <?php
                                    if (isset($get_page) && $get_page == 1) {
                                    ?>
                                        <a class="d-flex" href="add_assignment.php?batch_id=<?php echo $check_sno ?>">
                                        <?php
                                    } elseif (isset($get_page) && $get_page == 2) {
                                        ?>
                                            <a class="d-flex" href="mark_assigment.php?batch_id=<?php echo $check_sno ?>">

                                            <?php
                                        } elseif (isset($get_page) && $get_page == 3) {
                                            ?>
                                                <a class="d-flex" href="edit_attendance.php?batch_id=<?php echo $check_sno ?>">

                                                <?php
                                            } elseif (isset($get_page) && $get_page == 4) {
                                                ?>
                                                    <a class="d-flex" href="edit_assigment.php?batch_id=<?php echo $check_sno ?>">

                                                    <?php
                                                } else {
                                                    ?>
                                                        <a class="d-flex" href="add_attandance.php?batch_id=<?php echo $check_sno ?>&page_attandance=1">

                                                        <?php
                                                    }
                                                        ?>
                                                        <div class="card card-shadow-ph batches-card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <img src="../batch_image/<?php echo $course_image; ?>" class="img img-fluid">
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4 text-center">
                                                                    <div class="col-md-12">
                                                                        <h4 class="batches-card-text"><?php echo $row['batch_name'] ?></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                </div>
                            <?php
                            }
                            ?>

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