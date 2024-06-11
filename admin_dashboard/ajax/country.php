<?php
include('../include/connect.php');
include('../../functions/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $country_id = $_POST['country_id'];
    $data = array();

    $sql1 = "SELECT * FROM `country` WHERE `country_sno` = '$country_id'";
    $result1 = $con->query($sql1);

    if ($result1 && $result1->num_rows > 0) {
        $row1 = mysqli_fetch_assoc($result1);
        $data['country_code'] = $row1['country_code'];
    }

    $sql2 = "SELECT * FROM `city` WHERE `country_id` = '$country_id'";
    $result2 = $con->query($sql2);

    if ($result2 && $result2->num_rows > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $data['cities'][] = $row2['city_name'];
        }
        echo json_encode($data);
    } else {
        echo json_encode(array());
    }
}
