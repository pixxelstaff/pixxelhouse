<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student Dashboard</title>
    <?php include('include/links.php');

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
                    <div class="row">
                        <!--  Row 2 -->
                        <div class="col-lg-12 py-4 iph_blue rounded">
                            <div class="card-body my-2">
                                <h3 class=" text-center text-light">Students Profile</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 profile_div_01 py-2 text-center profile_img_div overflow-hidden my-2">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="side_profile_img_div w-320">
                                    <img src="../images/<?php echo $session_image; ?>" class="w-280" alt="">
                                </div>
                                <h4 class="std_dash_name"><?php echo $session_student_name; ?></h4>
                                <p class="std_dash_email"><?php echo $session_email; ?></p>
                                <a href="update.php" class="std_profile_setting">Edit profile</a>
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-12 col-sm-12 student_details_div my-2">

                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2 p_sec">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex align-items-center justify-content-between detail_head">
                                            <p>Personal-information</p>
                                            <a href="update.php"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                <h6 class="data_label">Name:</h6>
                                                <p class="actual_data"><?php echo $session_student_name; ?></p>
                                            </div>

                                            <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                <h6 class="data_label">Father-email:</h6>
                                                <p class="actual_data"><?php echo $session_father_email; ?></p>
                                            </div>

                                            <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                <h6 class="data_label">portal-email:</h6>
                                                <p class="actual_data"><?php echo $session_email; ?></p>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                <h6 class="data_label">Father-Name:</h6>
                                                <p class="actual_data"><?php echo $session_father_name; ?></p>
                                            </div>

                                            <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                <h6 class="data_label">Father-contact:</h6>
                                                <p class="actual_data"><?php echo $session_home_contact; ?></p>
                                            </div>

                                            <div class="data_div_01 p-1 my-2 d-flex justify-content-start align-items-center">
                                                <h6 class="data_label">Personal-contact:</h6>
                                                <p class="actual_data"><?php echo $session_student_contact; ?></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12  col-md-12 col-sm-12 mb-2 p_sec">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex align-items-center justify-content-between detail_head">
                                            <p>Academic-details</p>
                                            <a href="update.php"><i class="fa-solid fa-pen-to-square"></i></a>

                                        </div>

                                        <div class="data_div_01 p-1 mt-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">Gender:</h6>
                                            <p class="actual_data"><?php echo $session_gender; ?></p>
                                        </div>

                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">Date-of-birth:</h6>
                                            <p class="actual_data"><?php echo $session_date_of_birth; ?></p>
                                        </div>

                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">Qualification:</h6>
                                            <p class="actual_data"><?php echo $session_qualification; ?></p>
                                        </div>

                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">Emergency-Num:</h6>
                                            <p class="actual_data"><?php echo $session_emergency_contact; ?></p>
                                        </div>
                                        <?php

                                        $country_name = one_col($con, 'country', 'country_sno', $session_std_country);

                                        while ($show_c_data = mysqli_fetch_assoc($country_name)) {
                                            $countryName = $show_c_data['country_name'];
                                            $countryCode = $show_c_data['country_code'];
                                        }
                                        ?>

                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">Country:</h6>
                                            <p class="actual_data"><?php
                                                                    echo  $countryName;
                                                                    ?></p>
                                        </div>

                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">City</h6>
                                           <p class="actual_data"><?php
                                                                     $city_name = one_col($con, 'city', 'city_sno', $session_std_city);
                                                                    while ($showCity = mysqli_fetch_assoc($city_name)) {
                                                                        echo $showCity['city_name'];
                                                                    }

                                                                    ?></p>

                                        </div>
                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">
                                            <h6 class="data_label">Country:</h6>
                                            <p class="actual_data">
                                                <?php
                                                                    echo  $countryCode;
                                                                    ?></p>
                                        </div>


                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 mb-0 p_sec">

                                <div class="container">
                                    <div class="row">

                                        <div class="col-lg-12 d-flex align-items-center justify-content-between detail_head">

                                            <p>Admission-details</p>

                                            <a href="update.php"><i class="fa-solid fa-pen-to-square"></i></a>


                                        </div>

                                        <div class="data_div_01 p-1 mt-1 d-flex justify-content-start align-items-center">

                                            <h6 class="data_label">Course:</h6>

                                             <p class="actual_data">
                                                <?php

                                                $exp_course =  explode(',', $session_course);
                                                $name = '';
                                                foreach ($exp_course as $value) {

                                                    $all_course = one_col($con, 'course', 'Id', $value);

                                                    while ($show_c_slide = mysqli_fetch_assoc($all_course)) {

                                                        $name .=   $show_c_slide['course_name'] . ",";
                                                    }
                                                }
                                                echo rtrim($name, ',');
                                                ?>
                                            </p>

                                        </div>

 
                                        <div class="data_div_01 p-1 my-1 d-flex justify-content-start align-items-center">

                                            <h6 class="data_label">Address:</h6>
                                            <p class="actual_data"><?php echo $session_address; ?></p>
                                        </div>





                                    </div>
                                </div>
                            </div>



                        </div>

                        <?php include('include/footer.php'); ?>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>
</body>

</html>