<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Select Batch)</title>
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
                        } elseif (isset($get_page) && $get_page == 5) {
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
                            $show_batches = get_table_data('batch', $con);
                            while ($row = mysqli_fetch_assoc($show_batches)) {
                                $check_sno = $row['batch_id'];
                                $teacher = $row['teacher'];
                                $batch_slot = $row['batch_slot'];
                                $batch_code = $row['batch_code'];
                                $course_id = $row['course_id'];
                                // $batch_image = $row['image'];
                                $show_course = get_table_data2('teacher', $con, 'teacher_id', $teacher);
                                while ($row2 = mysqli_fetch_assoc($show_course)) {
                                    $teacher_name = $row2['teacher_name'];
                                }
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
                                                    <a class="d-flex" href="edit_assignment.php?batch_id=<?php echo $check_sno ?>">

                                                    <?php
                                                } elseif (isset($get_page) && $get_page == 5) {
                                                    ?>
                                                        <a class="d-flex" href="change_teacher.php?batch_id=<?php echo $check_sno ?>">

                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a class="d-flex" href="add_attendance.php?batch_id=<?php echo $check_sno ?>&page_attendance=1">

                                                            <?php
                                                        }
                                                            ?>
                                                            <div class="card card-shadow-ph batches-card" style="height:430px !important">
                                                                <div class="card-body text-center">
                                                                    <div class="row w-100 p-0 m-0">

                                                                        <img src="../batch_image/<?php echo $course_image; ?>" width="350" height="170">

                                                                    </div>
                                                                    <div class="row text-center p-0 m-0">
                                                                        <div class="col-md-12 bg-primary">
                                                                            <h4 class="batches-card-text text-white"><?php echo $row['batch_name'] ?></h4>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="row mt-2">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Teacher Name</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label><?php echo $teacher_name ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Batch Code</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label><?php echo $batch_code ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Days Slot</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label><?php echo $batch_slot ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Course Name</label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label><?php echo $course_name ?></label>
                                                                                </div>
                                                                            </div>
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