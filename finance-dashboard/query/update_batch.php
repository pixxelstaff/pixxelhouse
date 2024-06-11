<?php
include("../include/connect.php");
$get_batch_sno = $_GET['batch_sno'];
if (isset($_POST['update_btn'])) {
    $batch_name = $_POST['batch_name'];
    $batch_code = $_POST['batch_code'];
    $slot = $_POST['slot'];
    $teacher = $_POST['teacher'];
    $time = $_POST['time'];
    $lab = $_POST['lab'];
    $course_id = $_POST['course'];
    $duration = $_POST['duration'];
    $start_date_of = $_POST['start_date'];
    $end_date_of = $_POST['end_date'];
    $start_date = date("d-m-Y", strtotime($start_date_of));
    if($end_date_of==''){
        $end_date='';
    }else{
        
    $end_date = date("d-m-Y", strtotime($end_date_of));
    }

    $update_batch = "UPDATE `batch` SET `batch_name`='$batch_name',`batch_code`='$batch_code',`batch_slot`='$slot',`time`='$time',`course_duration`='$duration',`date_of_start`='$start_date',`date_of_end`='$end_date',`teacher`='$teacher',`course_id`='$course_id',`lab_number`='$lab' WHERE `batch_id`='$get_batch_sno'";
    $update_batch_qry = mysqli_query($con, $update_batch);
    if ($update_batch_qry) {
?>
        <script>
            window.location = "../alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Batch Updated Successfully!' ?>&location=<?php echo 'batches.php' ?>";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'batches.php' ?>";
        </script>
<?php
    }
}
?>