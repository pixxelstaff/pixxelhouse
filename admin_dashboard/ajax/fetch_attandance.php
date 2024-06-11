<?php
include('../../connect.php');
include('../../functions/function.php');

$teacher_sno = $_POST['teacher_sno'];
$sortOrder = $_POST['sortOrder'];
$monthsSelect = $_POST['monthsSelect'];
$selectedOrder_year = $_POST['selectedOrder_year'];
$attendance_data = array();

if ($sortOrder == "Nill" || !isset($sortOrder)) {
    $show_batches = get_table_data2('batch', $con, 'teacher', $teacher_sno);
} else {
    $show_batches = get_table_data3('batch', $con, 'teacher', $teacher_sno, 'batch_id', $sortOrder);
}

while ($show = mysqli_fetch_assoc($show_batches)) {
    $teacher_batch_sno = $show['batch_id'];
    $teacher_batch_name = $show['batch_name'];
    $teacher_batch_code = $show['batch_code'];
    $teacher_batch_slot = $show['batch_slot']; 
    $teacher_batch_time = $show['time'];
    $date_of_start = $show['date_of_start'];

    if ($monthsSelect != "Nill" && $selectedOrder_year != "Nill") {
        $show_students_attendance = get_table_data4('attandance', $con, 'batch_name', $teacher_batch_sno, 'attendance_month', $monthsSelect, 'attendance_year', $selectedOrder_year);
    } elseif ($monthsSelect == "Nill" && $selectedOrder_year != "Nill") {

        $show_students_attendance = get_table_data3('attandance', $con, 'batch_name', $teacher_batch_sno, 'attendance_year', $selectedOrder_year);
    } elseif ($monthsSelect != "Nill" && $selectedOrder_year == "Nill") {

        $show_students_attendance = get_table_data3('attandance', $con, 'batch_name', $teacher_batch_sno, 'attendance_month', $monthsSelect);
    } else {
        $show_students_attendance = get_table_data2('attandance', $con, 'batch_name', $teacher_batch_sno);
    }

    while ($row = mysqli_fetch_assoc($show_students_attendance)) {
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
                        'batch_id' => $teacher_batch_sno,
                        'student_id' => $send_student_id,
                        'student_name' => $student_name,
                        'father_name' => $father_name,
                        'batch_name' => $teacher_batch_name,
                        'batch_code' => $teacher_batch_code,
                        'batch_slot' => $teacher_batch_slot,
                        'batch_time' => $teacher_batch_time,
                        'date_of_start' => $date_of_start,
                        'attendance_data' => array()
                    );

                    $attendance_data[] = $new_student_entry;
                    $existing_student_index = count($attendance_data) - 1;
                }

                // Add assignments_done to the attendance_data array
                $attendance_data[$existing_student_index]['attendance_data'][] = array(
                    'attendance_id' => $row['attendance_id'],
                    'attendance_date' => $row['attendance_date'],
                    'attendance_status' => $attendance_statuses[$index],
                    'assignments_done' => $assignments_done_all[$index], // Add assignments_done
                    'attendance_month' => $row['attendance_month'],
                    'assigments' => $row['assigments'],
                    'attendance_year' => $row['attendance_year'],
                    'attendance_id' => $row['attendance_id']
                );
            }
        }
    }
}
echo json_encode($attendance_data);
