<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Add Batches)</title>
    <?php include('include/links.php'); ?>
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
                <!--  Row 1 -->
                <div class="card bg-primary">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Add New Batch</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label for="batch_name" class="form-label">Batch Name<span class="text-danger">*</span></label>
                                            <input type="text" name="batch_name" id="batch_name" placeholder="Batch Name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="course" class="form-label">Course<span class="text-danger">*</span></label>
                                            <select class="form-select" name="course" id="course" required>
                                                <option value="">Select Course</option>
                                                <?php
                                                $course = get_table_data('course', $con);
                                                while ($row = mysqli_fetch_assoc($course)) {
                                                ?>
                                                    <option value="<?php echo $row['Id'] ?>"><?php echo $row['course_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="batch_code" class="form-label">Code<span class="text-danger">*</span></label>
                                            <input type="number" placeholder="Batch Code" min="1" name="batch_code" id="batch_code" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="teacher" class="form-label">Teacher<span class="text-danger">*</span></label>
                                            <select class="form-select" name="teacher" id="teacher" required>
                                                <option value="">Select Teacher</option>
                                                <?php
                                                $course = get_table_data('teacher', $con);
                                                while ($row = mysqli_fetch_assoc($course)) {
                                                ?>
                                                    <option value="<?php echo $row['teacher_id'] ?>"><?php echo $row['teacher_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>


                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="duration" class="form-label">Duration<span class="text-danger">*</span></label>

                                            <select class="form-select" name="duration" id="duration" required>
                                                <option value="">Select Duration</option>
                                                <option value="1">1 Months</option>
                                                <option value="2">2 Months</option>
                                                <option value="3">3 Months</option>
                                                <option value="4">4 Months</option>
                                                <option value="5">5 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="7">7 Months</option>
                                                <option value="8">8 Months</option>
                                                <option value="9">9 Months</option>
                                                <option value="10">10 Months</option>
                                                <option value="11">11 Months</option>
                                                <option value="12">12 Months</option>
                                                <option value="13">13 Months</option>
                                                <option value="14">14 Months</option>
                                                <option value="15">15 Months</option>
                                                <option value="16">16 Months</option>
                                                <option value="17">17 Months</option>
                                                <option value="18">18 Months</option>
                                                <option value="19">19 Months</option>
                                                <option value="20">20 Months</option>
                                                <option value="21">21 Months</option>
                                                <option value="22">22 Months</option>
                                                <option value="23">23 Months</option>
                                                <option value="24">24 Months</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="slot" class="form-label">Slot<span class="text-danger">*</span></label>
                                            <select class="form-select" name="slot" id="slot" required>
                                                <option value="">Select Days</option>
                                                <option value="MWF">MWF</option>
                                                <option value="TTS">TTS</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="lab" class="form-label">Lab Number<span class="text-danger">*</span></label>
                                            <select class="form-select" name="lab" id="lab" required>
                                                <option value="">Select Lab</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="time" class="form-label">Time<span class="text-danger">*</span></label>
                                            <select class="form-select" name="time" id="time" required>
                                                <option value="">Select Time</option>
                                                <option value="1to2pm">1pm To 2pm</option>
                                                <option value="2to3pm">2pm To 3pm</option>
                                                <option value="3to4pm">3pm To 4pm</option>
                                                <option value="4to5pm">4pm To 5pm</option>
                                                <option value="5to6pm">5pm To 6pm</option>
                                                <option value="6to7pm">6pm To 7pm</option>
                                                <option value="7to8pm">7pm To 8pm</option>
                                                <option value="8to9pm">8pm To 9pm</option>
                                                <option value="9to10pm">9pm To 10pm</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label for="start_date" class="form-label">Date Of Start<span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" placeholder="Date Of Start" id="start_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="add_btn" value="Add" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['add_btn'])) {
                                    $batch_name = $_POST['batch_name'];
                                    $course = $_POST['course'];
                                    $batch_code = $_POST['batch_code'];
                                    $teacher = $_POST['teacher'];
                                    $duration = $_POST['duration'];
                                    $slot = $_POST['slot'];
                                    $lab = $_POST['lab'];
                                    $time = $_POST['time'];
                                    $start_date = $_POST['start_date'];
                                    $sort_start_date = date("d-m-Y", strtotime($start_date));
                                    $insert_batch = "INSERT INTO `batch`(`batch_name`,`course_id`, `batch_code`, `batch_slot`,`lab_number`,`teacher`, `time`, `course_duration`, `date_of_start`) VALUES ('$batch_name','$course','$batch_code','$slot','$lab','$teacher','$time','$duration','$start_date')";
                                    $insert_batch_qry = mysqli_query($con, $insert_batch);
                                    if ($insert_batch_qry) {
                                ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'New Batch Added!' ?>&location=<?php echo 'add_batch.php' ?>";
                                        </script>
                                    <?php
                                    } else {
                                    ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'add_batch.php' ?>";
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>