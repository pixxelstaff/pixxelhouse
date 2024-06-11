<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixxelHouse || Teacher Rating</title>

    <?php
    include('connect.php');
    include('student_dashboard/include/function.php');
    ?>
    <!-- custom css -->

    <link rel="stylesheet" href="assets/css/index_page.css" type="text/css">

    <!-- boostarp and fontawesome css -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- jquery cdns -->

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <!-- boostarp and fontawesome js -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- custom js -->

    <script src="assets/js/rating.js" type="text/javascript" defer></script>

    <!-- google font link -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">




</head>

<body>


    <div class="container-fluid form_row1 py-2">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10 col-md-12 col-sm-12 text-center d-flex flex-column justify-content-center">

                    <div class="col-12 p_title_div my-2 p-1 text-center">

                        <h2 class="iph_form_head">Teacher Review</h2>

                        <a href="#" class="bck_btn"><i class="fa-solid fa-angle-left"></i></a>

                    </div>

                    <div class="iph_spacer my-2"></div>

                    <div class=" w-100 d-flex justify-content-center my-2">

                        <div class="col-lg-8 col-md-12 col-sm-12 my-2 py-2">

                            <h2 class="iph_form_head my-4">Ask About Our Teacher!</h2>

                            <form action="" method="post" id="tr_from">

                                <div class="iph_inp_div my-2">

                                    <div class="iph_half_inp">
                                        <input type="text" name="u_name" id="tr_user_name" class="iph_inp_field  " placeholder="User Name:">
                                        <p class="error-msg "></p>
                                    </div>
                                    <div class="iph_half_inp">
                                        <input type="text" name="u_email" id="tr_email" class="iph_inp_field  " placeholder="Email:">
                                        <p class="error-msg"></p>
                                    </div>

                                </div>

                                 <div class="iph_inp_div flex-nowrap my-2">

                                    <select name="teacher_name" id="tr_sel_class" class="iph_inp_field ">
                                        <option value="">Select Teacher</option>

                                        <?php
                                        $all_teacher = "SELECT `teacher_id`,`teacher_name` FROM `teacher`";

                                        $all_teacher_query = mysqli_query($con, $all_teacher);

                                        if ($all_teacher_query) {
                                            while ($teach = mysqli_fetch_assoc($all_teacher_query)) {
                                        ?>
                                                <option value="<?php echo $teach['teacher_id']; ?>"><?php echo $teach['teacher_name']; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>

                                    <p class="error-msg"></p>



                                </div>

                                <div class="iph_inp_div my-2">
                                    <div class="rev_div">
                                        <textarea name="review" id="std_review" rows="2" class="iph_inp_field form-control" placeholder="Comments in (words)"></textarea>
                                        <p class="error-msg"></p>
                                    </div>

                                </div>


                                <div class="col-lg-12 rt_div my-2">
                                    <p class="rev_head">
                                        Reviews:
                                    </p>
                                    <div class="rating">
                                        <span class="rating-star" rate="1"><i class="fa-solid fas fa-star"></i></span>
                                        <span class="rating-star" rate="2"><i class="fa-solid fas fa-star"></i></span>
                                        <span class="rating-star" rate="3"><i class="fa-solid fas fa-star"></i></span>
                                        <span class="rating-star" rate="4"><i class="fa-solid fas fa-star"></i></span>
                                        <span class="rating-star" rate="5"><i class="fa-solid fas fa-star"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="rating_value_taker iph_inp_field" id="rating" value="" name="rate" hidden>
                                    <p class="error-msg"></p>
                                </div>

                                <input type="submit" name="rat_sub" class="iph_form_sub my-2" value="submit">
                            </form>



                        </div>

                    </div>

                    <div class="iph_spacer my-3"></div>

                    <div class="col-lg-12 d-flex justify-content-around my-1 px-2 py-2">
                        <a href="index.php" class="form_links">admission-form</a>
                        <a href="teacher-rating.php" class="form_links">Teacher Review</a>
                    </div>

                </div>




            </div>

        </div>
    </div>




    <!-- error div -->

    <div class="error_popup">
        <div class="error_div">
            <div class="e_img_div">
                <img src="images/error.gif" alt="">
            </div>
            <h6 class="error_h">please fill the fields properly.</h6>
            <p class="error_p"> provide complete and original detail.avoid use of special characters and unnecessary
                spaces </p>
            <span class="err_close_popup"><i class="fa-solid fa-circle-xmark"></i></span>
        </div>
    </div>

    <!-- success-div -->

    <div class="success_popup">
        <div class="success_div">
            <div class="s_img_div">
                <img src="images/teach.gif" alt="">
            </div>
            <h6 class="success_h">The review has submitted.</h6>
            <p class="success_p"> Thanks for u review it helps us to make thing more better</p>
            <span class="suc_close_popup"><i class="fa-solid fa-circle-xmark"></i></span>
        </div>
    </div>

    <?php

    if (isset($_POST['rat_sub'])) {

         $user_name = mine_sanitize_string($_POST['u_name']);
        $user_email = mine_sanitize_string($_POST['u_email']);
        $teacher_opt = mine_sanitize_string($_POST['teacher_name']);
        $act_date = date('d-m-Y');
        $review = mine_sanitize_string($_POST['review']);
        $rating = mine_sanitize_string($_POST['rate']);


        if (
            !empty($user_name) &&
            !empty($user_email) &&
            !empty($teacher_opt) &&
            !empty($review) &&
            !empty($rating)
        ) {

            $prepare_q = "INSERT INTO `rating`( `name`, `email`, `teacher_name`, `date`, `review`, `rating`) VALUES (?,?,?,?,?,?)";

            $stmt = mysqli_prepare($con, $prepare_q);

            mysqli_stmt_bind_param($stmt, 'ssssss', $user_name, $user_email, $teacher_opt, $act_date, $review, $rating);

            $insert_teacher_review_query = mysqli_stmt_execute($stmt);

            if ($insert_teacher_review_query) {
                $to = $user_email;
                $subject = "Teacher Rating Feedback!";
                $host_email = 'pixxel@prepwings.com';
                $head = "From: $host_email" . "\r\n";
                $head .= "Reply-To: $host_email" . "\r\n";
                $head .= implode("\r\n", [
                    "MIME-Version: 1.0",
                    "Content-type: text/html; charset=utf-8"
                ]);
                ob_start();
                $html = "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<style type='text/css'>
/* CSS styles go here */
body {
background-color: #f2f2f2;
font-family: Arial, sans-serif;
font-size: 14px;
line-height: 1.5;
color: #333333;
margin: 0;
padding: 0;
}
.container {
max-width: 600px;
margin: 0 auto;
padding: 20px;
}
h1 {
font-size: 28px;
margin-bottom: 20px;
text-align: center;
}
p {
margin-bottom: 20px;
}
.button {
display: inline-block;
background-color: #007bff;
color: #ffffff;
text-decoration: none;
padding: 10px 20px;
border-radius: 5px;
margin-bottom: 20px;
}
.button:hover {
background-color: #0056b3;
}
</style>
</head>
<body>
<div class='container'>
<img src='http://pixxel.prepwings.com/images/logo-black2.png' width='100%'>

<p>Dear $user_email,</p>
<p>Thank you for providing teacher ratings for your recent experience at Pixxel House. Your feedback is essential in helping us maintain the quality of our education.</p>

<p>We appreciate your input and will use it to enhance our teaching standards. Your feedback is confidential and will be used solely for improvement purposes.<br>
<br>
If you have more feedback to share, please don't hesitate to reach out. We value your perspective.</p>

<p>Best regards,<br>
   Team Pixxel House<br>
Institute of Pixxel House<br>
</p>
</div>
</body>
</html>

";

                ob_end_clean();
                $mailresult = mail($to, $subject, $html, $head);
    ?>
                <script>
                    window.location = "functions/alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'your review is upload successfully' ?>&location=<?php echo '../teacher-rating.php'; ?>";
                </script>
            <?php


            } else {
            ?>
                <script>
                    window.location = "functions/alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'something wwent wrong' ?>&location=<?php echo '../teacher-rating.php'; ?>";
                </script>
    <?php
            }
        }
    }
    ?>


</body>

</html>