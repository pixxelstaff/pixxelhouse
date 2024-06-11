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
    <title>Teacher Dashboard - (Add Assignment)</title>
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
                        <h3 class=" text-center text-light">Add Assignment</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card card-shadow-ph">
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label for="">Batch Name:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php
                                                    $get_batch_id = $_GET['batch_id'];
                                                    $show_batch_name = get_table_data2('batch', $con, 'batch_id', $get_batch_id);
                                                    while ($show = mysqli_fetch_assoc($show_batch_name)) {
                                                        $batch_name = $show['batch_name'];
                                                        $batch_code = $show['batch_code'];
                                                        $batch_slot = $show['batch_slot'];
                                                        $course_duration = $show['course_duration'];
                                                        $time = $show['time'];
                                                    }
                                                    ?>
                                                    <input type="text" class="form-control" value="<?php echo $batch_name . "    " . $batch_slot . "    " . $time ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="row mt-3 align-items-center">
                                                <div class="col-md-4">
                                                    <label for="">Assignment Date:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select id="assignment_date" name="assignment_date" class="form-select">
                                                        <option value="">Select Date</option>
                                                        <?php
                                                        $show_students = get_table_data2('attandance', $con, 'batch_name', $get_batch_id);
                                                        while ($show = mysqli_fetch_assoc($show_students)) {
                                                            $assignment_name = $show['assigments'];
                                                            $date_show_to = $show['attendance_date'];
                                                            $sort_date = date("d-F-Y", strtotime($date_show_to));
                                                        ?>
                                                            <option value="<?php echo $show['attendance_id']; ?>"><?php echo $sort_date; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3 align-items-center">
                                                <div class="col-md-4">
                                                    <label for="">Assignment Name:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="assignment_name" id="assignment_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3 align-items-center">
                                                <div class="col-md-12">
                                                    <label for="">Assignment Description:</label>
                                                    <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-3">
                                                    <a href="assigment.php"><button type="button" class="btn btn-dark form-control">Back</button></a>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="submit" value="Add" name="btn_sub" class="form-control btn btn-primary">
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['btn_sub'])) {
                                            $assignment_sno = $_POST['assignment_date'];
                                            $assignment_name = ucfirst($_POST['assignment_name']);
                                            $assignment_name_capital = mysqli_real_escape_string($con,$assignment_name);
                                            $description1 = $_POST['description'];
                                            $description = mysqli_real_escape_string($con,$description1);
                                            $update = "UPDATE `attandance` SET `assigments`='$assignment_name_capital',`assigment_detail`='$description' WHERE `attendance_id`='$assignment_sno' AND `batch_name`='$get_batch_id' AND `attendance_teacher_id`='$teacher_sno'";
                                            $update_query = mysqli_query($con, $update);
                                            if ($update_query) {
                                        ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Assignment Added Successfully!' ?>&location=<?php echo 'assigment.php' ?>";
                                                </script>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
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