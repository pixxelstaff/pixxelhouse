<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Approve Student)</title>
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
                        <h3 class=" text-center text-light">Approve Student</h3>
                    </div>
                </div>
                <?php
                $get_student_sno = $_GET['student_sno'];
                $student_detail = get_table_data2('pending_students', $con, 'sno', $get_student_sno);

                if ($row = mysqli_fetch_assoc($student_detail)) {
                    $student_name = $row['student_name'];
                    $father_name = $row['father_name'];
                    $father_email = $row['father_email'];
                    $father_contact = $row['home_contact'];
                    $date_of_birth = $row['date_of_birth'];
                    $student_contact = $row['student_contact'];
                    $emergency_contact = $row['emergency_contact'];
                    $gender = $row['gender'];
                    $country = $row['country'];
                    $city = $row['city'];
                    $country_code = $row['country_code'];
                    $address = $row['address'];
                    $qualification = $row['qualification'];
                    $email = $row['email'];
                    $image = $row['image'];
                    $get_course_id = $row['course'];

                    $get_course_name = get_table_data2('course', $con, 'Id', $get_course_id);
                    $course_name = mysqli_fetch_assoc($get_course_name)['course_name'];

                    $student_check = get_table_data2('students', $con, 'email', $email);

                    if (mysqli_num_rows($student_check) > 0) {
                        $batch_ids = explode(',', mysqli_fetch_assoc($student_check)['batch']);
                        $batch_names = array_map(function ($batch_id) use ($con) {
                            return mysqli_fetch_assoc(get_table_data2('batch', $con, 'batch_id', $batch_id))['batch_name'];
                        }, $batch_ids);

                        $batch_names_string = implode(', ', $batch_names);
                ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card bg-danger text-center">
                                    <div class="card-body">
                                        <h4 class="text-bg-danger">Note: This Student Already Have In Batch: <span>(<?php echo $batch_names_string; ?>)</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>


                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-md-6">
                        <div class="card card-shadow-ph">
                            <div class="card-header text-center bg-primary">
                                <h4 class="text-bg-primary">Student Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">

                                    <div class="col-md-6">
                                        <label class="form-label">Students Name</label>
                                        <input type="text" placeholder="student Name" value="<?php echo $student_name; ?>" class="form-control" disabled>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Father Name</label>
                                        <input type="text" value="<?php echo $father_name; ?>" placeholder="Father Name" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Student Email</label>
                                        <input type="text" value="<?php echo $email; ?>" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="father_email" class="form-label">Father Email</label>
                                        <input type="text" value="<?php echo $father_email; ?>" placeholder="Father Email" class="form-control" disabled>
                                    </div>

                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Personal Contact</label>
                                        <input type="text" value="<?php echo $student_contact; ?>" placeholder="Personal Contact" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Father Contact</label>
                                        <input type="text" value="<?php echo $father_contact; ?>" placeholder="Father Contact" class="form-control" disabled>
                                    </div>

                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Selected Course</label>
                                        <input type="text" value="<?php echo $course_name; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                                
                                <div class="row align-items-center mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Address</label>
                                        <textarea disabled id="address" rows="2" class="form-control"><?php echo $address ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-shadow-ph">
                            <div class="card-header text-center bg-primary">
                                <h4 class="text-bg-primary">Batch Enrollment</h4>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <label for="assign_batch" class="form-label">Assign Batch<span class="text-danger">*</span></label>
                                            <select name="batch_id" id="assign_batch" class="form-select">
                                                <option value="">Select Batch</option>
                                                <?php
                                                $select_batch = get_table_data('batch', $con);
                                                while ($row = mysqli_fetch_assoc($select_batch)) {
                                                ?>
                                                    <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="assign_batch" class="form-label">Assign Fees<span class="text-danger">*</span></label>
                                           <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <?php
                                    if (!mysqli_num_rows($student_check) > 0) {
                                    ?>
                                        <div class="row align-items-center mt-5">
                                            <h4 class="text-primary">Student Portal </h4>
                                        </div>
                                        <div class="row align-items-center mt-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Portal Email<span class="text-danger">*</span></label>
                                                <input type="email" name="portal_email" placeholder="Email" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="portal_password" class="form-label">Portal Password <span class="text-danger">*</span></label>
                                                <div class="password-container">
                                                    <input type="password" name="portal_password" placeholder="Portal Password" id="portal_password" class="form-control">
                                                    <button id="toggleButton" class="eye-icon">
                                                        <i id="eyeIcon" class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row mt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="approve_btn" value="Approve" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['approve_btn'])) {
                        $portal_email_new = $_POST['portal_email'];
                        $user_input_password = $_POST['portal_password'];
                        $password = password_hash($user_input_password, PASSWORD_DEFAULT);
                        $date = date("d-m-y");
                        $batch_id = $_POST['batch_id'];

                        $check_student = get_table_data2('students', $con, 'email', $email);

                        if (!mysqli_num_rows($check_student) > 0) {
                            if ($batch_id != '') {
                                $insert_student = "INSERT INTO `students`(`student_name`, `father_name`, `father_email`, `home_contact`, `date_of_birth`, `student_contact`, `emergency_contact`, `gender`, `address`, `qualification`, `course`,`batch` ,`country`,`city`,`country_code`,`email` ,`portal_email`, `password`, `student_image`, `date`) 
                                                                   VALUES('$student_name','$father_name','$father_email','$father_contact','$date_of_birth','$student_contact','$emergency_contact','$gender','$address', '$qualification', '$get_course_id','$batch_id','$country','$city','$country_code','$email', '$portal_email_new', '$password','$image','$date')";
                                $insert_student_qry = mysqli_query($con, $insert_student);

                                if ($insert_student_qry) {

                            $sel_data = "SELECT `sno`, `batch` FROM `students` WHERE `portal_email` = '$email'";
                            $result=mysqli_query($con,$sel_data);

                            if ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['sno'];
                                $batch = $row['batch'];

                                // Step 2: Fetch attendance records for the batch
                                $sel_attendance = "SELECT * FROM `attandance` WHERE `batch_name` = '$batch'";
                                $result2= mysqli_query($con,$sel_attendance);

                                if (!$result2) {
                                    die("Error: " . mysqli_error($con)); // Handle query execution error
                                }

                                while ($attData = mysqli_fetch_assoc($result2)) {
                                    $att_id = $attData['attendance_id'];
                                    $std_ids = explode(',', $attData['student_ids']);
                                    $std_attendance = explode(',', $attData['attendance_status']);
                                    $std_assign_fullfil = explode(',', $attData['assigments_done']);
                                    if (!in_array($id, $std_ids)) {
                                        $std_ids[] = $id;
                                        $std_attendance[] = 'S';
                                        $std_assign_fullfil[] = '3';
                                        print_r($std_attendance);
                                        $update_ids = implode(',', $std_ids);
                                        $update_attendance = implode(',', $std_attendance);
                                        $update_assign_fullfil = implode(',', $std_assign_fullfil);

                                        // Step 3: Update the attendance record
                                        $update_data = mysqli_query($con, "UPDATE `attandance` SET `student_ids` = '$update_ids',`attendance_status` = '$update_attendance',`assigments_done` = '$update_assign_fullfil' WHERE `attendance_id` = '$att_id'");
                                    }
                                }
                            }
                                    $delete_qry = "DELETE FROM `pending_students` WHERE `sno`='$get_student_sno'";
                                    $delete_qry_res = mysqli_query($con, $delete_qry);
                                    
                                        $to = $portal_email_new;
                                        $subject = "Your Portal Created!";
                                        $host_email = 'pixxel@prepwings.com';
                                        $head = "From: $host_email" . "\r\n";
                                        $head .= "Reply-To: $host_email" . "\r\n";
                                        $head .= implode("\r\n", [
                                            "MIME-Version: 1.0",
                                            "Content-type: text/html; charset=utf-8"
                                        ]);
                                        ob_start();
                                        $html = "<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <style type='text/css'>
      /* CSS styles go here */
      body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
        color: #333333;
        margin: 0;
        padding: 0;
      }
      .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
      }
      h1 {
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
      }
      p {
        margin-bottom: 20px;
      }
      .button {
        display: inline-block;
        background-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
      }
      .button:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <div class='container'>
    <img src='http://pixxel.prepwings.com/images/logo-black2.png' width='100%'>
      
<p>Dear $portal_email_new,</p>
<p>We value your presence as a student at Institute of Pixxel House and are dedicated to ensuring the security and privacy of your account. Please find your login details below:</p>
<p>Email Address: $portal_email_new<br>
   Password: $user_input_password</p>
<p>These credentials are exclusive to you and are intended solely for accessing your student account. We urge you to keep them confidential.</p>
<p>**Important Security Information:**</p>
<ol>
<li>Do not share your email and password with anyone, including fellow students.</li>
<li>If you didn't sign up for Institute of Pixxel House, please disregard this email and contact us immediately at [Insert Contact Information].</li>
</ol>
<p>**Login Instructions:**</p>
<ol>
<li>Visit our website at pixxel.prepwings.com/student_dashboard.</li>
<li>Click on 'Student Login.'</li>
<li>Upon login,you can't change your password to enhance security.</li>
</ol>
<p>Note that this email and password will not be sent again. If you miss the specified time frame, request a new password.</p>
<p>Thank you for choosing Institute of Pixxel House. Your education is our priority. Feel free to contact us if you have questions.</p>
<p>Best regards,<br>
Team Pixxel House<br>
Institute of Pixxel House<br>
    </div>
  </body>
</html>

";

                                        ob_end_clean();
                                        $mailresult = mail($to, $subject, $html, $head);

                                    
                                    $success_message = 'Student Approved!';
                                } else {
                                    $error_message = 'Something Went Wrong!';
                                }
                            } else {
                                $error_message = 'Something Went Wrong!';
                            }
                        } else {
                            while ($row2 = mysqli_fetch_assoc($check_student)) {
                                $batch_ids = $row2['batch'];
                            }

                            $array_batch = explode(',', $batch_ids);

                            if (!in_array($batch_id, $array_batch)) {
                                $array_batch[] = $batch_id;
                                $batch_ids = implode(',', $array_batch);

                                $update_query = "UPDATE `students` SET `batch` = '$batch_ids' WHERE email = '$email'";
                                $new_result = mysqli_query($con, $update_query);

                                if ($new_result) {



                                    $sel_data = "SELECT `sno`, `batch` FROM `students` WHERE `portal_email` = '$email'";
                                  
                                    $result = mysqli_query($con,$sel_data);
        
                                    if (!$result) {
                                        die("Error: " . mysqli_error($con)); // Handle query execution error
                                    }
        
                                    if ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['sno'];
                                        $batch = $row['batch'];
        
                                        // Step 2: Fetch attendance records for the batch
                                        $sel_attendance = "SELECT * FROM `attandance` WHERE `batch_name` = '$batch'";
                                        
                                        $result2 = mysqli_query($con,$sel_attendance);
        
                                        if (!$result2) {
                                            die("Error: " . mysqli_error($con)); // Handle query execution error
                                        }
        
                                        while ($attData = mysqli_fetch_assoc($result2)) {
                                            $att_id = $attData['attendance_id'];
                                            $std_ids = explode(',', $attData['student_ids']);
                                            $std_attendance = explode(',', $attData['attendance_status']);
                                            $std_assign_fullfil = explode(',', $attData['assigments_done']);
                                            if (!in_array($id, $std_ids)) {
                                                $std_ids[] = $id;
                                                $std_attendance[] = 'S';
                                                $std_assign_fullfil[] = '3';
                                                print_r($std_attendance);
                                                $update_ids = implode(',', $std_ids);
                                                $update_attendance = implode(',', $std_attendance);
                                                $update_assign_fullfil = implode(',', $std_assign_fullfil);
        
                                                // Step 3: Update the attendance record
                                                $update_data = mysqli_query($con, "UPDATE `attandance` SET `student_ids` = '$update_ids',`attendance_status` = '$update_attendance',`assigments_done` = '$update_assign_fullfil' WHERE `attendance_id` = '$att_id'");
                                            }
                                        }
                                    }






                                    $delete_qry = "DELETE FROM `pending_students` WHERE `sno`='$get_student_sno'";
                                    $delete_qry_res = mysqli_query($con, $delete_qry);
                                    $success_message = 'Student Approved!';
                                } else {
                                    $error_message = 'Something Went Wrong!';
                                }
                            } else {
                                $error_message = 'This Student Already In This Batch!';
                            }
                        }

                        if (isset($success_message)) {
                            $location = 'pending_student.php';
                    ?>
                            <script>
                                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo $success_message ?>&location=<?php echo $location ?>";
                            </script>
                        <?php
                        } elseif (isset($error_message)) {
                            $location = 'pending_student.php';
                        ?>
                            <script>
                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo $error_message ?>&location=<?php echo $location ?>";
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