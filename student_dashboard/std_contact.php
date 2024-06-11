<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>student Dashboard</title>

    <?php

    include('include/links.php');

    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

                <!--  Row 1 -->


                <!-- row2 -->
                <div class="container">

                    <div class="row iph_pag_row1">
                        <div class="col-lg-8 col-md-6 col-sm-12 p-2">
                            <h2 class="std_name">Contact Us <span><?php echo $session_student_name; ?></span></h2>
                            <p class="gen_msg">"Have any questions or concerns? Reach out to us - we're here to help!"</p>
                            <a href="courses.php" class="en_btn">More Courses</a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 iph_row_img_div text-center">
                            <img src="../images/sm-png.png" class="w-60">
                        </div>

                    </div>

                    <div class="row justify-content-center std_contact_row2">

                        <h2 class="std_p_contact_head text-center">Query Us</h2>

                        <span class="h2_spacer"></span>

                        <!-- <div class="w-100 d-flex justify-content-center">

                         </div> -->

                        <div class="col-lg-9 col-md-10 col-sm-12 text-center">
                            <div class="container">
                                <div class="row">
                                    <form method="post">
                                        <div class="col-12 my-1 ">
                                            <label for="" class="query_label">Subject :</label>
                                            <input type="text" class="std_con_inp" placeholder="your Subject" name="std_subject" id="">

                                        </div>
                                        <div class="col-12 my-1 ">
                                            <label for="" class="query_label">Select batch :</label>
                                            <select name="std_batch_id" id="batch_sel" class="std_con_inp">
                                                <option value="">select</option>
                                                <?php

                                                $exp_batch = explode(',', $session_batch);

                                                foreach ($exp_batch as $bh_value) {

                                                    if (count($exp_batch) < 2) {
                                                ?>
                                                        <option value="<?php echo $bh_value; ?>" selected>
                                                            <?php
                                                            $btn = batch_table_name($con, $bh_value);
                                                            echo $btn;
                                                            ?>
                                                        </option>

                                                    <?php

                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $bh_value; ?>">
                                                            <?php
                                                            $btn = batch_table_name($con, $bh_value);
                                                            echo $btn;
                                                            ?>
                                                        </option>
                                                <?php

                                                    }
                                                }

                                                ?>

                                            </select>
                                        </div>
                                        <div class="col-12 my-1 ">
                                            <label for="" class="query_label">Select query person :</label>
                                            <select name="reciever" id="reciever_name" class="std_con_inp">
                                                <option value="">select</option>
                                                <?php
                                                foreach ($exp_batch as  $value2) {

                                                    if (count($exp_batch) < 2) {
                                                        $teacher_name = "SELECT `teacher`.`teacher_name`,`teacher`.`teacher_id` FROM `batch` JOIN `teacher` ON `teacher`.`teacher_id` = `batch`.`teacher` WHERE `batch`.`batch_id` = '$value2'";

                                                        $teacher_name_query = mysqli_query($con, $teacher_name);

                                                        if ($teacher_name_query) {
                                                            while ($show_tn = mysqli_fetch_assoc($teacher_name_query)) {
                                                ?>
                                                                <option value="<?php echo $show_tn['teacher_id']; ?>" selected><?php echo $show_tn['teacher_name']; ?></option>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                }



                                                ?>


                                            </select>
                                        </div>
                                        <div class="col-12 my-1 ">
                                            <label for="" class="query_label">Your message :</label>
                                            <textarea name="std_query" class="std_con_inp con_txt_area" id="" rows="5" placeholder="write your msg here"></textarea>
                                        </div>
                                        <input type="submit" class="std_con_inp std_con_sub_btn" name="query_sub" value="submit">

                                    </form>

                                    <?php
                                    if (isset($_POST['query_sub'])) {
                                        $batch_id = $_POST['std_batch_id'];
                                        $subject = $_POST['std_subject'];
                                        $message = $_POST['std_query'];
                                        $reciever = $_POST['reciever'];
                                        $date = date("d-m-Y");

                                        if (!empty($subject) && !empty($batch_id) && !empty($message)) {
                                            // Create a prepared statement
                                            $insert_msg_query = mysqli_prepare($con, "INSERT INTO `query` (`name`, `email`, `batch`, `subject`, `msg`, `message_status`,`date`) VALUES (?, ?, ?, ?, ?, ?,?)");

                                            // Check if the prepared statement was created successfully
                                            if ($insert_msg_query) {
                                                // Bind parameters to the prepared statement
                                                mysqli_stmt_bind_param($insert_msg_query, "sssssss", $session_student_name, $session_email, $batch_id, $subject, $message, $reciever,$date);

                                                // Execute the prepared statement
                                                if (mysqli_stmt_execute($insert_msg_query)) {
                                    ?>
                                                    <script>
                                                        window.location = "../functions/alert.php?icon=<?php echo 'success' ?>&message=<?php echo 'Thanku for contacting us we will respond u quickly' ?>&location=<?php echo '../student_dashboard/dashboard.php'; ?>";
                                                    </script>
                                            <?php
                                                } else {
                                                    echo "<script>alert(Error executing prepared statement: " . mysqli_error($con) . ")</script>";
                                                }

                                                // Close the prepared statement
                                                mysqli_stmt_close($insert_msg_query);
                                            } else {
                                                echo "Error creating prepared statement: " . mysqli_error($con);
                                            }
                                        } else {
                                            ?>
                                            <script>
                                                alert("Fill complete information");
                                            </script>
                                    <?php
                                        }
                                    }


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('include/javascript.php'); ?>

    <script>
        $('#batch_sel').on('change', function() {
            $.ajax({
                url: 'teacher_name.php',
                type: 'POST',
                data: {
                    batch: $(this).val()
                },
                success: function(data) {
                    $('#reciever_name').empty();
                    $('#reciever_name').append(`<option value="">Select</option>`)
                    if (data) {

                        $('#reciever_name').append(`<option value="Admin">Admin</option>`)
                        $('#reciever_name').append(`<option value="${data}">${data}</option>`)

                    }
                },
                error: function() {
                    console.log('error')
                }
            })
        });
    </script>
</body>

</html>