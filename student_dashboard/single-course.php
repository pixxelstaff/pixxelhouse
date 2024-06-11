<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student Dashboard</title>
    <?php
    include('include/links.php');

    ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php

        // knowing how many course student enrolled so he coud enter more




     
        $specific_course_id =  $_GET['course_id'];

        $all_course = one_col($con, 'course', 'Id', $specific_course_id);

        while ($show_c_slide = mysqli_fetch_assoc($all_course)) {

            $course_img = $show_c_slide['course_thumbnail'];

            $course_title = $show_c_slide['course_name'];

            $course_des = $show_c_slide['description'];
        }

        ?>

        <!-- confirm popup div -->

        <div class="confirm_popup_parent">
            <div class="child_popup_div">
                <div class="gif_div">
                    <img src="../images/gff.gif" alt="" srcset="">
                </div>
                <h4>Are You Sure?</h4>
                <p>you have selected the course ( <?php echo $course_title; ?> ) please confirm it by clicking on confirm btn</p>
                <div class="pop_btn_div d-flex justify-content-around my-1">
                    <button class="cancel_btn">
                        <span><i class="fa-solid fa-xmark"></i></span>
                        cancel
                    </button>
                    <form method="post">
                        <button type="submit" name="add_course">
                            <span><i class="fa-solid fa-check"></i></span>
                            confirm
                        </button>
                    </form>
                </div>
            </div>
        </div>

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

                <div class="col-lg-12 my-2">

                    <div class="col-lg-12 single_course_img_div">

                        <img src="../batch_image/<?php echo $course_img ?  $course_img : "course titlte here"; ?>" class="iph_course_feature_img" alt="" srcset="">

                        <h2 class="single_course_title">
                            <?php

                            echo $course_title ?  $course_title : "course titlte here";

                            ?>
                        </h2>

                        <p class="single_page_p">
                            <?php

                            echo $course_des ?  $course_des : "course description here";

                            ?>
                        </p>

                        <?php

                        $enroll_course_id = explode(',', $session_course);

                        if (!in_array($specific_course_id, $enroll_course_id)) {

                        ?>
                            <a class="single_page_btn">Apply Now</a>
                        <?php
                        }

                        ?>


                    </div>

                </div>

                <?php

                $date = date('d-M-Y');
                if (isset($_POST['add_course'])) {

                    $snt_id = mine_sanitize_string($specific_course_id);

                    $app_course = "SELECT * FROM `pending_students` WHERE `email` = '$session_std_email' AND `course` = '$snt_id'";
                    $app_course_query = mysqli_query($con, $app_course);


                    if (mysqli_num_rows($app_course_query) <= 0) {
                        $insert_sec_course_data = "INSERT INTO `pending_students` (
                                `student_name`, `email`, `father_name`, `father_email`, `home_contact`,
                                `date_of_birth`, `student_contact`, `emergency_contact`, `gender`, `address`,
                                `qualification`, `country`, `city`, `country_code`, `course`,
                                `image`, `date`
                            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $insert_prepare_Query = mysqli_prepare($con, $insert_sec_course_data);
                        mysqli_stmt_bind_param(
                            $insert_prepare_Query,
                            "sssssssssssssssss",
                            $session_student_name,
                            $session_std_email,
                            $session_father_name,
                            $session_father_email,
                            $session_home_contact,
                            $session_date_of_birth,
                            $session_student_contact,
                            $session_emergency_contact,
                            $session_gender,
                            $session_address,
                            $session_qualification,
                            $session_std_country,
                            $session_std_city,
                            $session_std_country_code,
                            $specific_course_id,
                            $session_image,
                            $date
                        );

                        $insert_sec_course_data_query = mysqli_stmt_execute($insert_prepare_Query);


                        if ($insert_sec_course_data_query) {
                ?>
                            <script>
                                window.location = "alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'you have successfully applied' ?>&location=<?php echo 'courses.php'; ?>";
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script>
                            window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'you have already applied' ?>&location=<?php echo 'courses.php'; ?>";
                        </script>
                <?php
                    }
                }


                ?>

                <script src="../assets/js/single_course.js"></script>
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>