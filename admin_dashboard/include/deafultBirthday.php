<?php



include('connect.php');
$selectAllData = "SELECT * FROM `students`";
$selectAllDataQ  = mysqli_query($con, $selectAllData);
// $today_date = date('m-d');
$today_date = "02-01";
// $data = mysqli_fetch_all($selectAllDataQ,MYSQLI_ASSOC);

// echo "<pre>";
// print_r($data);
while ($sh = mysqli_fetch_assoc($selectAllDataQ)) {
    $birthdate = $sh['date_of_birth'];

    // Attempt to convert date using strtotime
    $timestamp = strtotime($birthdate);

    if ($timestamp === false) {
        // Handle the case where the date couldn't be parsed
        echo "Error parsing the date: $birthdate<br>";
    } else {
        // Convert timestamp to a standard date format (e.g., Y-m-d)
        $standardDateFormat = date('m-d', $timestamp);
        echo $standardDateFormat;
        if($standardDateFormat == $today_date){
            ?>
            <script>alert("matched")</script>
            <?php
        }
    }
}
