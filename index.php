<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
    <base href="http://pixxel.prepwings.com/index.php">
   <!-- fevi icon -->
<link rel="apple-touch-icon" sizes="180x180" href="assets/fevi/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/fevi/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/fevi/favicon-16x16.png">
<link rel="manifest" href="assets/fevi/site.webmanifest">
<link rel="mask-icon" href="assets/fevi/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!--<link rel="icon" type="image/x-icon" href="assets/fevi/favicon-32x32.png">-->
<!--====================== -->
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- custom css -->
    <!--<link rel="stylesheet" href="pixxel.prepwings.com/assets/css/index_page.css" type="text/css">-->
    <link rel="stylesheet" href="assets/css/index_page.css" type="text/css">



    <!-- bootstrap and fontawesome css -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- jquery cdns -->

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- bootstrap and fontawesome js -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- custom js -->

    <script src="assets/js/index_page.js" type="text/javascript" defer></script>


</head>

<body>

    <div class="container-fluid form_row1 py-1">
        <div class="container">
            <form action="functions/form_query.php" method="post" id="my-form" enctype="multipart/form-data">
                <div class="row" id="iph_from_row">

                    <div class="col-lg-6 col-md-12 col-sm-12 form_row1_col1 py-1">

                        <div class="col-lg-12">

                            <h4 class="iph_form_head">
                                Personal Details:
                            </h4>

                            <div class="iph_inp_div">
                                <div class="iph_half_inp">
                                    <input type="text" name="student_name" id="std-name-f" class="iph_inp_field" placeholder="Full Name">
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_half_inp">
                                    <input type="text" name="father_name" id="f-name" class="iph_inp_field  " placeholder="Father/Guardian Name">
                                    <p class="error-msg" tabindex="1"></p>
                                </div>

                            </div>

                            <div class="iph_inp_div">
                                <div class="iph_half_inp">
                                    <input type="email" name="std_email" id="email" class="iph_inp_field" placeholder="Email">
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_half_inp">
                                    <input type="email" name="std_father_email" id="f-email" class="iph_inp_field" placeholder="Father/Guardian Email">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="iph_inp_div">
                                <div class="iph_half_inp">
                                    <select name="country" id="country" class="iph_inp_field">
                                        <option value="">Select Country</option>
                                        <?php
                                        $country = "SELECT * FROM `country`";
                                        $country_query = mysqli_query($con, $country);
                                        if ($country_query) {
                                            while ($country_opt = mysqli_fetch_assoc($country_query)) {
                                                if ($country_opt['country_sno'] == '1') {
                                        ?>
                                                    <option value="<?php echo $country_opt['country_sno']; ?>" selected><?php echo $country_opt['country_name']; ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?php echo $country_opt['country_sno']; ?>"><?php echo $country_opt['country_name']; ?></option>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>
                                    </select>
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_half_inp">
                                    <select name="city" id="city" class="iph_inp_field">
                                        <option value="">Select City</option>
                                    </select>
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="iph_inp_div">
                                <div class="iph_half_inp justify-content-between flex-wrap d-flex  ">
                                    <input type="text" name="country_code" size="2" class="country_code" value="" title="Please enter exactly 2 characters" readonly>

                                    <input type="tel" name="std_num" id="s-p-num" class="iph_inp_field" placeholder="Personal Contact">
                                    <p class="error-msg "></p>
                                </div>

                                <div class="iph_half_inp justify-content-between flex-wrap d-flex  ">
                                <input type="text" name="" size="2" class="country_code" value="" title="Please enter exactly 2 characters" readonly>

                                    <input type="tel" name="std_father_contact" id="f-contact" class="iph_inp_field" placeholder="Father/Guardian Contact">
                                    <p class="error-msg"></p>
                                </div>
                            </div>

                            <div class="iph_inp_div">
                                <div class="iph_half_inp label_div">
                                    <input type="date" name="form_date" placeholder="date of birth" id="s-date" class="iph_inp_field">
                                    <span class="dob">D.O.B</span>
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_half_inp">
                                    <select name="std_gender" id="std-gender-sel" class="iph_inp_field">
                                        <option value="" selected>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <p class="error-msg"></p>
                                </div>
                            </div>

                            <div class="iph_inp_div">

                                <div class="iph_half_inp">
                                    <!--<input type="text" name="std_qualification" id="s-qualification" class="iph_inp_field" placeholder="Qualification:">-->
                                    <select name="std_qualification" id="s-qualification" class="iph_inp_field">
                                        <option value=''>Select Qualification</option>
                                        <option value='8th Class'>8th Class</option>
                                        <option value='Matric (10th)'>Matric (10th)</option>
                                        <option value='Enter (12th)'>Enter (12th)</option>
                                        <option value='Graduation (14 years)'>Graduation (14 years)</option>
                                        <option value='Graduation (16 years)'>Graduation (16 years)</option>
                                        <option value='Masters'>Masters</option>
                                    </select>
                                    <p class="error-msg"></p>
                                </div>

                                <div class="iph_half_inp justify-content-between flex-wrap d-flex  ">
                                <input type="text" name="" size="2" class="country_code" value="" title="Please enter exactly 2 characters" readonly>

                                    <input type="tel" name="emergency_num" id="s-e-num" class="iph_inp_field" placeholder="Emergency Contact">
                                    <p class="error-msg"></p>
                                </div>
                            </div>


                            <div class="iph_inp_div">
                                <div class="d-block w-100">
                                    <textarea name="std_address" id="s-address" rows="2" class="iph_inp_field" placeholder="address"></textarea>
                                    <p class="error-msg"></p>
                                </div>
                            </div>



                        </div>

                        <div class="col-lg-12 mt-2">
                            <h4 class="iph_form_head">
                                Details Related To Admission:
                            </h4>
                            <div class="iph_inp_div">
                                <div class="iph_semi_half_inp">
                                    <select name="std_wanted_course" id="std-course-sel" class="iph_inp_field ">
                                        <option value="">Courses</option>
                                        <?php

                                        require('student_dashboard/include/function.php');
                                     $courses =  all_data_func($con, 'course');

                                        while ($cr = mysqli_fetch_assoc($courses)) {

                                        ?>
                                            <option value="<?php echo $cr['Id']; ?>"><?php echo $cr['course_name']; ?></option> <?php
                                                                                                                            }
                                                                                                                            ?>


                                    </select>
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_semi_half_inp">

                                    <select name="std_wanted_day_slot" id="std-day-sel" class="iph_inp_field ">
                                        <option value="">Days</option>
                                        <option value="MWF">MWF (Mon-Wed-Fri)</option>
                                        <option value="TTS">TTS (Tues-Thus-Sat)</option>
                                    </select>
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_semi_half_inp">
                                    <select name="time" id="std-time-sel" class="iph_inp_field ">
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
                                    <p class="error-msg"></p>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h4 class="iph_form_head">
                                Declaration:
                            </h4>

                            <ol class="iph_imp_p_ol">
                                <li>That The Particulars Filled In The Above Form Are True To The Best Of My Knowledge & I shall Be Responsible For Any Miss Statement There In.</li>
                                <li>That I shall Confirm To The Rules, Regulations & Conditions Of Admission & Post Admission tenure. </li>
                            </ol>

                        </div>

                        <div class="col-lg-12 mt-2">
                            <div class="iph_inp_div">

                                <div class="iph_half_inp">
                                    <div class="w-100 d-flex align-items-center  ">
                                        <input type="checkbox" name="std_apply_admission" id="app-add-chk" class="chk_btn iph_inp_field" value="yes">
                                        <h2 class="chk_heading">Apply Admission</h2>
                                    </div>
                                    <p class="error-msg"></p>
                                </div>
                                <div class="iph_half_inp ">
                                    <div class="w-100 d-flex align-items-center  ">
                                        <input type="checkbox" name="std_parent_permission" id="p-per-chk" class="chk_btn iph_inp_field" value="yes">
                                        <h2 class="chk_heading">Parents Permission</h2>
                                    </div>
                                    <p class="error-msg"></p>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <h4 class="iph_form_head">
                                Note:
                            </h4>
                            <p class="iph_imp_p">
                                The Administration reserves the right to make at any time changes & addition to the
                                program/course regulations & conditions governing the conduct of students.
                            </p>

                        </div>

                        <div class="iph_spacer my-3"></div>

                        <div class="col-lg-12 mt-1">
                            <div class="w-100 d-flex align-items-center  ">
                                <input type="checkbox" name="std_admission_policy" id="acc-all" class="chk_btn ex-parent iph_inp_field" value="yes">
                                <h2 class="chk_heading">I Accept all <span class="iph_blue">Terms & Conditions</span>
                                </h2>
                            </div>
                            <p class="error-msg"></p>
                        </div>

                        <div class="col-lg-12 mt-3">

                            <input type="submit" name="iph_course_form" class="iph_form_sub" id="std_form_sub_btn" value="submit">
                        </div>


                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 form_row1_col2 py-3 text-center">

                        <h3 class="iph_blue form_row1_col2_h3">ADMISSION FORM</h3>

                        <h5 class="text-center form_row1_col2_h5">We Build Professionals</h5>

                        <div class="iph_spacer my-2"></div>

                        <div class="col-lg-12 iph_logo_div text-center">

                            <img src="./images/logo.svg" alt="">

                        </div>

                        <div class="iph_spacer my-2"></div>



                        <div class="upload_img_div mt-4">
                            <input type="file" name="std_profile_img" class="iph_inp_field " id="iph_file_field" hidden>
                            <label for="iph_file_field" class="iph_inp_label">Upload <br> Image</label>
                            <img src="" class="iph_uploaded_img  " alt="">

                        </div>
                        <p class="error-msg py-3 " id="file-error"></p>

                        <a class="upload_img_close_btn ">change image</a>

                        <h2 class="form_row1_col2_h3 iph_blue mt-4" id="std_name_head">Your name xyz</h2>

                        <h5 class="form_row1_col2_h5" id="std_dis_course">Your course</h5>

                        <div class="iph_spacer my-2"></div>

                        <!-- <div class="col-lg-12 d-flex justify-content-around my-2 px-2 py-3">
                            <a href="complaint.php" class="form_links">Complain</a>
                            <a href="teacher-rating.php" class="form_links">Teacher Review</a>
                        </div> -->

                    </div>


                </div>
            </form>
        </div>
    </div>





    <script src="assets/js/country.js"></script>
    <script>
            document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});
window.addEventListener('keydown', function (e) {
    if (e.key === 'F12' || e.keyCode === 123) {
        e.preventDefault();
    }
});
window.addEventListener('keydown', function (e) {
    if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'I') {
        e.preventDefault();
    }
});
window.addEventListener('keydown', function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
        e.preventDefault();
    }
});

    </script>
    
</body>

</html>