<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Welcome Back, Admin</title>
    <style>
        /* body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: darkgray;
            color: #333;
            text-align: center;
        } */

        #welcome {
            margin-top: 5%;
            color: black;
            font-size: 36px;
            font-weight: bold;
        }

        .blockk {
            width: 22%;
            height: 160px;
            border-radius: 10px;
            margin: 20px;
            display: inline-blockk;
            background-color: #009688;
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border:1px solid black;
        }

        .blockk i {
            font-size: 2rem;
            margin-right: 8px;
        }

        .blockk:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            background-color: #00796B;
            border:2px solid whitesmoke;
        }
        
        .blockk span {
            display: blockk;
            margin-top: 8px;
            font-size: 1rem;
            font-size: 25px;
            border: 1px solid black;
            border-radius: 50%;
            padding: 1px 10px;
            background-color: red;
        }
        #b{
            background-color: darkgray;
        }
        </style>
</head>
<?php include("admin_navbar.php");?>
<body id="b">
    <?php

    include("connect.php");

    $query_users = "SELECT COUNT(*) AS user_count FROM tbl_user";
    $result_users = mysqli_query($connect, $query_users);
    $row_users = mysqli_fetch_assoc($result_users);
    $user_count = $row_users['user_count'];

    // Query to count vendors
    $query_vendors = "SELECT COUNT(*) AS owner_count FROM tbl_owners";
    $result_vendors = mysqli_query($connect, $query_vendors);
    $row_vendors = mysqli_fetch_assoc($result_vendors);
    $owner_count = $row_vendors['owner_count'];

    // Query to count products
    $query_products = "SELECT COUNT(*) AS house_count FROM tbl_house";
    $result_products = mysqli_query($connect, $query_products);
    $row_products = mysqli_fetch_assoc($result_products);
    $house_count = $row_products['house_count'];

    // // Query to count auctions
    // $query_auctions = "SELECT COUNT(*) AS auction_count FROM tbl_auction";
    // $result_auctions = mysqli_query($connect, $query_auctions);
    // $row_auctions = mysqli_fetch_assoc($result_auctions);
    // $auction_count = $row_auctions['auction_count'];

    mysqli_close($connect);
    ?>
  
    <center>
        <div id="welcome">Hello, Welcome Back Admin</div>
        <div>
            <a href="admin_user.php" class="blockk">
                <i class="ri-user-3-fill"></i> Users &nbsp <span> <?php echo $user_count; ?></span>
            </a>
            <a href="admin_owner.php" class="blockk">
                <i class="ri-store-3-fill"></i> Owners &nbsp <span> <?php echo $owner_count; ?></span>
            </a>
        </div>
        <div>
            <a href="admin_house.php" class="blockk">
                <i class="ri-home-4-fill"></i> Houses &nbsp <span> <?php echo $house_count; ?></span>
            </a>
        </div>

</body>

</html>