<!doctype html>
<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Change Teacher)</title>
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
                        <h3 class=" text-center text-light">Change Teacher</h3>
                    </div>
                </div>

                <!-- ======= details ======== -->
                <div class="card card-shadow-ph my-detail-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <?php
                                $get_batch_sno = $_GET['batch_id'];
                                $table_detail = get_table_data2('batch', $con, 'batch_id', $get_batch_sno);
                                while ($row = mysqli_fetch_assoc($table_detail)) {
                                    $batch_sno = $row['batch_id'];
                                    $batch_name = $row['batch_name'];
                                    $batch_code = $row['batch_code'];
                                    $batch_teacher = $row['teacher'];
                                    $course_name = $row['course_id'];
                                    $batch_duration = $row['course_duration'];
                                    $slot = $row['batch_slot'];
                                    $change_date_old = $row['change_date'];
                                    $date_of_start = $row['date_of_start'];
                                }
                                $show_teacher_name = get_table_data2('teacher', $con, 'teacher_id', $batch_teacher);
                                while ($show_teacher = mysqli_fetch_assoc($show_teacher_name)) {
                                    $call_teacher_name = $show_teacher['teacher_name'];
                                    $call_teacher_image = $show_teacher['teacher_image'];
                                }

                                $show_course_name = get_table_data2('course', $con, 'Id', $course_name);
                                $call_course_name = mysqli_fetch_assoc($show_course_name)['course_name'];
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Batch Name:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $batch_name ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Batch Code:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $batch_code ?></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Teacher Name:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $call_teacher_name ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Slot:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $slot ?></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Course Name:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $call_course_name ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Duration:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $batch_duration . ' ', 'Months'; ?></label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Batch Start Date:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $date_of_start ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-bold-ph">
                                                <label>Batch End Date:</label>
                                            </div>
                                            <div class="col-md-6"><label><?php echo $date_of_start ?></label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <img src="../images/<?php echo $call_teacher_image ?>" class="img img-fluid" width="150px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====================== -->

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <label for="teacher_id" class="form-label">Teacher Name<span class="text-danger">*</span></label>
                                            <select class="form-select" name="teacher_id" id="teacher_id" required>
                                                <option value="">Select Teacher</option>
                                                <?php
                                                $course = get_table_data('teacher', $con);
                                                while ($row = mysqli_fetch_assoc($course)) {
                                                ?>
                                                    <option value="<?php echo $row['teacher_id'] ?>"><?php echo $row['teacher_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="change_btn" value="Change" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['change_btn'])) {

                                    $teacher_id = $_POST['teacher_id'];
                                    // $date_of_start

                                    $change_date = date("d-m-Y");

                                    $select = get_table_data2('old_batch_data', $con, 'batch_id', $get_batch_sno);
                                    if (!mysqli_num_rows($select) > 0) {

                                        $insert_old_batch = "INSERT INTO `old_batch_data`(`old_teacher_id`,`batch_id`,`date_to`,`date_from`) VALUES ('$call_teacher_name','$get_batch_sno','$date_of_start','$change_date')";

                                        $insert_old_batch_qry = mysqli_query($con, $insert_old_batch);
                                        if ($insert_old_batch_qry) {
                                            $update = "UPDATE `batch` SET `teacher`='$teacher_id',`change_date`='$change_date' WHERE `batch_id`='$get_batch_sno'";
                                            $update_qry = mysqli_query($con, $update);
                                            if ($update_qry) {

                                ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Teacher Change Successfully!' ?>&location=<?php echo 'batches.php' ?>";
                                                </script>
                                            <?php
                                            } else {
                                            ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'select_batch.php?page_assignment=5' ?>";
                                                </script>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <script>
                                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'select_batch.php?page_assignment=5' ?>";
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        // $select = get_table_data3('old_batch_data', $con, 'batch_id', $get_batch_sno,'date_from',$change_date);

                                        $insert_old_batch = "INSERT INTO `old_batch_data`(`old_teacher_id`,`batch_id`,`date_to`,`date_from`) VALUES ('$teacher_id','$get_batch_sno','$change_date_old','$change_date')";

                                        echo $insert_old_batch;
                                        $insert_old_batch_qry = mysqli_query($con, $insert_old_batch);
                                        if ($insert_old_batch_qry) {
                                            $update = "UPDATE `batch` SET `teacher`='$teacher_id',`change_date`='$change_date' WHERE `batch_id`='$get_batch_sno'";
                                            $update_qry = mysqli_query($con, $update);
                                            if ($update_qry) {

                                            ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Teacher Change Successfully!' ?>&location=<?php echo 'batches.php' ?>";
                                                </script>
                                            <?php
                                            } else {
                                            ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'select_batch.php?page_assignment=5' ?>";
                                                </script>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <script>
                                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'select_batch.php?page_assignment=5' ?>";
                                            </script>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>