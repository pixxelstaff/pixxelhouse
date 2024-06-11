<?php
include('include/connect.php');
if (isset($_GET['student_sno'])) {
    $student_sno = $_GET['student_sno'];


        // Now, delete the student record
        $delete_student = "DELETE FROM `students` WHERE `sno`='$student_sno'";
        $delete_student_qry = mysqli_query($con, $delete_student);

        if ($delete_student_qry) {
?>
            <script>
                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Student Deleted Successfully!' ?>&location=<?php echo 'students.php' ?>";
            </script>
        <?php
        } else {
        ?>
            <script>
                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'students.php' ?>";
            </script>
        <?php
        }

}elseif (isset($_GET['batch_sno'])) {
    $batch_sno = $_GET['batch_sno'];
    $delete_batch = "DELETE FROM `batch` WHERE `batch_id`='$batch_sno'";
    $delete_batch_qry = mysqli_query($con, $delete_batch);
    if ($delete_batch_qry) {
    ?>
        <script>
            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Batch Deleted Successfully!' ?>&location=<?php echo 'batches.php' ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'batches.php' ?>";
        </script>
<?php
    }
}elseif($_GET['pending_sno']){
    $pending_sno = $_GET['pending_sno'];
    $delete_pending = "DELETE FROM `pending_students` WHERE `sno`='$pending_sno'";
    $delete_pending_qry = mysqli_query($con, $delete_pending);
    if ($delete_pending_qry) {
    ?>
        <script>
            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Student Delete Successfully!' ?>&location=<?php echo 'pending_student.php' ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'pending_student.php' ?>";
        </script>
<?php
    }
}else{
    echo '<script>window.location="dashboard.php"</script>';
}
?>