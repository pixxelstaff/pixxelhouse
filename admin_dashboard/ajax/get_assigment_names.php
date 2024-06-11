<?php
include('../include/connect.php');
include('../../functions/function.php');

$assignment_date = $_POST['assignment_date'];
$show_assignment = get_table_data2('attandance', $con, 'attendance_id', $assignment_date);

$new_array = array();

while ($row = mysqli_fetch_assoc($show_assignment)) {
    // Change 'assigments' to the appropriate field name
    $new_array[] = array(
        'attendance_id' => $row['attendance_id'],
        'assignment_name' => $row['assigments']
        
    );
}
echo json_encode($new_array);

// echo ($new_array);
?>
