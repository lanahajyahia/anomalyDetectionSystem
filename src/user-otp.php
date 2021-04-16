<?php require_once "registration-functions.php"; ?>
<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="styles\register-style.css">

</head>

<body class="login">

    <div class="container">

        <div class="row">
            <div class="_8esl">
                <div class="_8esk">
                    <form action="user-otp.php" method="POST" autocomplete="off">
                        <h2 class="text-center">Code Verification</h2>
                        <?php
                        if (isset($_SESSION['info'])) {
                        ?>
                            <div class="alert alert-success text-center">
                                <?php echo $_SESSION['info']; ?>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (count($errors) > 0) {
                        ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                foreach ($errors as $showerror) {
                                    echo $showerror;
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="input-group">
                            <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                        </div>
                        <div class="">
                            <input style="line-height: 33px; width: 17%;" class="btn" type="submit" name="check" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>