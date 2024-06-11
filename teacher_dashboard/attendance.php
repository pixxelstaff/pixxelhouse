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
                <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Attendance</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Select Batch</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <?php
                                                $show_batches = get_table_data2('batch', $con, 'teacher', $teacher_sno);
                                                while ($row = mysqli_fetch_assoc($show_batches)) {
                                                ?>
                                                    <a href="add_attandance.php?batch_id=<?php echo $row['batch_id']; ?>"><button class="btn btn-primary"><?php echo $row['batch_name']; ?></button></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary float-end" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"><i class="fas fa-plus"></i> Add Attendance</button>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex align-items-center">
                                <label class="w-25">Quick Search</label>

                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-4 mb-4 bg-danger" id="note">
                            <div class="col-md-12 p-3 text-center">
                                <h4 class="text-bg-danger p-0 m-0">Note :Please First Select Batch Name /year /month</h4>
                            </div>
                        </div>
                        <div class="row mt-4 mb-3">
                            <div class="col-md-4">
                                <label for="sortOrder" class="mb-3">Batch Name:</label>
                                <select id="sortOrder" class="form-select">
                                    <option value="Nill">Select Batch Name</option>
                                    <?php
                                    $show_batch_name_for_select = get_table_data2('batch', $con, 'teacher', $teacher_sno);
                                    while ($row = mysqli_fetch_assoc($show_batch_name_for_select)) {
                                        $new_batch_name = $row['batch_id'];
                                    ?>
                                        <option value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="yearsSelect" class="mb-3">Years: </label>
                                <select id="yearsSelect" class="form-select">
                                    <!-- The years will be dynamically added here -->
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="monthsSelect" class="mb-3">Months: </label>
                                <select id="monthsSelect" class="form-select">
                                    <!-- The months will be dynamically added here -->
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 mb-1 m-0 p-0" id="batch_detail_row">
                            <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8" id="batch_name_update"></div>
                                        <div class="col-md-4 text-end" id="batch_date_update"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8" id="batch_month_update"></div>
                                        <div class="col-md-4 text-end" id="batch_code_update"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" id="edit_button">

                                </div>
                            </div>
                            <div class="table-responsive main-table mt-3 m-0 p-0">
                                <table id="myTable" class="teacher-table table-bordered pt-0 pb-0 table data-table text-nowrap text-center my-border-primary-1">
                                    <thead class="bg-primary text-white" id="attendanceTableHead">
                                        <th>Sno</th>
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <?php
                                        $show_table_head = get_table_data2('attandance', $con, 'batch_name', $new_batch_name);
                                        while ($row = mysqli_fetch_assoc($show_table_head)) {
                                        ?>
                                            <th><?php echo $row['attendance_date']; ?></th>
                                        <?php
                                        }
                                        ?>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody id="attendanceTableBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        $(document).ready(function() {
            $("#myTable").hide();
            $("#batch_detail_row").hide();

            function fetchAttendanceData(sortOrder, monthsSelect, selectedOrder_year) {
                var teacher_sno = <?php echo $teacher_sno; ?>;
                $.ajax({
                    url: "ajax/fetch_attandance.php",
                    method: "POST",
                    data: {
                        teacher_sno: teacher_sno,
                        sortOrder: sortOrder,
                        monthsSelect: monthsSelect,
                        selectedOrder_year: selectedOrder_year
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#attendanceTableBody").empty();

                        var uniqueDates = [];
                        $.each(data, function(index, student) {
                            $.each(student.attendance_data, function(idx, attendance) {
                                if (!uniqueDates.includes(attendance.attendance_date)) {
                                    uniqueDates.push(attendance.attendance_date);
                                }
                            });
                        });

                        var tableHeaders = "<tr><th>Sno</th><th>Student Name</th>";
                        $.each(uniqueDates, function(index, date) {
                            var new_date = date.slice(0, -5)
                            tableHeaders += "<th>" + new_date + "</th>";
                        });
                        tableHeaders += "<th>Month</th>";
                        tableHeaders += "</tr>";
                        $("#attendanceTableHead").html(tableHeaders);

                        $.each(data, function(index, student) {
                            var newRow = "<tr><td></td>" +
                                "<td>" + student.student_name + "</td>";

                            $.each(uniqueDates, function(index, date) {
                                var attendance = student.attendance_data.find(a => a.attendance_date === date);
                                // console.log(attendance);
                                if (attendance.attendance_status == 'P') {
                                    var cellContent = attendance ? "<td class='text-success text-stu-attain-ph'>P</td>" : "<td></td>";
                                } else if (attendance.attendance_status == 'A') {
                                    var cellContent = attendance ? "<td class='text-danger text-stu-attain-ph'>A</td>" : "<td></td>";
                                } else if (attendance.attendance_status == 'L') {
                                    var cellContent = attendance ? "<td class='text-warning text-stu-attain-ph'>L</td>" : "<td></td>";
                                } else if (attendance.attendance_status == 'S') {
                                    var cellContent = attendance ? "<td class='text-dark text-stu-attain-ph'>S</td>" : "<td></td>";
                                }
                                newRow += cellContent;
                            });

                            newRow += "<td>" + student.attendance_data[0].attendance_month + "</td>" +
                                "</tr>";

                            $("#attendanceTableBody").append(newRow);
                        });

                        $.each(data, function(index, student) {
                            if (monthsSelect == 'Nill') {
                                $("#batch_detail_row").hide();

                            } else {
                                var name_style = "<h4 class='text-bg-primary'>Batch Name :<label style='margin-left:20px'>" + (student.batch_name) + "</label><label style='margin-left:20px'>(" + (student.batch_slot) + ")</label><label style='margin-left:20px'> - " + (student.batch_time) + "</label>" + "</h4>";

                                var batch_date_style = "<h5 class='text-bg-primary'>Start From :" + (student.date_of_start) + "</h5>";
                                var batch_code_style = "<h5 class='text-bg-primary'>Batch Code :" + (student.batch_code) + "</h5>";
                                var batch_month_update = "<h5 class='text-bg-primary'>Attendance Sheet For <label>" + (student.attendance_data[0].attendance_month) + "</label><label style='margin-left:10px'>" + (student.attendance_data[0].attendance_year) + "</label>" + "</h5>";
                                var edit_button = "<a href='edit_attendance.php?batch_id=" + student.batch_id + "'>" +
                                    "<button class='btn btn-primary' style='margin-right:5px'>Edit Attendance</button></a>";
                                $("#batch_detail_row").show();
                                $("#batch_name_update").empty();
                                $("#batch_date_update").empty();
                                $("#batch_code_update").empty();
                                $("#batch_month_update").empty();
                                $("#edit_button").empty();
                                $("#edit_button").append(edit_button);
                                $("#batch_name_update").append(name_style);
                                $("#batch_date_update").append(batch_date_style);
                                $("#batch_code_update").append(batch_code_style);
                                $("#batch_month_update").append(batch_month_update);
                            }

                        });

                    },
                    error: function(xhr, status, error) {
                        console.log("Error fetching attendance data: " + error + xhr);
                    },
                });
            }

            $("#monthsSelect").change(function() {
                $("#note").hide();
                $("#myTable").show();
                $("#batch_detail_row").show();
                var selectedOrder = $("#sortOrder").val();
                var selectedOrder_year = $("#yearsSelect").val();
                var selectedOrder_date = $('#monthsSelect').val();
                fetchAttendanceData(selectedOrder, selectedOrder_date, selectedOrder_year);
            });

            $("#sortOrder").change(function() {
                var selectedOrder = $("#sortOrder").val();
                var selectedOrder_year = $("#yearsSelect").val();
                var selectedOrder_date = $('#monthsSelect').val();
                fetchAttendanceData(selectedOrder, selectedOrder_date, selectedOrder_year);
            });

            $("#yearsSelect").change(function() {
                var selectedOrder = $("#sortOrder").val();
                var selectedOrder_year = $('#yearsSelect').val();
                var selectedOrder_date = $('#monthsSelect').val();
                fetchAttendanceData(selectedOrder, selectedOrder_date, selectedOrder_year);
            });

            fetchAttendanceData("Nill", "Nill", "Nill");

        });
    </script>


    <script>
        $(document).ready(function() {
            // Handle the change event of the first select box (sortOrder)
            $("#sortOrder").change(function() {
                var selectedBatchSno = $(this).val();

                // Make an AJAX request to fetch the months data
                $.ajax({
                    url: "ajax/get_years.php",
                    method: "POST",
                    data: {
                        batchSno: selectedBatchSno
                    },
                    dataType: "json",
                    success: function(data) {
                        // Clear the existing options in the monthsSelect select box

                        $("#yearsSelect").empty();
                        $("#yearsSelect").append("<option value=''>Select Year</option>");
                        $.each(data, function(index, row) {
                            $("#yearsSelect").append("<option value='" + row.year + "'>" + row.year + "</option>");

                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error fetching months data: " + error);
                    },
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            // Handle the change event of the first select box (sortOrder)
            $("#yearsSelect").change(function() {
                var selectedyears = $(this).val();
                var selectedOrder = $("#sortOrder").val();

                // Make an AJAX request to fetch the months data
                $.ajax({
                    url: "ajax/get_months.php",
                    method: "POST",
                    data: {
                        selectedyears: selectedyears,
                        selectedOrder: selectedOrder
                    },
                    dataType: "json",
                    success: function(data) {
                        // Clear the existing options in the monthsSelect select box

                        $("#monthsSelect").empty();
                        $("#monthsSelect").append("<option value=''>Select Month</option>");

                        // Append new options for each received month
                        $.each(data, function(index, row) {
                            $("#monthsSelect").append("<option value='" + row.month + "'>" + row.month + "</option>");
                        });

                    },
                    error: function(xhr, status, error) {
                        console.log("Error fetching months data: " + error);
                    },
                });
            });
        });
    </script>
</body>

</html>