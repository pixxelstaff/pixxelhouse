<?php

// =============================================taking class analytical data

function std_class_data($connect, $batch_num, $std_id)
{

    $class_analytical_data = "SELECT `student_ids`, `attendance_status`, `assigments_done` FROM `attandance` WHERE `batch_name` = '$batch_num'";

    $class_analytical_data_query = mysqli_query($connect, $class_analytical_data);

    $total_class = 0;
    $total_present_class = 0;
    $total_absent_class = 0;
    $total_leave_class = 0;
    $total_skip_class = 0;
    $assignment_done = 0;
    $nill_assignments = 0;
    $present_percentage = 0;
    $absent_percentage = 0;
    $assignment_percentage = 0;

    if (mysqli_num_rows($class_analytical_data_query) > 0) {

        while ($c_a_data = mysqli_fetch_assoc($class_analytical_data_query)) {

            $total_class++;

            // exploding student id
            $student_ids = $c_a_data['student_ids'];

            $exp_std_ids = explode(',', $student_ids);

            $std_id_index_no = array_search($std_id, $exp_std_ids);

            if (in_array($std_id, $exp_std_ids)) {
                // checking the student data is present are not?
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

                if ($exp_std_assign_status[$std_id_index_no] == '1') {

                    $assignment_done++;
                } elseif ($exp_std_assign_status[$std_id_index_no] > 1) {
                    $nill_assignments++;
                }
            }

            $present_percentage = round($total_present_class / $total_class * 100);

            $absent_percentage = round($total_absent_class / $total_class * 100);

            $assignment_percentage = round($assignment_done / ($total_class - $nill_assignments) * 100);

        }

        // exploding class active status


        return [
            'total_class' => $total_class,
            'total_present_class' => $total_present_class,
            'total_absent_class' => $total_absent_class,
            'total_leave_class' => $total_leave_class,
            'total_skip_class' => $total_skip_class,
            'assignment_done' => $assignment_done,
            'present_percentage' => $present_percentage,
            'absent_percentage' => $absent_percentage,
            'assignment_percentage' => $assignment_percentage,
        ];
    } else {
        return [
            'total_class' => $total_class,
            'total_present_class' => $total_present_class,
            'total_absent_class' => $total_absent_class,
            'total_leave_class' => $total_leave_class,
            'total_skip_class' => $total_skip_class,
            'assignment_done' => $assignment_done,
            'present_percentage' => $present_percentage,
            'absent_percentage' => $absent_percentage,
            'assignment_percentage' => $assignment_percentage,
        ];
    }
}



//=========================================student attendance data =========================================

function student_attendance_data($connect, $batch_num, $std_id, $student_name, $limit_status, $limit)
{


    $batch_num = mysqli_real_escape_string($connect, $batch_num);
    $std_id = mysqli_real_escape_string($connect, $std_id);
    $limit_status = $limit_status;
    $limit = $limit;

    // Construct the SQL query without ORDER BY clause
    $query = "SELECT `batch`.`batch_name` AS 'course_name',`batch`.`batch_code`, `teacher`.`teacher_name`, `batch`.`course_duration`, `attandance`.*
    FROM `attandance`
    JOIN `batch` ON `attandance`.`batch_name` = `batch`.`batch_id`
    JOIN `teacher` ON  `batch`.`teacher` = `teacher`.`teacher_id`
    WHERE `attandance`.`batch_name` = '$batch_num'";

    // Add ORDER BY clause if $limit_status is true
    if ($limit_status) {
        $query .= " ORDER BY `attandance`.`attendance_date` DESC";
    }

    // Add LIMIT clause if $limit_status is true
    if ($limit_status) {
        $query .= " LIMIT $limit";
    }

    $result = mysqli_query($connect, $query);

    $attendanceData = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $act_id =  explode(',', $row['student_ids']);

        $act_id_index = array_search($std_id, $act_id);

        $att = explode(',', $row['attendance_status']);

        $assign_status = explode(',', $row['assigments_done']);

        if (in_array($std_id, $act_id)) {

            $attendanceData[] = [
                'Id' => $row['attendance_id'],
                'student_name' => $student_name,
                'course_name' => $row['course_name'],
                'batch_name' => $row['batch_code'],
                'attendance_date' => $row['attendance_date'],
                'attendance' => $att[$act_id_index],
                'assignments' => $row['assigments'],
                'assignments_des' => $row['assigment_detail'],
                'assignment_status' => $assign_status[$act_id_index],
                'teacher' => $row['teacher_name'],

            ];
        }
    }

    // Render HTML using $attendanceData

    return $attendanceData;
    // Close the database connection
    mysqli_close($connect);
}



//===============================================fees function.php============================================

function fees_data_func($connect, $batch_no, $std_id, $want_limit)
{

    $fees_var = "SELECT `students`.`student_name`, `students`.`father_name`, `batch`.`batch_name`, `batch`.`batch_code`,`batch`.`teacher`, `students_fees`.`date`, `students_fees`.`month`, `students_fees`.`fees`, `students_fees`.`fees_status` FROM `students_fees` JOIN `students` ON `students_fees`.`std_data` = `students`.`sno` JOIN `batch` ON `students_fees`.`batch_data` = `batch`.`batch_id` WHERE `students_fees`.`batch_data` = '$batch_no' AND `students_fees`.`std_data` ='$std_id'";

    if ($want_limit == true) {
        $fees_var .= "LIMIT 1";
    }

    $fees_var_query = mysqli_query($connect, $fees_var);

    $fees_data_arr = [];

    if ($fees_var_query) {

        while ($f_data = mysqli_fetch_assoc($fees_var_query)) {
            $fees_data_arr[] = array(
                'student_name' => $f_data['student_name'],
                'father_name' => $f_data['father_name'],
                'batch_name' => $f_data['batch_name'],
                'batch_code' => $f_data['batch_code'],
                'batch_teacher' => $f_data['teacher'],
                'date' => $f_data['date'],
                'month' => $f_data['month'],
                'fees' => $f_data['fees'],
                'fees_status' => $f_data['fees_status']
            );
        }
    }

    return $fees_data_arr;
}


// $student_basic_data = fees_data_func($con,1,2,false);

// echo "<pre>";
// print_r($var);
// echo"</pre>";


//===============================================batch_name.php============================================

// $sel_batch_name_from_att = "SELECT DISTINCT `batch`.`batch_name` FROM `attandance` JOIN `batch` ON `attandance`.`batch_name` = `batch`.`batch_id` WHERE `attandance`.`batch_name` = '$batch'";


function batch_table_name($connect, $batch)
{
    $sel_batch_name_from_att = "SELECT `batch_name` FROM `batch` WHERE `batch_id` = '$batch'";

    $sel_batch_name_from_att_query = mysqli_query($connect, $sel_batch_name_from_att);

    $batchName = "";

    if ($sel_batch_name_from_att_query) {

        while ($batch_from_att = mysqli_fetch_assoc($sel_batch_name_from_att_query)) {
            $batchName = $batch_from_att['batch_name'];
        }
    }

    return $batchName;
}

// $ans = batch_name($con,4);

// echo $ans;

// ================================================ALL DATA FUNCTION ===================================



function all_data_func($connect, $table)
{
    $all_data = "SELECT * FROM `$table`";

    $all_data_q = mysqli_query($connect, $all_data);

    if ($all_data) {
        return $all_data_q;
    } else {
        echo "error occur" . mysqli_error($connect);
    }
}


// ================================================ONE COLUMN FUNCTION ===================================

function one_col($connect, $table, $col_name, $col_val)
{
    $data = "SELECT * FROM `$table` WHERE `$col_name` = '$col_val'";
    $data_query = mysqli_query($connect, $data);
    if ($data_query) {
        return $data_query;
    } else {
        echo "error occur" . mysqli_error($connect);
    }
}


//=====================================================sanitization function ===============================


function mine_sanitize_string($string)
{

    $string = strip_tags($string);

    $string = preg_replace('/\s{2,}/', ' ', $string);

    $string = addslashes($string);

    $string = htmlspecialchars($string);

    $string = trim($string);

    return $string;
}
