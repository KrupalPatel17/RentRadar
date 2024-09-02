<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>RentRadar - Options</title>
    <style>
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

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .login-option {
            width: 250px;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            color: black;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .login-option:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .login-option i {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .login-user {
            background-color: #ffffff;
        }

        .login-owner {
            background: linear-gradient(90deg, #ffffff, #c0c0c0);
        }

        .login-back {
            background-color: #c0c0c0;
        }

        .login-option h2 {
            margin: 10px 0;
            font-size: 18px;
            font-weight: 600;
        }

        .login-option p {
            margin: 10px 0 20px;
            font-size: 14px;
        }

        .btn {  
            background-color: #00796B;
            transform: scale(1.05); 
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 2px solid #fff;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #007265;
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .login-option {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-option login-user animate__animated animate__fadeInLeft">
            <i class="fas fa-user"></i>
            <h2>SignUp as User</h2>
            <p>Click here to SignUp as a User</p>
            <a href="signup.php" style="color: #fff; text-decoration: none;">
                <button class="btn">SignUp</button>
            </a>
        </div>
        <div class="login-option login-owner animate__animated animate__fadeInUp">
            <i class="fas fa-home"></i>
            <h2>SignUp as Owner</h2>
            <p>Click here to SignUp as an Owner</p>
            <a href="own_signup.php" style="color: #fff; text-decoration: none;">
                <button class="btn">SignUp</button>
            </a>
        </div>

        <div class="login-option login-back animate__animated animate__fadeInRight">
            <i class="fas fa-sign-in-alt"></i>
            <h2>Back To Login</h2>
            <p>Click here to Login</p>
            <a href="login.php" style="color: #fff; text-decoration: none;">
                <button class="btn">Login</button>
            </a>
        </div>
    </div>

</body>

</html>
