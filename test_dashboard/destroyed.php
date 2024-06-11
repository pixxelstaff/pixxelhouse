<?php
session_start();
if (isset($_SESSION['student_test_id'])) {
    unset($_SESSION['student_test_id']);
}
if (isset($_SESSION['student_result'])) {
    unset($_SESSION['student_result']);
    unset($_SESSION['student_test_batch']);
}
header("location:student.php");
