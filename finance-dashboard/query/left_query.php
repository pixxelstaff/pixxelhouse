<?php
include('../../functions/function.php');
include('../../connect.php');
if (isset($_GET['left_student_sno'])) {
    $student_sno = $_GET['left_student_sno'];
    $get_all_data = get_table_data2('students', $con, 'sno', $student_sno);
    while ($row = mysqli_fetch_assoc($get_all_data)) {
        $student_name = $row['student_name'];
        $father_name = $row['father_name'];
        $father_email = $row['father_email'];
        $home_contact = $row['home_contact'];
        $date_of_birth = $row['date_of_birth'];
        $student_contact = $row['student_contact'];
        $emergency_contact = $row['emergency_contact'];
        $gender = $row['gender'];
        $address = $row['address'];
        $qualification = $row['qualification'];
        $course = $row['course'];
        $batch = $row['batch'];
        $country = $row['country'];
        $country_code = $row['country_code'];
        $city = $row['city'];
        $email = $row['email'];
        $portal_email = $row['portal_email'];
        $password = $row['password'];
        $student_image = $row['student_image'];
        $admission_date = $row['date'];
    }
    $left_date = date('d-m-Y');
    $inset_left = "INSERT INTO `left_student`(`student_name`, `email`, `father_name`, `father_email`, `home_contact`, `date_of_birth`, `student_contact`, `emergency_contact`, `gender`, `address`, `qualification`, `country`, `city`, `country_code`, `course`,`batch`, `image`, `admission_date`, `left_date`)
VALUES('$student_name', '$email', '$father_name', '$father_email', '$home_contact', '$date_of_birth', '$student_contact', '$emergency_contact', '$gender', '$address', '$qualification', '$country', '$city', '$country_code', '$course','$batch', '$student_image', '$admission_date', '$left_date')";
    $inset_left_qry = mysqli_query($con, $inset_left);
    if ($inset_left_qry) {
        $delete_student = "DELETE FROM `students` WHERE `sno`='$student_sno'";
        $delete_qry = mysqli_query($con, $delete_student);
        if ($delete_qry) {
?>
            <script>
                window.location = "../alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Student Removed!' ?>&location=<?php echo 'students.php' ?>";
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location = "../alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'students.php' ?>";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            window.location = "../alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'students.php' ?>";
        </script>
<?php
    }
}
