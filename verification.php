<?php
session_start();
include("connect.php");

if (isset($_SESSION['username'])) {
    header("location:home.php");
}

if (isset($_POST['btnsubmit'])) {
    $cotp = $_POST['otp'];

    // Check if OTP is set and valid
    if (isset($_SESSION['otp'])) {
        $otp = $_SESSION['otp'];
        $email = $_SESSION['email'];
        if ($otp == $cotp) {
            // Update verification field in the database
            $updateQuery = "UPDATE tbl_user SET verification = 1 WHERE email = ?";
            $stmt = $connect->prepare($updateQuery);
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                unset($_SESSION['otp']);
                unset($_SESSION['email']);
                header("location:login.php");
                exit();
            } else {
                echo '<script>alert("Error updating verification status. Please try again.")</script>';
            }
        } else {
            echo '<script>alert("Your OTP Was Wrong Please Try Again")</script>';
        }
    }

    if (isset($_SESSION['votp'])) {
        $votp = $_SESSION['votp'];
        $vemail = $_SESSION['vemail'];
        if ($votp == $cotp) {
            // Update verification field in the database
            $updateQuery = "UPDATE tbl_owners SET verification = 1 WHERE email = ?";
            $stmt = $connect->prepare($updateQuery);
            $stmt->bind_param("s", $vemail);

            if ($stmt->execute()) {
                unset($_SESSION['votp']);
                unset($_SESSION['vemail']);
                header("location:login.php");
                exit();
            } else {
                echo '<script>alert("Error updating verification status. Please try again.")</script>';
            }
        } else {
            echo '<script>alert("Your OTP Was Wrong Please Try Again")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - Verify Email</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

        body {
            background-color: #EAF6F6;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .verify {
            background-color: #FFFFFF;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .verify:hover {
            transform: scale(1.02);
        }

        .verify h1 {
            color: #333333;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 24px;
        }

        .verify h5 {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .verify input {
            width: calc(100% - 40px);
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #CCCCCC;
            font-size: 16px;
            transition: border-color 0.3s ease;
            margin-bottom: 20px;
        }

        .verify input:focus {
            border-color: #009688;
            outline: none;
        }

        .verify button {
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

        .verify button:hover {
            background-color: #00796B;
            transform: scale(1.05);
        }

        .verify p {
            margin-top: 15px;
            font-size: 14px;
        }

        .verify a {
            color: #009688;
            text-decoration: none;
            font-weight: 600;
        }

        .verify a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .verify {
                padding: 30px;
                width: 95%;
            }

            .verify input {
                font-size: 14px;
            }

            .verify button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <form class="verify" name="verificationForm" action="" method="POST">
        <h1>Verify Your Email</h1>

        <h5>We've sent a One Time Password (OTP) to <u><?php 
            if (isset($_SESSION['email'])) {
                echo $_SESSION['email'];
            } else {
                echo $_SESSION['vemail'];
            } ?></u></h5>

        <input type="text" placeholder="Enter OTP" name="otp" required>

        <button type="submit" name="btnsubmit">Submit</button>
    </form>
</body>

</html>
