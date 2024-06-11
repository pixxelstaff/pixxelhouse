<?php
header('Content-Type: application/json');
include('../include/connect.php');
include('../../functions/function.php');

$select_date = $_POST['select_date'];
$select_batch = $_POST['select_batch'];
$attendance_data = array();

$show_attendance_data = "SELECT * FROM `attandance` WHERE `attendance_date`='$select_date' AND `batch_name`='$select_batch'";
$show_attendance_data_qry = mysqli_query($con, $show_attendance_data);
while ($row = mysqli_fetch_assoc($show_attendance_data_qry)) {
    $attendance_id = $row['attendance_id'];
    $student_id = $row['student_ids'];
    $attendance_status = $row['attendance_status'];
    $assignments_done = $row['assigments_done'];

    $student_ids = explode(',', $student_id);
    $attendance_statuses = explode(',', $attendance_status);
    $assignments_done_all = explode(',', $assignments_done);

    foreach ($student_ids as $index => $individual_student_id) {
        $show_students_name = get_table_data2('students', $con, 'sno', $individual_student_id);
        while ($row2 = mysqli_fetch_assoc($show_students_name)) {
            $send_student_id = $row2['sno'];
            $student_name = $row2['student_name'];
            $father_name = $row2['father_name'];

            $existing_student_index = -1;
            foreach ($attendance_data as $existing_index => $existing_student) {
                if ($existing_student['student_name'] === $student_name) {
                    $existing_student_index = $existing_index;
                    break;
                }
            }

            if ($existing_student_index === -1) {
                $new_student_entry = array(
                    'student_id' => $send_student_id,
                    'student_name' => $student_name,
                    'father_name' => $father_name,
                    'attendance_data' => array()
                );

                $attendance_data[] = $new_student_entry;
                $existing_student_index = count($attendance_data) - 1;
            }

            // Add assignments_done to the attendance_data array
            $attendance_data[$existing_student_index]['attendance_data'][] = array(
                'attendance_status' => $attendance_statuses[$index],
                'assignments_done' => $assignments_done_all[$index], // Add assignments_done
                'attendance_id' => $attendance_id
            );
        }
    }
}
echo json_encode($attendance_data);
