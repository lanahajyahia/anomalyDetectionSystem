<?php include('registration-functions.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="styles/register-style.css">
    <style>
        .findaccount {
            font-size: 20px;
            color: black;
            font-family: SFProDisplay-Bold, Helvetica, Arial, sans-serif;

        }

        .sendcancel {
            float: right;
            display: flex !important;
        }

        .findaccounttext {
            color: black;
            font-family: SFProDisplay-Bold, Helvetica, Arial, sans-serif;
            text-align: initial;
            font-weight: 500;
            margin: 24px !important;

        }

        /* button {
            font-family: SFProDisplay-Bold, Helvetica, Arial, sans-serif  !important;
        } */
    </style>
</head>

<body class="login">
    <div class="_8esk">
        <div class="_8esl" style="padding-top:0 !important">
            <h1 style="color: #1877f2;">
                Anomaly Detection System</h1>
            <div class="_8ice">

                <div class="formdiv" style=" width: 86%;  margin: 0;">
                    <form method="post" action="login.php">
                        <div>
                            <h2 class="findaccount"> Reset Your Password </h2>
                            <p class="findaccounttext"> Type in your email address below and we'll send you an email with instructions on how to create new password </p>

                        </div>
                        <?php echo display_error(); ?>

                        <div class="input-group">
                            <input type="text" name="username" placeholder="Email">
                        </div>

                        <div class="input-group sendcancel">
                            <button style="background-color: #e4e6eb; color: #4b4f56; margin-right:0.5em" type="submit" class="btn">Cancel</button>

                            <button type="submit" class="btn" name="forgotpassword">Send</button>

                        </div>

                <!-- <div class="forgot-pass">
                                        <a class="" href="login.html">Already have an account? Login!</a>
                                    </div> -->
                    </form>
                    
                </div>
            

            </div>
</body>

</html>