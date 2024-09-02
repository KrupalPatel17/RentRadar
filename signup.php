<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("connect.php");


if (isset($_SESSION['username'])) {
    header("location:home.php");
}

if (isset($_POST['btnsubmit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $encpassword = md5($password);
    $select = "select user_id from tbl_user where user_name='$username'";
    $vselect = "select owner_id from tbl_owners where owner_name='$username'";
    $result = mysqli_query($connect, $select);
    $vresult = mysqli_query($connect, $vselect);
    $count = mysqli_num_rows($result);
    $vcount = mysqli_num_rows($vresult);
    if ($count > 0) {
        echo '<script>alert("Error: User Name Is Already Registered Please Take Another")</script>';
    } elseif ($vcount > 0) {
        echo '<script>alert("Error: User Name Is Already Registered Please Take Another")</script>';
    } else {
        $insert = "insert into tbl_user values(0,'$username','$email',$phone,'$address','$encpassword')";
        if (mysqli_query($connect, $insert)) {

            $otp = rand(111111, 999999);

            $body = "<p> Dear $username,<br>

                Thank you for choosing bid Bazzere for your online shopping needs.<br>
                To ensure the security of your account, we have initiated the verification process for your email address.<br><br>

                Please find below your one-time password (OTP) for verification:<br><br>        

                <b>OTP: <u>$otp</u></b><br><br>

                Kindly use this OTP to verify your email address by entering it on the verification page.<br> 
                If you did not initiate this process or have any concerns regarding the security of your <br>
                account, please contact our customer support immediately.<br><br>

                We appreciate your cooperation in maintaining the security of your account. If you <br>
                have any further questions or require assistance, feel free to reach out to us.<br><br>

                Best regards,<br><br>

                Bid Bazzer Your Shopping Patner</p>";

            require 'Mailer/vendor/autoload.php';
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'patelkrupal679@gmail.com'; // Your Gmail email address
                $mail->Password   = 'gvoi wbtn whnu joic';        // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('patelkrupal679@gmail.com', 'Bid Bazzer');
                $mail->addAddress($email,  $username);

                //Content
                $mail->isHTML(true);
                $mail->Subject = ' Your One-Time Password (OTP) for Verification';
                $mail->Body    = "<p> $body </p>";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            header("location:verification.php");
        } else {
            echo "Fail" or die(mysqli_error($connect));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - SignUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #EAF6F6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login {
            background-color: #FFFFFF;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            position: relative;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .login:hover {
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
            transform: scale(1.02);
        }

        .login h1 {
            color: #333333;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }

        .input-container {
            position: relative;
            margin-bottom: 15px;
        }

        .input-container input {
            width: calc(100% - 40px);
            padding: 10px 10px 10px 40px;
            border-radius: 8px;
            border: 1px solid #CCCCCC;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .input-container i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888888;
            font-size: 18px;
        }

        .input-container input:focus {
            border-color: #009688;
            outline: none;
        }

        .login button {
            width: 100%;
            padding: 12px;
            background-color: #009688;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .login button:hover {
            background-color: #00796B;
            transform: scale(1.05);
        }

        .login a {
            color: #009688;
            text-decoration: none;
            font-size: 14px;
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .login a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .login {
                padding: 30px;
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <form class="login" name="signupForm" action="" method="POST">
        <h1>RentRadar - SignUp</h1>
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="UserName" required>
        </div>
        <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-container">
            <i class="fas fa-phone"></i>
            <input type="tel" id="number" name="number" placeholder="Phone Number" required>
        </div>
        <div class="input-container">
            <i class="fas fa-home"></i>
            <input type="text" id="address" name="address" placeholder="Address" required>
        </div>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" id="button" name="btnsubmit">Sign Up</button>
        <a href="login.php" style="color: black;">Already have an account? <b style="color: #009688;">Login here</b></a>
    </form>
</body>

</html>
