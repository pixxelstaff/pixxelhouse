<?php

include('../include/connect.php');
include('../include/custom.php');

$likeVal = $_POST['val'];
$offset = ($_POST['offset'] - 1) * 12;

$arryData = [];

$selectData = "SELECT * FROM `students` WHERE `student_name` LIKE CONCAT('%', ?, '%')";

if (empty($likeVal)) {
    $selectData .= "ORDER BY `sno` DESC LIMIT 12 OFFSET $offset";
}

$selectDataP = mysqli_prepare($con, $selectData);

mysqli_stmt_bind_param($selectDataP, 's', $likeVal);

mysqli_stmt_execute($selectDataP);


$results = mysqli_stmt_get_result($selectDataP);

while ($display = mysqli_fetch_assoc($results)) {
    $studentId = $display['sno'];
    $studentName = $display['student_name'];
    $fatherName = $display['father_name'];
    $studentImage = $display['student_image'];
    $batch_id = explode(',', $display['batch']);
    $course_id = explode(',', $display['course']);
    $actual_b_name = '';
    $teachers_act_names = '';
    $course_names = '';
    foreach ($batch_id as  $b_value) {
        $data = fetchOtherdetails($con, 'batch', 'batch_id', $b_value);
        $t_id = '';
        while ($show = mysqli_fetch_assoc($data)) {
            $actual_b_name .= $show['batch_name'] . ",";
            $t_id = $show['teacher'];
        }
        $data2 = fetchOtherdetails($con, 'teacher', 'teacher_id', $t_id);
        while ($show2 = mysqli_fetch_assoc($data2)) {
            $teachers_act_names .= $show2['teacher_name'] . ",";
        }
    }
    foreach ($course_id as  $c_value) {
        $data3 = fetchOtherdetails($con, 'course', 'Id', $c_value);
        while ($show3 = mysqli_fetch_assoc($data3)) {
            $course_names .= $show3['course_name'] . ",";
        }
    }
    $cl_b_name = trim($actual_b_name, ',');
    $cl_t_name = trim($teachers_act_names, ',');
    $cl_c_name = trim($course_names, ',');

    $arryData[] = array(
        'id' => $studentId,
        'name' => $studentName,
        'fathername' => $fatherName,
        'studentImage'=>$studentImage,
        'batchName' => $cl_b_name,
        'courseName' => $cl_c_name,
        'teacherName' => $cl_t_name
    );
}

header("Content-Type:application/json");
echo json_encode($arryData);
// echo "<pre>";
//  print_r($arryData);
