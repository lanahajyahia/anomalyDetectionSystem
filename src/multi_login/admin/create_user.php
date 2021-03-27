<?php include('../registration-functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create user</title>
	<link rel="stylesheet" type="text/css" href="../styles/register-style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body class="create-user">

	<form class="formdiv "method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<select name="user_type" id="user_type" >
				<option value="user-type" placeholder="user type">choose user type</option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<input type="password" placeholder="Password" name="password_1">
		</div>
		<div class="input-group">
			<input type="password" placeholder="Confirm password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> + Create user</button>
		</div>
	</form>
</body>
</html>