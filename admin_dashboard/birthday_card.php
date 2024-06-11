<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth day card</title>
    <!-- <?php // include('include/links.php');
            include('include/connect.php');
            include('../functions/function.php');
            ?> -->

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <!-- css file-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="../assets/css/birthday_style.css" type="text/css">
    <!-- js file -->
    <script src="../assets/js/confetti.js" defer></script>
    <script src="../assets/js/logic.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<?php
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $student_data_p = mysqli_prepare($con, "SELECT * FROM `students` WHERE `sno` = ?");
    mysqli_stmt_bind_param($student_data_p, 's', $student_id);
    if (mysqli_stmt_execute($student_data_p)) {
        $result = mysqli_stmt_get_result($student_data_p);
        while ($data = mysqli_fetch_assoc($result)) {
            $name = $data['student_name'];
            $gender = $data['gender'];
            $batch = $data['batch'];
            $explode_batch = explode(',', $batch); // checking if it has two or more batches//
            $batchName = '';
            foreach ($explode_batch as $value) {
                $fetchBatchName = mysqli_query($con, "SELECT * FROM `batch` WHERE `batch_id` = '$value' ");
                while ($bN = mysqli_fetch_assoc($fetchBatchName)) {
                    $batchName .= $bN['batch_name'] . ",";
                }
            }
        }
    }
    $combine_batch_name =  trim($batchName, ',');
}
?>

<body>

    <div class="custom_container">
        <div class="birthday-card" id="b-card">
            <!-- circle div  -->
            <div class="circle-div">
                <div class="circle-1">
                    <div class="circle-2">

                    </div>
                </div>
            </div>
            <!-- bar -->
            <div class="rect-bar"></div>
            <div class="birthday-message-image">
                <img src="../assets/images/bd1.png" alt="">
            </div>
            <!-- image for student -->
            <div class="image-div">

                <img src="<?php echo $gender == 'Male' ? '../assets/images/boy11.png' : '../assets/images/girl.png' ?>" alt="">

            </div>
            <div class="naming-div">
                <h4><?php echo $name; ?></h4>
                <p><?php echo $combine_batch_name; ?></p>
            </div>
            <div class="birthday-message">
                <p>We wish you a very happy birthday.
                    May ALLAH bless you with happiness
                    and you success</p>
            </div>
            <!-- bottom content div -->
            <div class="content-div">
                <div class="post-logo-div">
                    <img src="../assets/images/logo.svg" alt="">
                </div>
                <div class="contact-div">
                    <div class="contact-icon-div">
                        <span><i class="fa-solid fa-address-book"></i></span>
                    </div>
                    <div class="contact-number-div">
                        <p>03353253513</p>
                        <p>0223821470</p>
                    </div>
                </div>
                <div class="info-div">
                    <p class="info-p">
                        <span><i class="fa-brands fa-skype"></i></span>
                        pixxel.house
                    </p>
                    <p class="info-p">
                        <span><i class="fa-brands fa-google-plus"></i></span>
                        pixxel.house2004@gmail.com
                    </p>
                </div>
            </div>

        </div>
        <div class="button_div">
            <a href="javascript:void(0)" class="act-btn" id="bck-btn"><i class="fa-solid fa-backward"></i></a>
            <a href="javascript:void(0)" class="act-btn" id="cap-image-btn"><i class="fa-solid fa-camera"></i></a>
        </div>
    </div>

</body>

</html>