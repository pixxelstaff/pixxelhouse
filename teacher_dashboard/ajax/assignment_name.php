<?php
include('../../connect.php');
$batch_id = $_POST['batchId'];
$date = $_POST['date'];

$select_name = "SELECT `assigments` FROM `attandance` WHERE `batch_name` = '$batch_id'  AND `attendance_date` = '$date'";

$select_name_q = mysqli_query($con,$select_name);

while($data = mysqli_fetch_assoc($select_name_q)){
    $name = !empty($data['assigments']) ? $data['assigments'] : 'no assignment'  ;
}

header('Content-type:application/json');

echo json_encode($name);