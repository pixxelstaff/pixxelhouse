<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student Dashboard</title>
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

                        <div class="col-lg-12 col-md-12 col-sm-12 my-4">
                            <div class="alert alert-warning" role="alert">
                                You are changing the batch of student
                            </div>
                            <form method="post">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="text-center upd_head"> From</h2>

                                            <select name="change_batch" id="" class="form-select" aria-label="Default select example">
                                                <option value="">select leaving batch</option>
                                                <?php
                                                $exp_batch = explode(',', $session_batch);
                                                foreach ($exp_batch as $b_key => $b_val) {
                                                    $batch_data = sel_data($con, 'batch', true, 'batch_id', $b_val);
                                                ?>
                                                    <option value="<?php echo  $batch_data[0]['batch_id'] ?>"><?php echo  $batch_data[0]['batch_name'] ?></option>
                                                <?php

                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <h2 class="text-center upd_head"> to </h2>

                                            <select name="wanted_batch" id="" class="form-select" aria-label="Default select example">
                                                <option value="">select joining batch</option>
                                                <?php
                                                $all_batch_data = sel_data($con, 'batch');
                                                foreach ($all_batch_data as  $all_value) {
                                                    if (!in_array($all_value['batch_id'], $exp_batch)) {

                                                ?>
                                                        <option value="<?php echo  $all_value['batch_id'] ?>"><?php echo  $all_value['batch_name'] ?></option>
                                                <?php

                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12 text-center my-4">
                                            <input type="submit" value="Change Batch" name="change_btn" class="std_con_inp std_con_sub_btn rounded">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <?php
                        include('include/footer.php');

                        if (isset($_POST['change_btn'])) {
                            $change_batch = $_POST['change_batch'];
                            $wanted_batch = $_POST['wanted_batch'];

                            if (!empty($change_batch) && !empty($wanted_batch)) {
                                $batch_exp_array = explode(',', $session_batch);
                                $batch_exp_array[array_search($change_batch, $batch_exp_array)] = $wanted_batch;
                                $upd_batch_str = implode(',', $batch_exp_array);

                                $upd_statement = "UPDATE `students` SET `batch` = ? WHERE `sno` = ?";
                                $stmt = mysqli_prepare($con, $upd_statement);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "ss", $upd_batch_str, $session_student_id);
                                    $upd_statement_query = mysqli_stmt_execute($stmt);

                                    if ($upd_statement_query) {
                                        $select_att_data = "SELECT * FROM `attandance` WHERE `batch_name` = ?";
                                        $stmt = mysqli_prepare($con, $select_att_data);

                                        if ($stmt) {
                                            mysqli_stmt_bind_param($stmt, "s", $wanted_batch);
                                            mysqli_stmt_execute($stmt);
                                            $select_att_data_query = mysqli_stmt_get_result($stmt);

                                            if (mysqli_num_rows($select_att_data_query) > 0) {

                                                while ($sel_chg_batch_data = mysqli_fetch_assoc($select_att_data_query)) {
                                                    $id = $sel_chg_batch_data['attendance_id'];
                                                    $std_ids = explode(',', $sel_chg_batch_data['student_ids']);

                                                    if (!in_array($session_student_id, $std_ids)) {
                                                        array_push($std_ids, "$session_student_id");
                                                        $imp_ids = implode(',', $std_ids);

                                                        $update_records = "UPDATE `attandance` SET `student_ids` = ?, `attendance_status` = ?, `assigments_done` = ? WHERE `attendance_id` = ?";
                                                        $stmt = mysqli_prepare($con, $update_records);

                                                        if ($stmt) {
                                                            $att_status = explode(',', $sel_chg_batch_data['attendance_status']);
                                                            $att_assign = explode(',', $sel_chg_batch_data['assigments_done']);
                                                            array_push($att_status, "S");
                                                            $imp_att = implode(',', $att_status);
                                                            array_push($att_assign, "-1");
                                                            $imp_assign_status = implode(',', $att_assign);

                                                            mysqli_stmt_bind_param($stmt, "ssss", $imp_ids, $imp_att, $imp_assign_status, $id);
                                                            $update_records_query = mysqli_stmt_execute($stmt);

                                                            if ($update_records_query) {
                                                                $message = 'your batch and data successfully is updated';
                                                            }
                                                        }
                                                    } else {
                                                        $message = 'your batch is updated';
                                                    }
                                                }
                                            } else {

                                                $message = 'your batch is updated';
                                            }
                                        }
                                    }
                                }

                                if (isset($message)) {
                        ?>
                                    <script>
                                        window.location = "../functions/alert.php?icon=<?php echo 'success' ?>&message=<?php echo $message; ?>&location=<?php echo '../student/dashboard.php'; ?>"
                                    </script>
                        <?php
                                    exit;
                                }
                            } else {
                                echo '<script>alert("Please select both options")</script>';
                            }
                        }
                        ?>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>