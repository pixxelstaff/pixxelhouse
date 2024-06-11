<?php
include('../../connect.php');
include('../../functions/function.php');

$batchQuery = isset($_GET['batch']) ? $_GET['batch'] : '';

$sql = "SELECT * FROM `students` WHERE FIND_IN_SET('$batchQuery', batch) > 0";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch data and store it in an array
$data = array();
$usedPasswords = array(); // To store used passwords

while ($row = mysqli_fetch_assoc($result)) {
    $displayed_students[] = $row['sno'];

    // Generate a unique password
    do {
        $rand_password = rand(1, 999999);
    } while (in_array($rand_password, $usedPasswords));

    $usedPasswords[] = $rand_password; // Add the used password to the array

    $data[] = array(
        'sno' => $row['sno'],
        'student_name' => $row['student_name'],
        'father_name' => $row['father_name'],
        'father_email' => $row['father_email'],
        'student_email' => $row['email'],
        'student_contact' => $row['student_contact'],
        'portal_email' => $row['portal_email'],
        'password' => $rand_password
    );
}

// Send the data as JSON response
header("Content-type: application/json");
echo json_encode($data);
