<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard - (Edit Attendance)</title>
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
                        <h3 class=" text-center text-light">Edit Attendance</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <form action="" method="post">
                            <div class="card card-shadow-ph my-detail-card">
                                <div class="card-body">
                                    <?php
                                    $get_batch_id = $_GET['batch_id'];
                                    $table_detail = get_table_data2('batch', $con, 'batch_id', $get_batch_id);
                                    while ($row = mysqli_fetch_assoc($table_detail)) {
                                        $batch_sno = $row['batch_id'];
                                        $batch_name = $row['batch_name'];
                                        $batch_code = $row['batch_code'];
                                        $batch_teacher = $row['teacher'];
                                        $course_id = $row['course_id'];
                                        $batch_duration = $row['course_duration'];
                                        $lab_number = $row['lab_number'];
                                        $slot = $row['batch_slot'];
                                        $date_of_start = $row['date_of_start'];
                                    }
                                    $show_teacher_name = get_table_data2('teacher', $con, 'teacher_id', $batch_teacher);
                                    $call_teacher_name = mysqli_fetch_assoc($show_teacher_name)['teacher_name'];
                                    $show_course_name = get_table_data2('course', $con, 'Id', $course_id);
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
                                                    <label>Course Name:</label>
                                                </div>
                                                <div class="col-md-6"><label><?php echo $call_course_name ?></label></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6 text-bold-ph">
                                                    <label>Lab Number:</label>
                                                </div>
                                                <div class="col-md-6"><label><?php echo '0' . $lab_number ?></label></div>
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
                                                    <label>Duration:</label>
                                                </div>
                                                <div class="col-md-6"><label><?php echo $batch_duration . " " . "Months" ?></label></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6 text-bold-ph">
                                                    <label>Start Date:</label>
                                                </div>
                                                <div class="col-md-6"><label><?php echo $date_of_start ?></label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ====================== -->
                            <div class="row mt-4 mb-4 bg-danger" id="note">
                                <div class="col-md-12 p-3 text-center">
                                    <h4 class="text-bg-danger p-0 m-0">Note :Please First Select Date</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="datepicker">Select Date <span class="text-danger">*</span></label>
                                    <select name="attandance_date" id="datepicker" class="form-select" required>
                                        <option value="">Select Date</option>
                                        <?php
                                        $show_attendance_detail = get_table_data2('attandance', $con, 'batch_name', $get_batch_id);
                                        while ($detail = mysqli_fetch_assoc($show_attendance_detail)) {
                                        ?>
                                            <option value="<?php echo $detail['attendance_date']; ?>"><?php echo $detail['attendance_date']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="attandance_month">Month</label>
                                    <input type="text" name="attandance_month" id="attandance_month" class="form-control" value="<?php $currentMonth = date('F');
                                                                                                                                    echo $currentMonth;
                                                                                                                                    ?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <?php
                                    if (isset($_GET['page_attandance'])) {
                                        $get_page_attandance = $_GET['page_attandance'];
                                    }
                                    if (isset($get_page_attandance) && $get_page_attandance == 1) {
                                    ?>
                                        <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save Attendance">
                                        <a href="select_batch.php">
                                            <input type="button" class="btn btn-primary mt-3 float-end" value="Back" style="margin-right:6px">
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save Attendance" id="save_button">
                                        <a href="attendance.php">

                                            <input type="button" onclick="history.back()" class="btn btn-primary mt-3 float-end" value="Back" style="margin-right:6px">
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="table-responsive main-table mt-4" id="main-table">
                                <table id="myTable" class="teacher-table table-bordered table data-table text-nowrap text-center my-border-primary-1">
                                    <thead class="text-bg-primary">
                                        <th>Sno</th>
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Leave</th>
                                        <th>Skip</th>
                                    </thead>
                                    <tbody id="show_students_body">

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save Attendance" id="save_button2">
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_submit'])) {

                            $student_ids = $_POST['student_id'];
                            $attendance_date = $_POST['attandance_date'];
                            $attendance_month = $_POST['attandance_month'];
                            $attendance_statuses = $_POST['attandance_status'];

                            $student_ids_combined = implode(',', $student_ids);
                            $attendance_statuses_combined = implode(',', $attendance_statuses);

                            $update_query = "UPDATE `attandance` SET `student_ids`='$student_ids_combined',`attendance_status`='$attendance_statuses_combined' WHERE `attendance_date`='$attendance_date'";
                            $insert_result = mysqli_query($con, $update_query);

                            if ($insert_result) {
                        ?>
                                <script>
                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Attendance Updated Successfully!' ?>&location=<?php echo 'edit_attendance.php?batch_id=' . $get_batch_id; ?>";
                                </script>
                        <?php
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
                var selectedDate = $(this).val();
                var parts = selectedDate.split('-');
                var monthNumeric = parseInt(parts[1], 10); // Convert the string to an integer

                var monthNames = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];

                if (monthNumeric >= 1 && monthNumeric <= 12) {
                    var selectedMonthName = monthNames[monthNumeric - 1]; // Array index is 0-based
                    $('#attandance_month').val(selectedMonthName);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#main-table').hide();
            $('#save_button').hide();
            $('#save_button2').hide();
            $("#datepicker").change(function() {
                var select_date = $("#datepicker").val();
                fetchAttendanceData(select_date);
            });

            function fetchAttendanceData(select_date) {
                $.ajax({
                    url: "ajax/update_data.php",
                    method: "POST",
                    data: {
                        select_date: select_date,
                        select_batch: <?php echo $get_batch_id ?>
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#show_students_body").empty();
                        if (select_date != '') {
                            $('#main-table').show();
                            $('#save_button').show();
                            $('#save_button2').show();
                            $("#note").hide();
                        } else {
                            $('#main-table').hide();
                            $('#save_button').hide();
                            $('#save_button2').hide();
                            $("#note").show();
                        }
                        $.each(data, function(index, student) {
                            var newRow = "<tr><td></td>" +
                                "<td>" + student.student_name + "</td>";
                            newRow += "<td>" + student.father_name + "<input type='hidden' name='student_id[]' value=" + student.student_id + "></td>";

                            $.each(student.attendance_data, function(index, attendance) {
                                if (attendance.attendance_status == 'P') {
                                    var cellContent1 = "<td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='P' checked></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='A'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='L'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='S'></td>";
                                } else if (attendance.attendance_status == 'A') {
                                    var cellContent1 = "<td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='P'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='A' checked></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='L'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='S'></td>";
                                } else if (attendance.attendance_status == 'L') {
                                    var cellContent1 = "<td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='P'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='A'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='L' checked></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='S'></td>";
                                } else {
                                    var cellContent1 = "<td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='P'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='A'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='L'></td><td><input type='radio' class='custom-control-input-ph' name=attandance_status[" + [student.student_id] + "] value='S' checked></td>";
                                }
                                newRow += cellContent1 + "</tr>";

                            });



                            $("#show_students_body").append(newRow);

                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error fetching attendance data: " + error + xhr);
                    },
                });
            }

        });
    </script>
</body>

</html>