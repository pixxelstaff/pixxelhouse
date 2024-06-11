<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard (Merged Batch)</title>
    <?php include('include/links.php');

    ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include('include/sidebar.php'); ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <?php include('include/navbar.php'); ?>
            </header>
            <!--  Header End -->
            <div class="container-fluid">

                <div class="container">
                <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
          <div class="card-body">
            <h3 class=" text-center text-light">Merge Batch</h3>
          </div>
        </div>
        <div class="card my-border-primary-1 my-border-bottom-1">
          <div class="card-body table-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                        <form method="post">
                        <div class="row justify-content-center">
                            <!-- alert message -->

                            <div class="alert alert-warning mt-3 mb-0" id="b_alert" role="alert">
                                You can Merge two batches
                            </div>
                            <!-- select no 1 -->

                            <div class="col-lg-6 col-md-12 col-sm-12 my-1 pe-1 mb-3">
                                <!--  batch no heading -01 -->
                                <h4 class="text-center p-3 iph_blue text-white rounded"> Select batch - 01</h4>
                                <!-- select the first merging batch -->
                                <select name="batch_01" id="batch_01" class="form-select border border-primary" aria-label="Default select example">
                                    <option value="">select leaving batch</option>
                                    <?php
                                    // replace this functionby your function
                                    $batch = get_table_data( 'batch',$con);
                                    while ($b_val = mysqli_fetch_assoc($batch)) {
                                        echo "<option value =" . $b_val['batch_id'] . ">" . $b_val['batch_name'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <!-- select no 2 -->

                            <div class="col-lg-6 col-md-12 col-sm-12 my-1 ps-1">
                                <!--  batch no heading -01 -->
                                <h4 class="text-center p-3 iph_blue text-white rounded"> Select batch - 02</h4>
                                <!-- select the first merging batch -->
                                <select name="batch_02" id="batch_02" class="form-select border border-primary" aria-label="Default select example">
                                    <option value="">select leaving batch</option>
                                    <?php
                                    // replace this functionby your function
                                    $batch = get_table_data('batch',$con);
                                    while ($b_val = mysqli_fetch_assoc($batch)) {
                                        echo "<option value =" . $b_val['batch_id'] . ">" . $b_val['batch_name'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="merge_form_details col-12 my-1 px-1 d-none" id="o-detail">
                                <h3 class="std_p_contact_head text-center mt-3 mb-1">Merged Batch Detail </h3>
                                <span class="h2_spacer"></span>
                                <!-- first col of other details -->
                                <div class="row g-3 my-1">
                                    <div class="col">
                                        <label for="" class="form-label">Day slot</label>
                                        <select name="batch_slot" id="" class="form-select border border-primary" aria-label="Default select example">
                                            <option value="">select slot</option>
                                            <option value="MWF">MWF</option>
                                            <option value="TTS">TTS</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Timing</label>
                                        <select name="batch_timing" id="" class="form-select border border-primary" aria-label="Default select example">
                                            <option value="">Timing</option>
                                            <option value="1:00pm to 2:00pm">1:00pm to 2:00pm</option>
                                            <option value="2:00pm to 3:00pm">2:00pm to 3:00pm</option>
                                            <option value="3:00pm to 4:00pm">3:00pm to 4:00pm</option>
                                            <option value="4:00pm to 5:00pm">4:00pm to 5:00pm</option>
                                            <option value="5:00pm to 6:00pm">5:00pm to 6:00pm</option>
                                            <option value="6:00pm to 7:00pm">6:00pm to 7:00pm</option>
                                            <option value="7:00pm to 8:00pm">7:00pm to 8:00pm</option>
                                            <option value="8:00pm to 9:00pm">8:00pm to 9:00pm</option>
                                            <option value="9:00pm to 10:00pm">9:00pm to 10:00pm</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- second row of other details -->
                                <div class="row g-3 my-1">
                                    <div class="col">
                                        <label for="" class="form-label">Teacher</label>
                                        <select name="batch_teacher" id="" class="form-select border border-primary" aria-label="Default select example">
                                            <option value="">Select Teacher</option>
                                            <?php

                                            $fetch_teacher = get_table_data('teacher',$con);

                                            while ($sh_teacher = mysqli_fetch_assoc($fetch_teacher)) {
                                                echo "<option value=" . $sh_teacher['teacher_id'] . ">" . $sh_teacher['teacher_name'] . "</option>";
                                            }


                                            ?>

                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Course</label>
                                        <select name="batch_course_name" id="" class="form-select border border-primary" aria-label="Default select example">
                                            <option value="">Select course</option>
                                            <?php

                                            $fetch_course = get_table_data('course',$con);

                                            while ($sh_course = mysqli_fetch_assoc($fetch_course)) {
                                                echo "<option value=" . $sh_course['Id'] . ">" . $sh_course['course_name'] . "</option>";
                                            }

                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <!-- third row of other details -->
                                <div class="row g-3 my-1">
                                    <div class="col">
                                        <label for="" class="form-label">Lab number</label>
                                        <input type="text" name="labNo" id="labNo" class="form-control border border-primary" placeholder="Lab number" aria-label="First name">
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">Course duration </label>
                                        <input type="text" id="courseDuration" name="course_duration" class="form-control border border-primary" placeholder="Course duration" aria-label="Last name">
                                    </div>
                                </div>
                                <!-- fourth row of other details -->
                                <div class="row g-3 my-1">
                                    <div class="col">
                                        <label for="" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control border-primary" id="">
                                    </div>
                                    <div class="col">
                                        <label for="" class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control border-primary" id="">
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 text-center my-2">
                                <input type="submit" value="Merge Batch" name="merge_btn" class="btn btn-primary ">
                            </div>

                        </div>

                    </form>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                </div>
                </div>

            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        $(document).ready(function() {
            let batch_01 = $('#batch_01');
            let batch_02 = $('#batch_02');
            let alertElement = $('#b_alert');
            let detailForm = $('#o-detail');

            batch_01.on('change', checkValues);
            batch_02.on('change', checkValues);

            function checkValues() {
                let b_01_val = batch_01.val();
                let b_02_val = batch_02.val();

                if (b_01_val !== "" && b_02_val !== "") {
                    if (b_01_val === b_02_val) {
                        alertElement.removeClass('alert-warning').addClass('alert-danger');
                        alertElement.text("Don't select the same batch");

                        if (!detailForm.hasClass('d-none')) {
                            detailForm.addClass('d-none');
                        }
                    } else {
                        if (alertElement.hasClass('alert-danger')) {
                            alertElement.removeClass('alert-danger').addClass('alert-success');
                        } else if (alertElement.hasClass('alert-warning')) {
                            alertElement.removeClass('alert-warning').addClass('alert-success');
                        }
                        alertElement.text("Provide other details also");
                        detailForm.removeClass('d-none');
                    }
                }
            }
            $('#courseDuration, #labNo').on('input', function() {
                // Get the current input value
                let inputValue = $(this).val();

                // Use a regular expression to remove any non-numeric characters
                inputValue = inputValue.replace(/[^0-9]/g, '');

                // Update the input field with the cleaned value
                $(this).val(inputValue);
            });
        });
    </script>

</body>

</html>

<?php

if (isset($_POST['merge_btn'])) {
    // Get batch selections from the form
    $batch01 = $_POST['batch_01'];
    $batch02 = $_POST['batch_02'];

    if (!empty($batch01) && !empty($batch02)) {
        if ($batch01 != $batch02) {
            // Get other form inputs
            $batchDaySlot = $_POST['batch_slot'];
            $batchTiming = $_POST['batch_timing'];
            $batchTeacher = $_POST['batch_teacher'];
            $batchCourseName = $_POST['batch_course_name'];
            $labNo = $_POST['labNo'];
            $courseDuration = $_POST['course_duration'];
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];

            // Convert date formats
            $formattedStartDate = date('d-m-Y', strtotime($startDate));
            $formattedEndDate = date('d-m-Y', strtotime($endDate));

            // Initialize variables
            $mergedBatchNames = '';
            $mergedBatchCodes = '';
            $courseNum = '';
            $reverseBatchNames = '';

            // Arrays for batch IDs
            $batchesArray = [$batch01, $batch02];
            $reverseBatchArray = [$batch02, $batch01];

            // Fetch batch information
            foreach ($batchesArray as $batchValue) {
                $batchQuery = get_table_data2('batch',$con, 'batch_id', $batchValue);

                while ($shBatch = mysqli_fetch_assoc($batchQuery)) {
                    $mergedBatchNames .= $shBatch['batch_name'] . "-";
                    $mergedBatchCodes .= $shBatch['batch_code'] . "-";
                    $courseNum .= $shBatch['course_id'] . ",";
                }
            }

            // Reverse batch information
            foreach ($reverseBatchArray as $r_batchValue) {
                $batchQuery_r = get_table_data2( 'batch',$con, 'batch_id', $r_batchValue);

                while ($r_shBatch = mysqli_fetch_assoc($batchQuery_r)) {
                    $reverseBatchNames .= $r_shBatch['batch_name'] . "-";
                }
            }

            // Trim values
            $trimmedMergeName = rtrim($mergedBatchNames, '-');
            $trimmedMergeCode = rtrim($mergedBatchCodes, '-');
            $trimmedReverseBatchName = rtrim($reverseBatchNames, '-');
            $trimmedcourseNum = rtrim($courseNum, ',');

            // Explode course IDs
            $explodedStudentCourse = explode(',', $trimmedcourseNum);

            // Check if merged batch names are not present in the database
            $check_batch_presence = "SELECT * FROM `batch` WHERE `batch_name` = ? OR `batch_name` = ?";
            $check_batch_presence_q = mysqli_prepare($con, $check_batch_presence);

            // Bind the values to the placeholders
            mysqli_stmt_bind_param($check_batch_presence_q, "ss", $trimmedMergeCode, $trimmedReverseBatchName);

            // Execute the prepared statement
            mysqli_stmt_execute($check_batch_presence_q);

            // Get the result set
            $result_q_01 = mysqli_stmt_get_result($check_batch_presence_q);

            if (mysqli_num_rows($result_q_01) == 0) {
                // Insert merged batch data
                $insertMergeBatchQuery = "INSERT INTO `batch`(`batch_name`,`batch_code`,`batch_slot`,`teacher`,`time`,`course_id`,`course_duration`,`lab_number`,`date_of_start`,`date_of_end`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insertMergeBatchResult = mysqli_prepare($con, $insertMergeBatchQuery);

                // Bind the values to the placeholders
                mysqli_stmt_bind_param($insertMergeBatchResult, "ssssssssss", $trimmedMergeName, $trimmedMergeCode, $batchDaySlot, $batchTeacher, $batchTiming, $batchCourseName, $courseDuration, $labNo, $formattedStartDate, $formattedEndDate);

                // Execute the prepared statement

                if (mysqli_stmt_execute($insertMergeBatchResult)) {
                    // Get the ID of the newly inserted batch
                    $newBatchId = mysqli_insert_id($con);

                    // Fetch students and update their batch and course information
                    $selectSpecificStudentData = get_table_data( 'students',$con);

                    while ($selectedStudent = mysqli_fetch_assoc($selectSpecificStudentData)) {
                        $studentId = $selectedStudent['sno'];
                        $studentBatch = $selectedStudent['batch'];
                        $explodedStudentBatch = explode(',', $studentBatch);

                        if (in_array($batch01, $explodedStudentBatch) || in_array($batch02, $explodedStudentBatch)) {
                            $studentCourse = $selectedStudent['course'];
                            $dbExpCourseId = explode(',', $studentCourse);

                            // Calculate new batch and course information
                            $newBatchOfStudent = array_diff($explodedStudentBatch, $batchesArray);
                            $newBatchOfStudent[] = $newBatchId;

                            $newCourseOfStudent = array_diff($dbExpCourseId, $explodedStudentCourse);
                            $newCourseOfStudent[] = $batchCourseName;

                            // Previous batch information
                            $previous_batch = !empty($selectedStudent['previous_batch']) ? explode(',', $selectedStudent['previous_batch']) : [];
                            $previous_batch_result = array_intersect($explodedStudentBatch, $batchesArray);

                            if (!empty($previous_batch_result)) {
                                foreach ($previous_batch_result as $prevVal) {
                                    $previous_batch[] = $prevVal;
                                }
                            }

                            $implodeprevbatch = implode(',', $previous_batch);
                            $implodedArray = implode(',', $newBatchOfStudent);
                            $courseImpArray = implode(',', $newCourseOfStudent);

                            // Update the course and batch information for the student
                            $updateQuery = "UPDATE `students` SET `batch` = ?, `course` = ?, `previous_batch` = ? WHERE `sno` = ?";
                            $updateQueryResult = mysqli_prepare($con, $updateQuery);

                            // Bind the values to the placeholders
                            mysqli_stmt_bind_param($updateQueryResult, "sssi", $implodedArray, $courseImpArray, $implodeprevbatch, $studentId);

                            // Execute the prepared statement

                            if (mysqli_stmt_execute($updateQueryResult)) {
                                // Check if the update was successful
?>
                                <script>
                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Batch Merge Successfully!' ?>&location=<?php echo 'merged_batch.php'; ?>";
                                </script>
                            <?php
                            } else {
                            ?>
                                <script>
                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Failed Merging Batches!' ?>&location=<?php echo 'merged_batch.php'; ?>";
                                </script>
                    <?php
                            }
                        }
                    }

                    // Redirect after successful merge

                    exit;
                } else {
                    ?>
                    <script>
                        window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'merged_batch.php'; ?>";
                    </script>
<?php
                }
            } else {
               ?>
                    <script>
                        window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Same Batch Cannot Merged!' ?>&location=<?php echo 'merged_batch.php'; ?>";
                    </script>
<?php
            }
        } else {
            echo "<script>alert('Batches cannot be the same.');</script>";
        }
    } else {
        echo "<script>alert('Please select both batches.');</script>";
    }
}
?>