<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
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
                        <h3 class=" text-center text-light">Edit Student Details</h3>
                    </div>
                </div>

                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-md-9" id="first_coloumn">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <?php
                                $get_student_sno = $_GET['student_sno'];
                                $student_detail = get_table_data2('pending_students', $con, 'sno', $get_student_sno);
                                while ($row = mysqli_fetch_assoc($student_detail)) {
                                    $student_name = $row['student_name'];
                                    $student_email = $row['email'];
                                    $father_name = $row['father_name'];
                                    $father_email = $row['father_email'];
                                    $student_contact = $row['student_contact'];
                                    $course_id = $row['course'];
                                    $father_contact = $row['home_contact'];
                                    $emergency_contact = $row['emergency_contact'];
                                    $quli = $row['qualification'];
                                    $date_of_birth = $row['date_of_birth'];
                                    $gender = $row['gender'];
                                    $slot = $row['days'];
                                    $time = $row['time'];
                                    $address = $row['address'];
                                    $image = $row['image'];
                                }
                                $get_course_name = get_table_data2('course', $con, 'Id', $course_id);
                                $course = mysqli_fetch_assoc($get_course_name)['course_name'];
                                ?>
                                    <div class="row align-items-center">

                                        <div class="col-md-4">
                                            <label for="student_name" class="form-label">Students Name</label>
                                            <input type="text" name="student_name" id="student_name" placeholder="student Name" value="<?php echo $student_name; ?>" class="form-control" disabled>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Personal Contact</label>
                                            <input type="text" value="<?php echo $student_contact; ?>" placeholder="Personal Contact" class="form-control" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Student Email</label>
                                            <input type="text" value="<?php echo $student_email; ?>"  placeholder="Student Email" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-4">
                                            <label for="father_name" class="form-label">Father Name</label>
                                            <input type="text" value="<?php echo $father_name; ?>" placeholder="Father Name" name="father_name" id="father_name" class="form-control" disabled>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_contact" class="form-label">Father Contact</label>
                                            <input type="text" value="<?php echo $father_contact; ?>" name="father_contact" placeholder="Father Contact" id="father_contact" class="form-control" disabled>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_email" class="form-label">Father Email</label>
                                            <input type="text" value="<?php echo $father_email; ?>" placeholder="Father Email" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">

                                            <label for="birth_date" class="form-label">Date Of Birth</label>
                                            <input type="date" value="<?php echo $date_of_birth; ?>" disabled class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                                            <input type="text" value="<?php echo $emergency_contact; ?>" class="form-control" disabled>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Gender</label>
                                            <input type="text" value="<?php echo $gender; ?>" class="form-control" disabled>
                                        </div>

                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Qualification</label>
                                            <input type="text" value="<?php echo $quli; ?>" disabled class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Selected Course</label>
                                            <input type="text" value="<?php echo $course; ?>" disabled class="form-control">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Days Slot</label>
                                            <input type="text" value="<?php echo $slot; ?>" disabled class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Selected Time</label>
                                            <input type="text" value="<?php echo $time; ?>" disabled class="form-control">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" rows="2" class="form-control" disabled><?php echo $address ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class='row'>
                                                <div class='col-md-6'>
                                                    <input type="button" onclick="history.back();" name="update_btn" value="Back" class="btn btn-primary form-control">
                                                </div>
                                                <div class='col-md-6'>
                                                    <a href='approve_student.php?student_sno=<?php echo $get_student_sno ?>&student_email<?php echo $student_email ?>'>
                                                    <input type="button" value="Approve" class="btn btn-primary form-control">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 " id="second_coloumn">
                        <div class="card card-shadow-ph">
                            <div class="card-header text-bg-primary text-center">
                                <h5 class="text-bg-primary">Profile Image</h5>
                            </div>
                            <div class="card-body text-center">
                                <img src="../images/<?php echo $image ?>" class="img img-fluid">
                            </div>
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