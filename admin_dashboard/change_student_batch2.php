<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard (change student Batch)</title>
    <?php include('include/links.php');

    ?>
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
                        <!--  Row 2 -->
                        <div class="col-lg-12 py-4 iph_blue rounded">
                            <div class="card-body my-2">
                                <h3 class=" text-center text-light">Update Batch</h3>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <form method="post">
                                    <div class="card my-border-primary-1">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="change_batch" class="form-label">Select Student Which Batch You Want To Change</label>
                                                    <select class="form-select" name="change_batch" id="change_batch" required>
                                                        <option selected>Select Batch</option>
                                                        <?php
                                                        $student_sno = $_GET['student_sno'];
                                                        $select_student_batch_id = get_table_data2('students', $con, 'sno', $student_sno);
                                                        $get_all_batch_ids = mysqli_fetch_assoc($select_student_batch_id)['batch'];
                                                        $explode_batches = explode(',', $get_all_batch_ids);
                                                        foreach ($explode_batches as $value) {
                                                            $real_batch_name = get_table_data2('batch', $con, 'batch_id', $value);
                                                            $call_batch_name = mysqli_fetch_assoc($real_batch_name)['batch_name'];
                                                        ?>
                                                            <option value="<?php echo $value; ?>"><?php echo $call_batch_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="wanted_batch" class="form-label">Select New Batch Name</label>
                                                    <select class="form-select" name="wanted_batch" id="wanted_batch" required>
                                                        <option value="" selected>Select Change Batch</option>
                                                        <?php
                                                        $show_batch_name = get_table_data('batch', $con);
                                                        $collect_batch = [];
                                                        while ($show1 = mysqli_fetch_assoc($show_batch_name)) {
                                                            $collect_batch[] = $show1['batch_id'];
                                                        }
                                                        $array_difference = array_diff($collect_batch, $explode_batches);
                                                        foreach ($array_difference as $value) {
                                                            $real_batch_name = get_table_data2('batch', $con, 'batch_id', $value);
                                                            $call_batch_name = mysqli_fetch_assoc($real_batch_name)['batch_name'];
                                                        ?>
                                                            <option value="<?php echo $value; ?>"><?php echo $call_batch_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label class="form-label">Batch Change Reason</label>
                                                    <textarea style="height:70px" name="change_reason" class="form-control" required rows="3"></textarea>

                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="submit" name="change_btn" class="btn btn-primary w-100">Change</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" onclick="history.back()" class="btn btn-dark w-100" data-bs-dismiss="modal">Back</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php

                                if (isset($_POST['change_btn'])) {
                                    $change_batch = $_POST['change_batch'];
                                    $wanted_batch = $_POST['wanted_batch'];
                                    $change_reason = $_POST['change_reason'];

                                    $batch_exp_array = explode(',', $get_all_batch_ids);
                                    if (array_search($wanted_batch, $batch_exp_array) === false) {
                                        $batch_exp_array[array_search($change_batch, $batch_exp_array)] = $wanted_batch;
                                        $upd_batch_str = implode(',', $batch_exp_array);
                                        $upd_statement = "UPDATE `students` SET `batch` = '$upd_batch_str' WHERE `sno` = '$student_sno'";
                                        $update_qry = mysqli_query($con, $upd_statement);
                                        if ($update_qry) {

                                            $attendance_data = "SELECT * FROM `attandance` WHERE `batch_name` = '$wanted_batch'";
                                            $attendance_data_qry = mysqli_query($con, $attendance_data);

                                            while ($show_attendance = mysqli_fetch_assoc($attendance_data_qry)) {
                                                $id = $show_attendance['attendance_id'];
                                                $std_ids = explode(',', $show_attendance['student_ids']);
                                                $att_status = explode(',', $show_attendance['attendance_status']);
                                                $att_assign = explode(',', $show_attendance['assigments_done']);
                                                if (!in_array($student_sno, $std_ids)) {
                                                    array_push($std_ids, "$student_sno");
                                                    array_push($att_status, "S");
                                                    array_push($att_assign, "3");
                                                    $imp_ids = implode(',', $std_ids);
                                                    $imp_att = implode(',', $att_status);
                                                    $imp_assign_status = implode(',', $att_assign);
                                                    $update_records = "UPDATE `attandance` SET `student_ids` = '$imp_ids', `attendance_status` = '$imp_att', `assigments_done` = '$imp_assign_status' WHERE `attendance_id` = '$id'";
                                                    $update_records_query = mysqli_query($con, $update_records);
                                                }
                                            }
                                            $attendance_data2 = "SELECT * FROM `attandance` WHERE `batch_name` = '$change_batch'";
                                            $attendance_data_qry2 = mysqli_query($con, $attendance_data2);
                                            $collect_attendance_date = [];
                                            $collect_attendance_status = [];
                                            while ($show_attendance2 = mysqli_fetch_assoc($attendance_data_qry2)) {
                                                $attendance_date2 = $show_attendance2['attendance_date'];
                                                $collect_attendance_date[] = $attendance_date2;
                                                $id2 = $show_attendance2['attendance_id'];
                                                $std_ids2 = explode(',', $show_attendance2['student_ids']);
                                                $att_status2 = explode(',', $show_attendance2['attendance_status']);
                                                $att_assign2 = explode(',', $show_attendance2['assigments_done']);

                                                $find_student = array_search($student_sno, $std_ids2);
                                                $collect_attendance_status[] = $att_status2[$find_student];
                                                unset($std_ids2[$find_student]);
                                                unset($att_status2[$find_student]);
                                                unset($att_assign2[$find_student]);
                                                $imp_ids2 = implode(',', $std_ids2);
                                                $imp_att2 = implode(',', $att_status2);
                                                $imp_assign_status2 = implode(',', $att_assign2);
                                                $update_records2 = "UPDATE `attandance` SET `student_ids` = '$imp_ids2', `attendance_status` = '$imp_att2', `assigments_done` = '$imp_assign_status2' WHERE `attendance_id` = '$id2'";
                                                $update_records_query2 = mysqli_query($con, $update_records2);
                                                print_r($update_records2);
                                            }

                                            $attendance_date_srting = implode(',', $collect_attendance_date);
                                            $attendance_status_srting = implode(',', $collect_attendance_status);

                                              $insert_change_data = "INSERT INTO `change_student`(`change_student_id`,`change_batch`,`attendance_dates`,`attendance_status`,`change_reason`) VALUES('$student_sno','$change_batch','$attendance_date_srting','$attendance_status_srting','$change_reason')";
                                            $insert_change_data_qry = mysqli_query($con, $insert_change_data);
                                            if ($insert_change_data_qry) {
                                                $message = 'Student Batch Is Updated!';
                                            }
                                        }
                                    } else {
                                        $message = 'Student Already Have In This Batch!';
                                    }

                                    if (isset($message)) {
                                ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo $message; ?>&location=<?php echo 'change_student_batch.php'; ?>"
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <div class="card my-border-primary-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $select_student_data = get_table_data2('students', $con, 'sno', $student_sno);
                                            while ($student_row = mysqli_fetch_assoc($select_student_data)) {
                                                $student_name = $student_row['student_name'];
                                                $father_name = $student_row['father_name'];
                                                $home_contact = $student_row['home_contact'];
                                                $address = $student_row['address'];
                                                $email = $student_row['email'];
                                            }
                                            ?>
                                            <div class="col-md-12">
                                                <label class="form-label">Student Name</label>
                                                <input type="text" value="<?php echo $student_name ?>" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Student Father Name</label>

                                                <input type="text" value="<?php echo $father_name ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Student Email</label>

                                                <input type="text" value="<?php echo $email ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Student Address</label>
                                                <textarea class="form-control" disabled rows="1"><?php echo $address ?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        include('include/footer.php');
                        ?>

                    </div>
                </div>



            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>