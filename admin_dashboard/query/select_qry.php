<?php
// =============== Select Student with $get_student_sno =====================
if(isset($_GET['student_sno'])){
$fetch_query = get_table_data2('students', $con, 'sno', $get_student_sno);
while ($row = mysqli_fetch_assoc($fetch_query)) {
    $student_name = $row['student_name'];
    $student_contact = $row['student_contact'];
    $father_name = $row['father_name'];
    $father_email = $row['father_email'];
    $home_contact = $row['home_contact'];
    $date_of_birth = $row['date_of_birth'];
    $quli = $row['qualification'];
    $course = $row['course'];
    $batch = $row['batch'];
    $gender = $row['gender'];
    $portal_email = $row['portal_email'];
    $address = $row['address'];
    $email = $row['email'];
    $city = $row['city'];
    $country = $row['country'];
    $student_image = $row['student_image'];
    $emergency_contact = $row['emergency_contact'];
}

$select_country = get_table_data2('country', $con, 'country_sno', $country);
while ($row3 = mysqli_fetch_assoc($select_country)) {
    $country_name = $row3['country_name'];
    $country_code = $row3['country_code'];
}
$select_course = get_table_data2('course', $con, 'Id', $course);
while ($row1 = mysqli_fetch_assoc($select_course)) {
    $course_name = $row1['course_name'];
    $course_duration = $row1['course_duration'];
}
$select_batch = get_table_data2('batch', $con, 'batch_id', $batch);
while ($row2 = mysqli_fetch_assoc($select_batch)) {
    $batch_sno_attendance = $row2['batch_id'];
    $batch_name  = $row2['batch_name'];
}
}elseif(isset($_GET['left_student_sno'])){
    $fetch_query = get_table_data2('left_student', $con, 'sno', $get_student_sno);
    while ($row = mysqli_fetch_assoc($fetch_query)) {
        $student_name = $row['student_name'];
        $student_contact = $row['student_contact'];
        $father_name = $row['father_name'];
        $father_email = $row['father_email'];
        $home_contact = $row['home_contact'];
        $date_of_birth = $row['date_of_birth'];
        $quli = $row['qualification'];
        $course = $row['course'];
        $batch = $row['batch'];
        $gender = $row['gender'];
        $address = $row['address'];
        $email = $row['email'];
        $city = $row['city'];
        $country = $row['country'];
        $student_image = $row['image'];
        $emergency_contact = $row['emergency_contact'];
    }
    
    $select_country = get_table_data2('country', $con, 'country_sno', $country);
    while ($row3 = mysqli_fetch_assoc($select_country)) {
        $country_name = $row3['country_name'];
        $country_code = $row3['country_code'];
    }
    $select_course = get_table_data2('course', $con, 'Id', $course);
    while ($row1 = mysqli_fetch_assoc($select_course)) {
        $course_name = $row1['course_name'];
        $course_duration = $row1['course_duration'];
    }
    $select_batch = get_table_data2('batch', $con, 'batch_id', $batch);
    while ($row2 = mysqli_fetch_assoc($select_batch)) {
        $batch_sno_attendance = $row2['batch_id'];
        $batch_name  = $row2['batch_name'];
    }
}