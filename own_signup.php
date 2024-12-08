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
    $confirmpassword = $_POST['confirmpassword'];
    
    if ($password !== $confirmpassword) {
        echo '<script>alert("Passwords do not match.")</script>';
    } else {
        $encpassword = md5($password);

        // Handle file upload
        $filename = $_FILES["uploadfile"]["name"];
        $tmpname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "uploads/" . $filename;

        // Check if a file is uploaded
        if ($filename != '') {
            // Check file size (max 100 MB)
            if ($_FILES["uploadfile"]["size"] > 100 * 1024 * 1024) {
                echo '<script>alert("Error: File size exceeds the 100 MB limit.")</script>';
            } else {
                // Move the file to the server folder
                if (!move_uploaded_file($tmpname, $folder)) {
                    echo '<script>alert("Error: File upload failed.")</script>';
                }
            }
        }

        // Check if the username already exists in both user and owner tables
        $select = "SELECT user_id FROM tbl_user WHERE user_name='$username'";
        $vselect = "SELECT owner_id FROM tbl_owners WHERE owner_name='$username'";
        $result = mysqli_query($connect, $select);
        $vresult = mysqli_query($connect, $vselect);
        $count = mysqli_num_rows($result);
        $vcount = mysqli_num_rows($vresult);

        if ($count > 0 || $vcount > 0) {
            echo '<script>alert("Username is already taken. Please choose another.")</script>';
        } else {
            // Insert the data into tbl_owners table
            $insert = "INSERT INTO tbl_owners (owner_id, owner_name, email, phone, addresh, password, uploads, status, verification) 
                       VALUES (0, '$username', '$email', '$phone', '$address', '$encpassword', '$folder', 0,0)";

            if (mysqli_query($connect, $insert)) {
                // Generate OTP for email verification
                $otp = rand(111111, 999999);
                $body = "<html><body style='font-family: Arial, sans-serif; color: #333;'> 
                        <h2 style='color: #009688;'>Welcome to RentRadar, $username!</h2>
                        <p>Thank you for joining RentRadar. To complete your signup and activate your account, please verify your email address using the OTP below:</p>
                        <h3 style='background-color: #f0f0f0; padding: 10px; color: #009688; text-align: center;'>$otp</h3>
                        <p>Enter this OTP on the verification page to finalize your registration. If you didn’t initiate this request, please reach out to our support team immediately.</p>
                        <p>Thank you for trusting RentRadar for your rental needs. We're excited to have you on board!</p>
                        <p>Best regards,<br>RentRadar Team</p>
                        </body></html>";

                require 'Mailer/vendor/autoload.php';
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'patelkrupal679@gmail.com';
                    $mail->Password = 'gvoi wbtn whnu joic';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('patelkrupal679@gmail.com', 'RentRadar');
                    $mail->addAddress($email, $username);

                    $mail->isHTML(true);
                    $mail->Subject = 'Your RentRadar Account Verification OTP';
                    $mail->Body = $body;

                    $mail->send();
                    echo 'Verification email has been sent.';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $_SESSION['votp'] = $otp;
                $_SESSION['vemail'] = $email;
                header("location:verification.php");
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - Owner SignUp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Add your custom styles here */
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
    <form class="login" name="owner_signupForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return validatePhoneNumber();">
        <h1>RentRadar - Owner SignUp</h1>
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="UserName" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
        </div>
        <div class="input-container">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
        </div>
        <div class="input-container">
            <i class="fas fa-phone"></i>
            <input type="tel" id="number" name="number" placeholder="Phone Number" value="<?php echo isset($_POST['number']) ? $_POST['number'] : ''; ?>" required>
        </div>
        <div class="input-container">
            <i class="fas fa-home"></i>
            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>" required>
        </div>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
        </div>
        <div class="input-container">
            <i class="fas fa-file-upload"></i>
            <input type="file" name="uploadfile">
        </div>
        <button type="submit" name="btnsubmit">Submit</button>
        <a href="login.php">Already have an account? Login</a>
    </form>

    <script>
        // Function to validate phone number (Indian phone number format)
        // function validatePhoneNumber() {
        //     var phone = document.getElementById('number').value;
        //     var phonePattern = /^[6-9]\d{9}$/;

        //     if (!phone.match(phonePattern)) {
        //         alert('Please enter a valid 10-digit Indian phone number starting with 6, 7, 8, or 9.');
        //         return false;
        //     }
        //     return true;
        // }
    </script>
</body>

</html>
