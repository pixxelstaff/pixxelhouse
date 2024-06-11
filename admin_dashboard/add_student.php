<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - (Add Student)</title>
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
                        <h3 class=" text-center text-light">Add Student</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card card-shadow-ph">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label for="student_name" class="form-label">Student Name<span class="text-danger">*</span></label>
                                            <input type="text" name="student_name" id="student_name" placeholder="Student Name" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="student_contact" class="form-label">Student Contact<span class="text-danger">*</span></label>
                                            <input type="number" name="student_contact" placeholder="student Contact" id="student_contact" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="student_email" class="form-label">Student Email<span class="text-danger">*</span></label>
                                            <input type="email" placeholder="student Email" min="1" name="student_email" id="student_email" class="form-control" required onkeydown="type_email()">
                                        </div>
                                    </div>



                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">

                                            <label for="Father_name" class="form-label">Father/Guardian Name<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Father Name" name="father_name" id="Father_name" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="Father_contact" class="form-label">Father/Guardian Contact<span class="text-danger">*</span></label>
                                            <input type="number" name="father_contact" placeholder="Father/Guardian Contact" id="Father_contact" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_email" class="form-label">Father/Guardian Email<span class="text-danger">*</span></label>
                                            <input type="email" placeholder="Father Email" min="1" name="father_email" id="father_email" class="form-control" required>
                                        </div>

                                    </div>
                                    
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">

                                            <label for="date_of_birth" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="course" class="form-label">Course<span class="text-danger">*</span></label>
                                           <select class="form-select" name="course" id="course" required>
                                                <option value="" selected disabled>Select Course</option>
                                                <?php
                                                $select_country = get_table_data('course', $con);
                                                while ($row = mysqli_fetch_assoc($select_country)) {
                                                ?>
                                                    <option value="<?php echo $row['Id'] ?>"><?php echo $row['course_name'] ?></option>

                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>

                                      <div class="col-md-4">
                                            <label for="batch" class="form-label">Batch<span class="text-danger">*</span></label>
                                            <select class="form-select" name="batch" id="batch" required>
                                                <option value="" selected disabled>Select Batch</option>
                                                <?php
                                                $select_country = get_table_data('batch', $con);
                                                while ($row = mysqli_fetch_assoc($select_country)) {
                                                ?>
                                                    <option value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch_name'] ?></option>

                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-4">
                                            <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                                            <select class="form-select" name="country" id="country" required>
                                                <option value="" selected disabled>Select Country</option>
                                                <?php
                                                $select_country = get_table_data('country', $con);
                                                while ($row = mysqli_fetch_assoc($select_country)) {
                                                ?>
                                                    <option value="<?php echo $row['country_sno'] ?>"><?php echo $row['country_name'] ?></option>

                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                                            <select class="form-select" name="city" id="city" required>
                                                <option value="" selected disabled>Select City</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="country_code" class="form-label">Country Code<span class="text-danger">*</span></label>
                                            <input type="text" placeholder="country Code" name="country_code" id="country_code" class="form-control" readonly>

                                        </div>

                                    </div>


                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">
                                            <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                                            <select class="form-select" name="gender" id="gender" required>
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Custom">Custom</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">

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

                                        <div class="col-md-4">
                                            <label for="emergency" class="form-label">Emergency Contact<span class="text-danger">*</span></label>
                                            <input type="text" name="emergency" placeholder="Emergency Contact" id="emergency" class="form-control">
                                        </div>

                                    </div>
                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-12">
                                            <label for="image" class="form-label">Student Image<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="image" id="image">
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

                                    $student_name = $_POST['student_name'];
                                    $father_name = $_POST['father_name'];
                                    $father_email = $_POST['father_email'];
                                    $father_contact = $_POST['father_contact'];
                                    $date_of_birth  = $_POST['date_of_birth'];
                                    $student_contact = $_POST['student_contact'];
                                    $emergency = $_POST['emergency'];
                                    $gender = $_POST['gender'];
                                    $address = $_POST['address'];
                                    $quli = $_POST['quli'];
                                    $course = $_POST['course'];
                                    $batch_id = $_POST['batch'];
                                    $country = $_POST['country'];
                                    $country_code = $_POST['country_code'];
                                    $city = $_POST['city'];
                                    $student_email  = $_POST['student_email'];
                                    $portal_email = $_POST['portal_email'];
                                    $user_input_password = $_POST['portal_password'];
                                    $portal_password = password_hash($user_input_password, PASSWORD_DEFAULT);
                                    // $fileimg = $_FILES['image']['name'];
                                    // $tmpname = $_FILES['image']['tmp_name'];
                                    // $path = "../images/" . $fileimg;
                                    // move_uploaded_file($path, $tmpname);
                                    $tody=date('d-m-Y');
                                    
                                    
                                     // Check if an image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $fileimg = $_FILES['image']['name'];
        $tmpname = $_FILES['image']['tmp_name'];
        $path = "../images/" . $fileimg;
        
        // Move the uploaded image to the destination folder
        if (move_uploaded_file($tmpname, $path)) {
                                    
                                    
                                    
                                    $select_student = get_table_data2('students', $con, 'email', $student_email);
                                    if (!mysqli_num_rows($select_student) > 0) {
                                        $insert_student = "INSERT INTO `students`(`student_name`, `father_name`, `father_email`, `home_contact`, `date_of_birth`, `student_contact`, `emergency_contact`, `gender`, `address`, `qualification`, `course`, `batch`, `country`, `country_code`, `city`, `email`, `portal_email`, `password`, `student_image`, `date`) 
                                                                          VALUES ('$student_name','$father_name','$father_email','$father_contact','$date_of_birth','$student_contact','$emergency','$gender','$address','$quli','$course','$batch_id','$country','$country_code','$city','$student_email','$portal_email','$portal_password','$fileimg','$tody')";
                                        $insert_student_qry = mysqli_query($con, $insert_student);
                                        if ($insert_student_qry) {
$to = $student_email;
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
      
<p>Dear $student_email,</p>
<p>We value your presence as a student at Institute of Pixxel House and are dedicated to ensuring the security and privacy of your account. Please find your login details below:</p>
<p>Email Address: $portal_email<br>
   Password: $user_input_password</p>
<p>These credentials are exclusive to you and are intended solely for accessing your student account. We urge you to keep them confidential.</p>
<p>**Important Security Information:**</p>
<ol>
<li>Do not share your email and password with anyone, including fellow students.</li>
<li>If you didn't sign up for Institute of Pixxel House, please disregard this email and contact us immediately at pixxel.staff@gmail.com .</li>
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
                               
                                ?>
                                            <script>
                                                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Student Added Successfully!' ?>&location=<?php echo 'add_student.php' ?>";
                                            </script>
                                        <?php
                                        } else {
                                        ?>
                                            <script>
                                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'add_student.php' ?>";
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        if(!empty($batch_id)){
                                        $check_student = get_table_data2('students', $con, 'email', $student_email);

                                        $batch_ids = mysqli_fetch_assoc($check_student)['batch'];


                                        $array_batch = explode(',', $batch_ids);

                                        if (!in_array($batch_id, $array_batch)) {
                                            $array_batch[] = $batch_id;
                                            $batch_ids = implode(',', $array_batch);

                                            $update_query = "UPDATE `students` SET `batch` = '$batch_ids' WHERE email = '$student_email'";
                                            $new_result = mysqli_query($con, $update_query);
                                            if ($new_result) {
                                            ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Student Added Successfully!' ?>&location=<?php echo 'add_student.php' ?>";
                                                </script>
                                            <?php
                                            } else {
                                            ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo 'add_student.php' ?>";
                                                </script>
                                <?php
                                            }
                                        } else {
                                            $error_message = 'This Student Already In This Batch!';
                                        }
                                        }else{
                                             ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Please Select Batch!' ?>&location=<?php echo 'add_student.php' ?>";
                                                </script>
                                            <?php
                                        }
                                        
                                        
                                        
                                    }
                                    
                                } else{
                                             ?>
                                                <script>
                                                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Image Not Uploaded!' ?>&location=<?php echo 'add_student.php' ?>";
                                                </script>
                                            <?php
                                        }
    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        $(document).ready(function() {
            // When the country selection changes
            $("#country").on("change", function() {
                var country_id = $(this).val();
                console.log(country_id);
                // Clear previous options in city and years selects
                $("#city").empty().append("<option value=''>Select City</option>");
                $("#yearsSelect").empty();

                if (country_id !== "") {
                    $.ajax({
                        type: "POST",
                        url: "ajax/country.php", // Your PHP file URL
                        data: {
                            country_id: country_id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.cities && data.cities.length > 0) {
                                $.each(data.cities, function(index, city) {
                                    $("#city").append("<option value='" + city + "'>" + city + "</option>");
                                });
                            }

                            if (data.country_code) {
                                // Assuming you have a field with ID 'countryCode' to display country code
                                $("#country_code").val(data.country_code);
                                console.log(data.country_code)
                            }
                        },
                        error: function() {
                            console.log("Error fetching data.");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>