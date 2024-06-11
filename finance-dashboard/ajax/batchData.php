<?php

include('../include/connect.php');

$batch_id = $_POST['batch'];
// $batch_id = 3;

$data = array();

if (!empty($batch_id)) {
    $selectData = "SELECT * FROM `batch` WHERE `batch_id` = ?";

    $selectData_prepare = mysqli_prepare($con, $selectData);

    mysqli_stmt_bind_param($selectData_prepare, 's', $batch_id);

    mysqli_stmt_execute($selectData_prepare);

    $results = mysqli_stmt_get_result($selectData_prepare);

    $batchName = '';
    $teacherName = '';
    $teacherId = '';
    $cousreId = '';
    $courseName = '';

    while ($show = mysqli_fetch_assoc($results)) {
        $batchName = $show['batch_name'];
        $teacherId = $show['teacher'];
        $cousreId = $show['course_id'];
    }

    function fetchOtherdetails($connection, $table,$column, $id)
    {
        $otherData = mysqli_prepare($connection, "SELECT * FROM `$table` WHERE `$column` = ?");
        mysqli_stmt_bind_param($otherData, 's', $id);
        mysqli_stmt_execute($otherData);

        $Result = mysqli_stmt_get_result($otherData);
        if($Result){
            return $Result;
        }
        else{
            mysqli_error($connection);
        }
    }
    $Tdetails = fetchOtherdetails($con,'teacher','teacher_id',$teacherId);
    while($show1 = mysqli_fetch_assoc($Tdetails)){
        $teacherName = $show1['teacher_name'];
    }
    $Cdetails = fetchOtherdetails($con,'course','Id',$cousreId);
    while($show3 = mysqli_fetch_assoc($Cdetails)){
        $courseName = $show3['course_name'];
    }

    $data[] = array(
        'batchName' => $batchName,
        'teacherName' => $teacherName,
        'course' => $courseName
    );
} else {

    $data[] = array(
        'batchName' => '',
        'teacherName' => '',
        'course' => ''
    );
}

header('Content-Type:application/json');
echo json_encode($data);
