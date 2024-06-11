<?php

$today_date = date('m-d');

$sel_all_data = "SELECT * FROM `students` WHERE `date_of_birth` LIKE '%$today_date%'";

$sel_all_data_q = mysqli_query($con, $sel_all_data);


if (mysqli_num_rows($sel_all_data_q) > 0) {

    $std_b_ids = [];

    $notification_provider = 'student';

    $birthady_title = "Happy Birthday";

    $birthady_message = "We wish you a very happy birthday. May ALLAH bless you with happiness and you success";

    $not_date = date('j-n-y');

    $not_time = date('H:i a');


    while ($show_birth_data = mysqli_fetch_assoc($sel_all_data_q)) {
        $std_b_ids[] = $show_birth_data['sno'];
    }

    $str_ids = join(',', $std_b_ids);

    if (count($std_b_ids) != 0) {

        $select_notify_data = "SELECT * FROM `notification` WHERE `notification_provider` = '$notification_provider' AND `notification_provider_id` = '$str_ids' AND `notification_date` = '$not_date'";

        $select_notify_data_q = mysqli_query($con, $select_notify_data);

        if (mysqli_num_rows($select_notify_data_q) == 0) {

            $insert_data = "INSERT INTO `notification`(`notification_provider`,`notification_provider_id`,`notification_reader`,`notification_title`,`notification_des`,`notification_date`,`notification_time`) VALUES('$notification_provider','$str_ids','','$birthady_title','$birthady_message','$not_date','$not_time')";

            $insert_data_q = mysqli_query($con, $insert_data);

            if (!$insert_data_q) {
                mysqli_errno($con);
            }
        }
    }
}

mysqli_close($con);






// Function to convert seconds to a human-readable format
function timeAgo($date, $time)
{
    $datetime = DateTime::createFromFormat("d-m-y H:i A", "$date $time");
    $futureTimestamp = $datetime->getTimestamp();


    // Get the current timestamp
    $currentTimestamp = time();

    // Calculate the time difference in seconds
    $secondsDifference = $currentTimestamp - $futureTimestamp;


    $minutes = round($secondsDifference / 60);
    $hours = round($secondsDifference / 3600);
    $days = round($secondsDifference / 86400);
    $months = round($secondsDifference / 2629440);
    $years = round($secondsDifference / 31553280);

    if ($secondsDifference < 60) {
        return "few seconds ago";
    } elseif ($minutes < 60) {
        return ($minutes == 1) ? "1 m ago" : $minutes . "min ago";
    } elseif ($hours < 24) {
        return ($hours == 1) ? "1 h ago" : $hours . "h ago";
    } elseif ($days < 30) {
        return ($days == 1) ? "1 d ago" : $days . "d ago";
    } elseif ($months < 12) {
        return ($months == 1) ? "1 m ago" : $months . "mon ago";
    } else {
        return ($years == 1) ? "1 y ago" : $years . "y ago";
    }
}