<?php
session_start();

// Database connection
include('../connect.php');

if(!isset($_SESSION["teacher_id"])){

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the input data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query the database for the user
    $sql = "SELECT teacher_id, portal_email, portal_password FROM teacher WHERE portal_email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If a user is found, check their password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["portal_password"])) {
            // If the password is correct, start a new session and save the user id
            $_SESSION["loggedin"] = true;
            $_SESSION["teacher_id"] = $user["teacher_id"];
            $_SESSION["portal_email"] = $user["portal_email"];

            // Redirect to the dashboard page
            header("location: dashboard.php");
        } else {
           ?>
							<script>
								window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Wrong Password' ?>&location=<?php echo 'index.php' ?>";
							</script>
						<?php
        }
    } else {
       ?>
							<script>
								window.location = "alert.php?icon=<?php echo 'error' ?>&message=<?php echo 'Data Not Found!' ?>&location=<?php echo 'index.php' ?>";
							</script>
						<?php
    }

    // Close the database conection
    $stmt->close();
    $con->close();
}
}else{
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Teacher-Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<!-- fevi icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../assets/fevi/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../assets/fevi/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/fevi/favicon-16x16.png">
	<link rel="manifest" href="../assets/fevi/site.webmanifest">
	<link rel="mask-icon" href="../assets/fevi/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<!--====================== -->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../form/css/util.css">
	<link rel="stylesheet" type="text/css" href="../form/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background: url('../images/bg.jpg');background-size: cover;background-position: left;">
			<div class="wrap-login100" style="box-shadow: 0px 0px 5px #6a6969;border:1px solid #1176bc">
				<form class="login100-form validate-form" method="post">
					<div class="row mb-4">
						<div class="col-md-12">
							<img src="../images/logo-black2.png" alt="" class="img d-inline-block" style="width:100%">
						</div>
					</div>
					<h4 class="text-center text-primary mb-3">Teacher Portal</h4>
					<div class="wrap-input100 validate-input" data-validate="Valid email is: abc@abc.com">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn text-white" type="submit" name="sub_btn">
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="../form/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="../form/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="../form/vendor/bootstrap/js/popper.js"></script>
	<script src="../form/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="../form/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="../form/vendor/daterangepicker/moment.min.js"></script>
	<script src="../form/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="../form/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="../form/js/main.js"></script>

</body>

</html>