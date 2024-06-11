<?php
include('../include/connect.php');
include('../../finance-dashboard/include/custom.php');

$studentId = $_POST['std_id'];
$batchId = $_POST['batch_id'];
// $studentId = '16';
// $batchId = '3';

$output = [];

if (isset($studentId) && isset($batchId)) {
    $studentData = "SELECT * FROM `students` WHERE `sno` = ? AND FIND_IN_SET(?,`batch`)";
    $studentDataQ = mysqli_prepare($con, $studentData);
    mysqli_stmt_bind_param($studentDataQ, "ss", $studentId, $batchId);
    mysqli_stmt_execute($studentDataQ);
    $result = mysqli_stmt_get_result($studentDataQ);
    if (mysqli_num_rows($result) > 0) {
        while ($sh = mysqli_fetch_assoc($result)) {
            $studentName = $sh['student_name'];
        }
        $batchData = fetchOtherdetails($con, 'batch', 'batch_id', $batchId);
        while ($bch = mysqli_fetch_assoc($batchData)) {
            $batchname = $bch['batch_name'];
            $courseId = $bch['course_id'];
        }
        $FetchCourseName = fetchOtherdetails($con, 'course', 'Id', $courseId);
        while ($crs = mysqli_fetch_assoc($FetchCourseName)) {
            $courseName = $crs['course_name'];
        }
        $fee__data = fetchOtherdetailsCol2($con, 'students_fees', 'std_data', $studentId, 'batch_data', $batchId);
        if (mysqli_num_rows($fee__data) > 0) {
            while ($fee = mysqli_fetch_assoc($fee__data)) {
                $output[] = array(
                    'name' => $studentName,
                    'course' => $courseName,
                    'batch' => $batchname,
                    'month' => $fee['month'],
                    'amount' => $fee['feeAmount'],
                    'fee_status' => $fee['fees_status']
                );
            }
        } else {
            $output = array('status' => 'error', 'name' => $studentName, 'message' => 'fee data is not upload');
        }
    } else {
        $output = array('status' => 'error', 'name' => $studentName, 'message' => 'sorry this student data is not present');
    }
} else {
    $output = array('status' => 'error', 'name' => $studentName, 'message' => 'please provide complete details');
}

header('Content-Type:application/json');

echo json_encode($output);
