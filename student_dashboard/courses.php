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


                <!--  Row 2 -->
                <div class="container">
                    <div class="card iph_pag_row1 py-2">
                        <div class="card-body ">
                            <h3 class=" text-center text-light">Other Courses</h3>
                        </div>
                    </div>
                    <div class="row">

                         <?php

                        $all_course = all_data_func($con, 'course');

                        while ($show_c_slide = mysqli_fetch_assoc($all_course)) {
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 my-2">
                                <div class="course_slide">
                                    <img src="../batch_image/<?php echo $show_c_slide['course_thumbnail']; ?>" alt="" srcset="">
                                    <h6 class="course_title mb-0">
                                        <?php echo $show_c_slide['course_name']; ?>

                                    </h6>
                                    <p class="course_des"><?php echo $show_c_slide['description']; ?></p>

                                    <a href="single-course.php?course_id=<?php echo $show_c_slide['Id']; ?>" class="c_enroll_btn my-2"> view course</a>
                                </div>
                            </div>

                        <?php
                        }


                        ?>

                    </div>
                </div>






                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>