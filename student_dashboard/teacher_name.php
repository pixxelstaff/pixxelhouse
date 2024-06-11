<?php
include('include/connect.php');
$name = '';

if(!empty($_POST['batch'])){

$batch_id = $_POST['batch'];

$teacher_name = "SELECT `teacher`.`teacher_name` FROM `batch` JOIN `teacher` ON `batch`.`teacher` = `teacher`.`teacher_id` WHERE `batch`.`batch_id` = '$batch_id'";

$teacher_name_q = mysqli_query($con, $teacher_name);

while ($th_name = mysqli_fetch_assoc($teacher_name_q)) {
    $name = $th_name['teacher_name'];
}

echo $name;
}











