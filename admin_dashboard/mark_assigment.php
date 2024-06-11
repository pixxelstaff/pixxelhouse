<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Mark Assigment)</title>
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
                        <h3 class=" text-center text-light">Mark Assignment</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body pt-0 mt-0">
                        <form action="" method="post">

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="attandance_date">Assignment Dates</label>
                                    <select id="assignment_date" name="assignment_date" class="form-select">
                                        <option value="">Select Date</option>
                                        <?php
                                        $get_batch_id = $_GET['batch_id'];
                                        $show_students = get_table_data2('attandance', $con, 'batch_name', $get_batch_id);
                                        while ($show = mysqli_fetch_assoc($show_students)) {
                                            $assigment_name = $show['assigments'];
                                            $date_show_to = $show['attendance_date'];
                                            $sort_date = date("d-F-Y", strtotime($date_show_to));
                                        ?>
                                            <option value="<?php echo $show['attendance_id']; ?>"><?php echo $sort_date; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save">
                                    
                                        <input type="button" onclick="history.back()" class="btn btn-primary mt-3 float-end" value="Back" style="margin-right: 10px;">
                                   
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <h4>Assignment Name :</h4>
                                </div>
                                <div class="col-md-8" id="show_assignment">
                                    <!-- dynamic_add assignment Name -->
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
                                        <th>Submitted</th>
                                        <th>Not-Submitted</th>
                                        <th>Nill</th>
                                    </thead>
                                    <?php
                                    $show_batch_name = get_table_data2('batch', $con, 'batch_id', $get_batch_id);
                                    while ($show2 = mysqli_fetch_assoc($show_batch_name)) {
                                        $batch__get = $show2['batch_name'];
                                    }
                                    $show_students = get_table_data('students', $con);
                                    while ($show = mysqli_fetch_assoc($show_students)) {

                                        $batch_id_sno_get = $show['batch'];
                                        $batch_id_sno_array = explode(',', $batch_id_sno_get);
                                        if (in_array($get_batch_id, $batch_id_sno_array)) {

                                    ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $show['student_name']; ?></td>
                                                <td><?php echo $show['father_name']; ?></td>
                                                <td><?php echo $show['student_contact']; ?></td>
                                                <td><?php echo $batch__get; ?></td>
                                                <input type="hidden" name="student_id[]" value="<?php echo $show['sno']; ?>">
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="1" class="custom-control-input-ph">
                                                </td>
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="0" class="custom-control-input-ph">
                                                </td>
                                                <td>
                                                    <input type="radio" name="status[<?php echo $show['sno']; ?>]" value="2" class="custom-control-input-ph" checked>
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
                                    <input type="submit" class="btn btn-primary mt-3 float-end" name="btn_submit" value="Save">
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btn_submit'])) {

                            $assignment_date = $_POST['assignment_date'];
                            $assignment_statuses = $_POST['status'];

                            $assignment_statuses_combined = implode(',', $assignment_statuses);

                            $update_query = "UPDATE `attandance` SET `assigments_done`='$assignment_statuses_combined' WHERE `attendance_id`='$assignment_date'";
                            $update_result = mysqli_query($con, $update_query);

                            if ($update_result) {
                        ?>
                                <script>
                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Assignment Marked Successfully!' ?>&location=<?php echo 'assigment.php' ?>";
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
            $("#assignment_date").change(function() {
                var assignment_date = $("#assignment_date").val();
                $.ajax({
                    url: "ajax/get_assigment_names.php",
                    method: "POST",
                    data: {
                        assignment_date: assignment_date
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#show_assignment").empty();
                        $.each(data, function(index, row) {
                            if (row.assignment_name != '') {
                                $("#show_assignment").append("<a href='view_detail.php?assignment=" + row.attendance_id + "'><h4 class='text-primary'>" + row.assignment_name + "</h4></a>")

                            } else {
                                $("#show_assignment").append("<h4 class='text-danger'>No Assignment</h4>");
                            }
                        });
                    },

                    error: function(xhr, status, error) {
                        console.log("Error fetching data: " + xhr);
                    },
                });
            });
        });
    </script>
</body>

</html>