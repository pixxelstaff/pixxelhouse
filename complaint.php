<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixxelHouse || complaint</title>

    <!-- custom css -->

    <?php
    include('connect.php');
    include('student_dashboard/include/function.php');

    ?>
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

    <!-- <script src="assets/js/index_page.js" type="module" defer></script> -->
    <script src="assets/js/complain.js" type="module" defer></script>

    <!-- google font link -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

</head>

<body>

    <div class="container-fluid form_row1 py-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-sm-12 text-center d-flex flex-column justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 p_title_div my-2 p-1 text-center">
                        <h2 class="iph_form_head">Complain Box</h2>
                        <a class="bck_btn"><i class="fa-solid fa-angle-left"></i></a>
                    </div>
                    <div class="iph_spacer my-2"></div>
                    <div class="d-flex w-100 justify-content-center my-2">
                        <div class="col-lg-8 col-md-12 col-sm-12 my-2 py-2">
                            <h2 class="iph_form_head my-4">What you Think About us!</h2>
                            <form action="" method="post" id="complain-form">
                                <div class="iph_inp_div my-2">
                                    <div class="iph_half_inp">
                                        <input type="text" name="u_name" id="c_user_name" class="iph_inp_field  " placeholder="User Name:">
                                        <p class="error-msg text-right"></p>
                                    </div>
                                    <div class="iph_half_inp">
                                        <input type="text" name="u_email" id="c_email" class="iph_inp_field  " placeholder="Email:">
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="iph_inp_div my-2">
                                    <div class="rev_div">
                                        <select name="complain_opt" id="rev_com" class="iph_inp_field ">
                                            <option value="">Select (Review or Complain)</option>
                                            <option value="Review">Review</option>
                                            <option value="Complain">Complain</option>
                                        </select>
                                        <p class="error-msg"></p>
                                    </div>
                                </div>
                                <div class="iph_inp_div my-2">
                                    <div class="rev_div">
                                        <textarea name="complain" id="user_review" rows="2" class="iph_inp_field form-control" placeholder="Comments in (words)"></textarea>
                                        <p class="error-msg "></p>
                                    </div>
                                </div>
                                <input type="submit" name="complain_sub_btn" class="iph_form_sub my-2" value="submit">
                            </form>
                        </div>
                    </div>
                    <div class="iph_spacer my-3"></div>
                    <div class="col-lg-12 d-flex justify-content-around my-1 px-2 py-2">
                        <a href="index.php" class="form_links">Admission Form</a>
                        <a href="teacher-rating.php" class="form_links">Teacher Review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php

    if (isset($_POST['complain_sub_btn'])) {

        $user_name = mine_sanitize_string($_POST['u_name']);
        $user_email = mine_sanitize_string($_POST['u_email']);
        $complain_opt = mine_sanitize_string($_POST['complain_opt']);
        $complain = mine_sanitize_string($_POST['complain']);
        $date = date('d-M-Y');


        if (!empty($user_name) && !empty($user_email) && !empty($complain_opt) && !empty($complain)) {


            $ins_complain = "INSERT INTO `complain`( `name`, `email`, `complain_status`, `message`, `date`) VALUES (?,?,?,?,?)";

            $ins_complain_prepare = mysqli_prepare($con, $ins_complain);

            // $ins_complain_bind_param = mysqli_

            mysqli_stmt_bind_param($ins_complain_prepare, 'sssss', $user_name, $user_email, $complain_opt, $complain, $date);

            $ins_complain_query = mysqli_stmt_execute($ins_complain_prepare);
            if ($ins_complain_query) {

                $to = $user_email;
                $subject = "Your Complaint/Review are received!";
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
<p>I hope this email finds you well. We have received your recent complaint/review regarding your experience with Pixxel House, and I want to personally thank you for taking the time to share your feedback with us. We take all feedback seriously and consider it a valuable resource for improving our services.</p>

<p>Your feedback is instrumental in helping us identify areas for improvement, and we are grateful for your input. We are committed to creating a positive learning environment at Pixxel House, and your feedback will be used to guide our efforts in that direction.

If you have any additional information or specific concerns that you would like to share, please do not hesitate to Visit Us, and I will personally ensure that your concerns are addressed promptly.

Once again, thank you for your feedback, and we appreciate your continued support of Pixxel House. We are dedicated to making your experience with us a positive and enriching one.

Sincerely</p>

<p>Team Pixxel House<br>
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
                    window.location = "functions/alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Your Complaint/Review Submitted!' ?>&location=<?php echo '../complaint.php'; ?>";
                </script>
            <?php
            } else {
            ?>
                <script>
                    window.location = "functions/alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Something Went Wrong!' ?>&location=<?php echo '../complaint.php'; ?>";
                </script>
    <?php
            }
        }
    }

    ?>

</body>

</html>