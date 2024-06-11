<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student Dashboard</title>
    <?php include('include/links.php'); ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include('include/sidebar.php'); ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper overflow-hidden">
            <!--  Header Start -->
            <header class="app-header">
                <?php include('include/navbar.php'); ?>
            </header>
            <!--  Header End -->
            <div class="container-fluid">

                <div class="container">


                    <!-- coding starts here -->

                    <!--  Row 1 -->

                    <form method="post" enctype="multipart/form-data">



                        <div class="row">

                            <div class="col-lg-12 py-4 mb-2 iph_blue rounded">
                                <div class="card-body my-2">
                                    <h3 class=" text-center text-light">Update Profile</h3>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 profile_div_01 my-2 py-3 text-center ">

                                <div class="side_profile_img_div w-320">

                                    <div class="iph_dash_update text-center ">

                                        <!-- for remove and upload -->

                                        <a class="btn_shower"><i class="fa-solid fa-plus"></i></a>

                                        <!-- button coming down -->

                                        <div class="upload_btn_group">
                                            <label for="upd_img_inp" class="upl_label">
                                                <span class="icon-upload_img"></span>
                                            </label>
                                            <a class="remove_up_img"><i class="fa-solid fa-x"></i></a>
                                        </div>

                                        <input type="file" name="upload_img_file_btn" id="upd_img_inp" hidden>

                                        <img src="../images/<?php echo $session_image; ?>" class="iph_dash_update_img" alt="">

                                    </div>
                                </div>
                                <h4 class="std_dash_name"><?php echo $session_student_name; ?></h4>
                                <p class="std_dash_email"><?php echo $session_email; ?></p>
                                <input type="submit" value="update profile" class="std_profile_setting" name="upd_submit">

                            </div>

                            <div class="col-lg-8 col-md-12 col-sm-12 my-2 student_details_div">

                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p_sec">

                                    <div class="container">

                                        <div class="row">

                                            <div class="col-lg-12 d-flex align-items-center justify-content-between detail_head">

                                                <p>Personal-information</p>

                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">

                                                <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">

                                                    <h6 class="data_label ">Name:</h6>

                                                    <input type="text" name="upd_name" id="" value="<?php echo $session_student_name; ?>" class="actual_data e_p_inp">

                                                </div>

                                                <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">

                                                    <h6 class="data_label ">Father-email:</h6>

                                                    <input type="text" name="upd_father_email" id="" value="<?php echo $session_father_email; ?>" class="actual_data e_p_inp">

                                                </div>

                                                <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                    <h6 class="data_label ">portal-email:</h6>
                                                    <p class="actual_data"><?php echo $session_email; ?></p>

                                                </div>

                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">

                                                <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                    <h6 class="data_label ">Father-Name:</h6>
                                                    <input type="text" name="upd_father_name" id="" value="<?php echo $session_father_name; ?>" class="actual_data e_p_inp">
                                                </div>

                                                <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                    <h6 class="data_label ">Father-contact:</h6>
                                                    <input type="text" name="upd_father_contact" id="" value="<?php echo $session_home_contact; ?>" class="actual_data e_p_inp">
                                                </div>

                                                <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                    <h6 class="data_label ">Personal-contact:</h6>
                                                    <input type="text" name="upd_personal_contact" id="" value="<?php echo $session_student_contact; ?>" class="actual_data e_p_inp">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p_sec">

                                    <div class="container">
                                        <div class="row">

                                            <div class="col-lg-12 d-flex align-items-center justify-content-between detail_head">
                                                <p>Academic-details</p>

                                            </div>

                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>Gender:</h6>

                                                <select name="upd_gender" class="actual_data e_p_inp" id="" value="<?php echo $session_gender; ?>">
                                                    <option value="">select</option>
                                                    <option value="male" selected>male</option>
                                                    <option value="female">female</option>
                                                </select>


                                            </div>

                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>Date-of-birth:</h6>
                                                <input type="date" name="upd_date" id="" value="<?php
                                                                                                $string_date = $session_date_of_birth;
                                                                                                $formatted_date = date("Y-m-d", strtotime($string_date));
                                                                                                echo $formatted_date;
                                                                                                ?>" class="actual_data e_p_inp">
                                            </div>

                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>Qualification:</h6>
                                                <input type="text" name="upd_qualification" id="" value="<?php echo $session_qualification; ?>" class="actual_data e_p_inp">
                                            </div>
                                            <?php




                                            ?>

                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>Select country:</h6>
                                                <select name="upd_country" class="actual_data e_p_inp" id="country">
                                                    <option value="">select</option>
                                                    <?php
                                                    $country_name = all_data_func($con, 'country');

                                                    while ($show_c_data = mysqli_fetch_assoc($country_name)) {
                                                        if ($show_c_data['country_sno'] == $session_std_country) {

                                                            echo "<option value=" . $show_c_data['country_sno'] . " selected>" .  $show_c_data['country_name'] . "</option>";
                                                        } else {
                                                            echo "<option value=" . $show_c_data['country_sno'] . " >" .  $show_c_data['country_name'] . "</option>";
                                                        }


                                                        // $countryCode = $show_c_data['country_code'];
                                                    }


                                                    ?>
                                                </select>
                                            </div>
                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>Select city:</h6>
                                                <select name="upd_city" class="actual_data e_p_inp" id="city">
                                                    <option value="">select</option>
                                                </select>
                                            </div>

                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>country-code:</h6>
                                                <input type="text" name="upd_country_code" id="" value="" class="actual_data country_code e_p_inp" readonly>


                                            </div>
                                            <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                                <h6>Emergency-Num:</h6>
                                                <input type="text" name="upd_emergency_num" id="" value="<?php echo $session_emergency_contact; ?>" class="actual_data e_p_inp">
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12  p_sec">

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex align-items-center justify-content-between detail_head">

                                                <p>Admission-details</p>

                                            </div>

                                            <div class="data_div_01 p-1 d-flex justify-content-start align-items-center">
                                                <h6>Course:</h6>
                                                <p class="actual_data"> <?php

                                                                        $exp_course =  explode(',', $session_course);
                                                                        $name = '';
                                                                        foreach ($exp_course as $value) {

                                                                            $all_course = one_col($con, 'course', 'Id', $value);

                                                                            while ($show_c_slide = mysqli_fetch_assoc($all_course)) {

                                                                                $name .=   $show_c_slide['course_name'] . ",";
                                                                            }
                                                                        }
                                                                        echo rtrim($name, ',');
                                                                        ?></p>

                                            </div>

                                            <div class="data_div_01 p-1  d-flex justify-content-start align-items-center">
                                                <h6>Days-slot:</h6>
                                                <p class="actual_data">
                                                    <?php
                                                    $exp_batch =  explode(',', $session_batch);
                                                    $batch_slot = '';
                                                    foreach ($exp_batch as $value) {

                                                        $all_batch = one_col($con, 'batch', 'batch_id', $value);

                                                        while ($show_b_slide = mysqli_fetch_assoc($all_batch)) {

                                                            $batch_slot .=   $show_b_slide['batch_slot'] . ",";
                                                        }
                                                    }
                                                    echo rtrim($batch_slot, ','); ?>
                                                </p>
                                            </div>

                                            <div class="data_div_01 p-1  d-flex justify-content-start align-items-center">
                                                <h6>Timming:</h6>
                                                <p class="actual_data">
                                                    <?php
                                                    // $exp_batch =  explode(',', $session_batch);
                                                    $batch_time = '';
                                                    foreach ($exp_batch as $value) {

                                                        $all_batch = one_col($con, 'batch', 'batch_id', $value);

                                                        while ($show_b_slide = mysqli_fetch_assoc($all_batch)) {

                                                            $batch_time .=   $show_b_slide['time'] . ",";
                                                        }
                                                    }
                                                    echo rtrim($batch_time, ','); ?>
                                                </p>
                                            </div>
                                            <div class="data_div_01 p-1  d-flex justify-content-start align-items-center ">
                                                <h6>Address:</h6>
                                                <textarea name="upd_address" id="" rows="5" class="actual_data  w-100 border border-primary p-1"><?php echo $session_address; ?></textarea>

                                            </div>

                                            <?php
                                            if (isset($_POST['upd_submit'])) {
                                                $upd_name = mysqli_real_escape_string($con, $_POST['upd_name']);
                                                $upd_father_name = mysqli_real_escape_string($con, $_POST['upd_father_name']);
                                                $upd_father_email = mysqli_real_escape_string($con, $_POST['upd_father_email']);
                                                $upd_father_contact = mysqli_real_escape_string($con, $_POST['upd_father_contact']);
                                                $upd_personal_contact = mysqli_real_escape_string($con, $_POST['upd_personal_contact']);
                                                $upd_gender = $_POST['upd_gender'];
                                                $upd_date_of_birth = $_POST['upd_date'];
                                                $upd_format_date = date("d-m-Y", strtotime($upd_date_of_birth));
                                                $upd_qualification = mysqli_real_escape_string($con, $_POST['upd_qualification']);
                                                $upd_country = mysqli_real_escape_string($con, $_POST['upd_country']);
                                                $upd_city = mysqli_real_escape_string($con, $_POST['upd_city']);
                                                $upd_country_code = mysqli_real_escape_string($con, $_POST['upd_country_code']);
                                                $upd_emergency_num = mysqli_real_escape_string($con, $_POST['upd_emergency_num']);
                                                $upd_address = mysqli_real_escape_string($con, $_POST['upd_address']);
                                                $upd_image_name = $_FILES['upload_img_file_btn']['name'];
                                                $upd_image_tmp_name = $_FILES['upload_img_file_btn']['tmp_name'];
                                                $upd_image_path = "../images/" . $upd_image_name;
                                                $upd_image_type = $_FILES['upload_img_file_btn']['type'];
                                                $upd_image_size = $_FILES['upload_img_file_btn']['size'];

                                                // Assuming you have already defined and assigned values to the variables


                                                if (
                                                    !empty($upd_name) &&
                                                    !empty($upd_father_name) &&
                                                    !empty($upd_father_email) &&
                                                    !empty($upd_father_contact) &&
                                                    !empty($upd_personal_contact) &&
                                                    !empty($upd_gender) &&
                                                    !empty($upd_format_date) &&
                                                    !empty($upd_country) &&
                                                    !empty($upd_city) &&
                                                    !empty($upd_country_code) &&
                                                    !empty($upd_qualification) &&
                                                    !empty($upd_address)
                                                ) {
                                                    // checking image size and file

                                                    if ($upd_image_name) {

                                                        if ($upd_image_size < 5242880) {

                                                            // ================if starts img type

                                                            if ($upd_image_type == "image/jpeg" || $upd_image_type == "image/jpg" || $upd_image_type == "image/png" || $upd_image_type == "image/webp") {

                                                                move_uploaded_file($upd_image_tmp_name, $upd_image_path);

                                                                $update_student_data = "UPDATE `students` SET `student_name` = ?,`father_name` = ?,`father_email` = ?,`home_contact` = ?,`date_of_birth` = ?,`student_contact` = ?,`qualification`= ?,`country` = ?,`city`=?,`country_code` = ?,`emergency_contact` =?,`gender` = ?,`address` = ?,`student_image` = ? WHERE `sno` = ?";

                                                                $update_student_data_prepare_query = mysqli_prepare($con, $update_student_data);

                                                                mysqli_stmt_bind_param($update_student_data_prepare_query, 'sssssssssssssss', $upd_name, $upd_father_name, $upd_father_email, $upd_father_contact, $upd_format_date, $upd_personal_contact, $upd_qualification, $upd_country, $upd_city, $upd_country_code, $upd_emergency_num, $upd_gender, $upd_address, $upd_image_name, $session_student_id);

                                                                $update_student_data_query = mysqli_stmt_execute($update_student_data_prepare_query);

                                                                // ================if starts

                                                                if ($update_student_data_query) {
                                            ?>
                                                                    <script>
                                                                        window.location = "../functions/alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'your profile is updated successfully' ?>&location=<?php echo '../student_dashboard/profile.php'; ?>";
                                                                    </script>

                                                                <?php

                                                                }

                                                                // ================if ends
                                                                // ================else starts
                                                                else {
                                                                    echo "mysqli error occurs" . mysqli_error($con);
                                                                }
                                                                // ================else ends
                                                            }
                                                            // ================if ends img type 

                                                            // ================else start img type 
                                                            else {
                                                                ?>
                                                                <script>
                                                                    alert('image type must be jpg || jpeg || png || webp')
                                                                </script>

                                                            <?php
                                                            }
                                                            // ================else ends img type 

                                                        }
                                                        // ================if ends img size 

                                                        // ================else start img size 

                                                        else {
                                                            ?>
                                                            <script>
                                                                alert('image size must be less than 5 mbs')
                                                            </script>

                                                        <?php
                                                        }
                                                        // ================else ends img size 

                                                    } else {




                                                        $update_student_data = "UPDATE `students` SET `student_name` = ?,`father_name` = ?,`father_email` = ?,`home_contact` = ?,`date_of_birth` = ?,`student_contact` = ?,`qualification`= ?,`country` = ?,`city`=?,`country_code` = ?,`emergency_contact` =?,`gender` = ?,`address` = ?,`student_image` = ? WHERE `sno` = ?";

                                                        $update_student_data_prepare_query = mysqli_prepare($con, $update_student_data);

                                                        mysqli_stmt_bind_param($update_student_data_prepare_query, 'sssssssssssssss', $upd_name, $upd_father_name, $upd_father_email, $upd_father_contact, $upd_format_date, $upd_personal_contact, $upd_qualification, $upd_country, $upd_city, $upd_country_code, $upd_emergency_num, $upd_gender, $upd_address, $session_image, $session_student_id);

                                                        $update_student_data_query = mysqli_stmt_execute($update_student_data_prepare_query);

                                                        if ($update_student_data_query) {
                                                        ?>
                                                            <script>
                                                                window.location = "../functions/alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'your profile is updated successfully' ?>&location=<?php echo '../student_dashboard/profile.php'; ?>";
                                                            </script>

                                                    <?php

                                                        } else {
                                                            echo "mysqli error occurs" . mysqli_error($con);
                                                        }
                                                    }



                                                    // updating query


                                                } else {

                                                    ?>
                                                    <script>
                                                        alert("echo fill all fields")
                                                    </script>
                                            <?php
                                                }
                                            }

                                            ?>





                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>



                    </form>
                    <?php include('include/footer.php'); ?>

                </div>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php');


    include('ajax.php')
    ?>
    <script src="../assets/js/update.js"></script>
</body>

</html>