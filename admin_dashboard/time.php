<?php
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
        return ($minutes == 1) ? "1 minute ago" : "$minutes minutes ago";
    } elseif ($hours < 24) {
        return ($hours == 1) ? "1 hour ago" : "$hours hours ago";
    } elseif ($days < 30) {
        return ($days == 1) ? "1 day ago" : "$days days ago";
    } elseif ($months < 12) {
        return ($months == 1) ? "1 month ago" : "$months months ago";
    } else {
        return ($years == 1) ? "1 year ago" : "$years years ago";
    }
}


