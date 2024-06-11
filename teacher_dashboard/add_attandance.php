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
    <title>Teacher Dashboard - (Add Attendance)</title>
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
                                    <input type="date" min="<?php echo date('Y-m-d', strtotime('-6 days')) ?>" max="<?php echo date('Y-m-d');?>" name="attandance_date" class="form-control" required id="datepicker">
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

                            $select_date_attandance = get_table_data3('attandance', $con, 'attendance_date', $formattedDate,'batch_name',$get_batch_id);
                            if (mysqli_num_rows($select_date_attandance) > 0) {
                        ?>
                                <script>
                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'This Date Attendance Already Added!' ?>&location=<?php echo 'add_attandance.php?batch_id=' . $get_batch_id ?>";
                                </script>
                                <?php
                            } else {
                                $student_ids_combined = implode(',', $student_ids);
                                $attendance_statuses_combined = implode(',', $attendance_statuses);
                                $assignment_statuses_combined = implode(',', $assignment_status);

                                $insert_query = "INSERT INTO `attandance`(`student_ids`, `batch_name`,`attendance_teacher_id`, `attendance_date`, `attendance_month`, `attendance_status`,`attendance_year`,`assigments_done`) VALUES ('$student_ids_combined', '$get_batch_id','$teacher_sno','$formattedDate', '$attendance_month', '$attendance_statuses_combined','$get_year','$assignment_statuses_combined')";
                                // echo $insert_query;
                                $insert_result = mysqli_query($con, $insert_query);

                                if ($insert_result) {
                                    
                                    
                                    
                                    



 $select_previous = "SELECT * FROM `attandance` WHERE `batch_name` ='$get_batch_id' ORDER BY `attendance_id` DESC LIMIT 3";
                                    $select_previous_res = mysqli_query($con, $select_previous);

                                    // Initialize an associative array to store the count of 'A' status for each student
                                    $studentAStatusCount = [];

                                    // Process the retrieved records
                                    while ($row = mysqli_fetch_assoc($select_previous_res)) {
                                        // Parse the attendance_status and student_ids columns
                                        $attendanceStatusArray = explode(',', $row['attendance_status']);
                                        $studentIdsArray = explode(',', $row['student_ids']);

                                        // Iterate through the students and their attendance status
                                        for ($i = 0; $i < count($studentIdsArray); $i++) {
                                            $studentId = $studentIdsArray[$i];
                                            $status = trim($attendanceStatusArray[$i]); // Trim to remove any leading/trailing spaces

                                            if ($status === 'A') {
                                                // Increment the 'A' status count for the current student
                                                if (isset($studentAStatusCount[$studentId])) {
                                                    $studentAStatusCount[$studentId]++;
                                                } else {
                                                    $studentAStatusCount[$studentId] = 1;
                                                }
                                            }
                                        }
                                    }
                                    foreach ($studentAStatusCount as $student_id => $value) {
                                        if($value>=3){
                                        $select_student_father_email = "SELECT * FROM `students` WHERE `sno`='$student_id'";
                                        $select_student_father_email_res = mysqli_query($con, $select_student_father_email);
                                        while ($new_row = mysqli_fetch_assoc($select_student_father_email_res)) {
                                            $father_email = $new_row['father_email'];
                                            $student_name = $new_row['student_name'];
                                        }
                                        $to = $father_email;
                                        $subject = " Absence Report for Your Child - 3 Days!";
                                        $host_email = 'pixxel@prepwings.com';
                                        $head = "From: $host_email" . "\r\n";
                                        $head .= "Reply-To: $host_email" . "\r\n";
                                        $head .= implode("\r\n", [
                                            "MIME-Version: 1.0",
                                            "Content-type: text/html; charset=utf-8"
                                        ]);
                                        ob_start();
                                        $html = "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<style type='text/css'>
/* CSS styles go here */
body {
background-color: #f2f2f2;
font-family: Arial, sans-serif;
font-size: 14px;
line-height: 1.5;
color: #333333;
margin: 0;
padding: 0;
}
.container {
max-width: 600px;
margin: 0 auto;
padding: 20px;
}
h1 {
font-size: 28px;
margin-bottom: 20px;
text-align: center;
}
p {
margin-bottom: 20px;
}
.button {
display: inline-block;
background-color: #007bff;
color: #ffffff;
text-decoration: none;
padding: 10px 20px;
border-radius: 5px;
margin-bottom: 20px;
}
.button:hover {
background-color: #0056b3;
}
</style>
</head>
<body>
<div class='container'>
<img src='http://pixxel.prepwings.com/images/logo-black2.png' width='100%'>

<p>Dear $father_email,</p>

<p>We hope this message finds you well. We wanted to inform you about your child's recent attendance at In Institute of Pixxel House.</p>
<p>It has come to our attention that your child, $student_name, has been absent from Our Institute Pixxel House for the last three consecutive days. We take attendance very seriously, and it's important for us to ensure the well-being and educational progress of all our students.</p>
<p>We kindly request your assistance in addressing this matter. Understanding the reasons for your child's absence will help us provide the necessary support and resources to help them catch up on any missed lessons or assignments.
</p>
<p>Please feel free to reach out to us at Pixxel House to discuss the reasons for your child's absence or to request any assistance they may need to make up for missed classwork.</p>
<p>At Institute of Pixxel House, we are committed to the education and well-being of our students, and your cooperation and communication are crucial in this process.</p>

<p>Thank you for your prompt attention to this matter. We look forward to hearing from you soon to ensure that your child continues to thrive academically.</p>
<p>Best regards,<br>
Team Pixxel House<br>
Institute of Pixxel House<br>
</div>
</body>
</html>

";
                                        ob_end_clean();
                                        $mailresult = mail($to, $subject, $html, $head);
                                    }         
                                    }
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                ?>
                                    <script>
                                        window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Attendance added Successfully!' ?>&location=<?php echo 'add_attandance.php?batch_id=' . $get_batch_id ?>";
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