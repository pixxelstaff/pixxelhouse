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
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <?php include('include/navbar.php'); ?>
            </header>
            <!--  Header End -->
            <div class="container-fluid">


                <!-- coding starts here -->

                <div class="container">

                    <div class="row">



                        <!-- row 1  starts here -->

                        <!--<div class="col-12 marquee_parent">-->
                        <!--    <marquee behavior="scroll" direction="left">-->
                        <!--        today class are off due to strike in hyderabd due to xyz issue all of the students are advised to stay at their home and practice your given assignments-->
                        <!--    </marquee>-->
                        <!--</div>-->

                        <div class="col-lg-9 col-md-12 col-sm-12">

                            <!-- sub_row 1  starts here -->

                            <?php

                            // query to select the batches

                            $batch_arr = explode(',', $session_batch);



                            foreach ($batch_arr as $batch_key => $batch_value) {

                                // now selecting student ids from and batch/course duration from attendance2 week data 

                                $analytical_data = std_class_data($con, $batch_value, $session_student_id);


                            ?>

                                <!-- first row of data -->

                                <div class="row weekly_data">

                                    <div class="col-lg-3 col-md-6 col-sm-12 my-2 data_columns_parent">
                                        <div class="col-lg-12 course_analytical_data">
                                            <a href="#" class="c_data_title"><span class="icon-course_duration"></span> Total Class</a>
                                            <h6 class="c_data_num"><?php echo $analytical_data['total_class']; ?></h6>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12 my-2 data_columns_parent">
                                        <div class="col-lg-12 course_analytical_data">
                                            <a href="#" class="c_data_title"><span class="icon-present"></span> Classes Attend</a>
                                            <h6 class="c_data_num"><?php echo $analytical_data['total_present_class'];  ?></h6>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12 my-2 data_columns_parent">
                                        <div class="col-lg-12 course_analytical_data">
                                            <a href="#" class="c_data_title"><span class="icon-absent"></span> Absent Classes</a>
                                            <h6 class="c_data_num"><?php echo $analytical_data['total_absent_class'];  ?></h6>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-sm-12 my-2 data_columns_parent">
                                        <div class="col-lg-12 course_analytical_data">
                                            <a href="#" class="c_data_title"><span class="icon-complete"></span>Assignment Done</a>
                                            <h6 class="c_data_num"><?php echo $analytical_data['assignment_done']; ?></h6>
                                        </div>
                                    </div>

                                </div>

                                <!-- second row of data -->

                                <div class="row ">

                                    <div class="col-12 mt-4 mb-2">
                                        <h4 class="front_page_head">
                                            Your weekly report
                                        </h4>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-1 overflow-auto">

                                        <table class="weekly_report_table">

                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Course name</th>
                                                    <th>Assignments</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Teacher</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php

                                                $week_record =   student_attendance_data($con, $batch_value, $session_student_id, $session_student_name, true, 3);

                                                $att_sno = 0;

                                                foreach ($week_record as $record) {

                                                    $att_sno++;

                                                ?>
                                                    <!-- dynamic table row -->

                                                    <tr>

                                                        <td><?php echo $att_sno; ?></td>

                                                        <td><?php echo  $record['course_name']; ?></td>

                                                        <td><?php

                                                            if ($record['assignments']) {
                                                                echo   $record['assignments'];
                                                            } else {
                                                                echo "-";
                                                            }

                                                            ?></td>

                                                        <td><?php echo   $record['attendance_date']; ?></td>

                                                        <td>

                                                            <?php

                                                            if ($record['assignment_status'] == '1') {
                                                            ?>
                                                                <span class="icon-complete assign_status iph_blue"></span>

                                                            <?php

                                                            } elseif ($record['assignment_status'] == '0') {

                                                            ?>
                                                                <span class="icon-repeat assign_status bg-danger"></span>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <span>-</span>

                                                            <?php
                                                            }

                                                            ?>

                                                        </td>

                                                        <td><?php echo $record['teacher']; ?> </td>

                                                    </tr>

                                                <?php

                                                }

                                                // foreach loop ends 

                                                ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            <?php

                                // batch query if and while braces are these

                            }

                            ?>


                            <!-- course row starts here -->

                            <div class="row adv_course_div ">
                                <!-- heading div -->
                                <div class="col-12  my-3 ">

                                    <h4 class="front_page_head">

                                        recommended courses

                                    </h4>

                                </div>

                                <!-- courses -->

                                <div class="col-12">

                                    <div class="owl-carousel owl-theme" id="courses_loop">

                                        <!-- selecting courses  -->

                                        <?php
                                        
                                        $all_course = all_data_func($con,'course');

                                        while ($show_c_slide = mysqli_fetch_assoc($all_course)) {

                                        ?>
                                            <div class="item course_slide">
                                                <!-- img of course -->

                                                <img src="../batch_image/<?php echo $show_c_slide['course_thumbnail']; ?>" alt="" srcset="">

                                                <!-- h6 of course -->

                                                <h6 class="course_title my-2">

                                                    <?php echo $show_c_slide['course_name']; ?>

                                                </h6>

                                                <!-- anchor button -->

                                                <a href="single-course.php?course_id=<?php echo $show_c_slide['Id']; ?>" class="c_enroll_btn"> View Course</a>

                                            </div>

                                        <?php

                                        }


                                        ?>



                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- right side div with profile -->

                        <div class="col-lg-3 col-md-12 col-sm-12 text-center">

                            <!-- profile div -->

                            <div class="col-12 std_front_profile_div text-center p-2 my-2 overflow-hidden">
                                <div class="side_profile_img_div">
                                    <img src="../images/<?php echo $session_image; ?>" alt="">
                                </div>
                                <h4 class="std_dash_name"><?php echo $session_student_name; ?></h4>
                                <p class="std_dash_email"><?php echo $session_email; ?></p>
                                <a href="update.php" class="std_profile_setting">Edit profile</a>
                            </div>


                            <!-- notice div -->



                        </div>

                    </div>




                    <?php include('include/footer.php');   ?>

                </div>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>




</body>

</html>