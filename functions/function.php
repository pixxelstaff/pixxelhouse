<?php

/* =========  Fetch Query ========== */

function get_table_data($tableName, $connection)
{
    // Dynamic query to retrieve all records from the specified table
    $query = "SELECT * FROM $tableName";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        return $result;
    } else {
        // Query execution failed
        echo "Error executing query: " . mysqli_error($connection);
    }
}


/* ============================== */


/* =========  Fetch Join Query ========== */

function get_join_table($connection, $student_id)
{
    // Dynamic query to retrieve all records from the specified table
    $mega_fetch_query = "SELECT students.*,course.*,batch.* FROM
                                students JOIN batch ON students.course = batch.batch_id JOIN course ON batch.course_id = course.Id WHERE
                                students.sno= '$student_id'";

    // Execute the query
    $result = mysqli_query($connection, $mega_fetch_query);

    // Check if the query was successful
    if ($result) {
        return $result;
    } else {
        // Query execution failed
        echo "Error executing query: " . mysqli_error($connection);
    }
}


/* ============================== */


/* =========  Fetch distinct Query  2 ========== */

function get_dist_table_data2($tableName, $distinct_cloumn_name, $connection, $coloumn_name, $coloumn_value)
{
    // Dynamic query to retrieve all records from the specified table
    $query = "SELECT DISTINCT $distinct_cloumn_name FROM $tableName WHERE `$coloumn_name`='$coloumn_value'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        return $result;
    } else {
        // Query execution failed
        echo "Error executing query: " . mysqli_error($connection);
    }
}


/* ============================== */

/* =========  Fetch Query  2 ========== */

function get_table_data2($tableName, $connection, $columnName, $columnValue)
{
    // Prepare the query with a parameter placeholder
    $query = "SELECT * FROM $tableName WHERE `$columnName` = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($connection, $query);

    // Bind the parameter to the statement
    mysqli_stmt_bind_param($stmt, "s", $columnValue);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the statement execution was successful
    if ($result) {
        return $result;
    } else {
        // Statement execution failed
        echo "Error executing statement: " . mysqli_stmt_error($stmt);
        return false;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}



/* ============================== */



/* =========  Fetch Query  3 ========== */

function get_table_data3($tableName, $connection, $coloumn_name1, $coloumn_value1, $coloumn_name2, $coloumn_value2)
{
    // Dynamic query to retrieve all records from the specified table
    $query = "SELECT * FROM $tableName WHERE `$coloumn_name1`='$coloumn_value1' AND `$coloumn_name2`='$coloumn_value2'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        return $result;
    } else {
        // Query execution failed
        echo "Error executing query: " . mysqli_error($connection);
    }
}


/* ============================== */
/* =========  Fetch Query  4 ========== */

function get_table_data4($tableName, $connection, $coloumn_name1, $coloumn_value1, $coloumn_name2, $coloumn_value2, $coloumn_name3, $coloumn_value3)
{
    // Dynamic query to retrieve all records from the specified table
    $query = "SELECT * FROM $tableName WHERE `$coloumn_name1`='$coloumn_value1' AND `$coloumn_name2`='$coloumn_value2' AND `$coloumn_name3`='$coloumn_value3'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        return $result;
    } else {
        // Query execution failed
        echo "Error executing query: " . mysqli_error($connection);
    }
}


/* ============================== */





// ====================  count total attendance   =============================


function total_attendance($connection, $batch_id, $student_id_search, $attendanceStatus)
{
    // Prepare the query to fetch relevant records
    $select_batch = "SELECT * FROM `attandance` WHERE `batch_name`='$batch_id'";
    $select_batch_res = mysqli_query($connection, $select_batch);

    $totalAttendance = 0;

    // Loop through the fetched records
    while ($show = mysqli_fetch_assoc($select_batch_res)) {
        $all_students_id = $show['student_ids'];
        $all_attendance_status = $show['attendance_status'];

        $students_id_array = explode(',', $all_students_id);
        $students_attendance_array = explode(',', $all_attendance_status);

        // Find the index of the student_id_search in the students_id_array
        $get_id_index = array_search($student_id_search, $students_id_array);

        // Check if the index exists and matches the attendance status
        if ($get_id_index !== false && isset($students_attendance_array[$get_id_index])) {
            if ($students_attendance_array[$get_id_index] == $attendanceStatus) {
                $totalAttendance++;
            }
        }
    }

    // Return the calculated total attendance
    return $totalAttendance;
}

/* ============================== */


// ====================  count total assignment   =============================

function total_assignment($connection, $batch_id, $student_id_search, $assignment)
{
    // Prepare the query to fetch relevant records
    $select_batch = "SELECT * FROM `attandance` WHERE `batch_name`='$batch_id'";
    $select_batch_res = mysqli_query($connection, $select_batch);

    $total_assignment = 0;

    // Loop through the fetched records
    while ($show = mysqli_fetch_assoc($select_batch_res)) {
        $all_students_id = $show['student_ids'];
        $all_assignment_done = $show['assigments_done'];

        $students_id_array = explode(',', $all_students_id);
        $students_assignment_array = explode(',', $all_assignment_done);

        // Find the index of the student_id_search in the students_id_array
        $get_id_index = array_search($student_id_search, $students_id_array);

        // Check if the index exists and matches the assignment status
        if ($get_id_index !== false && isset($students_assignment_array[$get_id_index])) {
            if ($students_assignment_array[$get_id_index] == $assignment) {
                $total_assignment++;
            }
        }
    }

    // Return the calculated total attendance
    return $total_assignment;
}

/* ============================== */



// ========================      total Assignment in a batch ===========================
function countNonEmptyAssignments($connection, $batch_id)
{
    $batch_id = mysqli_real_escape_string($connection, $batch_id);

    // Prepare the query to count non-empty assignments
    $query = "SELECT COUNT(*) AS count FROM `attandance` WHERE `batch_name`='$batch_id' AND `assigments` <> ''";

    // Execute the query
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Fetch the result row
        $row = mysqli_fetch_assoc($result);

        // Get the count
        $count = $row['count'];

        // Return the count
        return $count;
    } else {
        // Handle the query error
        echo "Error: " . mysqli_error($connection);
        return false;
    }
}
/* ============================== */



// ========================      total days in a months ===========================

function getTotalWeekdaysInMonth($month, $year, $weekday)
{
    // Ensure the month is between 1 and 12
    $month = max(1, min(12, $month));

    // Initialize the count
    $count = 0;

    // Get the total number of days in the month
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Loop through the dates and count occurrences of the specified weekday
    for ($day = 1; $day <= $totalDays; $day++) {
        $currentDate = "$year-$month-$day";
        $currentWeekday = date('N', strtotime($currentDate));

        if ($currentWeekday == $weekday) {
            $count++;
        }
    }

    return $count;
}

// ========================      get total record  ===========================

function getTotalRecords($table_name)
{
    require('../connect.php'); // Adjust this to your database connection configuration

    $table_name = mysqli_real_escape_string($con, $table_name);

    $query = "SELECT COUNT(*) as total_records FROM `$table_name`";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_records = $row['total_records'];
        mysqli_free_result($result); // Free the result set
    } else {
        $total_records = 0; // Set default value in case of error
    }

    mysqli_close($con); // Close the database connection

    return $total_records;
}
// ========================      get total record  ===========================

function getTotalRecords_with($con,$table_name, $coloumn_name, $coloumn_value)
{
    // require('../connect.php'); // Adjust this to your database connection configuration

    $table_name = mysqli_real_escape_string($con, $table_name);

    $query = "SELECT COUNT(*) as total_records FROM `$table_name` WHERE $coloumn_name='$coloumn_value'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_records = $row['total_records'];
        mysqli_free_result($result); // Free the result set
    } else {
        $total_records = 0; // Set default value in case of error
    }


    return $total_records;
}

// ========================     get student record  ===========================

function getTotalStudentsForTeacher($con,$batch_name,$coloumn_name,$coloumn_value)
{
    // require('../connect.php'); // Adjust this to your database connection configuration

    $query = "SELECT * FROM `$batch_name` WHERE $coloumn_name='$coloumn_value'";
    $res = mysqli_query($con, $query);
    $new_batch_ids = array();

    while ($batch_row = mysqli_fetch_assoc($res)) {
        $new_batch_ids[] = $batch_row['batch_id'];
    }

    $total_students = 0; // Initialize the total count

    $show_batches = get_table_data('students', $con);
    while ($row = mysqli_fetch_assoc($show_batches)) {
        $students_batch_ids = explode(',', $row['batch']);

        // Check if the student's batch IDs intersect with teacher's batch IDs
        $matching_batches = array_intersect($students_batch_ids, $new_batch_ids);

        // If there are matching batches, increment the total count
        if (!empty($matching_batches)) {
            $total_students++;
        }
    }

    return $total_students; // Return the total count
}
