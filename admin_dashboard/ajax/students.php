<?php
include('../include/connect.php');

$batch = $_POST['batch_id'];

$stdFetch = "SELECT * FROM `students` WHERE FIND_IN_SET('$batch', `batch`)";

$stdFetchQ = mysqli_query($con,$stdFetch);

$data = array();

while($sh = mysqli_fetch_assoc($stdFetchQ)){
    $data[] = array(
        'id'=>$sh['sno'],
        "name"=>$sh['student_name']
    );
}

header('Content-Type:application/json');
echo json_encode($data);
