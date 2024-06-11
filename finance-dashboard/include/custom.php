<?php

function fetchAllData($connection,$Tablename){
    $data_sql = "SELECT * FROM `$Tablename`";
    $data_sql_p = mysqli_prepare($connection,$data_sql);
    mysqli_stmt_execute($data_sql_p);
    $dataResults = mysqli_stmt_get_result($data_sql_p);

    if($dataResults){
        return $dataResults;
    }
    else{
        echo mysqli_error($connection);
    }
}


function fetchOtherdetails($connection, $table,$column, $id)
{
    $otherData = mysqli_prepare($connection, "SELECT * FROM `$table` WHERE `$column` = ?");
    mysqli_stmt_bind_param($otherData, 's', $id);
    mysqli_stmt_execute($otherData);

    $Result = mysqli_stmt_get_result($otherData);
    if($Result){
        return $Result;
    }
    else{
        mysqli_error($connection);
    }
}
function fetchOtherdetailsCol2($connection, $table,$column1, $col1Val,$column2,$col2Val)
{
    $otherData = mysqli_prepare($connection, "SELECT * FROM `$table` WHERE `$column1` = ? AND `$column2` = ? ");
    mysqli_stmt_bind_param($otherData, 'ss', $col1Val,$col2Val);
    mysqli_stmt_execute($otherData);
    $Result = mysqli_stmt_get_result($otherData);
    if($Result){
        return $Result;
    }
    else{
        mysqli_error($connection);
    }
}
function fetchOtherdetailsCol3($connection, $table,$column1, $col1Val,$column2,$col2Val,$column3,$col3Val)
{
    $otherData = mysqli_prepare($connection, "SELECT * FROM `$table` WHERE `$column1` = ? AND `$column2` = ? AND `$column3` = ? ");
    mysqli_stmt_bind_param($otherData, 'sss', $col1Val,$col2Val,$col3Val);
    mysqli_stmt_execute($otherData);
    $Result = mysqli_stmt_get_result($otherData);
    if($Result){
        return $Result;
    }
    else{
        mysqli_error($connection);
    }
}
// increase 10 days in date ok?
function IncreaseDate($expectedFormat, $dateString)
{
    $timestamp = strtotime(DateTime::createFromFormat($expectedFormat, $dateString)->format('Y-m-d'));

    if ($timestamp !== false && $timestamp != -1) {
        // Add 10 days to the timestamp
        $newTimestamp = $timestamp + (10 * 24 * 60 * 60);

        // Format the new timestamp to the desired date format
        $formattedDate = date($expectedFormat, $newTimestamp);

        return $formattedDate;
    }
}
