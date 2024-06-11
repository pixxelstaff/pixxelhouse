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

                    <div class="col-12 d-flex justify-content-center my-1 py-3">

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


                    ?>

                        <div class="main_academic_div">





                            <!-- assignemnt div -->
                            <div class="col-12 gen_table_row m-0">
                                <h2 class="my-2 text-center">
                                    assignment
                                </h2>
                                <div class="col-lg-12 gen_table_parent">
                                    <table class="my_cus_tab ">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Assignment</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php

                                            $class_record1 =   student_attendance_data($con, $batch_value, $session_student_id, $session_student_name, false, '');

                                            $serial_num = 0;

                                            foreach ($class_record1 as $record) {

                                                $serial_num++;

                                            ?>
                                                <tr>

                                                    <td><?php echo $serial_num; ?></td>

                                                    <td><?php echo $record['student_name']; ?></td>

                                                    <td><?php echo $record['attendance_date']; ?></td>


                                                    <td><?php

                                                        if ($record['assignments']) {
                                                            echo   $record['assignments'];
                                                        } else {
                                                            echo "null";
                                                        }

                                                        ?>
                                                    </td>


                                                    <td class="assignment_des"><?php echo $record['assignments_des']; ?></td>
                                                      

                                                    <td><button data-id="<?php echo $record['Id']; ?>" class="view_assign"><i class="fa-solid fa-eye"></i>View</button></td>

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
    <script>
        let des_td = document.getElementsByClassName('assignment_des');
        Array.from(des_td).forEach((element) => {
            element.textContent = element.textContent ? element.textContent.slice(0, 60) + "..." : 'this is no description uploaded by teacher to read ...'
        })
    </script>

    <!-- popup div -->

    <div class="assignment_popup">
        <div class="assignment_content">
            <h2 class="a_model_h2" id="assign">
                <span>Assignment :</span>
            </h2>
            <h2 class="a_model_h2" id="assign_date">
                <span>Date :</span>
            </h2>
            <p class="a_model_p" id="assign_des">
                <span>Description :</span>

            </p>
            <button class="c_assign_popup"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>

    <script src="../assets/js/modal.js"></script>

</body>


</html>