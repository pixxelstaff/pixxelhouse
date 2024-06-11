<?php
session_start();
if (isset($_SESSION['finance_manager_login'])) {
	header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
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
	<link rel="stylesheet" href="../assets/css/pop.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background: url('../images/bg.jpg');background-size: cover;background-position: left;">
			<div class="wrap-login100" style="box-shadow: 0px 0px 5px #6a6969;border:1px solid #1176bc">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						<img src="../images/logo-black.png" alt="" class="img img-fluid">
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
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
				<?php
				if (isset($_POST['sub_btn'])) {
					require('include/connect.php');
					$raw_email = $_POST['email'];
					$raw_password = $_POST['pass'];
					$email = mysqli_real_escape_string($con, $raw_email);
					$password = mysqli_real_escape_string($con, $raw_password);
					$query = "SELECT * FROM `main_admin` WHERE `email`=?";

					$stmt = mysqli_prepare($con, $query);
					mysqli_stmt_bind_param($stmt, "s", $email);
					mysqli_stmt_execute($stmt);

					// Get the result
					$result = mysqli_stmt_get_result($stmt);

					if ($result) {
						// Fetch the user data
						$user = mysqli_fetch_assoc($result);

						if ($user && password_verify($password, $user['password'])) {
							$_SESSION['finance_manager_login'] = $email;
				?>
							<script>
								window.location = 'dashboard.php';
							</script>
						<?php
						} else {
						?>
							<script>
								window.location = "?error=true";
							</script>
						<?php
						}
					} else {
						?>
						<script>
							window.location = "?error=true";
						</script>
				<?php
					}

					// Close the statement
					mysqli_stmt_close($stmt);

					// Close the database connection
					mysqli_close($con);
				}
				?>
			</div>
		</div>
	</div>
	<div class="row1-pop ">
		<div class="pop-parent">
			<div class="pop-div">
				<h2>Oops! you enter wrong details</h2>
				<div class="err-div">
					<img src="finance/wrong-01.png" alt="">
				</div>
				<div class="button">
					<a href="index.php" class="confirm_button">Try Again</a>
				</div>
			</div>
		</div>
	</div>


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

<?php
if(isset($_GET['error'])){
	?>
	<script>
		window.addEventListener('DOMContentLoaded', () => {
			let popop = document.querySelector('.row1-pop');
				popop.style.display = 'inline-block';
				setTimeout(() => {
					popop.querySelector('.pop-parent').classList.add('active-pop')
				}, 50)
		})
	</script>
	<?php
}
?>

</body>

</html>