<?php
include('../../connect.php');
include('../../functions/function.php');
$batchQuery = isset($_GET['batch']) ? $_GET['batch'] : '';

$sql = "SELECT * FROM `change_student`";


$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    $student_id = $row['change_student_id'];
    $change_batch = $row['change_batch'];
    $change_reason = $row['change_reason'];
    $attendance_dates = $row['attendance_dates'];
    $attendance_status = $row['attendance_status'];


    $select_student_data = "SELECT * FROM `students` WHERE `sno`='$student_id'";
    $select_student_data_res = mysqli_query($con, $select_student_data);
    while ($row2 = mysqli_fetch_assoc($select_student_data_res)) {


        $select_batch_data = "SELECT * FROM `batch` WHERE `batch_id`='$change_batch'";
        $select_batch_data_res = mysqli_query($con, $select_batch_data);
        while ($row3 = mysqli_fetch_assoc($select_batch_data_res)) {
            $data[] = array(
                'sno' => $student_id,
                'student_name' => $row2['student_name'],
                'father_name' => $row2['father_name'],
                'father_email' => $row2['father_email'],
                'student_contact' => $row2['student_contact'],
                'email' => $row2['email'],
                'address' => $row2['address'],
                'student_image' => $row2['student_image'],
                'batch_name' => $row3['batch_name'],
                'batch_code' => $row3['batch_code'],
                'batch_slot' => $row3['batch_slot'],
                'attendance_dates' => $attendance_dates,
                'attendance_status' => $attendance_status,
                'change_reason' => $change_reason
            );
        }
    }
}

// Send the data as JSON response
header("Content-type: application/json");
echo json_encode($data);
// echo ($data);
