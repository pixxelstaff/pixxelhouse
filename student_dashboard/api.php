<?php
session_start();
if (!isset($_SESSION['std_email'])) {
    header('location:index.php');
}

include('include/connect.php');

$ses_email = $_SESSION['std_email'];

$std_all_data = "SELECT * FROM `students` WHERE `portal_email` = '$ses_email'";

$std_all_data_query = mysqli_query($con, $std_all_data);

if ($std_all_data_query) {

    while ($show_std_data = mysqli_fetch_assoc($std_all_data_query)) {

        $session_student_id = $show_std_data['sno'];
        $sesion_student_batch = $show_std_data['batch'];
    }
}

$main_array = [];



$exp_std_batches = explode(',', $sesion_student_batch);

foreach ($exp_std_batches as $batch_key => $batch_value) {

    $class_analytical_data = "SELECT `student_ids`,`attendance_status`,`assigments_done` FROM `attandance` WHERE `batch_name` = '$batch_value'";

    $class_analytical_data_query = mysqli_query($con, $class_analytical_data);


    if (mysqli_num_rows($class_analytical_data_query) > 0) {

        $total_class = mysqli_num_rows($class_analytical_data_query);
        $total_present_class = 0;
        $total_absent_class = 0;
        $total_leave_class = 0;
        $total_skip_class = 0;
        $assignment_done = 0;


        while ($c_a_data = mysqli_fetch_assoc($class_analytical_data_query)) {

            // exploding student id 

            $std_ids = $c_a_data['student_ids'];

            $exp_std_ids = explode(',', $std_ids);

            $std_id_index_no = array_search($session_student_id, $exp_std_ids);

            if (in_array($session_student_id, $exp_std_ids)) {
                // $total_class++;


                // exploding class active status
                $cl_active_status = $c_a_data['attendance_status'];

                $exp_cl_active_status = explode(',', $cl_active_status);

                if ($exp_cl_active_status[$std_id_index_no] == 'P') {

                    $total_present_class++;
                } elseif ($exp_cl_active_status[$std_id_index_no] == 'A') {

                    $total_absent_class++;
                } elseif ($exp_cl_active_status[$std_id_index_no] == 'L') {

                    $total_leave_class++;
                } else {

                    $total_skip_class++;
                }

                $std_assign_status = $c_a_data['assigments_done'];

                $exp_std_assign_status = explode(',', $std_assign_status);

                if ($exp_std_assign_status[$std_id_index_no] == '1' || $exp_std_assign_status[$std_id_index_no] == '3') {

                    $assignment_done++;
                }
            }
        }

        // while loop ends

        $main_array[] = array(
            'total_class' => $total_class,
            'total_present_class' => $total_present_class,
            'total_absent_class' => $total_absent_class,
            'total_leave_class' => $total_leave_class,
            'total_skip_class' => $total_skip_class,
            'assignment_done' => $assignment_done
        );
    } else {
        $main_array[] = array(
            'total_class' => 0,
            'total_present_class' => 0,
            'total_absent_class' => 0,
            'total_leave_class' => 0,
            'total_skip_class' => 0,
            'assignment_done' => 0
        );
    }
}



header('Content-Type: application/json');
echo json_encode($main_array);
