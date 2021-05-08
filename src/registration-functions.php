<?php
session_start();
include("server.php");
include("sendmail.php");

// variable declaration
$username = "";
$email    = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['add_user'])) {
	register();
}
if (isset($_POST['save-edit-user'])) {
	update_user_BY_admin();
}
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// call function isUserVerified() if sumbit button clicked
if (isset($_POST['check'])) {
	isUserVerified();
}

// resend code for mail verification
if (isset($_POST['resend'])) {
	sendcodeagain();
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_unset();
	session_destroy(); // destroy the session
	header("location: login.php");
}
function update_user_BY_admin()
{
	global $connection, $username, $errors;
	$id = (int)$_SESSION['id-to-edit'];
	$username = e($_POST['username-update']);
	$pass1 = e($_POST['password1-save']);
	$pass2 = e($_POST['password2-save']);
	$type = $_POST['usertype'];
	if (!empty($username) && $username != $_SESSION['username-to-edit']) {
		if (is_numeric($username[0])) {
			array_push($errors, "Username must start with a letter!");
		} else if (strlen($username) < 3) {
			array_push($errors, "Username must contain at least 3 letters!");
		} else {
			$query = "UPDATE Users SET username='$username' WHERE id=$id";
			if ($connection->query($query) === TRUE) {
				header("Location: ../../admin/users.php");
			}
		}
	}
	if (!empty($pass1)) {

		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $pass1);
		$lowercase = preg_match('@[a-z]@', $pass1);
		$number    = preg_match('@[0-9]@', $pass1);
		$specialChars = preg_match('@[^\w]@', $pass1);

		if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass1) < 8) {
			array_push($errors, "Password should be:");
			array_push($errors, "*at least 8 characters in length");
			array_push($errors, "*include at least one upper case letter");
			array_push($errors, "*one number");
			array_push($errors, "*one special character");
		} else if ($pass1 != $pass2) {
			array_push($errors, "The two passwords do not match");
		} else {
			$pass = md5($pass1);
			$query = "UPDATE Users SET password='$pass' WHERE id=$id";
			if ($connection->query($query) === TRUE) {
				header("Location: ../../admin/users.php");
			}
		}
	} else {
		header("Location: ../../admin/users.php");
	}
	if ($type != $_SESSION['type-to-edit']) {
		$query = "UPDATE Users SET user_type='$type' WHERE id=$id";
		if ($connection->query($query) === TRUE) {
			header("Location: ../../admin/users.php");
		}
	}
}

// LOGIN USER
function login()
{
	global $connection, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM Users WHERE username='$username' or email='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($connection, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['email'] = $logged_in_user['email'];

				$_SESSION['success']  = "You are now logged in";
				if ($logged_in_user['status'] == 'notverified') {
					header('location: user-otp.php');
				} else {
					header('location: admin/dashboard.php');
				}
			} else {
				if ($logged_in_user['status'] == 'notverified') {
					header('location: user-otp.php');
				} else {
					header('location: admin/dashboard.php');
				}
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				$_SESSION['email'] = $logged_in_user['email'];
			}
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function sendcodeagain()
{
	global $connection, $errors, $email;

	$email = $_SESSION['email'];
	$code = rand(999999, 111111);
	$query = "UPDATE Users SET code = $code WHERE email = '$email'";

	$resend = mysqli_query($connection, $query);
	if ($resend) {
		$subject = "Resend Email Verification Code";
		$message = "Your new verification code is $code";
		sendmail($email, $subject, $message);
		array_push($errors, "Please check your email Inbox");
	} else {
		array_push($errors, "Failed while sending code click the resend button again!");
	}
}

//if user click verification code submit button
function isUserVerified()
{
	global $connection, $errors, $name;
	$_SESSION['info'] = "";
	$otp_code = mysqli_real_escape_string($connection, $_POST['otp']);
	if (!empty($otp_code)) {
		$check_code = "SELECT * FROM Users WHERE code = $otp_code";
		$code_res = mysqli_query($connection, $check_code);
		if (mysqli_num_rows($code_res) > 0) {
			$fetch_data = mysqli_fetch_assoc($code_res);
			$fetch_code = $fetch_data['code'];
			$email = $fetch_data['email'];
			// echo $email;
			$code = 0;
			$status = 'verified';
			$update_otp = "UPDATE Users SET code = $code, status = '$status' WHERE email = '$email'";
			$update_res = mysqli_query($connection, $update_otp);
			if ($update_res) {
				$_SESSION['name'] = $name;
				$_SESSION['email'] = $email;
				header('location: admin/dashboard.php');
				exit();
			} else {
				$errors['otp-error'] = "Failed while updating code!";
			}
		} else {
			$errors['otp-error'] = "You've entered incorrect code!";
		}
	} else {
		$errors['otp-error'] = "Please enter the verification code!";
	}
}


// REGISTER USER
function register()
{
	// call these variables with the global keyword to make them available in function
	global $connection, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
	// defined below to escape form values
	$fullname    =  e($_POST['fullname']);
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$user_type   =  $_POST['usertype'];

	// form validation: ensure that the form is correctly filled
	if (empty($fullname)) {
		array_push($errors, "Name is required");
	} else if (strlen($fullname) < 3) {
		array_push($errors, "Name must have at least 3 characters");
	}
	if (empty($user_type)) {
		array_push($errors, "User type is required");
	}
	if (empty($username)) {
		array_push($errors, "Username is required");
	} else {
		if (preg_match('/^[a-zA-Z0-9]+$/', $username) == 0) {
			array_push($errors, "Username must start with a letter!");
		}
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	} else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Email is not valid!");
		}
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	} else {
		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $password_1);
		$lowercase = preg_match('@[a-z]@', $password_1);
		$number    = preg_match('@[0-9]@', $password_1);
		$specialChars = preg_match('@[^\w]@', $password_1);

		if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_1) < 8) {
			array_push($errors, "Password should be:");
			array_push($errors, "*at least 8 characters in length");
			array_push($errors, "*include at least one upper case letter");
			array_push($errors, "*one number");
			array_push($errors, "*one special character");
		}
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//check if email or user name already exist in dababase
		$isEmail_exist = "SELECT * FROM Users WHERE email = '$email'";
		$result_email = mysqli_query($connection, $isEmail_exist);
		$data_email = mysqli_fetch_array($result_email, MYSQLI_NUM);

		$isUsername_exist = "SELECT * FROM Users WHERE username = '$username'";
		$result_username = mysqli_query($connection, $isUsername_exist);
		$data_username = mysqli_fetch_array($result_username, MYSQLI_NUM);

		if ($data_email[0] > 1 && $data_username[0] > 1) {
			array_push($errors, "A user with this email & username already exists!");
		} else if ($data_email[0] > 1) {
			array_push($errors, "A user with this email already exists!");
		} else if ($data_username[0] > 1) {
			array_push($errors, "A user with this username already exists!");
		} else {

			$password = md5($password_1); //encrypt the password before saving in the database
			$code = rand(999999, 111111);
			$status = "notverified";

			$query = "INSERT INTO Users (username, email, fullname, user_type, password,code,status) 
					  VALUES('$username', '$email','$fullname', '$user_type', '$password','$code','$status')";
			$data_check = mysqli_query($connection, $query);
			if ($data_check) {
				$subject = "Email Verification Code";
				$message = "Your verification code is $code";
				sendmail($email, $subject, $message);
				$_SESSION['success']  = "New user successfully created!!";
			} else {
				array_push($errors, "Failed while inserting data into database!");
			}
		}
	}
}

// escape string specail chars if any 
function e($val)
{
	global $connection;
	return mysqli_real_escape_string($connection, trim($val));
}

function display_error()
{
	global $errors;

	if (count($errors) > 0) {
		echo '<div class="error" style="width: 100% !important;">';
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		echo '</div>';
	}
}


function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
		return true;
	} else {
		return false;
	}
}
