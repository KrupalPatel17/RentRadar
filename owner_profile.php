<?php
session_start();

include("connect.php");

if (!isset($_SESSION['owner_name'])) {
    header("location:login.php");
}

if (isset($_SESSION['owner_id'])) {
    $own_id = $_SESSION['owner_id'];
    $sel = "SELECT * FROM tbl_owners WHERE owner_id=$own_id";
    $res = mysqli_query($connect, $sel);
    $data = mysqli_fetch_assoc($res);
}

if (isset($_POST['btnadd'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    $update_query = "UPDATE tbl_owners SET owner_name='$username', email='$email', phone='$number', addresh='$address' WHERE owner_id=$own_id";

    if (mysqli_query($connect, $update_query)) {
        echo "<script>alert('Profile updated successfully!');</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Rent Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            padding-top: 5%;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;

        }

        .form-container {
            background-color: #ffffff87;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
            margin-top: 0px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            margin-top: 10px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #007bff;
        }

        .form-container input[type="file"] {
            padding: 3px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #009688;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .form-container button:hover {
            background-color: #009688;
        }

        .row select,
        .row input {
            flex: 1;
        }



        .row {
            display: flex;
            justify-content: space-between;
            gap: 11px;
            width: 102%;
            padding-left: 2%;
            margin-bottom: 15px;
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


<body style="background-color: darkgray;">
    <?php include("owner_nav.php"); ?>

    <div class="form-container">
        <h2>Your Profile</h2>
        <form action="" method="POST" id="productForm" enctype="multipart/form-data">
            <div class="input-container">
                &nbsp<i class="fas fa-user"> </i> &nbspUser Name :
                <input type="text" id="username" name="username" placeholder="UserName" value="<?php echo $data['owner_name'] ?>" required>
            </div>
            <div class="input-container">
                &nbsp<i class="fas fa-envelope"></i> &nbspEmail :
                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $data['email'] ?>" required>
            </div>
            <div class="input-container">
                &nbsp<i class="fas fa-phone"></i> &nbspPhone Number :
                <input type="tel" id="number" name="number" placeholder="Phone Number" value="<?php echo $data['phone'] ?>" required>
            </div>
            <div class="input-container">
                &nbsp<i class="fas fa-home"></i> &nbspAddress :
                <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $data['addresh'] ?>" required>
            </div>

            <button type="submit" name="btnadd" id="saveBtn" disabled>Save Changes</button>
        </form>
    </div>
    <script>
        // Get all input fields and the save button
        const inputs = document.querySelectorAll('input');
        const saveBtn = document.getElementById('saveBtn');

        // Disable the button initially
        saveBtn.disabled = true;

        // Add event listener to enable the button when input fields are changed
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                saveBtn.disabled = false;
            });
        });
    </script>
</body>

</html>