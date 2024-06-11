<?php
include('../include/connect.php');
$batchId = $_POST['batch'];
// $batchId = 3;
// $courseId = $_POST['course'];
// $courseId = 4;
$sortId = $_POST['sort'];
// $sortId = "";
// $batchId = !empty($_POST['batch']) ? $_POST['batch'] : 'Batch not provided';
// $courseId = !empty($_POST['course']) ? $_POST['course'] : 'Course not provided';
// $sortId = !empty($_POST['sort']) ? $_POST['sort'] : 'Sort not provided';

// echo $batchId . "," . $courseId . "," . $sortId;

$selectDyAjaxData = "SELECT * FROM `students`";

$conditions = array();

if (!empty($batchId)) {
    $conditions[] = "`batch` = '$batchId'";
}

// if (!empty($courseId)) {
//     $conditions[] = "FIND_IN_SET('$courseId', `course`)";
// }

if (!empty($conditions)) {
    $selectDyAjaxData .= ' WHERE ' . implode(' AND ', $conditions);
}

if (!empty($sortId)) {
    // $sortId = $_POST['sort'];
    $selectDyAjaxData .= "ORDER BY `student_name` $sortId"; // Replace 'sort_column' with the actual column name
}

$fetchingData = mysqli_query($con, $selectDyAjaxData);

$data = array();

while ($insertD = mysqli_fetch_assoc($fetchingData)) {
    $data[] = $insertD;
}

// Encode the data as JSON and send it back to the client
header('Content-Type: application/json');
echo json_encode($data);
