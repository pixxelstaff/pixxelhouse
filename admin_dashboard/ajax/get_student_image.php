<?php
// Assume your database connection is already established
include('include/connect.php');

if (isset($_GET['student_name'])) {
    $student_name = $_GET['student_name'];

    function get_student_details($student_name, $con) {
        $student_name = mysqli_real_escape_string($con, $student_name);

        // Assuming 'students' is the name of the student table and 'courses' is the name of the course table
        $query = "SELECT students.image, students.father_name, batch.batch_name
        FROM students
        LEFT JOIN batch ON students.course = batch.sno
        WHERE students.sno = '$student_name'
        LIMIT 1";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            // Return an empty array if the student is not found
            return array();
        }
    }

    // Get the student details and associated course name from the database
    $student_details = get_student_details($student_name, $con);

    // Return the student details as JSON
    echo json_encode($student_details);
    exit;
}
?>
