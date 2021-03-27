<?php include('registration-functions.php') ?> 
<!DOCTYPE html>
<html>
<head>
	<title>Registration
    </title>
    <link rel="stylesheet" href="styles\register-style.css">
</head>
<body class="register">

<form class="formdiv" method="post" action="register.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<input type="password" placeholder="Password" name="password_1">
	</div>
	<div class="input-group">
		<input type="password" placeholder="Confirm password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>

