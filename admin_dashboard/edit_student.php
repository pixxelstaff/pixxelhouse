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
                                include('query/select_qry.php');
                                ?>
                                <form method="post">
                                    <div class="row align-items-center">

                                        <div class="col-md-4">
                                            <label for="student_name" class="form-label">Students Name</label>
                                            <input type="text" name="student_name" id="student_name" placeholder="student Name" value="<?php echo $student_name; ?>" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email" class="form-label">Student Email</label>
                                            <input type="text" value="<?php echo $email; ?>" placeholder="Email" name="email" id="email" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="personal_contact" class="form-label">Personal Contact</label>
                                            <input type="text" value="<?php echo $student_contact; ?>" name="personal_contact" placeholder="Personal Contact" id="personal_contact" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-4">
                                            <label for="father_name" class="form-label">Father Name</label>
                                            <input type="text" value="<?php echo $father_name; ?>" placeholder="Father Name" name="father_name" id="father_name" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_contact" class="form-label">Father Contact</label>
                                            <input type="text" value="<?php echo $home_contact; ?>" name="father_contact" placeholder="Father Contact" id="father_contact" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_email" class="form-label">Father Email</label>
                                            <input type="text" value="<?php echo $father_email; ?>" name="father_email" placeholder="Father Email" id="father_email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">

                                            <label for="birth_date" class="form-label">Date Of Birth</label>
                                            <input type="date" value="<?php echo $date_of_birth; ?>" name="birth_date" id="birth_date" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                                            <input type="text" value="<?php echo $emergency_contact; ?>" name="emergency_contact" id="emergency_contact" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="gender">
                                                <option selected><?php echo $gender ?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-6">
                                            <label for="quli" class="form-label">Qualification</label>
                                            <input type="text" value="<?php echo $quli; ?>" name="quli" id="quli" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea name="address" id="address" rows="1" class="form-control"><?php echo $address ?></textarea>
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-6">
                                            <label for="fee-batch" class="form-label">Select Fee batch</label>
                                            <select class="form-select" name="feeBatch" id="fee-batch">
                                                <option selected>select batch</option>
                                                <option value="Male">Dum-100</option>
                                                <option value="Female">we 136</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fee" class="form-label">Fees</label>
                                            <input type="text" value="5900" name="feeamount" id="fee" class="form-control">
                                        </div>

                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="update_btn" value="Update" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
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
                                <img src="../images/<?php echo $student_image ?>" class="img img-fluid">
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    if (isset($_POST['update_btn'])) {
                        $student_name = $_POST['student_name'];
                        $email = $_POST['email'];
                        $personal_contact = $_POST['personal_contact'];
                        $father_name = $_POST['father_name'];
                        $father_contact = $_POST['father_contact'];
                        $father_email = $_POST['father_email'];
                        $birth_date = $_POST['birth_date'];
                        $emergency_contact = $_POST['emergency_contact'];
                        $gender = $_POST['gender'];
                        $quli = $_POST['quli'];
                        $address = $_POST['address'];

                        $update_student_detail = "UPDATE `students` SET `student_name`='$student_name',`father_name`='$father_name',`father_email`='$father_email',`home_contact`='$father_contact',`date_of_birth`='$birth_date',`student_contact`='$personal_contact',`emergency_contact`='$emergency_contact',`gender`='$gender',`address`='$address',`qualification`='$quli',`email`='$email' WHERE `sno`='$get_student_sno'";
                        $update_student_detail_qry = mysqli_query($con, $update_student_detail);
                        if ($update_student_detail_qry) {


                    ?>
                            <script>
                                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Details Updated Success!' ?>&location=<?php echo 'students.php' ?>";
                            </script>
                        <?php
                        } else {
                        ?>
                            <script>
                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'students.php' ?>";
                            </script>
                    <?php
                        }
                    }
                    ?>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

</body>

</html>