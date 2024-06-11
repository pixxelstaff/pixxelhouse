<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('../connect.php'); // Include your database connection code here
include('../student_dashboard/include/function.php'); // to get sanitize function
if (isset($_POST['iph_course_form'])) {
    // Sanitize and validate user inputs
    $std_name = mine_sanitize_string($_POST['student_name']);
    $std_father_name = mine_sanitize_string($_POST['father_name']);
    $std_email = sanitizeEmail($_POST['std_email']);
    $std_father_email = sanitizeEmail($_POST['std_father_email']);
    $std_father_contact = mine_sanitize_string($_POST['std_father_contact']);
    $birth_date = mine_sanitize_string($_POST['form_date']);
    $country = mine_sanitize_string($_POST['country']);
    $city = mine_sanitize_string($_POST['city']);
    $country_code = mine_sanitize_string($_POST['country_code']);
    $std_num = mine_sanitize_string($_POST['std_num']);
    $std_emergency_contact = mine_sanitize_string($_POST['emergency_num']);
    $std_gender = mine_sanitize_string($_POST['std_gender']);
    $std_address = mine_sanitize_string($_POST['std_address']);
    $std_qualification = mine_sanitize_string($_POST['std_qualification']);
    $std_wanted_course = mine_sanitize_string($_POST['std_wanted_course']);
    $std_wanted_day_slot = mine_sanitize_string($_POST['std_wanted_day_slot']);
    $time = mine_sanitize_string($_POST['time']);
    $std_apply_admission = mine_sanitize_string($_POST['std_apply_admission']);
    $std_parent_permission = mine_sanitize_string($_POST['std_parent_permission']);
    $std_admission_policy = mine_sanitize_string($_POST['std_admission_policy']);
    $std_profile_img_name = $_FILES['std_profile_img']['name'];
    $std_profile_img_tmp_name = $_FILES['std_profile_img']['tmp_name'];
    $std_profile_img_path = "../images/" . $std_profile_img_name;
    // $std_path_for_dash = $std_profile_img_name;
    $file_size = $_FILES['std_profile_img']['size'];
    $file_type = $_FILES['std_profile_img']['type'];
    $form_submitting_date = date('j F Y');


    // Perform validations
    $errors = [];

    if (
        empty($std_name) &&
        empty($std_father_name) &&
        empty($std_father_email) &&
        empty($std_father_contact) &&
        empty($birth_date) &&
        empty($std_num) &&
        empty($std_emergency_contact) &&
        empty($std_gender) &&
        empty($std_address) &&
        empty($std_qualification) &&
        empty($std_other_num) &&
        empty($std_wanted_course) &&
        empty($std_wanted_day_slot) &&
        empty($time) &&
        empty($std_admission_policy) &&
        empty($std_profile_img_name)
    ) {
        $errors[] = "Please provide complete information.";
    }

    if (empty($errors)) {
        // File upload validation
        $maxFileSize = 5242880; // 5 MB in bytes
        $allowedFileTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if ($file_size > $maxFileSize) {
            $errors[] = "File size must be within 5 MB.";
        } elseif (!in_array($file_type, $allowedFileTypes)) {
            $errors[] = "Inappropriate file type.";
        }

        if (empty($errors)) {
            // Handle file upload
            if (move_uploaded_file($std_profile_img_tmp_name, $std_profile_img_path)) {
                $app_students = "SELECT * FROM `students` WHERE `email` = ? OR `student_contact` = ?";
                $app_student_stmt = mysqli_prepare($con, $app_students);

                mysqli_stmt_bind_param($app_student_stmt, 'ss', $std_email, $std_num);
                mysqli_stmt_execute($app_student_stmt);
                $app_std_data_query = mysqli_stmt_get_result($app_student_stmt);

                if (!mysqli_num_rows($app_std_data_query) > 0) {
                    // Query to check if data exists
                     $pending_data = "SELECT * FROM `pending_students` WHERE `email` = ?  OR `student_contact` = ?";

                    $stmt = mysqli_prepare($con, $pending_data);

                    mysqli_stmt_bind_param($stmt, 'ss', $std_email, $std_num);
                    mysqli_stmt_execute($stmt);
                    $pending_std_data_query = mysqli_stmt_get_result($stmt);
                    if (!mysqli_num_rows($pending_std_data_query) > 0) {
                        // Insert data
                        $insert_data = "INSERT INTO `pending_students`(`student_name`, `father_name`,`email`, `father_email`, `home_contact`, `date_of_birth`, `student_contact`, `emergency_contact`, `gender`, `address`, `qualification`,`country`,`city`,`country_code`,`course`,`days`, `time`, `image`, `date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt2 = mysqli_prepare($con, $insert_data);
                        mysqli_stmt_bind_param($stmt2, "sssssssssssssssssss", $std_name, $std_father_name, $std_email, $std_father_email, $std_father_contact, $birth_date, $std_num, $std_emergency_contact, $std_gender, $std_address, $std_qualification, $country, $city, $country_code, $std_wanted_course, $std_wanted_day_slot, $time, $std_profile_img_name, $form_submitting_date);
                        $insert_data_query = mysqli_stmt_execute($stmt2);

                        if ($insert_data_query) {
                            
                            
                      
                      
                        $to = $std_email;
                                        $subject = "Admission Form Submission Confirmation!";
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
      
<p>Dear Student $std_email,</p>
<p>Thank you for submitting your admission form on our website. We have received your application and will process it accordingly.</p>
<p>If you have any questions or need further assistance, please feel free to contact Us and also Visit Institute of Pixxel House.</p>
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
                                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Form Submitted Check Your Email!' ?>&location=<?php echo '../index.php' ?>";
                            </script>
                        <?php
                        } else {
                        ?>
                            <script>
                                window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo '../index.php' ?>";
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script>
                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Your Data Already Exist!' ?>&location=<?php echo '../index.php' ?>";
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'data is already Uploaded!' ?>&location=<?php echo '../index.php' ?>";
                    </script>
                <?php

                }
            } else {
                ?>
                <script>
                    window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Image Uploaded Failed!' ?>&location=<?php echo '../index.php' ?>";
                </script>
<?php
            }
        }
    }
} else {
    echo "run";
}





// Sanitize email
function sanitizeEmail($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    return $email;
}
?>