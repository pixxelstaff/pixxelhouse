<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Add Attendance)</title>
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
                        <h3 class=" text-center text-light">Add Attendance</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="datepicker">Date</label>
                                    <input type="date" name="attandance_date" class="form-control" required id="datepicker">
                                </div>
                                <div class="col-md-6">
                                    <label for="attandance_month">Month</label>
                                    <input type="text" name="attandance_month" id="attandance_month" class="form-control" value="<?php $currentMonth = date('F');
                                                                                                                                    echo $currentMonth; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">

                                    <a href="select_batch.php">
                                        <input type="button" class="btn btn-primary mt-3 float-start" value="Back">
                                    </a>

                                    <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save Attendance">
                                </div>
                            </div>
                            <div class="table-responsive main-table mt-4">
                                <table id="myTable" class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
                                    <thead class="text-bg-primary">
                                        <th>Sno</th>
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <th>Contact</th>
                                        <th>Batch Name</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Leave</th>
                                        <th>Skip</th>
                                    </thead>
                                    <?php
                                    $get_batch_id = $_GET['batch_id'];
                                    $show_batch_detail = get_table_data2('batch', $con, 'batch_id', $get_batch_id);
                                    while ($show1 = mysqli_fetch_assoc($show_batch_detail)) {
                                        $show_batch_name = $show1['batch_name'];
                                    }
                                    $show_students = get_table_data('students', $con);
                                    while ($show = mysqli_fetch_assoc($show_students)) {
                                        $total_students_batch = $show['batch'];
                                        $total_students_batch_array = explode(',', $total_students_batch);
                                        if (in_array($get_batch_id, $total_students_batch_array)) {
                                    ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $show['student_name']; ?></td>
                                                <td><?php echo $show['father_name']; ?></td>
                                                <td><?php echo $show['student_contact']; ?></td>
                                                <td><?php echo  $show_batch_name; ?></td>
                                                <input type="hidden" name="student_id[]" value="<?php echo $show['sno']; ?>">
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="P" class="custom-control-input-ph">
                                                </td>
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="A" class="custom-control-input-ph" checked>
                                                </td>
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="L" class="custom-control-input-ph">

                                                </td>
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="S" class="custom-control-input-ph">
                                                    <input type="hidden" name="assignment_statuses[<?php echo $show['sno']; ?>]" value="3">
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save Attendance">
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_submit'])) {

                            $attendance_date = $_POST['attandance_date'];
                            $formattedDate = ($attendance_date == '') ? date('d-m-Y') : date("d-m-Y", strtotime($attendance_date));
                            $attendance_month = $_POST['attandance_month'];
                            $get_year = substr($formattedDate, -4);
                            $student_ids = $_POST['student_id'];
                            $attendance_statuses = $_POST['status'];
                            $assignment_status = $_POST['assignment_statuses'];

                            // $select_date_attandance = get_table_data2('attandance', $con, 'attendance_date', $formattedDate);
                            $select_date_attandance = get_table_data3('attandance', $con, 'attendance_date', $formattedDate,'batch_name',$get_batch_id);
                            if (mysqli_num_rows($select_date_attandance) > 0) {
                        ?>
                                <script>
                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'This Date Attendance Already Added!' ?>&location=<?php echo 'add_attendance.php?batch_id=' . $get_batch_id ?>";
                                </script>
                                <?php
                            } else {
                                $student_ids_combined = implode(',', $student_ids);
                                $attendance_statuses_combined = implode(',', $attendance_statuses);
                                $assignment_statuses_combined = implode(',', $assignment_status);

                                $insert_query = "INSERT INTO `attandance`(`student_ids`, `batch_name`, `attendance_date`, `attendance_month`, `attendance_status`,`attendance_year`,`assigments_done`) VALUES ('$student_ids_combined', '$get_batch_id', '$formattedDate', '$attendance_month', '$attendance_statuses_combined','$get_year','$assignment_statuses_combined')";
                                // echo $insert_query;
                                $insert_result = mysqli_query($con, $insert_query);

                                if ($insert_result) {
                                ?>
                                    <script>
                                        window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Attendance added Successfully!' ?>&location=<?php echo 'add_attendance.php?batch_id=' . $get_batch_id ?>";
                                    </script>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        $(document).ready(function() {
            $('#datepicker').on('change', function() {
                var selectedDate = new Date($(this).val());
                var selectedMonth = selectedDate.toLocaleString('default', {
                    month: 'long'
                });
                var selectedYear = selectedDate.getFullYear();
                var selectedMonthYearText = selectedMonth;
                $('#attandance_month').val(selectedMonthYearText);
            });
        });
    </script>
</body>

</html>