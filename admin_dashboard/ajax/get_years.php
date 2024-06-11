<?php
include('../include/connect.php');
include('../../functions/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batchSno = $_POST['batchSno'];

    $sql = "SELECT DISTINCT `attendance_year` FROM `attandance` WHERE `batch_name` = '$batchSno'";

    $result = $con->query($sql);

    if ($result) {
        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'year' => $row['attendance_year'],
            );
        }
        echo json_encode($data);
    } else {
        echo json_encode(array());
    }
}
