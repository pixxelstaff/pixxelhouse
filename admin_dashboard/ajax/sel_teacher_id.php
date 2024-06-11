<?php

include('../include/connect.php');
include('../../functions/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batchSno = $_POST['batchSno'];

    $sql = "SELECT  `teacher` FROM `batch` WHERE `batch_id` = '$batchSno'";

    $result = $con->query($sql);

    if ($result) {
        $data = '';

        while ($row = mysqli_fetch_assoc($result)) {

            $data = $row['teacher'];
        }
    }
 
    echo $data;
}