<?php

include('include/connect.php');

$id = $_POST['id'];

$assign_array = [];

if (isset($id)) {

    $assignment_data = "SELECT * FROM `attandance` WHERE `attendance_id` = '$id'";

    $assignment_data_q = mysqli_query($con, $assignment_data);

    if ($assignment_data_q) {
        while ($show = mysqli_fetch_assoc($assignment_data_q)) {
            $assign_array = array(
                'name' => $show['assigments'],
                'date' => $show['attendance_date'],
                'des' => $show['assigment_detail']
            );
        }
    }
    else{
        $assign_array = array(
            'name' => '',
            'date' => '',
            'des' => ''
        );
    }

    header('Content-Type: application/json');
    echo json_encode($assign_array);
}
