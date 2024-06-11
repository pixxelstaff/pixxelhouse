
<?php
include('../include/connect.php');

// $id = '1';
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true); // Decode JSON data into an associative array
$id = $data['id'];
$res_result = false; // Initialize to false by defaultlt
$response = array('success' => $res_result);

$fetchData = "SELECT `Id`, `notification_reader` FROM `notification` WHERE NOT FIND_IN_SET(?, `notification_reader`)";
$fetchData_prepare = mysqli_prepare($con, $fetchData);
mysqli_stmt_bind_param($fetchData_prepare, 's', $id);

if (mysqli_stmt_execute($fetchData_prepare)) {
    $result = mysqli_stmt_get_result($fetchData_prepare);

    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            $notification_id = $data['Id'];
            $current_reader = $data['notification_reader'];

            // Check if $id is already in the notification_reader
            if (strpos($current_reader, $id) === false) {
                // If not, update the row
                if (empty($current_reader) && strlen($current_reader) == 0) {
                    // If notification_reader is empty, just set it to $id
                    $new_reader = $id;
                } else {
                    // If not empty, append $id with a comma
                    $new_reader = $current_reader . ',' . $id;
                }

                $update_query = "UPDATE `notification` SET `notification_reader` = ? WHERE `Id` = ?";
                $update_prepare = mysqli_prepare($con, $update_query);
                mysqli_stmt_bind_param($update_prepare, 'si', $new_reader, $notification_id);

                if (mysqli_stmt_execute($update_prepare)) {
                    // Successfully updated row
                    $res_result = true;
                } else {
                    // Handle update failure
                    $res_result = false;
                }

                mysqli_stmt_close($update_prepare);
            } else {
                // ID is already in notification_reader, skip updating
                $res_result = false;
            }
        }
    } else {
        $res_result = false;
    }
} else {
    // Handle fetch error
    $res_result = false;
}

mysqli_stmt_close($fetchData_prepare);
mysqli_close($con);
// Always send a JSON response
header('Content-type:application/json');
$response['success'] = $res_result;
echo json_encode($response);

?>