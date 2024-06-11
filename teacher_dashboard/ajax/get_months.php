<?php
// Include your database connection and required functions
include('../../connect.php');
include('../../functions/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOrder = $_POST['selectedOrder'];
    $selectedyears = $_POST['selectedyears'];

    // Validate batchSno if needed

    // SQL query to fetch the months and years for the selected batch sno
    $sql = "SELECT DISTINCT  attendance_month FROM `attandance` WHERE `attendance_year` = '$selectedyears' AND `batch_name`='$selectedOrder'";
    // $sql = "SELECT attendance_month FROM `attandance` WHERE `batch_name` = '$selectedyears' GROUP BY attendance_month";

    $result = $con->query($sql);

    if ($result) {
        // Array to store the months and years
        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            // Add the year and month values to the data array
            $data[] = array(
                'month' => $row['attendance_month']
            );
        }

        // Return the data as JSON response
        echo json_encode($data);
    } else {
        echo json_encode(array()); // Return an empty array if no data found
    }
}
