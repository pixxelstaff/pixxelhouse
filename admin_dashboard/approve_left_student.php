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

            <form action="" method="post" enctype="multipart/form-data">
                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="card bg-primary">
                        <div class="card-body">
                            <h3 class=" text-center text-light">Enroll student again</h3>
                        </div>
                    </div>

                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-8" id="first_coloumn">
                            <div class="card card-shadow-ph">
                                <div class="card-body">
                                    <?php
                                    $get_student_sno = $_GET['leftStudent'];
                                    $student_detail = get_table_data2('left_student', $con, 'sno', $get_student_sno);
                                    if(mysqli_num_rows($student_detail) != 0){
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
                                            $address = $row['address'];
                                            $image = $row['image'];
                                        }
                                    }
                                    else{
                                        ?>
                                            <script>window.location.href='dashboard.php'</script>
                                        <?php
                                    }
                                    // $get_course_name = get_table_data2('course', $con, 'Id', $course_id);
                                    // $course = mysqli_fetch_assoc($get_course_name)['course_name'];
                                    ?>
                                    <div class="row align-items-center">

                                        <div class="col-md-4">
                                            <label for="student_name" class="form-label">Students Name</label>
                                            <input type="text" name="student_name" id="student_name" placeholder="student Name" value="<?php echo $student_name; ?>" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Personal Contact</label>
                                            <input type="text" name="student_contact" value="<?php echo $student_contact; ?>" placeholder="Personal Contact" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Student Email</label>
                                            <input type="text" name="student_email" value="<?php echo $student_email; ?>" placeholder="Student Email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">

                                        <div class="col-md-4">
                                            <label for="father_name" class="form-label">Father Name</label>
                                            <input type="text" value="<?php echo $father_name; ?>" placeholder="Father Name" name="father_name" id="father_name" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_contact" class="form-label">Father Contact</label>
                                            <input type="text" value="<?php echo $father_contact; ?>" name="father_contact" placeholder="Father Contact" id="father_contact" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="father_email" class="form-label">Father Email</label>
                                            <input type="text" name="father_email" value="<?php echo $father_email; ?>" placeholder="Father Email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">

                                            <label for="birth_date" class="form-label">Date Of Birth</label>
                                            <input type="date" name="birth_date" value="<?php echo $date_of_birth; ?>" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                                            <input type="text" name="emergency_contact" value="<?php echo $emergency_contact; ?>" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Gender</label>
                                            <input type="text" name="gender" value="<?php echo $gender; ?>" class="form-control">
                                        </div>

                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Qualification</label>
                                            <select id="Qualification_Select" name='upd_qualification' value='<?php echo $quli; ?>' class="form-select">
                                                <option value=''>Select Qualification</option>
                                                <option value='8th Class'>8th Class</option>
                                                <option value='Matric (10th)'>Matric (10th)</option>
                                                <option value='Enter (12th)'>Enter (12th)</option>
                                                <option value='Graduation (14 years)'>Graduation (14 years)</option>
                                                <option value='Graduation (16 years)'>Graduation (16 years)</option>
                                                <option value='Masters'>Masters</option>
                                            </select>

                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Select Course</label>
                                            <select name="course" id="" class="form-select">
                                                <option value="">Select course</option>
                                                <?php
                                                $select_course = get_table_data('course', $con);
                                                while ($row = mysqli_fetch_assoc($select_course)) {
                                                ?>
                                                    <option value="<?php echo $row['Id']; ?>"><?php echo $row['course_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Select Days</label>
                                            <select name="new_day_slot" class="form-select">
                                                <option value="">Days</option>
                                                <option value="MWF">MWF (Mon-Wed-Fri)</option>
                                                <option value="TTS">TTS (Tues-Thus-Sat)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Selected Time</label>
                                            <select name="new_time" class="form-select">
                                                <option value="">Timing</option>
                                                <option value="1 to 2pm">1:00pm to 2:00pm</option>
                                                <option value="2 to 3pm">2:00pm to 3:00pm</option>
                                                <option value="3 to 4pm">3:00pm to 4:00pm</option>
                                                <option value="4 to 5pm">4:00pm to 5:00pm</option>
                                                <option value="5 to 6pm">5:00pm to 6:00pm</option>
                                                <option value="6 to 7pm">6:00pm to 7:00pm</option>
                                                <option value="7 to 8pm">7:00pm to 8:00pm</option>
                                                <option value="8 to 9pm">8:00pm to 9:00pm</option>
                                                <option value="9 to 10pm">9:00pm to 10:00pm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Select Country</label>
                                            <select name="country" id="country_sel" class="form-select">
                                                <option value="">Select Country </option>
                                                <?php
                                                $country = get_table_data('country', $con);
                                                while ($show_country = mysqli_fetch_assoc($country)) {
                                                    echo "<option value =" . $show_country['country_sno'] . ">" . $show_country['country_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Selected City</label>
                                            <select name='city' id="city_select" class="form-select">
                                                <option value="">Select City</option>

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Country Code</label>
                                            <input type="text" name="c_code" id="country_code" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Select Batch</label>
                                            <select name="upd_batch" id="" class="form-select">
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

                                    </div>

                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" name='address' rows="2" class="form-control"><?php echo $address ?></textarea>
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


                                                    <input type="submit" name="enroll_again" value="Approve" class="btn btn-primary form-control">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 " id="second_coloumn">
                            <div class="card card-shadow-ph mb-2">
                                <div class="card-header text-bg-primary text-center">
                                    <h5 class="text-bg-primary">Profile Image</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="../images/<?php echo $image ?>" class="upl_image" id="left_Std_image">
                                    <input type="file" name="upd_profile" id="old_Std_image_inp" hidden>
                                    <div class="col-12 my-3 d-flex justify-content-between px-2">
                                        <a href="javascript:void(0)" class="btn btn-danger rm_btn">Remove Image</a>
                                        <label for="old_Std_image_inp" class="btn btn-success">Upload Image</label>

                                    </div>
                                </div>

                            </div>
                            <div class="card card-shadow-ph mt-2">
                                <div class="card-header text-bg-primary text-center ">
                                    <h5 class="text-bg-primary">Account Info</h5>
                                </div>
                                <div class="card-body ">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-12 my-1">
                                            <label class="form-label">Portal Email</label>
                                            <input type="text" name="portal_email" placeholder="Portal Email" value="" class="form-control">
                                        </div>
                                        <div class="col-md-12 my-1">
                                            <label class="form-label">Portal Password</label>
                                            <input type="text" name="portal_Password" placeholder="Portal Password" value="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php include('include/footer.php'); ?>
        </div>
        </form>
    </div>
    </div>
    <?php include('include/javascript.php'); ?>
    <script>
        let upload_file_input = document.getElementById("old_Std_image_inp");

        let uploaded_img = document.querySelector("#left_Std_image");

        let up_img_close_btn = document.querySelector(".rm_btn");

        up_img_close_btn.addEventListener("click", () => {

            uploaded_img.src = "assets/images/placeholder.webp";

            upload_file_input.value = "";
        });

        upload_file_input.addEventListener("change", (e) => {

            let img_file = e.target.files[0];

            var size = img_file.size / 1024 / 1024;

            if (
                img_file.type == "image/jpeg" ||
                img_file.type == "image/jpg" ||
                img_file.type == "image/png" ||
                img_file.type == "image/webp"
            ) {

                if (size < 5) {


                    let img_file_reader = new FileReader();

                    img_file_reader.addEventListener("load", (e) => {
                        up_img_src = e.target.result; // it is after reading file as read data as url

                        uploaded_img.src = up_img_src;
                    });

                    img_file_reader.readAsDataURL(img_file);
                } else {
                    alert("file size must less than 5mb");
                }
            } else {
                alert("file type must jpg,jpeg,png,webp");
            }
        });

        // selected

        // Get the select element
        var selectElement = document.getElementById('Qualification_Select');

        // Set the value of the option you want to be selected
        var selectedValue = `<?php echo $quli; ?>` // Change this to the desired value
        // Loop through the options and set the selected attribute for the desired option
        for (var i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].value === selectedValue) {
                selectElement.options[i].selected = true;
                break;
            }
        }
        // ajax

        $(document).ready(() => {
            $('#country_sel').on('change', function() {
                $.ajax({
                    url: 'ajax/mine_country_ajax.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        country_id: $(this).val()
                    },
                    success: function({
                        cities,
                        country_code
                    }) {
                        $('#city_select').empty()
                        $('#country_code').empty()
                        $('#city_select').append(`<option value=''>select city</option>`)
                        cities.forEach((item) => {
                            let opt = `<option value='${item.city_id}'>${item.city}</option>`
                            $('#city_select').append(opt)
                        })
                        $('#country_code').val(`${country_code}`)
                    },
                    error: function() {
                        console.log('error');
                    }
                });
                // console.log($(this).val())
            })
        })
    </script>
    <?php
    if (isset($_POST['enroll_again'])) {
        $name = mysqli_real_escape_string($con, $_POST['student_name']);
        $std_contact = mysqli_real_escape_string($con, $_POST['student_contact']);
        $std_email = mysqli_real_escape_string($con, $_POST['student_email']);
        $father_name = mysqli_real_escape_string($con, $_POST['father_name']);
        $std_father_contact = mysqli_real_escape_string($con, $_POST['father_contact']);
        $std_father_email = mysqli_real_escape_string($con, $_POST['father_email']);
        $d_o_b = mysqli_real_escape_string($con, $_POST['birth_date']);
        $e_m_contact = mysqli_real_escape_string($con, $_POST['emergency_contact']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $std_qaulification = mysqli_real_escape_string($con, $_POST['upd_qualification']);
        $std_course = mysqli_real_escape_string($con, $_POST['course']);
        $std_country = mysqli_real_escape_string($con, $_POST['country']);
        $std_city = mysqli_real_escape_string($con, $_POST['city']);
        $std_country_code = mysqli_real_escape_string($con, $_POST['c_code']);
        $std_days = mysqli_real_escape_string($con, $_POST['new_day_slot']);
        $std_time = mysqli_real_escape_string($con, $_POST['new_time']);
        $std_Batch = mysqli_real_escape_string($con, $_POST['upd_batch']);
        $std_Address = mysqli_real_escape_string($con, $_POST['address']);
        $p_email = mysqli_real_escape_string($con, $_POST['portal_email']);
        $p_password = mysqli_real_escape_string($con, $_POST['portal_Password']);
        $hash_password = password_hash($p_password, PASSWORD_DEFAULT);
        $date = date("d-m-y");
        if (isset($_FILES['upd_profile']['name']) && $_FILES['upd_profile']['name'] != '') {
            $new_image_name = $date . "-" . rand(1, 100000) . $_FILES['upd_profile']['name'];
            $new_image_tmp_name = $_FILES['upd_profile']['tmp_name'];
            $path = '../images/' . $new_image_name;
            move_uploaded_file($new_image_tmp_name, $path);
        }


        if (
            !empty($name) &&
            !empty($std_contact) &&
            !empty($std_email) &&
            !empty($father_name) &&
            !empty($std_father_contact) &&
            !empty($std_father_email) &&
            !empty($d_o_b) &&
            !empty($e_m_contact) &&
            !empty($gender) &&
            !empty($std_qaulification) &&
            !empty($std_course) &&
            !empty($std_country) &&
            !empty($std_city) &&
            !empty($std_country_code) &&
            !empty($std_days) &&
            !empty($std_time) &&
            !empty($std_Batch) &&
            !empty($std_Address) &&
            !empty($p_email) &&
            !empty($hash_password)

        ) {

            $img_to_upload = isset($new_image_name)  ? $new_image_name : $image;

            $selecting_data_from_students = "SELECT * FROM `students` WHERE `student_contact` = ? OR `email` = ? OR `portal_email` = ?";

            $selecting_data_from_students_prepare = mysqli_prepare($con, $selecting_data_from_students);

            mysqli_stmt_bind_param($selecting_data_from_students_prepare, 'sss', $std_contact, $std_email, $p_email);

            if (mysqli_stmt_execute($selecting_data_from_students_prepare)) {

                $check_result = mysqli_stmt_get_result($selecting_data_from_students_prepare);

                if (mysqli_num_rows($check_result) == 0) {

                    $insert_data = "INSERT INTO `students` (
                   `student_name`, `father_name`, `father_email`, `home_contact`,
                   `date_of_birth`, `student_contact`, `emergency_contact`, `gender`,
                  `address`, `qualification`, `course`, `batch`, 
                  `country`, `country_code`, `city`, `email`, `portal_email`,
                  `password`, `student_image`, `date`
             ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $insert_data_prepare = mysqli_prepare($con, $insert_data);

                    // Assuming all your variables are defined before this point
                    mysqli_stmt_bind_param(
                        $insert_data_prepare,
                        'ssssssssssssssssssss',
                        $name,
                        $father_name,
                        $father_email,
                        $father_contact,
                        $d_o_b,
                        $std_contact,
                        $e_m_contact,
                        $gender,
                        $std_Address,
                        $std_qaulification,
                        $std_course,
                        $std_Batch,
                        $std_country,
                        $std_country_code,
                        $std_city,
                        $std_email,
                        $p_email,
                        $hash_password,
                        $img_to_upload,
                        $date
                    );

                    // Execute the prepared statement
                    if (mysqli_stmt_execute($insert_data_prepare)) {


                        $del_std_id = "DELETE FROM `left_student` WHERE  `sno` = ?";

                        $del_std_id_prepare = mysqli_prepare($con, $del_std_id);

                        mysqli_stmt_bind_param($del_std_id_prepare, 's', $get_student_sno);

                        if (mysqli_stmt_execute($del_std_id_prepare)) {
                         
                            $student_id_query = "SELECT * FROM `students` WHERE `email` = ? AND `portal_email` = ?";
                            $student_id_statement = mysqli_prepare($con, $student_id_query);
                            mysqli_stmt_bind_param($student_id_statement, "ss", $std_email, $p_email);
                            mysqli_stmt_execute($student_id_statement);
                            
                            $student_id_result = mysqli_stmt_get_result($student_id_statement);
                            $student_row = mysqli_fetch_assoc($student_id_result);
                            $new_id = $student_row['sno'];
                            
                            $sel_att_query = "SELECT * FROM `attandance` WHERE `batch_name` = ?";
                            $sel_att_statement = mysqli_prepare($con, $sel_att_query);
                            mysqli_stmt_bind_param($sel_att_statement, "s", $std_Batch);
                            mysqli_stmt_execute($sel_att_statement);
                            
                            $sel_att_result = mysqli_stmt_get_result($sel_att_statement);
                            
                            while ($att = mysqli_fetch_assoc($sel_att_result)) {
                                if (strpos($att['student_ids'], $new_id) === false) {
                                    $new_student_ids = $att['student_ids'] != '' ? $att['student_ids'] . "," . $new_id : $new_id;
                                    $new_attendace_record = $att['attendance_status'] != '' ? $att['attendance_status'] . ",S"  : 'S';
                                    $new_assign_record = $att['assigments_done'] != '' ? $att['assigments_done'] . ",3"  : '3';
                                    $upd_statement = "UPDATE `attandance` SET `student_ids` = ?,`attendance_status` = ? ,`assigments_done` = ?  WHERE `batch_name` = ?";
                                    $upd_statement_q = mysqli_prepare($con, $upd_statement);
                                    mysqli_stmt_bind_param($upd_statement_q, "ssss", $new_student_ids,$new_attendace_record,$new_assign_record, $std_Batch);
                                    mysqli_stmt_execute($upd_statement_q);
                            
                                    if (mysqli_stmt_affected_rows($upd_statement_q) > 0) {
                                        $success_message = 'Student has been successfully sent back to the student list.';
                                        ?>
                                        <script>
                                            window.location = "alert.php?icon=<?php echo 'success' ?> &message=<?php echo $success_message ?>&location=<?php echo  'students.php' ?>";
                                        </script>
                                        <?php
                                    } 
                                }
                            }
                            
                            mysqli_stmt_close($student_id_statement);
                            mysqli_stmt_close($sel_att_statement);
                            mysqli_stmt_close($upd_statement_q);
                            mysqli_close($con);
                            
                            
                        }
                    } else {
                        echo "Error: " . mysqli_error($con);
                    }

                    // Close the statement
                    mysqli_stmt_close($insert_data_prepare);
                } else {
                    echo "<script>alert('data is present')</script>";
                }
            }
        } else {
            echo "<script>alert('enter full data')</script>";
        }
    }
    ?>


</body>

</html>