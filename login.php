<?php
session_start();
include("connect.php");

if (isset($_SESSION['owner_name'])) {
    header("location:owner_home.php");
}

if (isset($_POST['btnsubmit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select = "SELECT user_id,user_name,password FROM tbl_user WHERE user_name='$username'";
    $vselect = "SELECT owner_id,owner_name,password,status FROM tbl_owners WHERE owner_name='$username'";
    $check = mysqli_query($connect, $select);
    $vcheck = mysqli_query($connect, $vselect);
    $result = mysqli_fetch_assoc($check);
    $vresult = mysqli_fetch_assoc($vcheck);

    // Checking user login
    if (mysqli_num_rows($check) > 0) {
        $fpass = md5($password);
        if ($fpass == $result['password']) {
            $_SESSION['user_name'] = $username;
            $_SESSION['users_id'] = $result['user_id'];
            header("location:landingpage.php");
        } else {
            echo '<script>alert("Either Username Or Password Is Wrong")</script>';
        }
    }

    // Checking owner login and status
    if (mysqli_num_rows($vcheck) > 0) {
        $fpass = md5($password);
        if ($fpass == $vresult['password']) {
            $owner_status = $vresult['status'];  // Get the status of the owner
            $_SESSION['owner_name'] = $username;
            $_SESSION['owner_id'] = $vresult['owner_id'];

            // Check the status of the owner
            if ($owner_status == 0) {
                echo '<script>alert("Your profile is pending for verification. Please wait for approval.")</script>';
            } elseif ($owner_status == 1) {
                header("location:owner_home.php");
            } else {
                echo '<script>alert("Your profile has been declined. Please contact support.")</script>';
            }
        } else {
            echo '<script>alert("Either Username Or Password Is Wrong")</script>';
        }
    } else {
        echo '<script>alert("Either Username Or Password Is Wrong")</script>';
    }

    // Admin login
    if ($username == "admin" && $password == "Krup@l1") {
        header("location:admin.php");
        $_SESSION['admin'] = $password;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - Login</title>

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

    .login {
        background-color: #FFFFFF;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 90%;
        max-width: 400px;
        transition: transform 0.3s ease;
    }

    .login:hover {
        transform: scale(1.02);
    }

    .login h1 {
        color: #333333;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 24px;
    }

    .input-container {
        position: relative;
        margin-bottom: 20px;
        display: flex;  /* Ensures icons and input are aligned */
        align-items: center;
    }

    .input-container input {
        width: 100%; /* Ensures input takes full width minus icon padding */
        padding: 10px 10px 10px 40px;
        border-radius: 8px;
        border: 1px solid #CCCCCC;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .input-container input:focus {
        border-color: #009688;
        outline: none;
    }

    .input-container i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);  /* Ensures icon stays vertically centered */
        color: #888888;
        font-size: 18px;
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

    .login p {
        margin-top: 15px;
        font-size: 14px;
    }

    .login a {
        color: #009688;
        text-decoration: none;
        font-weight: 600;
    }

    .login a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        .login {
            padding: 30px;
            width: 95%;
        }

        .input-container input {
            font-size: 14px;
        }

        .login button {
            font-size: 14px;
            padding: 10px;
        }
    }
</style>

</head>

<body>
    <form class="login" name="signupForm" action="" method="POST">
        <h1>RentRadar</h1>
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username" id="uname" required>
        </div>
        <div class="input-container">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" id="password" required>
        </div>
        <p>Don't have an account? <a href="opction.php">Sign up</a></p>
        <button id="button" name="btnsubmit">Login</button>
    </form>
</body>

</html>
