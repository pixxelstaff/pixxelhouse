<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Edit Batch)</title>
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
                        <h3 class=" text-center text-light">Edit Batch</h3>
                    </div>
                </div>
                <?php
                $get_batch_sno = $_GET['batch_sno'];
                $fetch_batch_detail = get_table_data2('batch', $con, 'batch_id', $get_batch_sno);
                while ($fetch = mysqli_fetch_assoc($fetch_batch_detail)) {
                    $batch_name = $fetch['batch_name'];
                    $batch_code = $fetch['batch_code'];
                    $batch_slot = $fetch['batch_slot'];
                    $teacher_sno = $fetch['teacher'];
                    $lab_number = $fetch['lab_number'];
                    $course_id = $fetch['course_id'];
                    $time = $fetch['time'];
                    $course_duration = $fetch['course_duration'];
                    $show_date_of_start = $fetch['date_of_start'];
                    $show_date_of_end = $fetch['date_of_end'];
                    $date_of_start = date("Y-m-d", strtotime($show_date_of_start));
                    if($show_date_of_end==''){
                        $date_of_end='';
                    }else{
                        
                    $date_of_end = date("Y-m-d", strtotime($show_date_of_end));
                    }
                }
                $fetch_teacher_name = get_table_data2('teacher', $con, 'teacher_id', $teacher_sno);
                while ($fetch2 = mysqli_fetch_assoc($fetch_teacher_name)) {
                    $teacher = $fetch2['teacher_name'];
                    $teacher_main_id = $fetch2['teacher_id'];
                }
                ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form action="query/update_batch.php?batch_sno=<?php echo $get_batch_sno; ?>" method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label for="batch_name" class="form-label">Batch Name<span class="text-danger">*</span></label>
                                            <input type="text" name="batch_name" id="batch_name" placeholder="Batch Name" class="form-control" value="<?php echo $batch_name ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="batch_code" class="form-label">Code<span class="text-danger">*</span></label>
                                            <input type="number" placeholder="Batch Code" min="1" name="batch_code" id="batch_code" class="form-control" value="<?php echo $batch_code ?>">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-6">
                                            <label for="teacher" class="form-label">Teacher<span class="text-danger">*</span></label>
                                            <select class="form-select" name="teacher" id="teacher">
                                                <option value="<?php echo $teacher_main_id ?>"><?php echo $teacher ?></option>
                                                <?php
                                                $all_teacher = get_table_data('teacher', $con);
                                                while ($show = mysqli_fetch_assoc($all_teacher)) {
                                                ?>
                                                    <option value="<?php echo $show['teacher_id'] ?>"><?php echo $show['teacher_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="course" class="form-label">Course<span class="text-danger">*</span></label>
                                            <select class="form-select" name="course" id="course" required>
                                                <?php
                                                $course = get_table_data2('course', $con, 'Id', $course_id);
                                                while ($row2 = mysqli_fetch_assoc($course)) {
                                                    $course_name = $row2['course_name'];
                                                }
                                                ?>
                                                <option value="<?php echo $course_id; ?>"><?php echo $course_name ?></option>
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
                                            <label for="lab" class="form-label">Lab Number<span class="text-danger">*</span></label>
                                            <select class="form-select" name="lab" id="lab" required>
                                                <option value="<?php echo $lab_number ?>"><?php echo $lab_number ?></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="duration" class="form-label">Duration<span class="text-danger">*</span></label>
                                            <select class="form-select" name="duration" id="duration" required>
                                                <option value="<?php echo $course_duration ?>"><?php echo $course_duration . " " . "Months" ?></option>
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
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">

                                            <label for="slot" class="form-label">Slot<span class="text-danger">*</span></label>
                                            <select class="form-select" name="slot" id="slot">
                                                <option value="<?php echo $batch_slot ?>"><?php echo $batch_slot ?></option>
                                                <option value="MWF">MWF</option>
                                                <option value="TTS">TTS</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="time" class="form-label">Time<span class="text-danger">*</span></label>
                                            <select class="form-select" name="time" id="time">
                                                <option value="<?php echo $time ?>"><?php echo $time ?></option>
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
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Date Of Start<span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $date_of_start ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">Date Of End</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo $date_of_end ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="update_btn" value="Update" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
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