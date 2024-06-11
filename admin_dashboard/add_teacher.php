<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Add Teachers)</title>
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
                        <h3 class=" text-center text-light">Add New Teacher</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label for="teacher_name" class="form-label">Teacher Name<span class="text-danger">*</span></label>
                                            <input type="text" name="teacher_name" id="teacher_name" placeholder="Teacher Name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="teacher_email" class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" placeholder="Teacher Email" min="1" name="teacher_email" id="teacher_email" class="form-control" required onkeydown="type_email()">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-6">
                                            <label for="teacher_contact" class="form-label">Teacher Contact<span class="text-danger">*</span></label>
                                            <input type="number" name="teacher_contact" placeholder="Teacher Contact" id="teacher_contact" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cnic" class="form-label">CNIC<span class="text-danger">*</span></label>
                                            <input type="text" name="cnic" placeholder="Course Duration" id="cnic" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                                            <select class="form-select" name="gender" id="gender">
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">

                                            <label for="quli" class="form-label">Qualification<span class="text-danger">*</span></label>
                                            <select class="form-select" name="quli" id="quli">
                                                <option value="" selected disabled>Select Qualification</option>
                                                <option value="Metric (10th)">Metric (10th) </option>
                                                <option value="Enter (12th)">Enter (12th)</option>
                                                <option value="Graduation (14 years)">Graduation (14 years)</option>
                                                <option value="Graduation (16 years)">Graduation (16 years)</option>
                                                <option value="Masters">Masters</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exper" class="form-label">Experience<span class="text-danger">*</span></label>
                                            <input type="text" name="exper" placeholder="Experience" id="exper" class="form-control">
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                            <textarea name="address" id="address" rows="2" class="form-control" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <h5 class="text-primary">Portal Detail</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="portal_email" class="form-label">Portal Email<span class="text-danger">*</span></label>
                                            <input type="email" name="portal_email" placeholder="Portal Email" id="portal_email" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="portal_password" class="form-label">Portal Password<span class="text-danger">*</span></label>
                                            <div class="password-container">
                                                <input type="password" name="portal_password" placeholder="Portal Password" id="portal_password" class="form-control">
                                                <button id="toggleButton" class="eye-icon">
                                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                                </button>
                                            </div>
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
        $teacher_name = $_POST['teacher_name'];
        $teacher_email = $_POST['teacher_email'];
        $teacher_contact = $_POST['teacher_contact'];
        $gender = $_POST['gender'];
        $cnic = $_POST['cnic'];
        $quli = $_POST['quli'];
        $exper = $_POST['exper'];
        $address = $_POST['address'];
        $portal_email = $_POST['portal_email'];
        $user_input_password = $_POST['portal_password'];
        $portal_password = password_hash($user_input_password, PASSWORD_DEFAULT);
        
        // Check if an image was uploaded
        if (!empty($_FILES['image']['name'])) {
            $fileimg = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];
            $path = "../images/" . $fileimg;
            
            // Move the uploaded image to the destination folder
            if (move_uploaded_file($tmpname, $path)) {
                // Image successfully uploaded, proceed to insert into database
                $insert_teacher = "INSERT INTO `teacher`(`teacher_name`, `teacher_email`, `teacher_contact`, `gender`, `cnic`, `quli`, `exper`, `address`, `portal_email`, `portal_password`, `teacher_image`)
                                                 VALUES ('$teacher_name','$teacher_email','$teacher_contact','$gender','$cnic','$quli','$exper','$address','$portal_email','$portal_password','$fileimg')";
                $insert_teacher_qry = mysqli_query($con, $insert_teacher);
                                        if ($insert_teacher_qry) {
                                            
                                            $to = $portal_email;
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
      
<p>Dear $portal_email,</p>
<p>We value your presence as a Teacher at Institute of Pixxel House and are dedicated to ensuring the security and privacy of your account. Please find your login details below:</p>
<p>Email Address: $portal_email<br>
   Password: $user_input_password</p>
<p>These credentials are exclusive to you and are intended solely for accessing your teacher account. We urge you to keep them confidential.</p>
<p>**Important Security Information:**</p>
<ol>
<li>Do not share your email and password with anyone, including fellows.</li>
<li>If you didn't sign up for Institute of Pixxel House, please disregard this email and contact us immediately at pixxel.staff@gmail.com .</li>
</ol>
<p>**Login Instructions:**</p>
<ol>
<li>Visit our website at pixxel.prepwings.com/teacher_dashboard.</li>
<li>Type Your Email and Password'</li>
<li>Click on 'Login.'</li>
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
                                ?>
                                            <script>
                                                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Teacher Added Successfully!' ?>&location=<?php echo 'add_teacher.php' ?>";
                                            </script>
                                        <?php
                                        } else {
                                        ?>
                                            <script>
                                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'add_teacher.php' ?>";
                                            </script>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Image Not Uploaded!' ?>&location=<?php echo 'add_teacher.php' ?>";
                                        </script>
                                <?php
                                    }
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