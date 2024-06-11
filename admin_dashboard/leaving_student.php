<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Left Students)</title>
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
                <div class="card bg-primary card-bottom-ph my-border-primary-1 my-border-top-1">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Left Students</h3>
                    </div>
                </div>
                <div class="card my-border-primary-1 my-border-bottom-1">
                    <div class="card-body table-body">
                        <div class="row mt-2">
                            <div class="col-md-9 d-flex align-items-center">
                                <label class="w-25">Quick Search</label>

                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <a href="students.php"><button type="reset" class="btn btn-dark">Reset</button></a>
                                <a href="?slot=<?php echo 'mwf' ?>"><button type="reset" class="btn btn-primary">MWF</button></a>
                                <a href="?slot=<?php echo 'tts' ?>"><button type="reset" class="btn btn-primary">TTS</button></a>
                            </div>
                        </div>
                        <div class="table-responsive main-table mt-4">
                            <table id="myTable" class="teacher-table table-bordered table display data-table text-nowrap text-center my-border-primary-1">
                                <thead class="bg-primary text-white">
                                    <th>Sno</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Student Contact</th>
                                    <th>Batch Name</th>
                                    <th>Batch Slot</th>
                                    <th>Batch Code</th>
                                    <th>Batch Time</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Education</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </thead>

                                <?php
                                $displayed_students = array(); // Array to track displayed students

                                $slot_get = isset($_GET['slot']) ? $_GET['slot'] : '';

                                if ($slot_get == 'tts') {
                                    $batch_slot = 'TTS';
                                } elseif ($slot_get == 'mwf') {
                                    $batch_slot = 'MWF';
                                } else {
                                    $batch_slot = '';
                                }
                                if ($batch_slot != '') {
                                    $batch_ids_result = mysqli_query($con, "SELECT `batch_id` FROM `batch` WHERE `batch_slot`='$batch_slot'");
                                } else {
                                    $batch_ids_result = mysqli_query($con, "SELECT * FROM `batch`");
                                }
                                while ($batch_row = mysqli_fetch_assoc($batch_ids_result)) {
                                    $new_batch_ids[] = $batch_row['batch_id'];
                                }

                                $show_batches = get_table_data('left_student', $con);
                                while ($row = mysqli_fetch_assoc($show_batches)) {
                                    $students_batch_ids = explode(',', $row['batch']);
                                    if (array_intersect($students_batch_ids, $new_batch_ids) && !in_array($row['sno'], $displayed_students)) {
                                        $displayed_students[] = $row['sno'];
                                ?>
                                        <tr>
                                            <td class='vertical-align-middle'></td>
                                            <td class='vertical-align-middle'><?php echo $row['student_name'] ?></td>
                                            <td class='vertical-align-middle'><?php echo $row['father_name'] ?></td>
                                            <td class='vertical-align-middle'><?php echo $row['student_contact'] ?></td>
                                            <td class='vertical-align-middle'>
                                                <?php
                                                foreach ($students_batch_ids as $batch_id) {
                                                    $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));
                                                    echo $batch_data['batch_name'] . '<br>';
                                                }
                                                ?></td>
                                            <td class='vertical-align-middle'>
                                                <?php
                                                foreach ($students_batch_ids as $batch_id) {
                                                    $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));
                                                    echo $batch_data['batch_code'] . '<br>';
                                                }
                                                ?>
                                            </td>
                                            <td class='vertical-align-middle'>
                                                <?php
                                                foreach ($students_batch_ids as $batch_id) {
                                                    $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));
                                                    echo  $batch_data['batch_slot'] . '<br>';
                                                }
                                                ?>
                                            </td>
                                            <td class='vertical-align-middle'>
                                                <?php
                                                foreach ($students_batch_ids as $batch_id) {
                                                    $batch_data = mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id));
                                                    echo  $batch_data['time'] . '<br>';
                                                }
                                                ?>
                                            </td>
                                            <td class='vertical-align-middle'><?php echo $row['date_of_birth'] ?></td>
                                            <td class='vertical-align-middle'><?php echo $row['gender'] ?></td>
                                            <td class='vertical-align-middle'><?php echo $row['qualification'] ?></td>
                                            <td class='vertical-align-middle'><?php echo $row['email'] ?></td>
                                            <td class='vertical-align-middle' style="white-space: break-spaces;"><?php echo $row['address'] ?></td>
                                            <td class='vertical-align-middle'><img src="../images/<?php echo $row['image'] ?>" class="img img-fluid"></td>
                                            <td class='vertical-align-middle'>
                                                <a href="student_details2.php?left_student_sno=<?php echo $row['sno']; ?>"><button class="btn btn-primary" style="margin-right:5px">Detail</button></a>
                                                <a class="btn btn-dark"  href="approve_left_student.php?leftStudent=<?php  echo $row['sno']; ?>">Enroll Again</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>

                        </div>
                    </div>
                </div>
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>