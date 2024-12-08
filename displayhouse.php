<?php
session_start();
if (isset($_POST['btnlogout'])) {
    unset($_SESSION['user_name']);
    unset($_SESSION['users_id']);
    header("Location: login.php");
    exit(); 
}

include("connect.php");

if (!isset($_SESSION['user_name'])) {
    header("location:login.php");
}
$pid = $_GET['pids'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - View Details</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #444;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 5%;
            background-color: darkgray;
        }

        .product-container {
            display: flex;
            max-width: 1100px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            gap: 20px;
        }

        .product-image {
            width: 50%;
            background-color: #cdcdcd;
            padding: 20px;
            cursor: pointer;
        }

        .product-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid whitesmoke;
        }

        .product-image img:hover {
            transform: scale(1.05);
        }

        .product-info {
            width: 50%;
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            line-height: 1.8;
        }

        .product-info h2,
        .product-info h3 {
            color: #009688;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        .product-info p {
            font-size: 16px;
            color: #555;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .button {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .button-watchlist {
            background-color: #009688;
        }

        .button-watchlist:hover {
            background-color: #00796B;
        }

        .button-contact {
            background-color: #FF6F61;
        }

        .button-contact:hover {
            background-color: #E55A4F;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            border-radius: 10px;
        }

        .modal-content:hover {
            transform: scale(1.05);
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                padding: 15px;
            }

            .product-image,
            .product-info {
                width: 100%;
                padding: 15px;
            }
        }

        #b {
            background-color: darkgray;
        }
    </style>
</head>

<?php include "navbar.php"; ?>
<body id="b">
    <div class="product-container">
        <div class="product-image">
            <?php
            $sql = "SELECT * FROM tbl_house WHERE house_id='$pid'";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>
                <img src="<?php echo $row['img']; ?>" alt="<?php echo $row['p_name']; ?>" id="productImage">
                <div class="button-container">
                    <button class="button button-watchlist" data-id='<?php echo $row["house_id"]; ?>'><i class="ri-heart-line"></i> Add to Watchlist</button>
                    <button data-id='<?php echo $row["house_id"]; ?>' class="button button-contact"><i class="ri-chat-3-line"></i> Contact Owner</button>
                </div>
        </div>
        <div class="product-info">
            <h2>Address Details:</h2>
            <p><strong>House Number:</strong> <?php echo $row['house_num']; ?></p>
            <p><strong>Society:</strong> <?php echo $row['soc_name']; ?></p>
            <p><strong>Landmark:</strong> <?php echo $row['landmark']; ?></p>
            <p><strong>State:</strong> <?php echo $row['state']; ?></p>
            <p><strong>City:</strong> <?php echo $row['city']; ?></p>
            <p><strong>Pincode:</strong> <?php echo $row['pincode']; ?></p>

            <h3>House Information:</h3>
            <p><strong>Members Allowed:</strong> <?php echo $row['members']; ?></p>
            <p><strong>Furnishing:</strong> <?php echo $row['furnishing']; ?></p>
            <p><strong>Rent:</strong> ₹<?php echo $row['rent']; ?></p>
            <p><strong>Bedrooms:</strong> <?php echo $row['num_bed']; ?></p>
            <p><strong>Bathrooms:</strong> <?php echo $row['num_bath']; ?></p>
            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
        </div>
    <?php
            } else {
                echo "<p>No house found with the given ID.</p>";
            }

            $result->free();
            $connect->close();
    ?>
    </div>

    <!-- Modal for Enlarged Image -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="enlargedImage">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Show enlarged image in modal when the image is clicked
        document.getElementById("productImage").onclick = function() {
            document.getElementById("imageModal").style.display = "block";
            document.getElementById("enlargedImage").src = this.src;
        };

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }

        $(document).ready(function() {
            $(".button-watchlist").click(function() {
                var id = $(this).data("id");
                $.ajax({
                    url: "ajax/ajax_add_to_watchlist.php",
                    type: "POST",
                    data: {
                        ids: id
                    },
                    success: function(data) {
                        if (data === "added") {
                            alert("House added to watchlist.");
                        } else if (data === "exists") {
                            alert("House is already in your watchlist.");
                        } else {
                            alert("Error adding to watchlist.");
                        }
                    }
                });
            });

            $(".button-contact").click(function() {
                var id = $(this).data("id");
                $.ajax({
                    url: "ajax/insert_into_contact.php",
                    type: "POST",
                    data: {
                        ids: id
                    },
                    success: function(data) {
                        if (data === "added") {
                            alert("Your Request Has Submited To Owner.");
                        } else if (data === "exists") {
                            alert("Your Request Has Been Already Submited To Owner.");
                        } else {
                            alert("Error adding to Request.");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>