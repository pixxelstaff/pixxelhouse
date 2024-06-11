<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Edit Teacher Portal)</title>
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
                <div class="card bg-primary card-bottom-ph">
                    <div class="card-body">
                        <h3 class=" text-center text-light">Edit Teacher Portal</h3>
                    </div>
                </div>
                <div class="row mt-4">
                    <a href="student_portal.php">
                        <input type="button" value="Back" class="btn btn-primary"></a>
                </div>
                <div class="row mt-4">

                    <div class="col-md-6">
                        <div class="card card-shadow-ph">
                            <div class="card-header text-center bg-primary">
                                <h4 class="text-bg-primary">Teacher Details</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $get_teacher_sno = $_GET['teacher_sno'];
                                $get_student_detail = get_table_data2('teacher', $con, 'teacher_id', $get_teacher_sno);
                                while ($fetch = mysqli_fetch_assoc($get_student_detail)) {
                                    $teacher_name = $fetch['teacher_name'];
                                    $cnic = $fetch['cnic'];
                                    $gender = $fetch['gender'];
                                    $teacher_email = $fetch['teacher_email'];
                                    $teacher_contact = $fetch['teacher_contact'];
                                    $quli = $fetch['quli'];
                                    $portal_email = $fetch['portal_email'];
                                    // $portal_password = $fetch['portal_password'];
                                    $address = $fetch['address'];
                                    $image = $fetch['teacher_image'];
                                }
                                ?>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Teacher Name</label>
                                        <input type="text" disabled placeholder="Teacher Name" class="form-control" value="<?php echo $teacher_name ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">CNIC</label>
                                        <input type="text" disabled placeholder="CNIC" class="form-control" value="<?php echo $cnic ?>">
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Teacher Contact</label>
                                        <input type="text" disabled placeholder="Teacher Contact" class="form-control" value="<?php echo $teacher_contact ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Education</label>
                                        <input type="text" disabled placeholder="Education" class="form-control" value="<?php echo $quli ?>">
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Teacher Email</label>
                                        <input type="text" disabled placeholder="Teacher Email" class="form-control" value="<?php echo $teacher_email ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>
                                        <input type="text" disabled placeholder="Gender" class="form-control" value="<?php echo $gender ?>">
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Address</label>
                                        <textarea rows="2" disabled placeholder="Address" class="form-control"><?php echo $address ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-shadow-ph">
                            <div class="card-header text-center bg-primary">
                                <h4 class="text-bg-primary">Edit Portal Details</h4>
                            </div>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="portal_email" class="form-label">Portal Email<span class="text-danger">*</span></label>
                                            <input type="email" name="portal_email" placeholder="Portal Email" id="portal_email" class="form-control" value="<?php echo $portal_email ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="portal_password" class="form-label">Portal Password <span class="text-danger">*</span></label>
                                            <div class="password-container">
                                                <input type="password" name="portal_password" placeholder="Portal Password" id="portal_password" class="form-control" required>
                                                <button id="toggleButton" class="eye-icon">
                                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4 pt-4">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <input type="submit" name="add_btn" value="Update" class="btn btn-primary form-control">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['add_btn'])) {

                                $portal_email = $_POST['portal_email'];
                                $user_input_password = $_POST['portal_password'];
                                $password = password_hash($user_input_password, PASSWORD_BCRYPT);
                                $update_teacher = "UPDATE `teacher` SET `portal_email`='$portal_email',`portal_password`='$password' WHERE `teacher_id`='$get_teacher_sno'";
                                $update_teacher_qry = mysqli_query($con, $update_teacher);
                                if ($update_teacher_qry) {
                                    $to = $portal_email;
                                    $subject = "Your Portal Password Reset!";
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
<p>We value your presence as a Teacher at Institute of Pixxel House and are dedicated to ensuring the password of your account are reset. Please find your login details below:</p>
<h4>Email Address: $portal_email</h4><br>
<h4>New Password: $user_input_password</h4>
<p>These credentials are exclusive to you and are intended solely for accessing your teacher account. We urge you to keep them confidential.</p>

<p>Institute of Pixxel House. Your teaching experience is our priority. Feel free to contact us if you have questions.</p>
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
                                        window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Portal Detail Updated Successfully!' ?>&location=<?php echo 'teacher_portal.php' ?>";
                                    </script>
                                <?php
                                } else {
                                ?>
                                    <script>
                                        window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'teacher_portal.php' ?>";
                                    </script>
                            <?php
                                }
                            }
                            ?>
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