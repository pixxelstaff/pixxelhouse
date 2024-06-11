<?php
include('../functions/function.php');

$test_batch_id = $_SESSION['student_test_batch'];
$student_test_id = $_SESSION['student_test_id'];
// Get student information
$select_students_qry = get_table_data2('students', $con, 'portal_email', $student_test_id);
while ($row2 = mysqli_fetch_assoc($select_students_qry)) {
   $student_name = $row2['student_name'];
   $student_image = $row2['student_image'];
}
// Get batch information
$select_students_batch = "SELECT batch_name FROM `batch` WHERE `batch_id`='$test_batch_id'";
$select_students_batch_qry = mysqli_query($con, $select_students_batch);
$row3 = mysqli_fetch_assoc($select_students_batch_qry);
$batch_name = $row3['batch_name'];