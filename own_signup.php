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
        $insert = "insert into tbl_owners values(0,'$username','$email',$phone,'$address','$encpassword')";
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

            $_SESSION['votp'] = $otp;
            $_SESSION['vemail'] = $email;
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
    <title>Document</title>

    <style>
        body {
            background-color: #f45b69;
            font-family: "Asap", sans-serif;
        }

        .login {
            overflow: hidden;
            background-color: white;
            padding: 40px 30px 30px 30px;
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-transition: -webkit-transform 300ms, box-shadow 300ms;
            -moz-transition: -moz-transform 300ms, box-shadow 300ms;
            transition: transform 300ms, box-shadow 300ms;
            box-shadow: 5px 10px 10px rgba(2, 128, 144, 0.2);
        }

        .login::before,
        .login::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 900px;
            border-top-left-radius: 40%;
            border-top-right-radius: 45%;
            border-bottom-left-radius: 35%;
            border-bottom-right-radius: 40%;
            z-index: -1;
        }

        .login::before {
            left: 40%;
            bottom: -130%;
            background-color: rgba(69, 105, 144, 0.15);
            -webkit-animation: wawes 6s infinite linear;
            -moz-animation: wawes 6s infinite linear;
            animation: wawes 6s infinite linear;
        }

        .login::after {
            left: 35%;
            bottom: -125%;
            background-color: rgba(2, 128, 144, 0.2);
            -webkit-animation: wawes 7s infinite;
            -moz-animation: wawes 7s infinite;
            animation: wawes 7s infinite;
        }

        .login>input {
            font-family: "Asap", sans-serif;
            display: block;
            border-radius: 5px;
            font-size: 16px;
            background: white;
            width: 100%;
            border: 0;
            padding: 10px 10px;
            margin: 15px -10px;
        }

        .login>#button {
            font-family: "Asap", sans-serif;
            cursor: pointer;
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            width: 80px;
            border: 0;
            padding: 10px 0;
            margin-top: 10px;
            margin-left: -5px;
            border-radius: 5px;
            background-color: #f45b69;
            -webkit-transition: background-color 300ms;
            -moz-transition: background-color 300ms;
            transition: background-color 300ms;
        }

        .login>#button:hover {
            background-color: #f24353;
        }

        @-webkit-keyframes wawes {
            from {
                -webkit-transform: rotate(0);
            }

            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-moz-keyframes wawes {
            from {
                -moz-transform: rotate(0);
            }

            to {
                -moz-transform: rotate(360deg);
            }
        }

        @keyframes wawes {
            from {
                -webkit-transform: rotate(0);
                -moz-transform: rotate(0);
                -ms-transform: rotate(0);
                -o-transform: rotate(0);
                transform: rotate(0);
            }

            to {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        a {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.6);
            position: absolute;
            right: 10px;
            bottom: 10px;
            font-size: 12px;
        }
    </style>

</head>

<body>
    <form class="login" name="signupForm" action="" method="POST">
        <h1>RentRadar</h1>
        <input type="text" id="username" name="username" placeholder="UserName">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="number" id="number" name="number"  placeholder="Phone Number">
        <input type="text" id="address" name="address"placeholder="Address">
        <input type="password" id="password" name="password" placeholder="Password">
        <input type="password" placeholder="Confirm Password">
        <input type="submit" value="Sign Up" id="button" name="btnsubmit" />
    </form>

   
</body>

</html>