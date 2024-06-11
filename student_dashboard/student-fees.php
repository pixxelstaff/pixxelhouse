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


                <!-- coding starts here -->

                <div class="container">
                    <!--  Row 1 -->
                    <div class="iph_pag_row1 row">
                        <div class="col-lg-8 col-md-6 col-sm-12 p-2">
                            <h2 class="std_name">Welcome <span><?php echo  $session_student_name; ?></span></h2>
                            <p class="gen_msg">Timely payment of fees is mandatory for all students. Thank you for your cooperation!</p>
                            <a href="courses.php" class="en_btn">More Courses</a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 iph_row_img_div text-center">
                            <img src="../images/ill.png">
                        </div>

                    </div>

                    <!-- buttons row -->

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


                    <!-- buttons row ends -->

                    <!-- repeat the data according to batches? -->

                    <?php


                    foreach ($expl_the_batch_count as $b_value) {


                    ?>

                        <div class="main_academic_div">

                            <!-- row2 starts here -->

                            <div class="col-lg-12 my-2  detail_section">

                                <!-- php code for this sec -->

                                <div class="container ">

                                    <?php

                                    $student_basic_data = fees_data_func($con, $b_value, $session_student_id, true);

                                    if (count($student_basic_data) > 0) {

                                        foreach ($student_basic_data as $details_show) {

                                    ?>

                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-12 d-flex align-items-center">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Name : </label>
                                                                <p class="detail_sec_p"><?php echo  $session_student_name; ?></p>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Father-Name : </label>
                                                                <p class="detail_sec_p"><?php echo  $session_father_name; ?></p>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Student-Email : </label>
                                                                <p class="detail_sec_p"><?php echo  $session_email; ?></p>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Student-Contact : </label>
                                                                <p class="detail_sec_p"><?php echo  $session_student_contact; ?></p>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Batch-Name : </label>
                                                                <p class="detail_sec_p"><?php echo  $details_show['batch_name']; ?></p>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Batch-Code : </label>
                                                                <p class="detail_sec_p"><?php echo  $details_show['batch_code']; ?></p>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 my-1">
                                                                <label class="detail_sec_label" for="">Teacher : </label>
                                                                <p class="detail_sec_p"><?php echo  $details_show['batch_teacher']; ?></p>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 p-1 d-flex align-items-center justify-content-center">
                                                    <div class="detail_sec_img ">
                                                        <img src="../images/<?php echo $session_image; ?>" alt="" srcset="">
                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        }
                                    } else {
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h2>no data is upload</h2>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    ?>

                                </div>

                            </div>

                            <!-- row3 starts here -->



                            <?php

                            ?>



                            <div class="col-lg-12 gen_table_row overflow-auto">

                                <table class="my_cus_tab">

                                    <thead>

                                        <tr>
                                            <th>s.no</th>
                                            <th>name</th>
                                            <th>father-name</th>
                                            <th>course-name</th>
                                            <th>batch-name</th>
                                            <th>month</th>
                                            <th>date</th>
                                            <th>fees</th>
                                            <th>fees-staus</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        $fee_data = fees_data_func($con, $b_value, $session_student_id, false);

                                        $sno = 0;

                                        if (count($fee_data) > 0) {

                                            foreach ($fee_data as $row) {
                                                $sno++;

                                        ?>

                                                <tr>
                                                    <td><?php echo $sno; ?></td>
                                                    <td><?php echo $row['student_name']; ?></td>
                                                    <td><?php echo $row['father_name']; ?></td>
                                                    <td><?php echo $row['batch_name']; ?></td>
                                                    <td><?php echo $row['batch_code']; ?></td>
                                                    <td><?php echo $row['month']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['fees']; ?></td>

                                                    <td>
                                                        <a href="std_contact.php" class="btn btn-primary">contact</a>
                                                        <?php if ($row['fees_status'] === '1') { ?>
                                                            <span class="btn btn-primary">
                                                                paid
                                                            </span>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <span class="btn btn-danger">
                                                                due
                                                            </span>

                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                            <?php

                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan='100' class="text-center">
                                                    no data is found
                                                </td>
                                            </tr>
                                        <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php

                    }


                    ?>




                    <?php include('include/footer.php'); ?>

                </div>
            </div>
            <?php include('include/javascript.php'); ?>
            <script src="../assets/js/tab.js"></script>

            <!-- <script src="../assets/js/circular.js"></script> -->
</body>

</html>