<?php include('registration-functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="styles/register-style.css">
</head>
<body class="login">
<div class="_8esk">
<div class="_8esl">
<div class="_8ice">
	<h1>
Anomaly Detection System</h1></div>
<h2 class="_8eso">Secure your web applications from XSS and SQL injections.</h2></div>
<div class="formdiv">
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<input type="text" name="username" placeholder="Username or Email">
		</div>
		<div class="input-group">
			<input type="password" name="password" placeholder="Password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Log In</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
	</div>
	</div>
</body>
</html>