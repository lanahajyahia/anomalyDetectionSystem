<?php
// session_start();
include('registration-functions.php');
if (isset($_SESSION["captcha-show"])) {
	if ($_SESSION["captcha-show"] > 2) {
		// unset($_SESSION["captcha-show"]);
		echo '<style type="text/css">
	.elem-group {
		display: block !important;
	}
	</style>';
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Log In</title>
	<!-- <link href="admin/css/sb-admin-2.min.css" rel="stylesheet"> -->

	<link rel="stylesheet" type="text/css" href="admin/css/register-style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<style>
		.forgot-pass {
			color: #7596c8;
			font-family: 'Roboto-Regular', 'Helvetica', 'sans-serif';
			font-size: 14px;
			line-height: 16px;
			text-decoration: none;
		}

		footer.sticky-footer {
			padding: 2rem 0;
			flex-shrink: 0
		}

		.bg-white {
			background-color: #fff !important
		}

		.my-auto {
			margin-bottom: auto !important
		}

		.my-auto {
			margin-top: auto !important
		}

		footer.sticky-footer .copyright {
			line-height: 1;
			font-size: .8rem
		}
	</style>
</head>

<body class="login">
	<div class="_8esk">
		<div class="_8esl">
			<div class="_8ice">
				<h1 style="font-family: 'Trebuchet MS', sans-serif;">
					Anomaly Detection System</h1>
			</div>
			<h2 style="font-family: 'Trebuchet MS', sans-serif;" class="login-text">Secure your web applications from Cross-site scripting and SQL injections.</h2>
		</div>
		<div class="formdiv">
			<form method="post" action="login.php">

				<?php echo display_error(); ?>

				<div class="input-group">
					<input type="text" name="username" placeholder="Username or Email">
				</div>
				<div class="input-group">
					<input type="password" name="password" placeholder="Password">
				</div>
				<div class="elem-group" style="display: none">

					<img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fa fa-refresh fa_custom fa-2x"></i>
					<br>
					<input type="text" id="captcha" name="captcha_challenge" pattern="[A-Z1-9]{6}">
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="login_btn">Log In</button>
				</div>

				<p>
					<a class="forgot-pass" href="forgotpassword.php">Forgot Password?</a>
				</p>
			</form>
		</div>
	</div>

	<?php
	include('admin/includes/scripts.php');
	include('admin/includes/footer.php'); ?>

</html>
<script>
	var refreshButton = document.querySelector(".fa-refresh");
	refreshButton.onclick = function() {
		document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
	}
</script>