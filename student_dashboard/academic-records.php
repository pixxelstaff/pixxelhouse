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
                <div class="container">
                    <!-- coding starts here -->

                    <!--  Row 1 -->
                    <div class="row iph_pag_row1">

                        <div class="col-lg-8 col-md-6 col-sm-12 p-2">

                            <h2 class="std_name">Welcome <span><?php echo $session_student_name; ?></span></h2>

                            <p class="gen_msg">Your dedication today paves the way for a brighter tomorrow.</p>

                            <a href="courses.php" class="en_btn">More Courses</a>

                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 iph_row_img_div text-center">

                            <img src="../images/activity.png">

                        </div>

                    </div>

                    <!-- buttons div -->

                    <div class="col-12 d-flex justify-content-center my-3 py-3">

                        <div class="class_batch_row">
                            <?php

                            $expl_the_batch_count = explode(',', $session_batch);
                            foreach ($expl_the_batch_count as $b_value) {

                            ?>
                                <button class="cl_btn">
                                    <?php
                                    $btn = batch_table_name($con, $b_value);
                                    echo $btn;
                                    ?>
                                </button>
                            <?php

                            }


                            ?>
                        </div>
                    </div>



                    <?php

                    $exp_std_batches = explode(',', $session_batch);

                    foreach ($exp_std_batches as $batch_key => $batch_value) {

                        $analytical_data = std_class_data($con, $batch_value, $session_student_id);


                    ?>

                        <div class="main_academic_div">

                            <!-- row2 -->

                            <div class="col-12 academic-div">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 a-main-col">
                                        <div class="academic-sub-div col-lg-12">
                                            <p class="academic_p">
                                                total classes
                                            </p>
                                            <p class="act-num">
                                                <?php echo $analytical_data['total_class'];  ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 a-main-col">
                                        <div class="academic-sub-div col-lg-12">
                                            <p class="academic_p">
                                                no of present days
                                            </p>
                                            <p class="act-num">

                                                <?php echo $analytical_data['total_present_class']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 a-main-col">
                                        <div class="academic-sub-div col-lg-12">
                                            <p class="academic_p">
                                                no of absent days
                                            </p>
                                            <p class="act-num">

                                                <?php echo $analytical_data['total_absent_class']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 a-main-col">
                                        <div class="academic-sub-div col-lg-12">
                                            <p class="academic_p">
                                                no of leaves
                                            </p>
                                            <p class="act-num">

                                                <?php echo $analytical_data['total_leave_class']; ?>

                                            </p>
                                        </div>
                                    </div>




                                </div>
                            </div>

                            <!-- row3 -->

                            <div class="col-12 my-4">

                                <div class="row align-items-center">

                                    <!-- chart 01 div -->

                                    <div class="col-lg-6 col-md-12 col-sm-12 ">

                                        <div class="col-12 activity_chart">

                                            <div class="container">

                                                <div class="row align-items-center my-4">

                                                    <!-- apex pie chart -->

                                                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center ">

                                                        <!-- apex pie chart with dynamic attributes -->

                                                        <div id="mine_circular_chart<?php echo $batch_key + 1 ?>" data-present="<?php echo $analytical_data['total_present_class']; ?>" data-absent="<?php echo $analytical_data['total_absent_class']; ?>" data-leave="<?php echo $analytical_data['total_leave_class']; ?>"  data-skip="<?php echo $analytical_data['total_skip_class']; ?>"></div>

                                                    </div>

                                                    <!-- custom circular charts are here -->

                                                    <div class="col-lg-6 col-md-6 col-sm-12">

                                                        <div class="container">

                                                            <div class="row align-items-center my-2">

                                                                <div class="col-6 act_detail">

                                                                    <h6 class="act-h6">Present</h6>

                                                                    <p class="act-p">student presence</p>

                                                                </div>

                                                                <div class="col-6 text-center">
                                                                    <div class="circular-progress">
                                                                        <span class="progress-value" data-end-val="<?php echo $analytical_data['present_percentage']; ?>">0%</span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row align-items-center my-2">

                                                                <div class="col-6 act_detail">

                                                                    <h6 class="act-h6">Absent</h6>

                                                                    <p class="act-p">student absence</p>

                                                                </div>

                                                                <div class="col-6 text-center">

                                                                    <div class="circular-progress my-2">

                                                                        <span class="progress-value" data-end-val="<?php echo $analytical_data['absent_percentage']; ?>">0%</span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="row align-items-center my-2">

                                                                <div class="col-6 act_detail">

                                                                    <h6 class="act-h6">Assignments</h6>

                                                                    <p class="act-p">assignments done</p>

                                                                </div>

                                                                <div class="col-6 text-center">

                                                                    <div class="circular-progress">

                                                                        <span class="progress-value" data-end-val="<?php echo $analytical_data['assignment_percentage']; ?>">0%</span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- chart 02 div -->


                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="col-lg-12  activity_chart px-2">
                                            <div id="chart<?php echo $batch_key + 1 ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- row4 table div -->
                            <div class="col-12 gen_table_row">
                                <div class="col-lg-12 gen_table_parent">
                                    <table class="my_cus_tab ">
                                        <thead>
                                            <tr>
                                                <th>s.no</th>
                                                <th>name</th>
                                                <th>course-name</th>
                                                <th>batch-name</th>
                                                <th>date</th>
                                                <th>attendance</th>
                                                <th>assignment</th>
                                                <th>assignment-status</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php

                                            $class_record =   student_attendance_data($con, $batch_value, $session_student_id, $session_student_name, false, '');

                                            $serial_num = 0;

                                            foreach ($class_record as $record) {

                                                $serial_num++;

                                            ?>
                                                <tr>
                                                    <td><?php echo $serial_num; ?></td>

                                                    <td><?php echo $record['student_name']; ?></td>

                                                    <td><?php echo $record['course_name']; ?></td>

                                                    <td><?php echo $record['batch_name']; ?></td>

                                                    <td><?php echo $record['attendance_date']; ?></td>

                                                   <?php

                                                    if ($record['attendance'] == 'P') {
                                                    ?>
                                                        <td class="att_style att_p"><?php echo $record['attendance']; ?></td>

                                                    <?php
                                                    } elseif ($record['attendance'] == 'A') {
                                                    ?>
                                                        <td class="att_style att_a"><?php echo $record['attendance']; ?></td>

                                                    <?php
                                                    } elseif ($record['attendance'] == 'L') {
                                                    ?>
                                                        <td class="att_style att_l"><?php echo $record['attendance']; ?></td>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td class="att_style att_s"><?php echo $record['attendance']; ?></td>

                                                    <?php
                                                    }

                                                    ?>

                                                    <td><?php

                                                     if($record['assignments']){
                                                            echo   $record['assignments']; 
                                                         }
                                                         else{
                                                                 echo "null";
                                                         }

                                                      ?></td>


                                                   
 <?php



                                                    if ($record['assignment_status'] == '1') {

                                                    ?>
                                                        <td class="att_p att_style">submitted</td>

                                                    <?php

                                                    } elseif ($record['assignment_status'] == '0') {

                                                    ?>
                                                        <td class="att_a att_style">not submitted</td>

                                                    <?php

                                                    } else {

                                                    ?>

                                                        <td class="att_style att_s">null</td>

                                                    <?php

                                                    }

                                                    ?>

                                                </tr>
                                            <?php

                                            }


                                            ?>


                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    <?php

                    }

                    ?>



                    <script src="../assets/js/circular.js"></script>

                    <?php include('include/footer.php'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>