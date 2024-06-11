<?php

include('../include/connect.php');
include('../../finance-dashboard/include/custom.php');

$studentId = $_POST['id'];
$batchId = $_POST['batch_id'];
// $studentId = 16;
// $batchId = 3;

$month = [];
$fetchData = fetchOtherdetails($con, 'students', 'sno', $studentId);
if (mysqli_num_rows($fetchData) > 0) {
    while ($sh = mysqli_fetch_assoc($fetchData)) {
        $fetchedBatch = explode(',', $sh['batch']);
        if (in_array($batchId, $fetchedBatch)) {
           $fetchMonth = fetchOtherdetailsCol2($con,'students_fees','std_data',$studentId,'batch_data',$batchId);
           if(mysqli_num_rows($fetchMonth) > 0){
            while($fetch = mysqli_fetch_assoc($fetchMonth)){
                $month[] = array('month'=>$fetch['month']);
            }
           }
           else{
            $month = array('status' => 'error', 'month' => '', 'message' => 'this student has no reacords');
           }
           
        } else {
            $month = array('status' => 'error', 'month' => '', 'message' => 'student doesnot enrolled the batch u enter');
        }
    }
} else {
    $month = array('status' => 'error', 'month' => '', 'message' => 'the student you enter doesnot exists');
}

header("Content-Type:application/json");

echo json_encode($month);
