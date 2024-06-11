<?php
session_start();
require('../connect.php');
if (isset($_SESSION['student_result'])) {
    include('ajax/select_students.php');

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quiz HTML</title>
        <!-- fevi icon -->
   <link rel="apple-touch-icon" sizes="180x180" href="../assets/fevi/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="../assets/fevi/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="../assets/fevi/favicon-16x16.png">
   <link rel="manifest" href="../assets/fevi/site.webmanifest">
   <link rel="mask-icon" href="../assets/fevi/safari-pinned-tab.svg" color="#5bbad5">
   <meta name="msapplication-TileColor" content="#da532c">
   <meta name="theme-color" content="#ffffff">
   <!--===============================================================================================-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Google fonts include -->
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800;900&amp;family=Poppins:wght@700;800&amp;display=swap" rel="stylesheet">
        <!-- Bootstrap-css include -->
        <link rel="stylesheet" href="css/css-bootstrap.min.css">
        <!-- Animate-css include -->
        <link rel="stylesheet" href="css/css-animate.min.css">
        <!-- Main-StyleSheet include -->
        <link rel="stylesheet" href="css/css-style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </head>
    <style>
        .my-form {
            max-width: 56rem;
            min-height: 26rem;
            margin: 20px auto;
            border-radius: 0.625rem;
            background-color: #fff !important;
        }
    </style>

    <body>
        <div class="wrapper overflow-hidden">
            <!-- Top content -->
            <div class="container-fluid">
                <div class="row mt-3 align-items-center">
                    <div class="col-md-3">
                        <div class="logo_area">
                            <a href="index.html">
                                <img src="images/logo-logo.png" width="200px" alt="image-not-found">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center align-items-center">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Student Name:</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><?php echo $student_name; ?></h5>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <h5>Batch Name:</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><?php echo $batch_name; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="../images/<?php echo $student_image ?>" width="80px" height="80px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
            <div class="container">
                <form class="my-form d-flex align-items-center justify-content-center" id="wizard" method="POST" action="query.php">



                    <div class="row text-center">
                        <div class="col-md-12 mb-3">
                            <label class="display-3 text-primary"> YOUR OVERALL SCORE </label>
                        </div>
                        <div class="col-md-12 text-primary mb-3">
                            <h1 class="display-1">
                                <?php
                                if ($_SESSION['student_result'] <= 50) {
                                    echo $_SESSION['student_result'] . "%";
                                    $status = "<label class='text-danger'>FAIL</label>";
                                } else {
                                    echo $_SESSION['student_result'] . "%";
                                    $status = "<label class='text-success'>PASS</label>";
                                }
                                ?>
                            </h1>
                        </div>
                        <div class="col-md-12 mb-4">
                            <h2><?php echo $status; ?></h2>
                        </div>
                        <div class="col-md-12">
                            <input type="button" onclick="window.location='destroyed.php'" name="back_btn" value="Back to Home" class="btn btn-primary">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </body>
    <script>
        localStorage.removeItem('remainingTime', JSON.stringify(selectedOptions));
        localStorage.removeItem('selectedOptions', JSON.stringify(selectedOptions));
    </script>

    </html>
<?php
} else {
    header("location:test.php");
}
?>