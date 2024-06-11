<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Student Detail)</title>
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
                <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
                    <div class="card-body">
                        <h3 class="text-center text-light">Student Detail</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <!-- ==============  buttons  ================== -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input onclick="history.back()" type="button" value="Back" class="btn btn-primary">
                            </div>
                        </div>
                        <!-- ======= details ======== -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-shadow-ph my-detail-card">
                                    <div class="card-header text-center bg-primary">
                                        <h5 class="text-bg-primary">Personal Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $get_student_sno = $_GET['left_student_sno'];
                                        include('query/select_qry.php');
                                        $batch_ids = explode(',', $batch);
                                        $batch_names = array_map(function ($batch_id) use ($con) {
                                            return mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id))['batch_name'];
                                        }, $batch_ids);
                                        ?>

                                        <div class="row mt-4 pt-1">
                                            <div class="col-6">

                                                <label class="text-bold-ph my-mr-4">Name:</label>

                                                <label><?php echo $student_name ?></label>

                                            </div>
                                            <div class="col-6">
                                                <label class="text-bold-ph my-mr-3">Father Name:</label>
                                                <label><?php echo $father_name ?></label>
                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mt-4 pt-1">
                                            <div class="col-6">
                                                <label class="text-bold-ph my-mr-2">Contact:</label>
                                                <label><?php echo $student_contact ?></label>
                                            </div>
                                            <div class="col-6">

                                                <label class="text-bold-ph my-mr-2">Father/Home:</label>

                                                <label>
                                                    <?php echo $home_contact ?></label>

                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mt-4 pt-1">
                                            <div class="col-6">
                                                <label class="text-bold-ph my-mr-4">Email:</label>
                                                <label><?php echo $email ?></label>

                                            </div>
                                            <div class="col-6">

                                                <label class="text-bold-ph my-mr-2">Father Email:</label>
                                                <label><?php echo $father_email ?></label>

                                            </div>
                                        </div>
                                        <div class="row mt-4 pt-1">
                                            <div class="col-6">
                                                <label class="text-bold-ph my-mr-4">Country:</label>
                                                <label><?php echo $country_name ?></label>

                                            </div>
                                            <div class="col-6">

                                                <label class="text-bold-ph my-mr-3">City:</label>
                                                <label><?php echo $city ?></label>

                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mt-4 pt-1">
                                            <div class="col-6">
                                                <label class="text-bold-ph my-mr-4">Birth:</label>
                                                <label><?php echo $date_of_birth ?></label>

                                            </div>
                                            <div class="col-6">

                                                <label class="text-bold-ph my-mr-3">Emergency:</label>
                                                <label><?php echo $emergency_contact ?></label>

                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mt-4 pt-1">
                                            <div class="col-12">
                                                <label class="text-bold-ph my-mr-1-half">Address:</label>
                                                <label><?php echo $address ?></label>

                                            </div>

                                        </div>
                                        <!-- row -->
                                    </div>
                                    <!-- card-body -->
                                </div>
                                <!-- card -->
                            </div>
                            <!-- col-md-8 -->
                            <div class="col-md-4">
                                <div class="card card-shadow-ph">
                                    <div class="card-header text-center bg-primary">
                                        <h5 class="text-bg-primary">Profile Picture</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="../images/<?php echo $student_image ?>" alt="" class="img img-fluid" width="400px">
                                    </div>
                                </div>
                            </div>
                            <!-- col-md-4 -->
                        </div>
                        <!--main-row -->
                        <!-- ====================== -->

                        <!-- ==================   Batch Details  ================== -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card card-shadow-ph my-detail-card">
                                    <div class="card-header bg-primary text-center">
                                        <h5 class="text-bg-primary">Batch Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <label class="text-bold-ph my-mr-2">Course Names:</label>
                                                <label>
                                                    <?php
                                                    foreach ($batch_ids as $batch_id) {
                                                        $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));
                                                        $course_real_id = $batch_data['course_id'];
                                                        $course_data = mysqli_fetch_assoc(get_table_data2('course', $con, 'Id', $course_real_id));
                                                        echo $course_data['course_name'] . '<br>';
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <label class="text-bold-ph my-mr-2">Batch Slots:</label>
                                                <label>
                                                    <?php
                                                    foreach ($batch_ids as $batch_id) {
                                                        $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));

                                                        echo $batch_data['batch_slot'] . '<br>';
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- row -->
                                        <div class="row mt-4">

                                            <div class="col-6 d-flex align-items-center">
                                                <label class="text-bold-ph my-mr-2">Batch Names:</label>
                                                <label>
                                                    <?php
                                                    foreach ($batch_ids as $batch_id) {
                                                        $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));

                                                        echo $batch_data['batch_name'] . '<br>';
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <label class="text-bold-ph my-mr-2">Batch Times:</label>
                                                <label>
                                                    <?php
                                                    foreach ($batch_ids as $batch_id) {
                                                        $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));

                                                        echo $batch_data['time'] . '<br>';
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ====================== -->

                        <style>
                            .d-none {
                                display: none !important;
                            }
                        </style>
                        <!-- ==================   buttons  ======================== -->
                        <div class="row mt-3 mb-3">
                            <div class="col-md-1"></div>
                            <?php
                            $batch_ids = explode(',', mysqli_fetch_assoc(get_table_data2('left_student', $con, 'sno', $get_student_sno))['batch']);

                            foreach ($batch_ids as $batch_id) {
                                $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));
                                echo "<div class='col-3'>";
                                echo "<button type='button' class='btn btn-primary form-control' data-target='batch-details-$batch_id'>" . $batch_data['batch_name'] . '</button><br>';
                                echo "</div>";
                            }
                            ?>
                            <div class="col-md-2"></div>
                        </div>
                        <!-- ====================================================== -->


                        <!-- ==================   Other Details  ================== -->
                        <?php
                        foreach ($batch_ids as $batch_id) {
                            echo "<div id='batch-details-$batch_id' class='batch-details d-none'>";
                            // Batch details content goes here
                            $select_attendance = get_table_data2('attandance', $con, 'batch_name', $batch_id);
                        ?>
                            <div class="main-view-batch">
                                <div class="card card-shadow-ph">
                                    <div class="card-body">
                                        <div class="row d-flex align-items-center">

                                            <div class="col-md-12" style="margin-top: 3px !important;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card text-bg-primary">
                                                            <div class="card-header text-center">
                                                                <h3 class="text-bg-primary">Attendance</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row text-center">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-bg-primary">Total Days</h5>
                                                                        <h5 class="text-bg-primary">
                                                                            <?php
                                                                            $count_total = "SELECT COUNT(DISTINCT `attendance_date`) AS count FROM `attandance` WHERE `batch_name`='$batch_id'";
                                                                            $count_total_qry = mysqli_query($con, $count_total);
                                                                            $show_total_count = mysqli_fetch_assoc($count_total_qry);
                                                                            print_r($show_total_count['count']);
                                                                            ?></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4 text-center">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-bg-primary">Total Present</h5>
                                                                        <h5 class="text-bg-primary">
                                                                            <?php
                                                                            echo total_attendance($con, $batch_id, $get_student_sno, 'P');
                                                                            ?></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4 text-center">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-bg-primary">Total Absent</h5>
                                                                        <h5 class="text-bg-primary">
                                                                            <?php
                                                                            echo total_attendance($con, $batch_id, $get_student_sno, 'A');
                                                                            ?></h5>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card text-bg-primary">
                                                            <div class="card-header text-center">
                                                                <h3 class="text-bg-primary">Assignment</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row text-center">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-bg-primary">Total Assignment</h5>
                                                                        <h5 class="text-bg-primary">
                                                                            <?php
                                                                            echo countNonEmptyAssignments($con, $batch_id)
                                                                            ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4 text-center">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-bg-primary">Done Assignment</h5>
                                                                        <h5 class="text-bg-primary">
                                                                            <?php
                                                                            echo total_assignment($con, $batch_id, $get_student_sno, '1');
                                                                            ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4 text-center">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-bg-primary"></h5>
                                                                        <h5 class="text-bg-primary">
                                                                        </h5>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ====================== -->
                                <div class="table-responsive main-table mt-4">
                                    <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                                        <thead class="bg-primary text-white">
                                            <th>Sno</th>
                                            <th>Dates</th>
                                            <th>Attendance Status</th>
                                            <th>Assignment Name</th>
                                            <th>Assignment status</th>
                                        </thead>
                                        <?php
                                        $show_attendance = get_table_data2('attandance', $con, 'batch_name', $batch_id);
                                        while ($attain = mysqli_fetch_assoc($show_attendance)) {
                                            $students_all_ids = $attain['student_ids'];
                                            $attendance_status = $attain['attendance_status'];
                                            $assignments_done = $attain['assigments_done'];
                                            $attendance_status_array = explode(',', $attendance_status);
                                            $assignments_done_array = explode(',', $assignments_done);
                                            $get_ids_in_array = explode(',', $students_all_ids);
                                            $get_id_index = array_search($get_student_sno, $get_ids_in_array);
                                            if ($get_id_index != '') {
                                        ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $attain['attendance_date'] ?></td>
                                                    <?php if ($attendance_status_array[$get_id_index] == 'A') { ?>
                                                        <td class="text-danger text-stu-attain-ph"><?php echo ('A') ?></td>
                                                    <?php } elseif ($attendance_status_array[$get_id_index] == 'P') { ?>
                                                        <td class="text-success text-stu-attain-ph"><?php echo ('P') ?></td>
                                                    <?php } elseif ($attendance_status_array[$get_id_index] == 'L') { ?>
                                                        <td class="text-primary text-stu-attain-ph"><?php echo ('L') ?></td>
                                                    <?php } elseif ($attendance_status_array[$get_id_index] == 'S') { ?>
                                                        <td class="text-dark text-stu-attain-ph"><?php echo ('S') ?></td>
                                                    <?php } else { ?>
                                                        <td class="text-warning text-stu-attain-ph"><?php echo ('H') ?></td>
                                                    <?php } ?>
                                                    <td><?php
                                                        if ($attain['assigments'] == '') {
                                                            echo "<span class='text-danger'>No Assignment</span>";
                                                        } else {
                                                            echo $attain['assigments'];
                                                        }
                                                        ?></td>
                                                    <?php if ($assignments_done_array[$get_id_index] == 1) { ?>
                                                        <td class="text-success text-stu-assigment-ph"><?php echo 'Submitted' ?></td>
                                                    <?php } elseif ($assignments_done_array[$get_id_index] == 0) { ?>
                                                        <td class="text-danger text-stu-assigment-ph"><?php echo 'Not-Submitted' ?></td>
                                                    <?php } else { ?>
                                                        <td class="text-dark text-stu-assigment-ph"><?php echo 'Nill' ?></td>
                                                    <?php } ?>
                                                </tr>
                                        <?php
                                            }
                                        } ?>
                                    </table>
                                </div>
                                <!-- ====================== -->
                            </div>
                        <?php
                            echo "</div>";
                        }
                        ?>
                        <!-- ... Rest of your loop ... -->
                        <!-- main-view-batch -->
                    </div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.btn[data-target]');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    var targetId = this.getAttribute('data-target');
                    var targetDetails = document.getElementById(targetId);

                    if (targetDetails) {
                        targetDetails.classList.toggle('d-none');
                    }
                });
            });
        });
    </script>
</body>

</html>