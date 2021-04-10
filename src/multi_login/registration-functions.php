<?php 
session_start();
include("../server.php");
// connect to database
// $db = mysqli_connect('db', 'root', 'example', 'anomalyDetection');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
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

		$query = "SELECT * FROM Users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($connection, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: ../index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $connection, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$firstname   =  e($_POST['firstname']);
	$lastname    =  e($_POST['lastname']);
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($firstname)) { 
		array_push($errors, "Firstname is required"); 
	}else if(strlen($firstname) < 3){
		array_push($errors,"Firstname must have at least 3 characters");
	}
	if (empty($lastname)) { 
		array_push($errors, "Lastname is required"); 
	}else if(strlen($lastname) < 3){
		array_push($errors,"Lastname must have at least 3 characters");
	}
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}else{
		if (preg_match('/^[a-zA-Z0-9]+$/', $username) == 0) {
			array_push($errors, "Username must start with a letter!"); 
		}
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Email is not valid!");
		}
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}else{
		// Validate password strength
       $uppercase = preg_match('@[A-Z]@', $password_1);
       $lowercase = preg_match('@[a-z]@', $password_1);
       $number    = preg_match('@[0-9]@', $password_1);
       $specialChars = preg_match('@[^\w]@', $password_1);

       if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_1) < 8) {
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
		$result_email = mysqli_query($connection,$isEmail_exist);
		$data_email = mysqli_fetch_array($result_email,MYSQLI_NUM);
	
		$isUsername_exist = "SELECT * FROM Users WHERE username = '$username'";
		$result_username = mysqli_query($connection,$isUsername_exist);
		$data_username = mysqli_fetch_array($result_username,MYSQLI_NUM);
	
		if($data_email[0] > 1 && $data_username[0] > 1){
			array_push($errors,"A user with this email & username already exists!");
		}else if($data_email[0] > 1){
			array_push($errors,"A user with this email already exists!");
		}else if($data_username[0] > 1){
			array_push($errors,"A user with this username already exists!");
		}else{
	
		$password = md5($password_1);//encrypt the password before saving in the database
		$code = rand(999999, 111111);
        $status = "notverified";
		// if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO Users (username, email, firstname, lastname, user_type, password,code,status) 
					  VALUES('$username', '$email','$firstname','$lastname', '$user_type', '$password','$code','$status')";
			$data_check = mysqli_query($connection, $query);
			if($data_check){
				$subject = "Email Verification Code";
				$message = "Your verification code is $code";
				$sender = "From: anomalydetectionregister@gmail.com";
				if(mail($email, $subject, $message, $sender)){
					$info = "We've sent a verification code to your email - $email";
					$_SESSION['info'] = $info;
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					header('location: user-otp.php');
					exit();
				}else{
					array_push($errors,"Failed while sending code!");
				}
			$_SESSION['success']  = "New user successfully created!!";
		}else{
			array_push($errors,"Failed while inserting data into database!");
		}}
	// }else{
	// 		$query = "INSERT INTO Users (username, email, firstname, lastname, user_type, password,code,status) 
	// 				  VALUES('$username', '$email','$firstname','$lastname', '$user_type', '$password','$code',$status)";
	// 		mysqli_query($connection, $query);

	// 		// get id of the created user
	// 		$logged_in_user_id = mysqli_insert_id($connection);

	// 		$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
	// 		$_SESSION['success']  = "You are now logged in";
						
	// 	}
	     	// header('location: ../index.php');
		}	
	
}

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM Users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE Users SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: index.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }


// return user array from their id
function getUserById($id){
	global $connection;
	$query = "SELECT * FROM Users WHERE id=" . $id;
	$result = mysqli_query($connection, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string specail chars if any 
function e($val){
	global $connection;
	return mysqli_real_escape_string($connection, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}