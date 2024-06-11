<?php
include('../include/connect.php');
if (isset($_POST['image'])) {
    $image = $_POST['image'];
    $teacherSno = $_POST['teacher_sno'];

    list($type, $image) = explode(';', $image);
    list(, $image) = explode(',', $image);

    $image = base64_decode($image);
    $image_name = time() . '.png';
    $insert_image = file_put_contents('../../images/' . $image_name, $image);
    $new_image =  $image_name;
    $insert = "UPDATE `teacher` SET `teacher_image`='$new_image' WHERE `teacher_id`='$teacherSno'";
    $insert_qry = mysqli_query($con, $insert);
    if ($insert_qry) {
        echo 'Profile Uploaded';
    } else {
        echo 'Something Went Wrong';
    }
}
