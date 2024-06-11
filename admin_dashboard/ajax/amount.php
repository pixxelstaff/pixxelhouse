<?php

include('../include/connect.php');
include('../../finance-dashboard/include/custom.php');

$studentId = $_POST['id'];
$batchId = $_POST['batch_id'];

$amount = [];
$fetchData = fetchOtherdetails($con, 'students', 'sno', $studentId);
if (mysqli_num_rows($fetchData) > 0) {
    while ($sh = mysqli_fetch_assoc($fetchData)) {
        $fetchedBatch = explode(',', $sh['batch']);
        $fee = explode(',', $sh['fees']);
        if (in_array($batchId, $fetchedBatch)) {
            $index = array_search($batchId, $fetchedBatch);
            $amount = array('status' => 'success', 'amount' => $fee[$index]);
        } else {
            $amount = array('status' => 'error', 'Amount' => '', 'message' => 'student doesnot enrolled the batch u enter');
        }
    }
} else {
    $amount = array('status' => 'error', 'Amount' => '', 'message' => 'the student you enter doesnot exists');
}

header("Content-Type:application/json");

echo json_encode($amount);
