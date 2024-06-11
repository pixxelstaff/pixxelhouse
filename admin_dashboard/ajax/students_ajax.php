<?php
include('../../connect.php');
include('../../functions/function.php');
// Search query from the client-side (if provided)
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$selectQuery = isset($_GET['select']) ? $_GET['select'] : '';
$batchQuery = isset($_GET['batch']) ? $_GET['batch'] : '';
$batch_ids_result = mysqli_query($con, "SELECT * FROM `batch`");
while ($batch_row = mysqli_fetch_assoc($batch_ids_result)) {
    $new_batch_ids[] = $batch_row['batch_id'];
}

$sql = "SELECT * FROM `students`";

// Add a WHERE clause for name filtering if a search query is provided
if (empty($batchQuery)) {
    if (!empty($searchQuery)) {
        $sql .= " WHERE $selectQuery LIKE '%" . mysqli_real_escape_string($con, $searchQuery) . "%'";
    }
} else {
    if (!empty($searchQuery)) {
        $sql .= " WHERE FIND_IN_SET('$batchQuery', batch) > 0 AND $selectQuery LIKE '%" . mysqli_real_escape_string($con, $searchQuery) . "%'";
    } else {
        $sql .= " WHERE FIND_IN_SET('$batchQuery', batch) > 0";
    }
}

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch data and store it in an array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $students_batch_ids = explode(',', $row['batch']);
    $displayed_students = array();
    $batch_names1 = array();
    $batch_codes1 = array();
    $batch_times1 = array();
    $batch_days1 = array();
    foreach ($students_batch_ids as $batch_id) {
        $batch_fetch_data=get_table_data2('batch', $con, 'batch_id', $batch_id);
        while($new=mysqli_fetch_assoc($batch_fetch_data)){
            $batch_names1[] = $new['batch_name'];
            $batch_days1[] = $new['batch_slot'];
            $batch_times1[] = $new['time'];
            $batch_codes1[] = $new['batch_code'];

        }
        $batch_names = implode('<br>',$batch_names1);
        $batch_codes =implode('<br>',$batch_codes1);
        $batch_times =implode('<br>',$batch_times1);
        $batch_days  =implode('<br>',$batch_days1); 
    }
    if (array_intersect($students_batch_ids, $new_batch_ids) && !in_array($row['sno'], $displayed_students)) {
        $displayed_students[] = $row['sno'];
        // $data[] = $row;
        $data[] = array(
            'sno' => $row['sno'],
            'student_name' => $row['student_name'],
            'father_name' => $row['father_name'],
            'father_email' => $row['father_email'],
            'home_contact' => $row['home_contact'],
            'student_contact' => $row['student_contact'],
            'date_of_birth' => $row['date_of_birth'],
            'email' => $row['email'],
            'portal_email' => $row['portal_email'],
            'address' => $row['address'],
            'student_image' => $row['student_image'],
            'qualification' => $row['qualification'],
            'gender' => $row['gender'],
            'batch_name'=>$batch_names,
            'batch_codes'=>$batch_codes,
            'batch_times'=>$batch_times,
            'batch_days'=>$batch_days
        );
    }
}


// Send the data as JSON response
header("Content-type: application/json");
echo json_encode($data);
// echo ($data);
