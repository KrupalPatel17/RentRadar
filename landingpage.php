<?php
session_start();
include("connect.php");

if (!isset($_SESSION['user_name'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - Find Your Dream House</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            background: url('pics/bg-home2.png') no-repeat center top;
            background-position: center -60px;
            background-size: contain;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-top: 27%;
        }

        h1 {
            font-size: 4rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
            animation: fadeIn 1.5s ease-in-out;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            text-shadow: 2px 2px 1px black;

        }

        p {
            font-size: 1.5rem;
            margin-bottom: 20px;
            animation: fadeIn 2s ease-in-out;
            font-family: cursive;
        }

        #btn {
            padding: 10px 20px;
            font-size: 1.2rem;
            color: #fff;
            background-color: #009688;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            animation: fadeIn 2.5s ease-in-out;
            border: 1px solid black;
        }


        #btn:hover {
            background-color: #00796b;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<?php include("navbar.php") ?>

<body>
    <div class="overlay"></div>
    <div class="content">
        <h1 style="color: #009688;">RentRadar</h1>
        <p>Find Your Perfect Rental Home Easily</p>
        <button onclick="window.location.href='home.php'" id="btn">Explore Listings</button>
    </div>
</body>

</html>