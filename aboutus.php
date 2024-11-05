<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - RentRadar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
           
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        #b{
            background-color: darkgray;
        }

        .container {
            margin-top: 5%;
            background-color: #ffffffd9;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            animation: fadeInUp 1s ease-in-out;
            text-align: center;
        }

        h2 {
            color: #009688;
            margin-bottom: 20px;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid #009688;
            display: inline-block;
            padding-bottom: 5px;
        }

        p {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .highlight {
            color: #009688;
            font-weight: bold;
        }

        .about-content {
            margin-bottom: 30px;
        }

        button {
            background-color: #009688;
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 30px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 150, 136, 0.4);
        }

        button:hover {
            background-color: #00796b;
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 150, 136, 0.6);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.8rem;
            }

            p {
                font-size: 1rem;
            }

            button {
                padding: 12px 25px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.9rem;
            }

            button {
                padding: 10px 20px;
            }
        }
    </style>
</head>

<?php include("owner_nav.php"); ?>
<body id="b">

    <div class="container">
        <h2>About Us</h2>
        <div class="about-content">
            <p>Welcome to <span class="highlight">RentRadar</span>, your ultimate solution for finding rental homes easily and conveniently. We are committed to making the process of finding a home seamless for tenants and property owners alike.</p>
            <p>At <span class="highlight">RentRadar</span>, we offer a wide range of properties, from furnished apartments to spacious family homes. Whether you're looking to rent or list, our platform ensures a hassle-free experience with transparency and ease.</p>
            <p>We believe in creating a trustworthy environment where both tenants and property owners can connect effortlessly. Let us help you find your dream home today!</p>
        </div>

        <button onclick="window.location.href='home.php'">Explore Houses</button>
    </div>

</body>

</html>

